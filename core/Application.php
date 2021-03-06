<?php

namespace app\core;

class Application
{
	public string $userClass;
	public string $layout = "main";
	public static string $ROOT_DIR;
	public Router $router;
	public Request $request;
	public Response $response;
	public Session $session;
	public Database $db;
	public ?DbModel $user;
	public Controller $controller;
	public static Application $app;

	public function __construct($rootPath, array $config)
	{
		$this->userClass = $config["userClass"];
		self::$ROOT_DIR = $rootPath;
		self::$app = $this;
		$this->request = new Request();
		$this->response = new Response();
		$this->session = new Session();
		$this->db = new Database($config["db"]);
		$this->router = new Router($this->request, $this->response);

		$primaryValue = $this->session->get("user");
		if ($primaryValue)
		{
			$primaryKey = $this->userClass::primaryKey();
			$this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
		} else {
			$this->user = null;
		}
	}

	public function getController()
	{
		return $this->controller;
	}

	public function setController($controller)
	{
		$this->controller = $controller;
	}

	public function run()
	{
		try {
			echo $this->router->resolve();
		} catch (\Exception $e) {
			$this->response->setStatusCode($e->getCode());
			echo $this->router->renderView("_error", [
				"exception" => $e
			]);
		}
	}

	public function login(DbModel $user)
	{
		$this->user = $user;
		$primaryKey = $user->primaryKey();
		$primaryValue = $user->{$primaryKey};
		$this->session->set("user", $primaryValue);
		return true;
	}

	public function logout()
	{
		$this->user = null;
		$this->session->remove("user");
	}

	public static function isGuest()
	{
		return !self::$app->user;
	}

	public static function hasWritePermission()
	{
		return self::$app->user && self::$app->user->hasWritePermission();
	}

	public static function hasEditPermission()
	{
		return self::$app->user && self::$app->user->hasEditPermission();
	}

	public static function hasDeletePermission()
	{
		return self::$app->user && self::$app->user->hasDeletePermission();
	}
}