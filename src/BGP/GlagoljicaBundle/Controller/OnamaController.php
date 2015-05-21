<?php

namespace BGP\GlagoljicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OnamaController extends Controller {
    public function indexAction() {
        return $this->render('BGPGlagoljicaBundle:Onama:index.html.twig', [
            'jezik' => 'sr',
            'metaDescription' => 'O projektu "Glagoljica" i autorima ovog sajta.',
            'metaTitle' => 'Glagoljica - O nama',
            'title' => 'Glagoljica - O nama'
        ]);
    }
}