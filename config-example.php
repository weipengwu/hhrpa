<?



function print_rf($val)
{
  echo '<pre>';
  print_r($val);
  echo '</pre>';
}

function me($val)
{
  return mysql_real_escape_string($val);
}

function get_days($sStartDate, $sEndDate){
  
  $sStartDate = gmdate("Y-m-d", strtotime($sStartDate));
  $sEndDate = gmdate("Y-m-d", strtotime($sEndDate));

  $aDays[] = $sStartDate;

  $sCurrentDate = $sStartDate;

  while($sCurrentDate < $sEndDate){
    
    $sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  
    $aDays[] = $sCurrentDate;
  }

  return $aDays;
}

$GLOBALS['default'] = $GLOBALS['wpdb']->dbh;


define('PLUGIN_ROOT', __DIR__);
define('SALTY', 'jerryisfunny');

require_once(PLUGIN_ROOT . '/lib/Row.php');
// require_once(PLUGIN_ROOT . '/controllers/CronController.php');
// require_once(PLUGIN_ROOT . '/models/MioUser.php');


$paths = array( PLUGIN_ROOT . '/models',
        PLUGIN_ROOT . '/lib',
        PLUGIN_ROOT . '/controllers',
        );

set_include_path(get_include_path() . ':' . implode(":", $paths));

?>