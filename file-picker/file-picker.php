<?php
/*
Program Name: File Picker
Program URI: http://code.google.com/p/file-picker/
Description: Display and choose files from your website.

Copyright (c) 2008 Hpyer (hpyer[at]yahoo.cn)
Dual licensed under the MIT (MIT-LICENSE.txt)
and GPL (GPL-LICENSE.txt) licenses.
*/

// -------------------- Configration begin -------------------------

// Folder path
define('FP_ROOT_PATH', './media');

// Folder URI
define('FP_ROOT_URI', '/eclipse/file-picker/media');

// Langeuage [Default: zh_CN]
define('FP_LANGUAGE', 'zh_CN');

// Data format [Default: Y-m-d]
define('FP_DATE', 'Y-m-d');

// Time format [Default: H:i:s]
define('FP_TIME', 'H:i:s');

// Separator thousand [Default: ,]
define('FP_THOUSAND', ',');

// Decimal point [Default: .]
define('FP_DECIMAL', '.');

// Number of decimals to display [Default: 2]
define('FP_DECIMAL_NUM', 2);

// --------------------- Configration end --------------------------


header('Content-Type: text/html; charset=UTF-8');

define('FP_SCRIPT_ROOT', dirname(__FILE__));
define('FP_CLASS_ROOT', FP_SCRIPT_ROOT . '/classes');
require_once(FP_SCRIPT_ROOT . '/l10n.php');
require_once(FP_CLASS_ROOT . '/JSON.php');
require_once(FP_CLASS_ROOT . '/FilePicker.php');

$lang = FP_LANGUAGE;
load_textdomain(FP_SCRIPT_ROOT . '/languages');

$fp = new FilePicker();
$action = $_GET['action'];

switch ($action){
	case 'list':
		$dir = $_GET['dir'] ? $_GET['dir'] : '/';
		$filter = $_GET['filter'] ? $_GET['filter'] : 0;
		echo $fp->get_list($dir, $filter);
		break;
	case 'info':
		$dir = $_GET['dir'] ? $_GET['dir'] : '/';
		$file = $_GET['file'] ? $_GET['file'] : '';
		echo $fp->get_info($dir, $file);
		break;
	case 'new':
		$dir = $_GET['dir'] ? $_GET['dir'] : '/';
		$folder = $_GET['folder'] ? $_GET['folder'] : 'New Folder';
		$fp->new_folder($dir, $folder);
		break;
	default :
		$key = $_GET['var'] ? $_GET['var'] : 'FP_RESULT';
		$filter = $_GET['filter'] ? $_GET['filter'] : 31;
		$multi = $_GET['multi'] ? true : false;

		$filters = '';
		$filters = $fp->get_filters($filter);

		$tree = '';
		$tree = $fp->get_tree();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php _e('File Picker'); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="./media/file-picker.css" />
<script type="text/javascript" src="./media/jquery/jquery.pack.js"></script>
<script type="text/javascript" src="./media/jquery/jquery.autocomplete.min.js"></script>
<script type="text/javascript" src="./media/jquery/jquery.ppdrag.pack.js"></script>
<script type="text/javascript" src="./media/jquery/jquery.base64.min.js"></script>
<script type="text/javascript" src="./media/file-picker.min.js"></script>
</head>

<body>
<form id="file_picker_form" name="file_picker_form">
<div id="container">
	<div id="header">
		<table cellspacing="0" cellpadding="0"><tr>
			<td class="label"><label><?php _e('Folder'); ?></label>:</td>
			<td><select id="folders_tree" class="select"><option value="Lw==">Lw==</option><?php echo $tree; ?></select></td>
			<td class="button"><ul>
				<li><img id="btn_refresh" src="./media/images/refresh.gif" alt="<?php _e('Refresh'); ?>" /></li>
				<li><img id="btn_up" src="./media/images/up.gif" alt="<?php _e('Up'); ?>" /></li>
			</ul></td>
		</tr></table>
	</div>
	<div id="body">
		<div id="list_box" class="order_list"><img id="loading_img" src="./media/images/loading.gif" alt="<?php _e('Loading...'); ?>" /><ul id="list"></ul></div>
	</div>
	<div id="footer">
		<table cellspacing="0" cellpadding="0"><tr>
			<td class="label"><label for="filename_box"><?php _e('Filename'); ?></label>:</td>
			<td><input type="text" id="filename_box" name="filename" value="" class="select2" /></td>
			<td class="button"> &nbsp; <input type="button" id="btn_complete" value="<?php _e('OK'); ?>" class="btn" /></td>
		</tr></table>
		<table cellspacing="0" cellpadding="0"><tr>
			<td class="label"><label><?php _e('Filter'); ?></label>:</td>
			<td><select id="filter_box" onchange="get_list();" class="select"><?php echo $filters; ?></select></td>
			<td class="button"> &nbsp; <input type="button" id="btn_cancel" value="<?php _e('Cancel'); ?>" class="btn" /></td>
		</tr></table>
	</div>
</div>
<div id="info_box"></div>
</form>
<script type="text/javascript">
$(document).ready(function(){
	//$(window).get(0).resizeTo(400, 360);
	FilePicker.init({
		uri: '<?php echo FP_ROOT_URI; ?>',
		key: '<?php echo $key; ?>',
		multi: <?php echo $multi ? 'true' : 'false'; ?>,
		access: '<?php echo $_SERVER['PHP_SELF']; ?>',
		unicode: true,
		delay: 300
	});
});
</script>
</body>
</html>
<?php
		continue;
}

?>