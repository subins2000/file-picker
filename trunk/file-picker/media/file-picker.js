/*
Program Name: File Picker
Program URI: http://code.google.com/p/file-picker/
Description: Display and choose files from your website.
Version: 1.0 build 20080915

Copyright (c) 2008 Hpyer (hpyer[at]yahoo.cn)
Dual licensed under the MIT (MIT-LICENSE.txt)
and GPL (GPL-LICENSE.txt) licenses.
*/

/*
@desc	Operation completed, return the JSON string like: {uri:"/path/to/folder", files:["file_1.txt", "file_2.jpg"]}
@return	void
*/
function do_complete(){
	var obj = '';
	var uri = get_uri();
	var files = get_selected(true);
	obj = '{' +
		'uri:"' + uri + '", ' +
		'files:[' + files + ']' +
	'}';
	do_close(obj);
}

/*
@desc	Close window, and return the JSON string
@param	string	obj
@return	void
*/
function do_close(obj){
	if (typeof(obj) != 'string') obj = '';
	eval('window.opener.' + FP_RETURN_VAR + '=\'' + obj + '\';');
	window.close();
}

/*
@desc	Get the URI of current folder
@return	string
*/
function get_uri(){
	var uri;
	uri = $.base64.decode($('#folders_tree').val());
	uri = uri == '/' ? '' : uri;
	return FP_RETURN_URI + uri;
}

/*
@desc	Get JSON string that be translated with all the selected file(s)
@return	string
*/
function get_selected(with_quote){
	var t = $('li.selected');
	if (t.length == 1){
		return with_quote ? '"' + t.text() + '"' : t.text();
	}
	return $.map(t, function(li){return '"' + li.innerHTML + '"';}).join(', ');
}

/*
@desc	select the file/folder
@param	object	obj
@param	boolean	set_filename	[default:false]
@return	void
*/
function do_select(obj, set_filename){
	set_filename = set_filename || false;
	obj.addClass('selected');
	$('#filename_box').val(set_filename ? get_selected() : '');
}

/*
@desc	Unselect all file(s)/folder(s), and clear the information
@return	void
*/
function do_unselect(){
	$('li.selected').removeClass('selected');
	$('#filename_box').val('');
	do_hide_info();
}

/*
@desc	Show the information box
@param	object	evt
@return	void
*/
function do_show_info(evt){
	var box = $('#info_box').addClass('info_box').css("top", (evt.pageY + 10) + "px").css("left",(evt.pageX + 10) + "px").fadeIn('fast');
}

/*
@desc	Hide the information box
@param	boolean	without_box
@return	void
*/
function do_hide_info(without_box){
	var box = $('#info_box').empty();
	if (!without_box){
		box.hide();
	}
}

/*
@desc	Get JSON string that be translated with all the selected file(s)
@return	string
*/
function do_translate_options(){
	$('#folders_tree option').each(function(){
		$(this).text($.base64.decode($(this).text()));
	});
}

/*
@desc	Change the current folder to it parent
@return	void
*/
function do_up(){
	var dir = $.base64.decode($('#folders_tree').val());
	var p = dir.lastIndexOf('/');
	if (p < 0 || dir == '/') return false;
	var s = dir.substr(0,p);
	s = (s == '') ? '/' : $.base64.encode(s);
	$('#folders_tree').val(s);
	get_list();
}

/*
@desc	Deal with the incident of double-clicking on the file/folder
@return	void
*/
function do_dblclick(){
	if ($(this).attr('ftype') == 'folder'){
		var dir = $.base64.decode($('#folders_tree').val());
		if (dir != '/') dir += '/';
		$('#folders_tree').val($.base64.encode(dir + $(this).text()));
		get_list();
	} else {
		do_select($(this));
		do_complete();
	}
}

