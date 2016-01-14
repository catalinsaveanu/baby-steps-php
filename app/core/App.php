<?php
namespace Core;

class App{
	protected $controller = 'Controllers\Home';
	protected $method = 'index';
	protected $params = [];

	public function __construct() {

		$url = $this->parseUrl();

		if(count($url)) {
			$controllerMethod = array_splice($url, 2);
			$this->method = $controllerMethod;

			$controllerPath = array_map(function($element){
				return ucfirst($element);
			}, $url);
			$controllerClassName = "\\Controllers\\" . implode("\\", $controllerPath);

		}

		if(!$this->controller = new $controllerClassName) {
			throw new \Exception("Cannot find Class : " . $controllerClassName);
		}

		$this->normalizeMethod();

		if(!method_exists($this->controller, $this->method)) {
			throw new \Exception("Cannot find the right method: " . $this->method .
			" inside Controller: " . $controllerClassName);
		}

		call_user_func_array([$this->controller, $this->method], $this->params);
	}

	public function parseUrl() {
		if (isset($_GET['url'])) {
			return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}

	private function normalizeMethod()
	{
		$this->method = implode("", $this->method);
		$methodParts = explode("_", $this->method);

		$methodParts = array_map(function($element){
			return ucfirst(strtolower($element));
		}, $methodParts);
		$methodParts[0] = strtolower($methodParts[0]);

		$this->method = implode("", $methodParts);
	}
}