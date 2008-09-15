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

define('FP_SCRIPT_ROOT', dirname(__FILE__));
require_once(FP_SCRIPT_ROOT . '/l10n.php');

$lang = $_GET['lang'] ? $_GET['lang'] : 'zh_CN';
$domain = 'doc';
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
	$("#configration > ul").tabs();
	$("#developer > ul").tabs();
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
		<li><a href="#configration"><span><?php _e('Configration', $domain); ?></span></a></li>
		<li><a href="#developer"><span><?php _e('Developer', $domain); ?></span></a></li>
	</ul>

	<div id="summary">
		<p id="translate">
			Reload page to:
			<a href="?lang=en">English</a> -
			<a href="?lang=zh_CN">简体中文</a> -
			<a href="?lang=zh_TW">繁體中文</a>
		</p>

		<p><?php _e('Display and choose files from your website. This software was developed with jQuery library, and write by php.', $domain); ?></p>
		<h3><?php _e('Features', $domain); ?></h3>
		<ul>
			<li><?php _e('Multi-languages support', $domain); ?></li>
			<li><?php _e('Without refresh, its request server by AJAX', $domain); ?></li>
			<li><?php _e('Multi-select files, you can pick several file(s) at same time', $domain); ?></li>
			<li><?php _e('Visual interface, its looks like a File Explorer', $domain); ?></li>
			<li><?php _e('Easy to use, just open a new window by JavaScript to request file `file-picker.php` and define an variable to receive the JSON string', $domain); ?></li>
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
		<h3><?php _e('About', $domain); ?></h3>
		<ul>
			<li><?php _e('Program Name', $domain); ?>: File Picker</li>
			<li><?php _e('Version', $domain); ?>: 1.0 builde 20080915 [<a href="HISTORY.txt"><?php _e('View History', $domain); ?></a>]</li>
			<li><?php _e('License', $domain); ?>: <a href="MIT-LICENSE.txt">MIT</a> &amp; <a href="./GPL-LICENSE.txt">GPL</a></li>
			<li><?php _e('Program URI', $domain); ?>: <a href="http://code.google.com/p/file-picker/" target="_blank">http://code.google.com/p/file-picker/</a></li>
			<li><?php _e('Author', $domain); ?>: Hpyer</li>
			<li><?php _e('E-mail', $domain); ?>: <a href="mailto:hpyer@yahoo.cn">hpyer@yahoo.cn</a></li>
			<li><?php _e('Homepage', $domain); ?>: <a href="http://www.hpyer.cn" target="_blank">http://www.hpyer.cn</a></li>
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
	window.open('./file-picker.php?var=FP_RESULT&filter=31&multi=1', '_blank', 'toolbar=no,menubar=no');
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

	<div id="configration">
		<ul>
			<li><a href="#configration-server"><span><?php _e('Server', $domain); ?></span></a></li>
			<li><a href="#configration-client"><span><?php _e('Client', $domain); ?></span></a></li>
		</ul>

		<div id="configration-server">
			<p><?php echo sprintf(__('File `%s`', $domain), 'file-picker.php'); ?></p>
			<ul>
				<li>
					<h3><?php _e('Folder path', $domain); ?></h3>
					<pre><code>define('FP_ROOT_PATH', './media');</code></pre>
				</li>
				<li>
					<h3><?php _e('Folder URI', $domain); ?></h3>
					<pre><code>define('FP_ROOT_URI', '/file-picker/media');</code></pre>
				</li>
				<li>
					<h3><?php _e('Langeuage [Default: zh_CN]', $domain); ?></h3>
					<pre><code>define('FP_LANGUAGE', 'zh_CN');</code></pre>
				</li>
				<li>
					<h3><?php _e('Data format [Default: Y-m-d]', $domain); ?></h3>
					<pre><code>define('FP_DATE', 'Y-m-d');</code></pre>
				</li>
				<li>
					<h3><?php _e('Time format [Default: H:i:s]', $domain); ?></h3>
					<pre><code>define('FP_TIME', 'H:i:s');</code></pre>
				</li>
				<li>
					<h3><?php _e('Separator thousand [Default: ,]', $domain); ?></h3>
					<pre><code>define('FP_THOUSAND', ',');</code></pre>
				</li>
				<li>
					<h3><?php _e('Decimal point [Default: .]', $domain); ?></h3>
					<pre><code>define('FP_DECIMAL', '.');</code></pre>
				</li>
				<li>
					<h3><?php _e('Number of decimals to display [Default: 2]', $domain); ?></h3>
					<pre><code>define('FP_DECIMAL_NUM', 2);</code></pre>
				</li>
			</ul>
		</div>

		<div id="configration-client">
			<p><a href="javascript:void(0);" onclick="$('[href=#demo]').click(); $('[href=#demo-source]').click();"><?php _e('View a demo', $domain); ?></a></p>
			<ol>
				<li>
					<h3><?php _e('Define an variable to receive the JSON string', $domain); ?></h3>
					<pre><code>var FP_RESULT = '';</code></pre>
				</li>
				<li>
					<h3><?php echo sprintf(__('Open a %s', $domain), __('File Picker', $domain)); ?></h3>
					<pre><code>window.open('./file-picker.php?var=FP_RESULT&filter=31&multi=1', '_blank', 'toolbar=no,menubar=no');</code></pre>
					<h4><?php _e('Params of URI', $domain); ?></h4>
					<ul>
						<li>
							<h4>var</h4>
							<pre><code>@desc	<?php _e('Variable to receive the JSON string', $domain); ?> 
