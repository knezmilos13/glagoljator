<?php

namespace BGP\GlagoljicaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ClanakAdmin extends Admin {
	
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('redosled', 'number', [ 'label' => 'Redna pozicija članka u glavnom meniju' ])
			->add('naslov', 'text', [ 'label' => 'Naslov članka', 'help' => 'Biće prikazan nad tekstom, u h1' ])
			->add('meniNaslov', 'text', [ 'required' => false, 'label' => 'Kratak naslov', 'help' => 'Biće prikazan u glavnom meniju. Potencijalno isti kao naslov. Ako se ne stavi ništa ovde, biće prekopirana vrednost naslova'] )
			->add('metaNaslov', 'text', [ 'required' => false, 'label' => 'Meta naslov', 'help' => 'Tekst koji će ići u meta "title" tag stranice kad se prikaže članak. Ako se ne stavi ništa ovde, biće prekopirana vrednost naslova' ])
			->add('metaDescription', 'text', [ 'required' => false, 'label' => 'Meta description', 'help' => 'Tekst koji će ići u meta "description" tag stranice kad se prikaže članak.' ])
			->add('slug', 'text', [ 'label' => 'Slug', 'help' => 'Biće nakačen na URL stranice. Najbolje da bude isto kao naslov, samo malim slovima i sa crtama (-) umesto razmaka.' ])
            ->add('tekst', 'textarea', [ 'label' => 'Tekst članka' ]);
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
        	->add('redosled')
			->add('naslov')
			->add('meniNaslov');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('id')
			->add('redosled')
            ->add('naslov')
            ->add('meniNaslov');
    }
	
	/** Redosled listanja odredjuje */
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'ASC',
        '_sort_by' => 'redosled'
    );
}