<?php

namespace BGP\GlagoljicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GlagoljicaController extends Controller {
    public function indexAction() {
        return $this->render('BGPGlagoljicaBundle:Glagoljica:index.html.twig', [
			'jezik' => 'sr',
			'metaDescription' => '',
			'metaTitle' => 'Glagoljica - O glagoljici',
			'title' => 'Glagoljica - O glagoljici'
		]);
    }
}
