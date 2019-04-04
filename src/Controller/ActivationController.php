<?php

namespace App\Controller;

use App\Entity\Eppn;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Dotenv\Dotenv;
use GuzzleHttp\Client;

class ActivationController extends AbstractController
{
    /**
     * @Route("/activation", name="activation")
     */
    public function index()
    {
	    //Check if user is logged in.
	    $user = $this->getUser();
	    
	    if ($user != null) {
		    
		    //if user is logged in check if eppn already exists in DB.
		    $em = $this->getDoctrine()->getManager();
			$eppn = $em->getRepository(Eppn::class)->findEppn($user->eppn);
		    
		    if (!$eppn) {
			    
			    //if eppn not exist add eppn to DB.
			    $client = new Client([
	
			 		'base_uri' => 'http://hassio.local:1880',
			 		'timeout'  => 2.0,
			 	]);
			 	
		
			 	$response = $client->request('POST', 'account', ['json' => [
			   		
			   		'cn' => 'cn',
			   		'firstName' => $user->givenName,
			   		'lastName' => $user->sn,
			   		'uid' => $user->uid,
			   		'mail' => $user->mail, 		
			   	]]);
			   	
			   	$entityManager = $this->getDoctrine()->getManager();
		
		        $eppn = new Eppn();
		        $eppn->setEppn($user->eppn);
		        $entityManager->persist($eppn);
		        $entityManager->flush();  
	    	}
	    }
	    
	    //Render van pagina en doorsturen.
	    
        return $this->render('activation/activation.html.twig', [
            'logout_url' => getenv('SINGLE_LOGOUT_SERVICE_SP'),
            'portal_url' => getenv('PORTAL_URL'),
        ]);
    }
}
