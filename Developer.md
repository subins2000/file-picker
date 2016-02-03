## Server ##

> File classes/FilePicker.php

  * FilePicker::folders
```
@desc	To store all folders 
@access	private
@type	array
```
  * FilePicker::files
```
@desc	To store all files 
@access	private
@type	array
```
  * FilePicker::filters
```
@desc	To store description of each filter 
@access	private
@type	array
```
  * FilePicker::filters\_exts
```
@desc	To store extensions of each filter 
@access	private
@type	array
```
  * FilePicker::json
```
@desc	Object of JSON parser 
@access	private
@type	object
```
  * FilePicker::FilePicker()
```
@desc	Constructor 
@access	public
@return	void
```
  * FilePicker::display($var, $filter)
```
@desc	Display the main panel 
@param	string	$var	[default:FP_RESULT]
@param	integer	$filter	[default:31]
@access	public
@return	void
```
  * FilePicker::get\_list($dir, $filter)
```
@desc	Get list by $filter (include files and folders) 
@param	string	$dir
@param	integer	$filter	[default:0]	[range:0,1,2,3,4,5,6]
@access	public
@return	string
```
  * FilePicker::get\_info($dir, $file)
```
@desc	Get information of $file under $dir 
@param	string	$dir
@param	string	$file
@access	public
@return	string
```
  * FilePicker::do\_check($dir)
```
@desc	Make sure $dir is under FP_ROOT_PATH, and it really exist 
@param	string	$dir
@access	private
@return	boolean
```
  * FilePicker::do\_json\_encode($obj)
```
@desc	To encode $obj into JSON format 
@param	[mixed]	$obj
@access	private
@return	string
```
  * FilePicker::get\_tree($dir, $level)
```
@desc	Get folder-tree of $dir (recursive) 
@param	string	$dir	[default:FP_ROOT_PATH]
@param	string	$level	[default:0]
@access	private
@return	string
```
  * FilePicker::get\_filters($filter)
```
@desc	Get filters list that can be selected by user 
@param	integer	$filter	[default:31]	[range:1,2,3...126,127]
@access	private
@return	string
```
  * FilePicker::read\_dir($dir)
```
@desc	Read in all files and folders in $dir 
@param	string	$dir
@access	private
@return	void
```
  * FilePicker::get\_permission($file)
```
@desc	Get permission of $filename 
@param	string	$file
@access	private
@return	string
```
  * FilePicker::get\_extension($file)
```
@desc	Get extension of $filename 
@param	string	$file
@access	private
@return	string
```
  * FilePicker::format\_size($size, $decimals, $decimal, $thousand)
```
@desc	Format bit size 
@param	integer	$size
@param	integer	$decimals	[default:2]
@param	string	$decimal	[default:.]
@param	string	$thousand	[default:,]
@access	private
@return	string
```


## Client ##

> File media/file-picker.js

  * do\_complete()
```
@desc	Operation completed, return the JSON string like: {uri:"/path/to/folder", files:["file_1.txt", "file_2.jpg"]} 
@return	void
```
  * do\_close(obj)
```
@desc	Close window, and return the JSON string 
@param	string	obj
@return	void
```
  * get\_uri()
```
@desc	Get the URI of current folder 
@return	string
```
  * get\_selected(with\_quote)
```
@desc	Get JSON string that be translated with all the selected file(s) 
@return	string
```
  * do\_select(obj, set\_filename)
```
@desc	select the file/folder 
@param	object	obj
@param	boolean	set_filename	[default:false]
@return	void
```
  * do\_unselect()
```
@desc	Unselect all file(s)/folder(s), and clear the information 
@return	void
```
  * do\_show\_info(evt)
```
@desc	Show the information box 
@param	object	evt
@return	void
```
  * do\_hide\_info(without\_box)
```
@desc	Hide the information box 
@param	boolean	without_box
@return	void
```
  * do\_translate\_options()
```
@desc	Get JSON string that be translated with all the selected file(s) 
@return	string
```
  * do\_up()
```
@desc	Change the current folder to it parent 
@return	voiddo_dblclick()
@desc	Deal with the incident of double-clicking on the file/folder 
@return	void
```
  * do\_click(evt)
```
@desc	Deal with the incident of clicking on the file/folder 
@param	object	event
@return	void
```
  * get\_info(evt)
```
@desc	Get infomation of the selected file/folder 
@return	void
```
  * get\_list(read\_cache)
```
@desc	Get file(s)/folder(s) list of current directory 
@param	boolean	read_cache	[default:true]
@return	void
```
  * events\_binder()
```
@desc	Bind all events that we need 
@return	void
```