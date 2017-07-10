<?php

namespace Core;

class	Router
{
	protected $routes = [];
	protected $params = [];
	
	public function add($route, $params = [])
	{
		$route = preg_replace('/\//','\\/', $route);
		$route = preg_replace('/\{([a-z-]+)\}/','(?P<\1>[a-z-]+)', $route);
		$route = preg_replace('/\{([a-z-]+):([^\}]+)\}/','(?P<\1>\2)', $route);
		$route = "/^".$route."$/i";
		$this->routes[$route] = $params;
	}

	public function match($query)
	{
		foreach ($this->routes as $route=>$params)
		{
			if (preg_match($route, $query, $matchs))
			{
				foreach ($matchs as $key=>$value)
				{
					if (is_string($key))
						$params[$key] = $value;
				}
				$this->params = $params;
				return true;
			}
		}
		return false;
	}

	public function dispatch($query)
	{
		$query = $this->removeQueryVar($query);
		if ($this->match($query))
		{
			$controller = $this->toStudlyCaps($this->params['controller']);
			$controller = $this->getNamespace($controller);
			if (class_exists($controller))
			{
				$controller_object = new $controller($this->params);
				$action = $this->toCamelCase($this->params['action']);
				if (is_callable([$controller_object, $action]))
				{
					$controller_object->$action();
				}
				else
					echo "Not valide action: ".$action." for controller :".$controller;
			}
			else
				echo "Controller : ".$controller." do not exist";
		}
		else
			echo "No match found";
	}

	protected function getNamespace($controller)
	{
		if ($this->params['namespace'] != '')
			$this->params['namespace'] .= '\\';
		$controller = "App\\Controllers\\".$this->params['namespace'].$controller;
		return ($controller);
	}

	protected function removeQueryVar($query)
	{
		return preg_replace('/&.*$/', '', $query);
	}

	public function toStudlyCaps($str)
	{
		$str = preg_replace('/-/', ' ', $str);
		$str = ucwords($str);
		$str = preg_replace('/ /', '', $str);
		return $str;
	}

	public function toCamelCase($str)
	{
		$str = $this->toStudlyCaps($str);
		$str = lcfirst($str);
		return $str;
	}

	public function getRoutes()
	{
		return $this->routes;
	}

	public function getParams()
	{
		return $this->params;
	}
}
?>
