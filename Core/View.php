<?php
namespace Core;

class View
{
	public function render($view, $args = [])
	{
		$file = "./App/Views/".$view;
		extract ($args, EXTR_SKIP);

		if (is_readable($file))
			require ($file);
		else
			echo "$file not found";
	}
}
?>
