<?php

namespace BGP\GlagoljicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class KonvertorController extends Controller {
    public function indexAction() {
        return $this->render('BGPGlagoljicaBundle:Konvertor:index.html.twig', [
			'jezik' => 'sr',
			'metaDescription' => '',
			'metaTitle' => 'Glagoljica - Konverzija u glagoljicu',
			'title' => 'Glagoljica - Konverzija u glagoljicu'
		]);
    }
}
