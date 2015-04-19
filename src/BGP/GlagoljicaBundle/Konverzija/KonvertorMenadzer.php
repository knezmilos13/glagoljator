<?php

namespace BGP\GlagoljicaBundle\Konverzija;

/** 
 * Stara se o svim Konvertorima koji su na raspolaganju aplikaciji. Sve konvertore treba
 * prijaviti menadzeru, a onda dalje koristiti menadzer za rad sa njima, ne raditi direktno
 * sa Konvertorima jednim po jednima.
 */
class KonvertorMenadzer {
	
	/** @var Konvertor[] */
	private $konvertori = null;

	/**
	 * @param Konvertor[] $konvertori
	 *     konvertori koji se dodaju menadzeru. Mogu se dodati naknadno koriscenjem metode 
	 *     dodajKonvertor, a defualt vrednost ovde je prazan niz.
	 */
	public function __construct($konvertori = [ ]) {
		$this->konvertori = $konvertori;
	}
	
	/** 
	 * Dodaje prosledjen Konvertor na interni spisak 
	 * @param Konvertor $konvertor
	 */
	public function dodajKonvertor(Konvertor $konvertor) {
		$this->konvertori[] = $konvertor;
	}
	
	/** 
	 * Dodaje prosledjene Konvertore na interni spisak 
	 * @param Konvertor[] $konvertori
	 */
	public function dodajKonvertore($konvertori) {
		$this->konvertori[] = array_merge($this->konvertori, $konvertori);
	}

	/**
	 * Vraca niz svih dozvoljenih ulaza. Ulazi su istog formata kojeg ih Konvertori vracaju.
	 * @return array
	 */
	public function dajSveUlaze() {
		$sviUlazi = [ ];
		foreach($this->konvertori as $konvertor) {
			$sviUlazi = array_merge($sviUlazi, $konvertor->dajSveDozvoljeneUlaze());
		}

		return __($sviUlazi)->uniq(function($vrednost) {
			return $vrednost['id'];
		});
	}

	/**
	 * Vraca niz svih dozvoljenih izlaza. Izlazi su istog formata kojeg ih Konvertori vracaju.
	 * @return array
	 */
	public function dajSveIzlaze() {
		$sviUlazi = $this->dajSveUlaze();

		$sviIzlazi = [ ];
		foreach($this->konvertori as $konvertor) {
			$sviIzlazi = array_merge($sviIzlazi, $konvertor->dajSveIzlazeZaUlaze($sviUlazi));
		}

		return __($sviIzlazi)->uniq(function($vrednost) {
			return $vrednost['id'];
		});
	}

	/**
	 * Vraca niz svih mogucih izlaza za dati ulaz. Izlazi su istog formata kojeg ih Konvertori vracaju.
	 * Ulaz moze biti id-string ili ceo asoc. niz sa 'id' poljem.
	 * @param string|array $ulaz
	 * @return array
	 */
	public function dajSveIzlazeZaUlaz($ulaz) {
		$sviIzlazi = [ ];
		foreach($this->konvertori as $konvertor) {
			$sviIzlazi = array_merge($sviIzlazi, $konvertor->dajSveIzlazeZaUlaz($ulaz));
		}

		return __($sviIzlazi)->uniq(function($vrednost) {
			return $vrednost['id'];
		});
	}

	/**
	 * Vraca niz svih mogucih izlaza za date ulaze. Izlazi su istog formata kojeg ih Konvertori vracaju.
	 * Ulazi mogu biti id-stringovi ili celi asoc. nizovi sa 'id' poljima.
	 * @param string[]|array $ulazi
	 * @return array
	 */
	public function dajSveIzlazeZaUlaze($ulazi) {
		$sviIzlazi = [ ];
		foreach($this->konvertori as $konvertor) {
			$sviIzlazi = array_merge($sviIzlazi, $konvertor->dajSveIzlazeZaUlaze($ulazi));
		}

		return __($sviIzlazi)->uniq(function($vrednost) {
			return $vrednost['id'];
		});
	}

	public function dajSveParoveUlazIzlaz() {
		$sviParovi = [ ];
		foreach($this->konvertori as $konvertor) {
			$sviParovi = array_merge($sviParovi, $konvertor->dajSveParoveUlazIzlaz());
		}

		// Nema testiranja sta je jedinstveno, po logici sistema ne sme imati duplikata ulaz-izlaz,
		// tj. ne bi smelo da postoji vise konvertora koji znaju istu stvar da konvertuju (nema logike)
		return $sviParovi;
	}
	
}

?>