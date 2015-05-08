<?php

namespace BGP\GlagoljicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BGP\GlagoljicaBundle\Konverzija\KonvertorMenadzer;
use BGP\GlagoljicaBundle\Konverzija\CirLatKonvertor;
use Symfony\Component\HttpFoundation\JsonResponse;

/** REST, vraca spisak izlaza za zadati ulaz */
class DajIzlazeZaUlazController extends Controller {
    	
    public function indexAction($ulaz) {
	    $konvertorMenadzer = $this->get('konvertor_menadzer');
		
        $izlazi = $konvertorMenadzer->dajSveIzlazeZaUlaz($ulaz);
		$rezultat = [ 'izlazi' => $izlazi ];
		return new JsonResponse($rezultat);
    }
}
