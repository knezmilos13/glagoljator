<?php

namespace BGP\GlagoljicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GlagoljicaController extends Controller {
	
    public function indexAction($id) {
    	
		$clanak = $this->getDoctrine()->getRepository('BGPGlagoljicaBundle:Clanak')->find($id);
    	
        return $this->render('BGPGlagoljicaBundle:Glagoljica:index.html.twig', [
			'jezik' => 'sr',
			'metaDescription' => $clanak->getMetaDescription(),
			'metaTitle' => 'Glagoljica - ' . $clanak->getMetaNaslov(),
			'title' => $clanak->getNaslov(),
			'clanak' => $clanak
		]);
    }
	
}