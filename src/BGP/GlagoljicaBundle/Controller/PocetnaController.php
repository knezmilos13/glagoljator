<?php

namespace BGP\GlagoljicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PocetnaController extends Controller {
    public function indexAction() {
        return $this->render('BGPGlagoljicaBundle:Pocetna:index.html.twig', [
			'jezik' => 'sr',
			'metaDescription' => 'Projekat "Glagoljica" - prvi srpski sajt o glagoljičnom pismu.',
			'metaTitle' => 'Glagoljica',
			'title' => 'Glagoljica'
		]);
    }
}
