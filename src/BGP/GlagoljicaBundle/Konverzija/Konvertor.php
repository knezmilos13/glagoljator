<?php

namespace BGP\GlagoljicaBundle\Konverzija;

/** 
 * Zajednicki interfejs za sve klase koje rade konverziju iz jednog string zapisa u drugi.
 */
abstract class Konvertor {

	/**
	 * Vraca niz svih ulaza koje ovaj Konvertor moze da konvertuje. Ulazi su oblika:
	 * [ 'id' => '...identifikujuci string...', 'ime' => '...ljudski citljivo ime...' ]
	 * 
	 * @return array (vidi iznad)
	 */
	abstract public function dajSveDozvoljeneUlaze();
	
	/**
	 * Vraca niz svih izlaza koje ovaj Konvertor moze da generise za zadati ulaz. Izlazi su oblika:
	 * [ 'id' => '...identifikujuci string...', 'ime' => '...ljudski citljivo ime...' ]
	 * 
	 * @param string|array $ulaz
	 *     identifikujuci string ulaza ciji se moguci izlazi traze ili asoc. niz sa stringom pod 'id'
	 * @return array (vidi iznad)
	 */
	abstract public function dajSveIzlazeZaUlaz($ulaz);

	/**
	 * Vraca niz svih izlaza koje ovaj Konvertor moze da generise za zadati ulaz. Izlazi su oblika:
	 * [ 'id' => '...identifikujuci string...', 'ime' => '...ljudski citljivo ime...' ]
	 *
	 * @param string[]|array $ulazi
	 *     niz id-stringova ulaza ciji se moguci izlazi traze, ili niz asoc. nizova koji imaju string pod 'id'
	 * @return array (vidi iznad)
	 */
	public function dajSveIzlazeZaUlaze($ulazi) {
		$sviIzlazi = [ ];
		foreach($ulazi as $ulaz) {
			$jedniIzlazi = $this->dajSveIzlazeZaUlaz($ulaz);
			$sviIzlazi = array_merge($sviIzlazi, $jedniIzlazi);
		}
		
		return __($sviIzlazi)->uniq(false, function($izlaz) { return $izlaz['id']; });
	}
	
	/**
	 * Vraca niz parova [ ulaz, izlaz ] koji odgovaraju svim konverzijama koje zna da uradi.
	 * I ulazi i izlazi su oblika:
	 * [ 'id' => '...identifikujuci string...', 'ime' => '...ljudski citljivo ime...' ]
	 * 
	 * @return array (vidi iznad)
	 */
	abstract public function dajSveParoveUlazIzlaz();
	
	/**
	 * @param string $tipUlaza  - identifikujuci string ulaza (npr. "srp-cir")
	 * @param string $ulaz      - ulaz kojeg treba konvertovati 
	 * @param string $tipIzlaza - identifikujuci string izlaza (npr. "srp-gla")
	 */
	abstract public function konvertuj($tipUlaza, $ulaz, $tipIzlaza);

	/**
	 * Da li ovaj konvertor podrzava zadatu kombinaciju ulaz-izlaz? Mogu biti zadati IDjem ili celim objektom.
	 * @param $ulaz string|array
	 * @param $izlaz string|array
	 * @return boolean
	 */
	abstract public function podrzavaLiUlazIzlaz($ulaz, $izlaz);
	
}

?>