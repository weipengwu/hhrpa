<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>

<script src="/wp-content/plugins/cati/lib/jquery.timepicker.js"></script>


<style>
/*	img.list-image { height: 100px; width: 100px; }

	#image_gallery { border: 4px dashed #DDD; min-height: 75px; width: 500px; }
	#image_gallery div.empty { color: #DDD; text-align: center; margin-top: 25px; }
	#image_gallery img { border: 1px solid #DDD; height: 100px; width: 100px; margin: 10px; }
	#image_gallery img#set-primary { width: 20px; height: 20px; position: absolute; margin-left: -110px; margin-top: 10px;}*/
	label{display:inline-block; width: 100px; font-weight: bold; margin-right:15px; text-align: left; vertical-align: top; padding-top: 4px}
	.wrap h2{margin-bottom:30px;}
	.formrow{margin-bottom: 20px;}
	input[type="text"]{width: 500px;}
	input[type="text"].short{width:160px;}
	textarea{width:500px; height: 200px}
	
	.widefat td{vertical-align: middle;}
	.widefat tbody tr:nth-child(2n+1){background: #eaeaea}
	#del_btn{
		margin-left: 20px;
		padding: 3px 10px;
		height: 28px;
		font-weight: bold; 
		color: white;
		background-color: #FF0000;
		text-shadow: rgba(0, 0, 0, 0.3) 0 -1px 0;
		cursor: pointer;
		border: 1px solid #B10000;
		-webkit-appearance: none;
		-webkit-border-radius: 3px;
		border-radius: 3px;
	}
	#del_btn:hover { background-color:#DF0606; color:#eaf2fa}

	.ui-timepicker-wrapper {
		overflow-y: auto;
		height: 150px;
		width: 6.5em;
		background: #fff;
		border: 1px solid #ddd;
		-webkit-box-shadow:0 5px 10px rgba(0,0,0,0.2);
		-moz-box-shadow:0 5px 10px rgba(0,0,0,0.2);
		box-shadow:0 5px 10px rgba(0,0,0,0.2);
		outline: none;
		z-index: 10001;
		margin: 0;
	}

	.ui-timepicker-wrapper.ui-timepicker-with-duration {
		width: 13em;
	}

	.ui-timepicker-wrapper.ui-timepicker-with-duration.ui-timepicker-step-30,
	.ui-timepicker-wrapper.ui-timepicker-with-duration.ui-timepicker-step-60 {
		width: 11em;
	}

	.ui-timepicker-list {
		margin: 0;
		padding: 0;
		list-style: none;
	}

	.ui-timepicker-duration {
		margin-left: 5px; color: #888;
	}

	.ui-timepicker-list:hover .ui-timepicker-duration {
		color: #888;
	}

	.ui-timepicker-list li {
		padding: 3px 0 3px 5px;
		cursor: pointer;
		white-space: nowrap;
		color: #000;
		list-style: none;
		margin: 0;
	}

	.ui-timepicker-list:hover .ui-timepicker-selected {
		background: #fff; color: #000;
	}

	li.ui-timepicker-selected,
	.ui-timepicker-list li:hover,
	.ui-timepicker-list .ui-timepicker-selected:hover {
		background: #1980EC; color: #fff;
	}

	li.ui-timepicker-selected .ui-timepicker-duration,
	.ui-timepicker-list li:hover .ui-timepicker-duration {
		color: #ccc;
	}

	.ui-timepicker-list li.ui-timepicker-disabled,
	.ui-timepicker-list li.ui-timepicker-disabled:hover,
	.ui-timepicker-list li.ui-timepicker-selected.ui-timepicker-disabled {
		color: #888;
		cursor: default;
	}

	.ui-timepicker-list li.ui-timepicker-disabled:hover,
	.ui-timepicker-list li.ui-timepicker-selected.ui-timepicker-disabled {
		background: #f2f2f2;
	}
</style>