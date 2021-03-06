<?php

namespace app\models;

use app\core\Model;
use app\core\Application;

class LoginForm extends Model
{
	public string $username = "";
	public string $password = "";

	public function rules(): array
	{
		return [
			"username" => [self::RULE_REQUIRED],
			"password" => [self::RULE_REQUIRED]
		];
	}

	public function login()
	{
		$user = User::findOne(["username" => $this->username]);
		if (!$user) {
			$this->addError("username", "User with this username does not exist");
			return false;
		}
		if (!password_verify($this->password, $user->password)) {
			$this->addError("password", "Password is incorrect");
			return false;
		}

		return Application::$app->login($user);
	}

	public function labels(): array
	{
		return [
			"username" => "Username",
			"password" => "Password"
		];
	}
}