/*
@desc	Deal with the incident of clicking on the file/folder
@param	object	event
@return	void
*/
function do_click(evt){
	do_hide_info();
	if (!FP_MULTI_SELECT){
		do_unselect();
	}
	if (FP_MULTI_SELECT && $(this).attr('ftype') == 'folder'){
		if (!evt.shiftKey){
			// Don't remember this item, if SHIFT key was pushed down
			FP_LAST_CLICK = $(this).attr('id');
		}
		if (evt.ctrlKey){
			// Only one folder can be selected
			return false;
		}
		var t = $('li.selected').removeClass('selected');
		if (t.length == 1 && t.attr('id') == $(this).attr('id')){
			// Unselect current folder if it was selected
			do_unselect();
			return false;
		}
		do_select($(this));
	} else {	// files
		if (evt.ctrlKey){
			FP_LAST_CLICK = $(this).attr('id');
			// Unselect folder(s)
			$('li.selected[ftype=folder]').removeClass('selected');
			// Select/Unselect current file
			$(this).toggleClass('selected');
			$('#filename_box').val(get_selected());
		} else if (FP_MULTI_SELECT && evt.shiftKey){
			// To delay the operation
		} else {
			FP_LAST_CLICK = $(this).attr('id');
			var t = $('li.selected').removeClass('selected');
			if (t.length == 1 && t.attr('id') == $(this).attr('id')){
				// Unselect current file if it was selected
				do_unselect();
				return false;
			}
			do_select($(this), true);
		}
	}
	if (evt.shiftKey){
		if (!FP_LAST_CLICK){
			// Select current item, if no one selected
			FP_LAST_CLICK = $(this).attr('id');
			do_select($(this));
		} else {
			do_unselect();
			var first_id = parseInt(FP_LAST_CLICK.split('_')[1]);
			var this_id = parseInt($(this).attr('id').split('_')[1]);
			if (first_id > this_id){
				$('#list > li').slice(this_id, first_id + 1).each(function(){
					do_select($(this));
				});
			} else {
				$('#list > li').slice(first_id, this_id + 1).each(function(){
					do_select($(this));
				});
			}
		}
		// Unselect Folder(s)
		$('li.selected[ftype=folder]').removeClass('selected');
		$('#filename_box').val(get_selected());
	}
	get_info(evt);
	return false;
}

/*
@desc	Get infomation of the selected file/folder
@return	void
*/
function get_info(evt){
	do_hide_info(true);
	var t = $('li.selected');
	if (t.length == 1){
		// Initialize the information box
		do_show_info(evt);
		$('<img>').attr('id', 'info_loading_img').attr('src', $('#loading_img').attr('src')).appendTo('#info_box');
		$.ajax({
			data:{
				action: 'info',
				dir: $('#folders_tree').val(),
				file: $.base64.encode(t.text())
			},
			success: function(json){
				$('#info_box').html($('<label></label>').attr('id', 'btn_close').text('X').click(function(){do_hide_info(false);}));
				var i = 0;
				$.each(json, function(i, item){
					if ($('#info_box').css('display') == 'none') return false;
					if (item.key == 'preview'){
						var src = get_uri() + '/' + $.base64.decode(item.value);
						var img = $('<img>').attr('id', 'preview_img').attr('alt', item.trans).attr('src', src);
						img.click(function(){window.open(this.src,'_blank','');}).prependTo('#info_box');
					} else {
						if (i == 0){
							item.value = $.base64.decode(item.value);
						}
						$('#info_box').append('<strong>' + item.trans + '</strong>:<br /> &nbsp; ' + item.value + '<br />');
					}
					i++;
				});
			}
		});
	}
}

/*
@desc	Get file(s)/folder(s) list of current directory
@param	boolean	read_cache	[default:true]
@return	void
*/
function get_list(read_cache){
	if ( typeof(read_cache) == 'undefined' ) read_cache = true;
	// Clean memory when the list was change
	window._FP_LAST_CLICK = null;
	do_hide_info();
	$('#loading_img').show();
	$('#list').empty();
	$('#filename_box').val('');
	$.ajax({
		cache: read_cache,
		data: {
			action: 'list',
			dir: $('#folders_tree').val(),
			filter: $('#filter_box').val()
		},
		success: function(json){
			$('#loading_img').hide();
			// To store filename(s) that be used for Auto-Complete
			var files = [];
			$.each(json, function(i,item){
				item.name = $.base64.decode(item.name);
				var li = $('<li></li>').attr('id','item_'+i).attr('ftype',item.type).attr('title', item.name).html(item.name);
				li.addClass(item.type).bind('dblclick', do_dblclick).bind('click', do_click).appendTo('#list');
				if (item.type != 'folder') {
					files.push(item.name);
				}
			});
			$('#filename_box').autocompleteArray(files, {onItemSelect: function(){
				// `Click` the file that selected from the list of Auto-Complete
				$('li:not(li[ftyp:folder])').each(function(){
					if ($(this).html() == $('#filename_box').val()){
						$(this).click();
						return false;
					}
				});
			}});
			do_unselect();

		}
	});
}

/*
@desc	Bind all events that we need
@return	void
*/
function events_binder(){
	$('body').bind('selectstart', function(){return false;});
	$('#file_picker_form').bind('submit', function(){return false;});
	$('#list_box').bind('click', do_unselect);
	$('#folders_tree').bind('change', function(){get_list(true);});
	$('#btn_refresh').bind('click', function(){get_list(false);});
	$('#btn_up').bind('click', do_up);
	$('#btn_complete').bind('click', do_complete);
	$('#btn_cancel').bind('click', do_close);
	$('#info_box').ppdrag();
}
