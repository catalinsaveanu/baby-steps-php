<?php
namespace Controllers;

class Login extends \Core\Controller {
	public function index() {
		$this->view('Login/index');
	}
}