<?php

namespace BGP\GlagoljicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BGP\GlagoljicaBundle\Konverzija\KonvertorMenadzer;
use BGP\GlagoljicaBundle\Konverzija\CirLatKonvertor;

class KonvertorController extends Controller {
    public function indexAction() {
    	$konvertorMenadzer = new KonvertorMenadzer();
		$konvertorMenadzer->dodajKonvertor(new CirLatKonvertor());
		
        return $this->render('BGPGlagoljicaBundle:Konvertor:index.html.twig', [
			'jezik' => 'sr',
			'metaDescription' => '',
			'metaTitle' => 'Glagoljica - Konverzija u glagoljicu',
			'title' => 'Glagoljica - Konverzija u glagoljicu',
			'ulazi' => $konvertorMenadzer->dajSveUlaze()
		]);
    }
}
