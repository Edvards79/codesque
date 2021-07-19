<?php

namespace app\models;

use app\core\UserModel;

class User extends UserModel
{
	public const PERMISSION_WRITE = "write";
	public const PERMISSION_EDIT = "edit";
	public const PERMISSION_DELETE = "delete";

	public string $username = "";
	public string $email = "";
	public string $password = "";
	public string $confirmPassword = "";
	public string $permissions = "";

	public function register()
	{
		$this->password = password_hash($this->password, PASSWORD_DEFAULT);
		return $this->save();
	}

	public static function tableName(): string
	{
		return "users";
	}

	public static function primaryKey(): string
	{
		return "id";
	}

	public function rules(): array
	{
		return [
			"username" => [self::RULE_REQUIRED, [self::RULE_UNIQUE, "class" => self::class]],
			"email" => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, "class" => self::class]],
			"password" => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 8], [self::RULE_MAX, "max" => 32]],
			"confirmPassword" => [self::RULE_REQUIRED, [self::RULE_MATCH, "match" => "password"]]
		];
	}

	public function attributes(): array
	{
		return ["username", "email", "password", "permissions"];
	}

	public function labels(): array
	{
		return [
			"username" => "Username",
			"email" => "Email",
			"password" => "Password",
			"confirmPassword" => "Confirm password"
		];
	}

	public function getDisplayName(): string
	{
		return $this->username;
	}

	public function hasWritePermission()
	{
		$permissions = explode(" ", $this->permissions);
		return in_array(self::PERMISSION_WRITE, $permissions);
	}

	public function hasEditPermission()
	{
		$permissions = explode(" ", $this->permissions);
		return in_array(self::PERMISSION_EDIT, $permissions);
	}

	public function hasDeletePermission()
	{
		$permissions = explode(" ", $this->permissions);
		return in_array(self::PERMISSION_DELETE, $permissions);
	}
}