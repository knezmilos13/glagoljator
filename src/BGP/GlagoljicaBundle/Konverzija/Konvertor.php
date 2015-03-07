<?php

namespace BGP\GlagoljicaBundle\Konverzija;

/** 
 * Zajednicki interfejs za sve klase koje rade konverziju iz jednog string zapisa u drugi.
 */
interface Konvertor {

	/**
	 * Vraca niz svih ulaza koje ovaj Konvertor moze da konvertuje. Ulazi su oblika:
	 * [ 'id' => '...identifikujuci string...', 'ime' => '...ljudski citljivo ime...' ]
	 * 
	 * @return array (vidi iznad)
	 */
	public function dajSveDozvoljeneUlaze();
	
	/**
	 * Vraca niz svih izlaza koje ovaj Konvertor moze da generise za zadati ulaz. Izlazi su oblika:
	 * [ 'id' => '...identifikujuci string...', 'ime' => '...ljudski citljivo ime...' ]
	 * 
	 * @param string|array $ulaz
	 *     identifikujuci string ulaza ciji se moguci izlazi traze ili asoc. niz sa stringom pod 'id'
	 * @return array (vidi iznad)
	 */
	public function dajSveIzlazeZaUlaz($ulaz);

	/**
	 * Vraca niz svih izlaza koje ovaj Konvertor moze da generise za zadati ulaz. Izlazi su oblika:
	 * [ 'id' => '...identifikujuci string...', 'ime' => '...ljudski citljivo ime...' ]
	 *
	 * @param string[]|array $ulazi
	 *     niz id-stringova ulaza ciji se moguci izlazi traze, ili niz asoc. nizova koji imaju string pod 'id'
	 * @return array (vidi iznad)
	 */
	public function dajSveIzlazeZaUlaze($ulazi);
	
	/**
	 * Vraca niz parova [ ulaz, izlaz ] koji odgovaraju svim konverzijama koje zna da uradi.
	 * I ulazi i izlazi su oblika:
	 * [ 'id' => '...identifikujuci string...', 'ime' => '...ljudski citljivo ime...' ]
	 * 
	 * @return array (vidi iznad)
	 */
	public function dajSveParoveUlazIzlaz();
	
	/**
	 * @param string $tipUlaza  - identifikujuci string ulaza (npr. "cirilica")
	 * @param string $ulaz      - ulaz kojeg treba konvertovati 
	 * @param string $tipIzlaza - identifikujuci string izlaza (npr. "glagoljica")
	 */
	public function konvertuj($tipUlaza, $ulaz, $tipIzlaza);
	
}

?>