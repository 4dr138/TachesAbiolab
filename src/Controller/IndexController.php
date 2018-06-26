<?php

namespace App\Controller;

use App\Entity\Users;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/", name="login")
     */
    public function indexAction(Request $request)
    {
        $user = new Users();
        $form = $this->createForm("App\Form\UsersType", $user);
        $form->handleRequest($request);

        return $this->render('login.html.twig',array('form' => $form->createView()));
    }
}