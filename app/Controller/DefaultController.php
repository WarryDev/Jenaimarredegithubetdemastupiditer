<?php

namespace App\Controller;

use App\Weblitzer\Controller;

/**
 *
 */
class DefaultController extends Controller
{

    public function index()
    {
        $message = 'Bienvenue sur le framework MVC';
        $name = 'michel';

        $this->render('app.default.frontpage',array(
            'message' => $message,
            'nom'     => $name
        ));
    }

    public function contact()
    {
        $this->render('app.default.contact');
    }

    public function single($id)
    {
        $this->render('app.default.single', array(
            'id'  => $id
        ));
    }

    public function single2($id,$slug)
    {
        $this->render('app.default.single2', array(
            'id'  => $id,
            'slug' => $slug
        ));
    }

    public function Page404()
    {
        $this->render('app.default.404');
    }

}
