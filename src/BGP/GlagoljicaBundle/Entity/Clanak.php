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
     * Redosled prikaza u meniju. 1 = prvi, itd.
	 * @ORM\Column(type="integer")
     */
	protected $redosled;
	
	/**
	 * Kratak naslov za prikaz u meniju (u prinicpu moze biti isti kao $naslov, ali ne mora)
     * @ORM\Column(type="string", length=50)
     */
    protected $meniNaslov;
	
	/**
     * @ORM\Column(type="string", length=200)
     */
    protected $naslov;
	
	/**
     * Za koriscenje u rutama
	 * @ORM\Column(type="string", length=50)
     */
    protected $slug;
	
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

    /**
     * Set redosled
     *
     * @param integer $redosled
     *
     * @return Clanak
     */
    public function setRedosled($redosled)
    {
        $this->redosled = $redosled;

        return $this;
    }

    /**
     * Get redosled
     *
     * @return integer
     */
    public function getRedosled()
    {
        return $this->redosled;
    }

    /**
     * Set meniNaslov
     *
     * @param string $meniNaslov
     *
     * @return Clanak
     */
    public function setMeniNaslov($meniNaslov)
    {
        $this->meniNaslov = $meniNaslov;

        return $this;
    }

    /**
     * Get meniNaslov
     *
     * @return string
     */
    public function getMeniNaslov()
    {
        return $this->meniNaslov;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Clanak
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
