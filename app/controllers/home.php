<?php
class Home extends Controller {
	/**
	 * @param string $name
	 * @param string $mood
	 */
	public function index($name = 'cata', $mood = 'happy') {
		$user = $this->model('User');
		$user->name = $name;

		$this->view('home/index', [
			'name' => $user->name,
			'mood' => $mood
		]);
	}
}