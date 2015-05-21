<?php

namespace BGP\GlagoljicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavbarController extends Controller
{
    public function indexAction() {
    	
		$clanci = $this->getDoctrine()
        ->getRepository('BGPGlagoljicaBundle:Clanak')
        ->findAll();
        
        return $this->render(
            'BGPGlagoljicaBundle:Navbar:index.html.twig',
            [ 'clanci' => $clanci ]
        );
    }
}

?>