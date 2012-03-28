<?php

class Template
{

	private $template;
	private $blocks;
	private $data;
	private $view;

	public function __construct()
	{
	}
	
	public function init($template, $blocks = null, $data = null)
	{
		$this->template = $template;
		
		if( !is_null($blocks) )
		{
			$this->blocks = $blocks;
		}
		
		if( !is_null($data) )
		{
			$this->data = $data;
		}
	}
	
	public function set_block($key, $val)
	{
		$this->blocks["$key"] = $val;
	}
	
	public function set_view($view)
	{
		$this->view = $view;
	}
	
	public function get_template_url() 
	{
		return _BASEURL_.'template/'.$this->template.'/';
    }
	
	public function render($data = null)
	{
		if( !is_null($data) )
			$this->data = array_merge($this->data, $data);
	
		if( is_array($this->data) && count($this->data) > 0 )
			extract( $this->data, EXTR_PREFIX_SAME, 'wddx');
			
		$template_path = _BASEURL_.'template/'.$this->template.'/';
	
		foreach( $this->blocks as $key => $block )
		{
			if( $key == 'index' && !is_null($this->view) )
			{
				$file = _ROOTPATH_.'app/views/'.$this->view.'.php';
		
				if( !file_exists($file) )
				{
					echo '<h1>View File Not Found</h1>';
					die;
				}
				
				ob_start();
				require_once($file);
				$contents = ob_get_clean();
			}
			else
				$contents = null;
				
			$file = _ROOTPATH_.'template/'.$this->template.'/'.$block.'.php';
		
			if( !file_exists($file) )
			{
				echo '<h1>Template File Not Found</h1>';
				die;
			}
			
			require_once($file);
		}
	}

}