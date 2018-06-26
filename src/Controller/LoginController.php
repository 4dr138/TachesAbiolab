<?php

namespace App\Controller;

use App\Entity\Users;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    /**
     * @Route("/", name="login")
     */
    public function loginAction(Request $request)
    {
        $user = new Users();
        $form = $this->createForm("App\Form\UsersType", $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mail = $request->request->get('users')['mail'];
            $pass = $request->request->get('users')['password'];

            $okmail = $this->get('app.checkinfosservice')->checkMail($mail);
            if($okmail == 'pasOk')
            {
                $this->addFlash("error", "Votre email n'est pas enregistré. Veuillez réessayer ou contacter l'administrateur !");
                return $this->redirectToRoute('login');
            }
            else
            {
                $okPass = $this->get('app.checkinfosservice')->checkPass($pass);
                if($okPass == 'pasOk')
                {
                    $this->addFlash("error", "Attention, le mot de passe n'est pas bon. Veuillez réessayer ou contacter l'administrateur !");
                    return $this->redirectToRoute('login');
                }
                else
                {
                    dump('hello');exit;
                }

            }
        }
            // On check l'existence du mail dans la base
//            $mailExistant = $this->container->get('appbundle.forgotmail')->checkMail($user->getMail());
//
//            if($mailExistant == false) {
//                $em = $this->getDoctrine()->getManager();
//
//                $userSon = $request->request->get('users');
//                $godsonCode = $userSon['godsonCode'];
//                $ExperienceService->ExpParrainage($godsonCode);
//
//                // Par défaut, on attribue le role amateur au nouvel inscrit
//                $user->setRoles(['ROLE_AMATEUR']);
//                $user->setGodfatherCode($CodeGodFatherService->generateCode());
//
//                $em->persist($user);
//                $em->flush();
//                //            $this->container->get('appbundle.mailservice')->sendConfirmationMail($user);
//                $this->addFlash("success", "Votre inscription a bien été prise en compte, vous allez recevoir un mail de confirmation !");
//                return $this->redirectToRoute('connexion');
//            }
//            else{
//                $this->addFlash("error", "Vous avez déjà un compte chez nous, veuillez vous identifier directement");
//                return $this->redirectToRoute('inscription');
//            }

        return $this->render('login/login.html.twig',array('form' => $form->createView()));
    }
}