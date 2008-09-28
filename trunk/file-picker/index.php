<?php
/*
Program Name: File Picker
Program URI: http://code.google.com/p/file-picker/
Description: Display and choose files from your website.

Copyright (c) 2008 Hpyer (hpyer[at]yahoo.cn)
Dual licensed under the MIT (MIT-LICENSE.txt)
and GPL (GPL-LICENSE.txt) licenses.
*/

define('FP_SCRIPT_ROOT', dirname(__FILE__));
require_once(FP_SCRIPT_ROOT . '/l10n.php');

$lang = '';
$lang = $_GET['lang'] ? $_GET['lang'] : 'en';
$domain = null;
load_textdomain(FP_SCRIPT_ROOT . '/languages', $domain);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php _e('Document', $domain); ?> - <?php _e('File Picker', $domain); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="./media/doc.css" />
<script type="text/javascript" src="./media/jquery/jquery.pack.js"></script>
<script type="text/javascript" src="./media/jquery/ui.core.pack.js"></script>
<script type="text/javascript" src="./media/jquery/ui.tabs.pack.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#container > ul").tabs();
	$("#demo > ul").tabs();
});

var FP_RESULT = '';

function open_win(){
	window.open('./file-picker.php?var=FP_RESULT&filter=31&multi=1', '_blank', 'toolbar=no,menubar=no');
}

function get_value(){
	var obj;
	if (FP_RESULT){
		obj = eval('(' + FP_RESULT + ')');
		alert('uri: ' + obj.uri + '\nfiles: ' + obj.files);
	}
	document.getElementById('result').value = FP_RESULT;
}
</script>
</head>

<body>
<div id="container">
	<ul>
		<li><a href="#summary"><span><?php _e('Summary', $domain); ?></span></a></li>
		<li><a href="#demo"><span><?php _e('Demo', $domain); ?></span></a></li>
		<li><a href="#about"><span><?php _e('About', $domain); ?></span></a></li>
	</ul>

	<div id="summary">
		<p id="translate">
			Language:
			<a href="?lang=en"><?php _e('English', $domain); ?></a> -
			<a href="?lang=zh_CN"><?php _e('Simplified Chinese', $domain); ?></a> -
			<a href="?lang=zh_TW"><?php _e('Traditional Chinese', $domain); ?></a>
		</p>

		<h3><?php _e('Summary', $domain); ?></h3>
		<p><?php _e('Display and choose files from your website. This software was developed with jQuery library, and write by php.', $domain); ?></p>
		<h3><?php _e('Features', $domain); ?></h3>
		<ul>
			<li><?php _e('Auto-Complete the filename', $domain); ?></li>
			<li><?php _e('File/Folder information, also you can preview image files', $domain); ?></li>
			<li><?php _e('Support unicode character, file(s)/folder(s) named in unicode character will be displayed fine', $domain); ?></li>
			<li><?php _e('Multi-select files, you can pick several file(s) if the CTRL/SHIFT key was pressed down', $domain); ?></li>
			<li><?php _e('Multi-language support', $domain); ?></li>
			<li><?php _e('Without refresh, its request server using AJAX', $domain); ?></li>
			<li><?php _e('Visual interface, its looks like a Explorer of Windows', $domain); ?></li>
			<li><?php _e('Easy to use, just open a new window by JavaScript to request file `file-picker.php` and define an variable to receive the JSON string', $domain); ?></li>
		</ul>
	</div>

	<div id="demo">
		<ul>
			<li><a href="#demo-example"><span><?php _e('Demo', $domain); ?></span></a></li>
			<li><a href="#demo-source"><span><?php _e('View Source', $domain); ?></span></a></li>
		</ul>

		<div id="demo-example">
			<div>
				<a href="javascript:open_win();"><?php _e('Select file(s)', $domain); ?></a> -
				<a href="javascript:get_value();"><?php _e('Get value', $domain); ?></a>
			</div>
			<textarea id="result" cols="60" rows="5"></textarea>
		</div>

		<div id="demo-source">
			<pre><code>&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;
&lt;html xmlns="http://www.w3.org/1999/xhtml"&gt;
&lt;head&gt;
&lt;title&gt;File Picker&lt;/title&gt;
&lt;script type="text/javascript"&gt;
// <?php _e('Define an variable to receive the JSON string', $domain); ?> 
var FP_RESULT = '';

function open_win(){
	// <?php echo sprintf(__('Open a %s', $domain), __('File Picker', $domain)); ?> 
	window.open('./file-picker.php?var=FP_RESULT&amp;filter=31&amp;multi=1', '_blank', 'toolbar=no,menubar=no');
}

function get_value(){
	var obj;
	if (FP_RESULT){
		// <?php _e('Parse the result as an object of JSON', $domain); ?> 
		obj = eval('(' + FP_RESULT + ')');
		alert('uri: ' + obj.uri + '\nfiles: ' + obj.files);
	}
	document.getElementById('result').value = FP_RESULT;
}
&lt;/script&gt;
&lt;/head&gt;

&lt;body&gt;
	&lt;div&gt;
		&lt;a href="javascript:open_win();"&gt;<?php _e('Select file(s)', $domain); ?>&lt;/a&gt; -
		&lt;a href="javascript:get_value();"&gt;<?php _e('Get value', $domain); ?>&lt;/a&gt;
	&lt;/div&gt;
	&lt;textarea id="result" cols="60" rows="5"&gt;&lt;/textarea&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>
		</div>
	</div>

	<div id="about">
		<h3><?php _e('Program', $domain); ?></h3>
		<ul>
			<li><?php _e('Program Name', $domain); ?>: File Picker</li>
			<li><?php _e('Version', $domain); ?>: 1.0.2 builde 20080928 [<a href="HISTORY.txt"><?php _e('View History', $domain); ?></a>]</li>
			<li><?php _e('License', $domain); ?>: <a href="MIT-LICENSE.txt">MIT</a> &amp; <a href="./GPL-LICENSE.txt">GPL</a></li>
			<li><?php _e('Program URI', $domain); ?>: <a href="http://code.google.com/p/file-picker/" target="_blank">http://code.google.com/p/file-picker/</a></li>
			<li><?php _e('Documentation', $domain); ?>: <a href="http://code.google.com/p/file-picker/w/list" target="_blank">http://code.google.com/p/file-picker/w/list</a></li>
		</ul>
		<h3><?php _e('Request', $domain); ?></h3>
		<ul>
			<li><?php _e('Server', $domain); ?>: Apache/IIS + PHP</li>
			<li><?php _e('Client', $domain); ?>: <?php _e('A browser', $domain); ?></li>
		</ul>
		<h3><?php _e('Already tested', $domain); ?></h3>
		<ul>
			<li><?php _e('Server', $domain); ?>: Win XP Pro(SP2) + Apache/2.2.8(win) + PHP/5.2.5, Linux(Core 2.6.18.8) + Apache/2.2.4(unix) + PHP/5.2.6</li>
			<li><?php _e('Client', $domain); ?>: IE 6 SP2, FireFox 3.0.1, Google Chrome 0.2.149.29</li>
		</ul>
		<h3><?php _e('Author', $domain); ?></h3>
		<ul>
			<li><?php _e('Author', $domain); ?>: Hpyer</li>
			<li><?php _e('E-mail', $domain); ?>: <a href="mailto:hpyer@yahoo.cn">hpyer@yahoo.cn</a></li>
			<li><?php _e('Homepage', $domain); ?>: <a href="http://www.hpyer.cn" target="_blank">http://www.hpyer.cn</a></li>
		</ul>
	</div>

</div>
</body>
</html>
