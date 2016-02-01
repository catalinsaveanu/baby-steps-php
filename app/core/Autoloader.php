<?php
/**
 * Created by PhpStorm.
 * User: catalin
 * Date: 01/02/16
 * Time: 21:40
 */

namespace Core;


class Autoloader
{
	public function __construct()
	{
		spl_autoload_register(array($this, 'loadClass'));
	}

	private function loadClass($className)
	{
		$sFilePath =  APP_DIR . str_replace('\\', '/', $className) . '.php';

		if (file_exists($sFilePath)) {
			require_once ($sFilePath);
		}else{
			//throw new \Exception("Cannot find file to include : " . $sFilePath);
		}
	}
}