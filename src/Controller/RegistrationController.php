<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Eppn;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function index()
    {
	    $user = $this->getUser();
	    
	    
	    $em = $this->getDoctrine()->getManager();
		$eppn = $em->getRepository(Eppn::class)->findEppn($user->eppn);
	    
	    if ($eppn) {
		    dump($eppn);
	    }
		

	    
        return $this->render('registration/registration.html.twig', [
            'controller_name' => 'RegistrationController',

        ]);
    }
}
