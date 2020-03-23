<?php

// app/Controller/AbonneController

namespace App\Controller;

use App\Service\Form;
use App\Service\Validation;
use App\Weblitzer\Controller;
use App\Model\AbonneModel;


class AbonneController extends Controller
{
    public function index()
    {
        // aller chercher tous les abonnes
        $abonnes = AbonneModel::all();
        $count = AbonneModel::count();
        //$this->debug($abonnes);
        $this->render('app.abonne.listing',array(
            // faire passer les abonnes à la vue dans view/app/abonne/listing.php
            'abonnes' => $abonnes,
            'count' => $count
        ));
    }

    public function single($id)
    {
        // request pour aller chercher l'abonne qui possede cet id
        $abonne = AbonneModel::findById($id);
        if(empty($abonne)) {
            // si abonne n'existe pas dans la BDD => error 404
            //die('404');
            $this->Abort404();
        }
        $this->render('app.abonne.single',array(
            // faire passer l'abonne à la vue dans view/app/abonne/single.php
            'abonne' => $abonne
        ));

    }

    public function add()
    {
        $errors = array();
        if(!empty($_POST['submitted'])) {
            // protection Faille xss
            $post = $this->cleanXss($_POST);
            // validation
            $validation = new Validation();
            $errors['nom'] = $validation->textValid($post['nom'], 'nom',3,  30);
            $errors['prenom'] = $validation->textValid($post['prenom'], 'prenom',1,  50);
            $errors['email'] = $validation->emailValid($post['email'], 'email',1,  50);
            $errors['age'] = $validation->textValid($post['age'], 'age',1,  3);


            if($validation->IsValid($errors)) {
                // insert
                AbonneModel::insert($post);
                $this->redirect('abonnes');
            }
        }
        $form = new Form($errors);
        $this->render('app.abonne.add',array(
            'form'  => $form
        ));
    }

    public function update($id)
    {
        $errors = array();
        $abonne = AbonneModel::findById($id);
        if(empty($abonne)) { $this->Abort404(); }
        if(!empty($_POST['submitted'])) {
            $post = $this->cleanXss($_POST);
            $validation = new Validation();
            $errors['nom'] = $validation->textValid($post['nom'], 'nom',3,  30);
            $errors['prenom'] = $validation->textValid($post['prenom'], 'prenom',1,  50);
            $errors['email'] = $validation->emailValid($post['email'], 'email',1,  50);
            $errors['age'] = $validation->textValid($post['age'], 'age',1,  3);


            if($validation->IsValid($errors)) {
                // update
                AbonneModel::update($id,$post);
                $this->redirect('abonnes');
            }
        }
        $form = new Form($errors);
        $this->render('app.abonne.update',array(
            'form'     => $form,
            'abonne'  => $abonne
        ));
    }

    public function delete($id)
    {
      $this->ifAbonneExistOr404($id);
      AbonneModel::delete($id);
      $this->redirect('abonnes');
    }

    private function ifAbonneExistOr404($id)
    {
        $abonne = AbonneModel::findById($id);
        if(empty($abonne)) {
            $this->Abort404();
        }
        return $abonne;

    }

}