@type	string
@default	FP_RESULT</code></pre>
						</li>
						<li>
							<h4>filter</h4>
							<pre><code>@desc	<?php _e('Filters list that can be selected by user', $domain); ?> 
@type	integer
@default	31
@range	1,2,3...126,127
@special value
	1:<?php _e('All files', $domain); ?>	2:<?php _e('Images', $domain); ?>	4:<?php _e('Documents', $domain); ?>
	8:<?php _e('Archives', $domain); ?><br />	16:<?php _e('Flash files', $domain); ?>
	32:<?php _e('Audio files', $domain); ?>	64:<?php _e('Video files', $domain); ?></code></pre>
						</li>
						<li>
							<h4>multi</h4>
							<pre><code>@desc	<?php _e('Is multi-select files', $domain); ?> 
@type	integer
@default	0
@range	1,0</code></pre>
						</li>
					</ul>
				</li>
				<li>
					<h3><?php _e('Parse the result as an object of JSON', $domain); ?></h3>
					<pre><code>var obj;
if (FP_RESULT){
	obj = eval('(' + FP_RESULT + ')');
	alert('uri: ' + obj.uri + '\nfiles: ' + obj.files);
}</code></pre>
				</li>
			</ol>
		</div>
	</div>

	<div id="developer">
		<ul>
			<li><a href="#developer-server"><span><?php _e('Server', $domain); ?></span></a></li>
			<li><a href="#developer-client"><span><?php _e('Client', $domain); ?></span></a></li>
		</ul>

		<div id="developer-server">
			<p><?php echo sprintf(__('File `%s`', $domain), 'classes/FilePicker.php'); ?></p>
			<ul>
				<li>
					<h3>FilePicker::folders</h3>
					<pre><code>@desc	<?php _e('To store all folders', $domain); ?> 
@access	private
@type	array</code></pre>
				</li>
				<li>
					<h3>FilePicker::files</h3>
					<pre><code>@desc	<?php _e('To store all files', $domain); ?> 
@access	private
@type	array</code></pre>
				</li>
				<li>
					<h3>FilePicker::filters</h3>
					<pre><code>@desc	<?php _e('To store description of each filter', $domain); ?> 
@access	private
@type	array</code></pre>
				</li>
				<li>
					<h3>FilePicker::filters_exts</h3>
					<pre><code>@desc	<?php _e('To store extensions of each filter', $domain); ?> 
@access	private
@type	array</code></pre>
				</li>
				<li>
					<h3>FilePicker::json</h3>
					<pre><code>@desc	<?php _e('Object of JSON parser', $domain); ?> 
@access	private
@type	object</code></pre>
				</li>
				<li>
					<h3>FilePicker::FilePicker()</h3>
					<pre><code>@desc	<?php _e('Constructor', $domain); ?> 
@access	public
@return	void</code></pre>
				</li>
				<li>
					<h3>FilePicker::display($var, $filter)</h3>
					<pre><code>@desc	<?php _e('Display the main panel', $domain); ?> 
@param	string	$var	[default:FP_RESULT]
@param	integer	$filter	[default:31]
@access	public
@return	void</code></pre>
				</li>
				<li>
					<h3>FilePicker::get_list($dir, $filter)</h3>
					<pre><code>@desc	<?php _e('Get list by $filter (include files and folders)', $domain); ?> 
@param	string	$dir
@param	integer	$filter	[default:0]	[range:0,1,2,3,4,5,6]
@access	public
@return	string</code></pre>
				</li>
				<li>
					<h3>FilePicker::get_info($dir, $file)</h3>
					<pre><code>@desc	<?php _e('Get information of $file under $dir', $domain); ?> 
@param	string	$dir
@param	string	$file
@access	public
@return	string</code></pre>
				</li>
				<li>
					<h3>FilePicker::do_check($dir)</h3>
					<pre><code>@desc	<?php _e('Make sure $dir is under FP_ROOT_PATH, and it really exist', $domain); ?> 
@param	string	$dir
@access	private
@return	boolean</code></pre>
				</li>
				<li>
					<h3>FilePicker::do_json_encode($obj)</h3>
					<pre><code>@desc	<?php _e('To encode $obj into JSON format', $domain); ?> 
@param	[mixed]	$obj
@access	private
@return	string</code></pre>
				</li>
				<li>
					<h3>FilePicker::get_tree($dir, $level)</h3>
					<pre><code>@desc	<?php _e('Get folder-tree of $dir (recursive)', $domain); ?> 
