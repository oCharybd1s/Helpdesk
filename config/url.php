<?php

function base_url($file_name=''){
	return base_url.$file_name;
}

function glob_url($file_name=''){
	return _glob_url.$file_name;
}

function glob_path($file_name=''){
	return glob_path.$file_name;
}

function sis_core($file_name=''){
	return sis_core.$file_name;
}

function glob_page($file_name=''){
	return glob_page.$file_name;
}

function glob_src($file_name=''){
	return glob_src.$file_name;
}

function glob_helper($file_name=''){
	return glob_helper.$file_name;
}

function glob_module($file_name=''){
	return glob_module.$file_name;
}

function glob_api($file_name=''){
	return glob_api.$file_name;
}

function template($file_name=''){
	return base_url.template.$file_name;
}
?>