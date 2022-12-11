<?php
/**
 * User: taykh
 * Date: 12/1/2022
 * Time: 10:14 PM
 **/

namespace app\controllers;

use dmanh0603\phpmvc\Application;
use dmanh0603\phpmvc\middlewares\AuthMiddleware;
use dmanh0603\phpmvc\Request;
use dmanh0603\phpmvc\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends \dmanh0603\phpmvc\Controller
{


    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                $response->redirect('/');
                return;
            }
        }

        $this->setLayout('auth');
        return $this->render('login',[
            'model' => $loginForm
        ]);
    }

    public function register(Request $request)
    {
        $this->setLayout('auth');
        $user = new User();

        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/');
            }


            return $this->render('register', [
                'model' => $user
            ]);
        }
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function logout(Request $request,Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile()
    {
        return $this->render('profile');
    }

}