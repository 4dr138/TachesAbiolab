<?php

namespace App\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class checkInfosUsersService extends Controller
{
    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function checkMail($mail)
    {
        $em = $this->getDoctrine()->getManager();
        $existingMail = $em->getRepository('App:Users')->checkUserMail($mail);
        if(empty($existingMail))
        {
            return 'pasOk';
        }
        else
        {
            return 'Ok';
        }
    }

    public function checkPass($pass)
    {
        $em = $this->getDoctrine()->getManager();
        $existingPass = $em->getRepository('App:Users')->checkUserPass($pass);
        if(empty($existingPass))
        {
            return 'pasOk';
        }
        else
        {
            return 'Ok';
        }
    }
}