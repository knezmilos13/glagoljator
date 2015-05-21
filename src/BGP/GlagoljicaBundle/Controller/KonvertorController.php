<?php

namespace BGP\GlagoljicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BGP\GlagoljicaBundle\Konverzija\KonvertorMenadzer;
use BGP\GlagoljicaBundle\Konverzija\CirLatKonvertor;

class KonvertorController extends Controller {
    public function indexAction() {
	    $konvertorMenadzer = $this->get('konvertor_menadzer');
		
        return $this->render('BGPGlagoljicaBundle:Konvertor:index.html.twig', [
			'jezik' => 'sr',
			'metaDescription' => 'Pretvarač (konvertor) teksta u glagoljicu vam omogućava da pretvorite (konvertujete) ćirilične i latinične tekstove u glagoljicu i obrnuto.',
			'metaTitle' => 'Glagoljica - Pretvaranje teksta u glagoljicu',
			'title' => 'Glagoljica - Pretvaranje teksta u glagoljicu',
			'ulazi' => $konvertorMenadzer->dajSveUlaze()
		]);
    }
}
