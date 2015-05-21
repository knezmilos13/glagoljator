<?php

namespace BGP\GlagoljicaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ClanakAdmin extends Admin {
	
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('redosled', 'number', [ 'label' => 'Redna pozicija članka u glavnom meniju' ])
			->add('naslov', 'text', [ 'label' => 'Naslov članka (biće prikazan nad tekstom)' ])
			->add('meniNaslov', 'text', [ 'label' => 'Kratak naslov članka koji će biti prikazan u glavnom meniju. Može biti isti kao naslov.'] )
			->add('metaNaslov', 'text', [ 'label' => 'Naslov članka' ])
			->add('metaDescription', 'text', [ 'label' => 'Tekst koji će ići u meta "description" tag stranice kad se prikaže članak' ])
			->add('slug', 'text', [ 'label' => 'Slug - biće nakačen na URL stranice. Najbolje da bude isto kao naslov, samo malim slovima i sa crtama (-) umesto razmaka.' ])
            ->add('tekst', 'textarea', [ 'label' => 'Tekst članka' ]);
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        	->add('redosled')
			->add('naslov')
			->add('meniNaslov');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
			->add('redosled')
            ->add('naslov')
            ->add('meniNaslov');
    }
}