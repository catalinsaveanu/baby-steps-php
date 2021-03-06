<?php
namespace Controllers;

class Home extends \Core\Controller {
	/**
	 * @param string $name
	 * @param string $mood
	 */
	public function index($name = 'cata', $mood = 'happy') {
		$user = new \Models\User;
		$user->name = $name;

		return $this->view('Home/Index', [
			'name' => $user->name,
			'mood' => $mood
		]);
	}

	/*$user = new User(1);
	$user->username = "Something Nice";
	$user->save();

	UserCollection()
		- find
		- save()

	$userCollection = User::find([
		'id', '>' , '10'
	]);*/
}