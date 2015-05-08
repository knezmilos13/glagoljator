<?php

namespace BGP\GlagoljicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BGP\GlagoljicaBundle\Konverzija\KonvertorMenadzer;
use BGP\GlagoljicaBundle\Konverzija\CirLatKonvertor;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class KonverzijaController extends Controller {

    public function indexAction(Request $zahtev) {
    	$konvertorMenadzer = $this->get('konvertor_menadzer');

	    $tipUlaza = $zahtev->request->get("tipUlaza");
	    $tipIzlaza = $zahtev->request->get("tipIzlaza");
	    $ulaz = $zahtev->request->get("ulaz");

	    $izlaz = $konvertorMenadzer->konvertuj($tipUlaza, $ulaz, $tipIzlaza);
	    $rezultat = [ 'konvertovanTekst' => $izlaz ];
	    return new JsonResponse($rezultat);
    }
}
