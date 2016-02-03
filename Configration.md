## Server ##

> File file-picker.php

  * Folder path
```
define('FP_ROOT_PATH', './media');
```
  * Folder URI
```
define('FP_ROOT_URI', '/file-picker/media');
```
  * Langeuage [Default: zh\_CN]
```
define('FP_LANGUAGE', 'zh_CN');
```
  * Data format [Default: Y-m-d]
```
define('FP_DATE', 'Y-m-d');
```
  * Time format [Default: H:i:s]
```
define('FP_TIME', 'H:i:s');
```
  * Separator thousand [Default: ,]
```
define('FP_THOUSAND', ',');
```
  * Decimal point [Default: .]
```
define('FP_DECIMAL', '.');
```
  * Number of decimals to display [Default: 2]
```
define('FP_DECIMAL_NUM', 2);
```


## Client ##

  1. Define an variable to receive the JSON string
```
var FP_RESULT = '';
```
  1. Open a File Picker
```
window.open('./file-picker.php?var=FP_RESULT&filter=31&multi=1', '_blank', 'toolbar=no,menubar=no');
```
> Params of URI
    * var
```
@desc	Variable to receive the JSON string 
@type	string
@default	FP_RESULT
```
    * filter
```
@desc	Filters list that can be selected by user 
@type	integer
@default	31
@range	1,2,3...126,127
@special value
	1:All files	2:Images	4:Documents	8:Archives	16:Flash files	32:Audio files	64:Video files
```
    * multi
```
@desc	Is multi-select files 
@type	integer
@default	0
@range	1,0
```
  1. Parse the result as an object of JSON
```
var obj;
if (FP_RESULT){
	obj = eval('(' + FP_RESULT + ')');
	alert('uri: ' + obj.uri + '\nfiles: ' + obj.files);
}
```
  1. Demo
```
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>File Picker</title>
<script type="text/javascript">
// Define an variable to receive the JSON string 
var FP_RESULT = '';

function open_win(){
	// Open a File Picker 
	window.open('./file-picker.php?var=FP_RESULT&filter=31&multi=1', '_blank', 'toolbar=no,menubar=no');
}

function get_value(){
	var obj;
	if (FP_RESULT){
		// Parse the result as an object of JSON 
		obj = eval('(' + FP_RESULT + ')');
		alert('uri: ' + obj.uri + '\nfiles: ' + obj.files);
	}
	document.getElementById('result').value = FP_RESULT;
}
</script>
</head>

<body>
	<div>
		<a href="javascript:open_win();">Select file(s)</a> -
		<a href="javascript:get_value();">Get value</a>
	</div>
	<textarea id="result" cols="60" rows="5"></textarea>
</body>
</html>
```