<?php
namespace Login;

class Login extends \Core\Controller {
	public function index() {
		$this->view('login/index');
	}
}