@param	string	$dir	[default:FP_ROOT_PATH]
@param	string	$level	[default:0]
@access	private
@return	string</code></pre>
				</li>
				<li>
					<h3>FilePicker::get_filters($filter)</h3>
					<pre><code>@desc	<?php _e('Get filters list that can be selected by user', $domain); ?> 
@param	integer	$filter	[default:31]	[range:1,2,3...126,127]
@access	private
@return	string</code></pre>
				</li>
				<li>
					<h3>FilePicker::read_dir($dir)</h3>
					<pre><code>@desc	<?php _e('Read in all files and folders in $dir', $domain); ?> 
@param	string	$dir
@access	private
@return	void</code></pre>
				</li>
				<li>
					<h3>FilePicker::get_permission($file)</h3>
					<pre><code>@desc	<?php _e('Get permission of $filename', $domain); ?> 
@param	string	$file
@access	private
@return	string</code></pre>
				</li>
				<li>
					<h3>FilePicker::get_extension($file)</h3>
					<pre><code>@desc	<?php _e('Get extension of $filename', $domain); ?> 
@param	string	$file
@access	private
@return	string</code></pre>
				</li>
				<li>
					<h3>FilePicker::format_size($size, $decimals, $decimal, $thousand)</h3>
					<pre><code>@desc	<?php _e('Format bit size', $domain); ?> 
@param	integer	$size
@param	integer	$decimals	[default:2]
@param	string	$decimal	[default:.]
@param	string	$thousand	[default:,]
@access	private
@return	string</code></pre>
				</li>
			</ul>
		</div>

		<div id="developer-client">
			<p><?php echo sprintf(__('File `%s`', $domain), 'media/file-picker.js'); ?></p>
			<ul>
				<li>
					<h3>do_complete()</h3>
					<pre><code>@desc	<?php _e('Operation completed, return the JSON string like: {uri:"/path/to/folder", files:["file_1.txt", "file_2.jpg"]}', $domain); ?> 
@return	void</code></pre>
				</li>
				<li>
					<h3>do_close(obj)</h3>
					<pre><code>@desc	<?php _e('Close window, and return the JSON string', $domain); ?> 
@param	string	obj
@return	void</code></pre>
				</li>
				<li>
					<h3>get_uri()</h3>
					<pre><code>@desc	<?php _e('Get the URI of current folder', $domain); ?> 
@return	string</code></pre>
				</li>
				<li>
					<h3>get_selected(with_quote)</h3>
					<pre><code>@desc	<?php _e('Get JSON string that be translated with all the selected file(s)', $domain); ?> 
@return	string</code></pre>
				</li>
				<li>
					<h3>do_select(obj, set_filename)</h3>
					<pre><code>@desc	<?php _e('select the file/folder', $domain); ?> 
@param	object	obj
@param	boolean	set_filename	[default:false]
@return	void</code></pre>
				</li>
				<li>
					<h3>do_unselect()</h3>
					<pre><code>@desc	<?php _e('Unselect all file(s)/folder(s), and clear the information', $domain); ?> 
@return	void</code></pre>
				</li>
				<li>
					<h3>do_show_info(evt)</h3>
					<pre><code>@desc	<?php _e('Show the information box', $domain); ?> 
@param	object	evt
@return	void</code></pre>
				</li>
				<li>
					<h3>do_hide_info(without_box)</h3>
					<pre><code>@desc	<?php _e('Hide the information box', $domain); ?> 
@param	boolean	without_box
@return	void</code></pre>
				</li>
				<li>
					<h3>do_translate_options()</h3>
					<pre><code>@desc	<?php _e('Get JSON string that be translated with all the selected file(s)', $domain); ?> 
@return	string</code></pre>
				</li>
				<li>
					<h3>do_up()</h3>
					<pre><code>@desc	<?php _e('Change the current folder to it parent', $domain); ?> 
@return	void</code></pre>
				</li>
				<li>
					<h3>do_dblclick()</h3>
					<pre><code>@desc	<?php _e('Deal with the incident of double-clicking on the file/folder', $domain); ?> 
@return	void</code></pre>
				</li>
				<li>
					<h3>do_click(evt)</h3>
					<pre><code>@desc	<?php _e('Deal with the incident of clicking on the file/folder', $domain); ?> 
@param	object	event
@return	void</code></pre>
				</li>
				<li>
					<h3>get_info(evt)</h3>
					<pre><code>@desc	<?php _e('Get infomation of the selected file/folder', $domain); ?> 
@return	void</code></pre>
				</li>
				<li>
					<h3>get_list(read_cache)</h3>
					<pre><code>@desc	<?php _e('Get file(s)/folder(s) list of current directory', $domain); ?> 
@param	boolean	read_cache	[default:true]
@return	void</code></pre>
				</li>
				<li>
					<h3>events_binder()</h3>
					<pre><code>@desc	<?php _e('Bind all events that we need', $domain); ?> 
@return	void</code></pre>
				</li>
			</ul>
		</div>
	</div>
</div>
</body>
</html>
