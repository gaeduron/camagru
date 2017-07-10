<?php
namespace Core;

class Controller
{
	protected $route_params = [];

	public function __construct ($route_params)
	{
		$this->route_params = $route_params;
	}
	
	public function __call ($name, $args)
	{
		$method = $name."Action";
		if (method_exists($this, $method))
		{
			$this->before();
			call_user_func_array([$this, $method], $args);
			$this->after();
		}
		else
			echo "Method: ".$method." not found in controller: ".get_class($this);
	}

	public function before()
	{
		echo "(before)";
	}
	
	public function after()
	{
		echo "(after)";
	}
}
?>
