<?php
/*
Program Name: File Picker
Program URI: http://code.google.com/p/file-picker/
Description: Display and choose files from your website.
Version: 1.0 build 20080915

Copyright (c) 2008 Hpyer (hpyer[at]yahoo.cn)
Dual licensed under the MIT (MIT-LICENSE.txt)
and GPL (GPL-LICENSE.txt) licenses.
*/

// -------------------- Configration begin -------------------------

// Folder path
define('FP_ROOT_PATH', './media');

// Folder URI
define('FP_ROOT_URI', '/file-picker/media');

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
require_once(FP_CLASS_ROOT . '/gettext/gettext.class.php');
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
		$var = $_GET['var'] ? $_GET['var'] : '';
		$filter = $_GET['filter'] ? $_GET['filter'] : 31;
		$multi = $_GET['multi'] ? $_GET['multi'] : false;
		$fp->display($var, $filter, $multi);
		continue;
}

?>