<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Application;
use app\models\User;
use app\models\LoginForm;
use app\core\Request;
use app\core\Response;
use app\core\middlewares\AuthMiddleware;



class AuthController extends Controller
{
	public function __construct()
	{
		$this->registerMiddleware(new AuthMiddleware(["writeArticle"]));
	}

	public function login(Request $request, Response $response)
	{
		$loginForm = new LoginForm();
		if ($request->isPost())
		{
			$loginForm->loadData($request->getBody());
			if ($loginForm->validate() && $loginForm->login())
			{
				Application::$app->session->setFlash("success", "You have successfully logged in.");
				$response->redirect("/");
				return;
			}
		}
		return $this->render("login", [
			"model" => $loginForm
		]);
	}

	public function register(Request $request)
	{
		$user = new User();
		if ($request->isPost())
		{
			$user->loadData($request->getBody());

			if ($user->validate() && $user->register())
			{
				Application::$app->session->setFlash("success", "Account created successfully. Please log in.");
				Application::$app->response->redirect("/");
				exit();
			}

			return $this->render('register', [
				"model" => $user
			]);
		}
		return $this->render("register", [
			"model" => $user
		]);
	}

	public function logout(Request $request, Response $response)
	{
		Application::$app->logout();
		$response->redirect("/");
	}

	public function writeArticle()
	{
		return $this->render("writeArticle");
	}
}