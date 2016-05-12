<?

class Row
{	
	private static $_table_cache = array();

	public function __construct()
	{
		
	}
	
	public function save()
	{
		$pk = static::_get_primary_key();
		
		if (!isset($this->{$pk}))
		{
			$this->created_at = date('Y-m-d H:i:s');
			$this->updated_at = date('Y-m-d H:i:s');
			return static::insert($this);
		}
		else 
		{
			$this->updated_at = date('Y-m-d H:i:s');
			return static::update($this);
		}
	}
	
	public static function _get_primary_key()
	{
		return static::$_primary_key;
	}
	
	public function __get($name)
	{
		if (in_array($name, array('db_connection', 'new_record')))
			return null;

		if (!isset(static::$_relationships))
			return null;	
			
		foreach ((array)static::$_relationships as $key => $relation)
		{
			if ($name == $key)
			{
				if (!isset($relation['type']))
					throw new Exception('The type of relationship was not specified for key: ' . $key);

				if (!isset($relation['foreign_key']))
					throw new Exception('The foreign key of a relationship was not specified for key: ' . $key);

				if (!isset($relation['model']))
					throw new Exception('The related model of a relationship was not specified for key: ' . $key);

				switch ($relation['type'])
				{
					case 'has_many':

						$conditions = array();
						foreach ($relation['foreign_key'] as $to_key => $from_key)
						{
							if (!isset($this->{$from_key}))
								return array();
							$conditions[] = "{$to_key} = '{$this->{$from_key}}'";
						}

						if (isset($relation['additional_where']))
							$conditions[] = $relation['additional_where'];
						
						$m = $relation['model'];
						$data = $m::find_all(array(), implode(" AND ", $conditions), isset($relation['order']) ? $relation['order'] : null, null);

						$this->{$name} = array();
						if (isset($relation['key_on']))
						{
							foreach ($data as $dat)
							{
								$this->{$name}[$dat->{$relation['key_on']}] = $dat;
							}
						}
						else
						{
							foreach ($data as $dat)
							{
								$this->{$name}[] = $dat;
							}
						}

						break;
					case 'has_one':
						
						$conditions = array();

						foreach ($relation['foreign_key'] as $to_key => $from_key)
						{
							$conditions[] = "{$to_key} = '{$this->{$from_key}}'";
						}
						
						if (isset($relation['additional_where']))
							$conditions[] = $relation['additional_where'];

						$m = $relation['model'];
						$this->{$name} = array_shift($m::find_all(null, implode(" AND ", $conditions), isset($relation['order']) ? $relation['order'] : null, null));	
						
						break;

				}
			}
		}

		if (isset($this->{$name}))
			return $this->{$name};
		else
			return null;
	}

	public function populate($data)
	{
		foreach ((array)$data as $key => $value)
		{
			$this->{$key} = $value;
		}
	}
	
	public function to_xml()
	{
		$fields = Table::_get_fields(static::$_table_name, static::$_connection_name);
		
		$tag_name = strtolower(get_class($this));
		
		$xml = '';
		
		$xml .= '<' . $tag_name . ' ';
		
		foreach ($fields as $field)
		{
			$xml .= strtolower($field) . '="' . htmlentities($this->{$field}) . '" ';	
		}
			
		$child_xml = '';
		
		foreach ((array)$this->relationships as $rel_key => $data)
		{
			if (isset($this->{$rel_key}))
			{
				if ($this->{$rel_key} instanceof Row)
				{
					$inner_xml_obj = $this->{$rel_key};
					$child_xml .= $inner_xml_obj->to_xml();
				}	
				elseif (is_array($this->{$rel_key}))
				{
					$xml_collection = $this->{$rel_key};
					
					foreach ($xml_collection as $inner_xml_obj)
					{
						$child_xml .= $inner_xml_obj->to_xml();		
					}
				}
			}
		}
		
		if (!$child_xml)
		{
			$xml .= '/>';
		}
		else 
		{	
			$xml .= '>' . $child_xml . '</' . $tag_name . '>';
		}
		
		return $xml;
	}
	
	public static function _get_fields($table_name, $connection)
	{
		if (isset(self::$_table_cache[$table_name]))
			return self::$_table_cache[$table_name];
			
		$fieldset = self::run_query("DESC " . static::$_table_name, static::$_connection_name);
		
		while ($row = mysql_fetch_assoc($fieldset))
		{
			$fields[] = $row['Field'];
		}
				
		return self::$_table_cache[$table_name] = $fields;
	}
	
	public static function update(Row $row)
	{
		$table_fields = self::_get_fields(static::$_table_name, static::$_connection_name);
		
		$fields = array();
		foreach ($table_fields as $field)
		{
			if ($field != static::$_primary_key)
			{
				if (is_null($row->$field))
					$fields[] = '`' . $field . "` = NULL";
				else
					$fields[] = '`' . $field . "` = '" . mysql_real_escape_string($row->$field) . "'";
			}
		}
		
		$sql = "UPDATE " . static::$_table_name . " SET " . implode(",", $fields) . " WHERE " . static::$_primary_key . " = '" . $row->{static::$_primary_key} . "'";
		
		$resource = self::run_query($sql, static::$_connection_name);
		
		return $row;
	}
	
