<?php

namespace BGP\GlagoljicaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="clanak")
 * @ORM\HasLifecycleCallbacks
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
	 * Naslov za meta tag, verovatno isti kao naslov
     * @ORM\Column(type="string", length=100)
     */
    protected $metaNaslov;
	
	/**
	 * Naslov za meta description tag
     * @ORM\Column(type="string", length=500)
     */
    protected $metaDescription = "";
	
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
	
	
	/** @ORM\PrePersist */
    public function doStuffOnPrePersist() {
        $this->srediNedostajuceVrednosti();
    }
	
	/** @ORM\PreUpdate */
    public function doStuffOnPreUpdate() {
        $this->srediNedostajuceVrednosti();
    }
	
	/* Sredjuje tipa kratak naslov, meta naslov ako ih nisi stavio - kopira iz "naslov" itd. */
	private function srediNedostajuceVrednosti() {
		if(empty($this->metaNaslov)) $this->metaNaslov = $this->naslov;
		if(empty($this->meniNaslov)) $this->meniNaslov = $this->naslov;
	}
	

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

    /**
     * Set metaNaslov
     *
     * @param string $metaNaslov
     *
     * @return Clanak
     */
    public function setMetaNaslov($metaNaslov)
    {
        $this->metaNaslov = $metaNaslov;

        return $this;
    }

    /**
     * Get metaNaslov
     *
     * @return string
     */
    public function getMetaNaslov()
    {
        return $this->metaNaslov;
    }

    /** @param string $metaDescription
     *  @return Clanak */
    public function setMetaDescription($metaDescription) {
    	if($metaDescription == null) $metaDescription = "";
        $this->metaDescription = $metaDescription;
        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }
}
