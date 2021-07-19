<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;
use app\core\Application;

class SiteController extends Controller
{
	public function home()
	{
		$params = [
			"name" => "Edvards"
		];
		return $this->render("home", $params);
	}

	public function about()
	{
		return $this->render("about");
	}

	public function books()
	{
		return $this->render("books");
	}

	public function contact(Request $request, Response $response)
	{
		$contactForm = new ContactForm();
		if ($request->isPost())
		{
			$contactForm->loadData($request->getBody());
			if ($contactForm->validate()) {
				Application::$app->session->setFlash("success", "Your message has been sent.");
				return $response->redirect("/contact");
			}
		}
		return $this->render("contact", [
			"model" => $contactForm
		]);
	}
}