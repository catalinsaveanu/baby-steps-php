<?php
namespace Core;

class App{
	protected $controller;
	protected $method = 'index';
	protected $params = [];

	public function __construct() {

		$url = $this->parseUrl();

		if (count($url) > 1) {
			$this->method = $this->normalize(array_pop($url));
		}

		if (count($url) > 0) {
			$controllerPath =  array_map(function($str){
				return $this->normalize($str, false);
			}, $url);
			$controllerClassName = "\\Controllers\\" .implode('\\', $controllerPath);
		}else {
			$controllerClassName = "\\Controllers\\Home";
		}

		echo ('Called Controller: "' . $controllerClassName . '" and method: "' . $this->method . '"');
		echo ("<br>Params: ");
		print_r(array_slice($_GET, 1));

		if(!$this->controller = new $controllerClassName) {
			throw new \Exception("Cannot find Class : " . $controllerClassName);
		}

		if(!method_exists($this->controller, $this->method)) {
			throw new \Exception("Cannot find the right method: " . $this->method . " inside Controller: " . $controllerClassName);
		}

		call_user_func_array([$this->controller, $this->method], $this->params);
	}

	public function parseUrl() {
		if (isset($_GET['url'])) {
			return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}else {
			return [];
		}
	}

	private function normalize($str = '', $firstLetterSmall = true ) {
		$str = str_replace('_', ' ', $str);
		$str = str_replace(' ', '', ucwords($str));

		if ($firstLetterSmall) {
			$str = lcfirst($str);
		}

		return $str;
	}
}