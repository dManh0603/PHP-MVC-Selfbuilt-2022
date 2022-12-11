<?php
/**
 * User: taykh
 * Date: 12/1/2022
 * Time: 8:16 PM
 **/

namespace app\controllers;

use dmanh0603\phpmvc\Application;
use dmanh0603\phpmvc\Controller;
use dmanh0603\phpmvc\Request;
use dmanh0603\phpmvc\Response;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => 'dMS'
        ];

        return $this->render('home', $params);
    }

    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success', 'Thanks for contacting us.');
                $response->redirect('/contact');
            }
        }
        return $this->render('contact',[
            'model' => $contact
        ]);
    }


}