	public static function insert(Row $row)
	{
		$table_fields = self::_get_fields(static::$_table_name, static::$_connection_name);
		
		$fields = array();
		$values = array();
		
		foreach ($table_fields as $field)
		{
			if (isset($row->$field))
			{
				$fields[] = '`' . $field . '`';
				
				$values[] = @mysql_real_escape_string($row->$field);
			}
		}
		
		$sql = "INSERT INTO " . static::$_table_name . " (" . implode(",", $fields) . ") VALUES ('" . implode("','", $values) . "');";
		
		$resource = self::run_query($sql, static::$_connection_name);
		
		

		$pk_id = mysql_insert_id($GLOBALS[static::$_connection_name]);
		
		$primary_key = static::$_primary_key;
		$row->$primary_key = $pk_id;
		
		return $row;
	}
	
	// single
	public static function find($relationships = null, $selector, $connection = null)
	{
		$wheres = array();
		
		foreach ($selector as $key => $value)
		{
			$wheres[] = $key . " = '" . mysql_real_escape_string($value) . "'";
		}

		return array_shift(self::find_all($relationships, implode(" AND ", $wheres), null, 1, $connection));
	}

	public static function build_join(&$value, $relationships)
	{
		foreach ($relationships as $tag => $sub_tag)
		{
			$value->$tag;

			if (count($sub_tag) > 0)
			{	
				$v = get_class_vars(get_called_class());

				if ($v['_relationships'][$tag]['type'] == 'has_one')
				{
					if ($sub_tag)
					{
						call_user_func_array(array(get_class($value->$tag), 'build_join'), array(&$value->$tag, $sub_tag));
					}
				}
				else
				{
					foreach ((array)$value->$tag as $s_tag => $item)
					{
						if ($sub_tag)
						{
							$tmp = $value->$tag;
							call_user_func_array(array(get_class($item), 'build_join'), array(&$tmp[$s_tag], $sub_tag));
						}
					}
				}
			}
		}
	}
	
	// multiple
	public static function find_all($relationships = null, $where = null, $order = null, $limit = null, $connection = null)
	{
		$sql = "SELECT * FROM " . static::$_table_name . " ";

		if (!is_null($where))
			$sql .= "WHERE " . $where . " ";
		
		if (!is_null($order))
			$sql .= "ORDER BY " . $order . " ";
		
		if (!is_null($limit))
			$sql .= "LIMIT " . $limit;
				
		return self::find_by_sql($relationships, $sql, $connection);
	}
	public static function get_count($where = null)
	{
		$sql = "SELECT count(1) AS `co` FROM " . static::$_table_name . " ";
    	if (!is_null($where))
    		$sql .= "WHERE " . $where . " ";
	    $connection_name = static::$_connection_name;
        $resource = mysql_query($sql, $GLOBALS[$connection_name]);
        if (mysql_error($GLOBALS[$connection_name]))
        {
        	throw new Exception(mysql_error($GLOBALS[$connection_name]));
        }
        $row = mysql_fetch_assoc($resource);
        return $row['co'];
	}
	// any
	public static function find_by_sql($relationships = null, $sql, $connection = null)
	{
		$connection_name = static::$_connection_name;
		
		$resource = mysql_query($sql, $GLOBALS[$connection_name]);
		
		if (mysql_error($GLOBALS[$connection_name]))
		{
			throw new Exception(mysql_error($GLOBALS[$connection_name]));
		}
		
		$results = self::create_set($resource);

		foreach ($results as $key => $value)
		{
			if (count($relationships) > 0)
				static::build_join($results[$key], $relationships);
		}

		return $results;
	}
	
	public static function create_set($resource)
	{
		$result = array();
		
		while ($row = mysql_fetch_assoc($resource))
		{
			$cn = get_called_class();
			$row_obj = new $cn();
			
			$row_obj->populate($row);
	
			$result[] = $row_obj;		
		}
		
		return $result;
	}
	
	public static function _get_class()
	{
		return __CLASS__;
	}
	
	public static function run_query($sql, $connection)
	{
		$resource = mysql_query($sql, $GLOBALS[$connection]);
	
		if (mysql_error($GLOBALS[$connection]))
		{
			throw new Exception(mysql_error($GLOBALS[$connection]));
		}		
		
		return $resource;
	}
	
	public static function delete(Row $row)
	{
		$sql = "DELETE FROM " . static::$_table_name . " WHERE id = '" . $row->id . "' LIMIT 1";
		
		mysql_query($sql, $GLOBALS[static::$_connection_name]);
	}

	public static function delete_all($row_array)
	{	
		$pk = static::$_primary_key;

		$ids = array();
		foreach($row_array as $row){
			$ids[] = "'" . me($row->$pk) . "'";
		}

		$sql = "DELETE FROM " . static::$_table_name . " WHERE " . $pk . " in (" . implode(",", $ids) . ")";
		mysql_query($sql, $GLOBALS[static::$_connection_name]);
	}

	public static function delete_where($conditions)
	{
		if (!$conditions)
		{
			throw new Exception('You must pass a condition into Row::delete_where');
		}
		
		$sql = "DELETE FROM " . static::$_table_name . " WHERE " . $conditions;
		
		mysql_query($sql, $GLOBALS[static::$_connection_name]);
	}
}