<?PHP

function format_class_name($class)
{
	$root = dirname(__DIR__);
	$class = str_replace('\\', '/', $class);
	$file = $root.'/'.$class.'.php';
	if (is_readable($file))
		require ($file);
}

echo $_SERVER["QUERY_STRING"];

spl_autoload_register('format_class_name');

$router = new Core\Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'posts', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
$router->add('{controller}/{id:\d+}/{action}');

$router->dispatch($_SERVER["QUERY_STRING"]);
?>
