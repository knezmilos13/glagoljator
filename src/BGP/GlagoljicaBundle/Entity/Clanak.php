<?php

namespace BGP\GlagoljicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="clanak")
 */
class Clanak {
	
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	protected $id;
	
	/**
     * @ORM\Column(type="string", length=200)
     */
    protected $naslov;
	
	/**
     * @ORM\Column(type="text")
     */
    protected $tekst;
	

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set naslov
     *
     * @param string $naslov
     *
     * @return Clanak
     */
    public function setNaslov($naslov)
    {
        $this->naslov = $naslov;

        return $this;
    }

    /**
     * Get naslov
     *
     * @return string
     */
    public function getNaslov()
    {
        return $this->naslov;
    }

    /**
     * Set tekst
     *
     * @param string $tekst
     *
     * @return Clanak
     */
    public function setTekst($tekst)
    {
        $this->tekst = $tekst;

        return $this;
    }

    /**
     * Get tekst
     *
     * @return string
     */
    public function getTekst()
    {
        return $this->tekst;
    }
}