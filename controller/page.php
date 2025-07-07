<?php 
/**
 * 
 */
class Page
{
	public $path_template='';
	public $path_view='';
	function __construct($path_template='', $path_view='')
	{
		$this->path_template = $path_template;
		$this->path_view = $path_view;
	}

	function layout($template_name='', $file_name='index'){
		if($template_name!=''){
			$this->path_template = 'template/'.$template_name.'/'.$file_name.'.php';
		}
	}

	function view($page_name){
		if( file_exists(glob_page($page_name.'.php')) ){
			$this->path_view = glob_page($page_name.'.php');
		}else{
			$this->path_view = glob_page('404.php');
		}
	}

	function init(){
		if( $this->path_template!='' ){
			if( file_exists($this->path_template) ){
				require $this->path_template;
			}else{
				echo ('template Not Found');
			}
		}
		
	}
}
?>