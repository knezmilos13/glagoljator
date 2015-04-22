<?php

namespace BGP\GlagoljicaBundle\Konverzija;

/**
 * Stara se o konvertovanju srpskih pisama i slicnim peripetijama sa srpskim pismima.
 */
class CirLatKonvertor extends Konvertor {
	
	private static $cirilica = [ "љ", "њ", "е", "р", "т", "з", "у", "и", "о",
		"п", "ш", "ђ", "ж", "а", "с", "д", "ф", "г", "х", "ј", "к", "л", 
		"ч", "ћ", "џ", "ц", "в", "б", "н", "м", "Љ", "Њ", "Е", "Р", "Т", 
		"З", "У", "И", "О", "П", "Ш", "Ђ", "Ж", "А", "С", "Д", "Ф", "Г", 
		"Х", "Ј", "К", "Л", "Ч", "Ћ", "Џ", "Ц", "В", "Б", "Н", "М" ];
	private static $latinica = [ "lj", "nj", "e", "r", "t", "z", "u", "i", "o",
		"p", "š", "đ", "ž", "a", "s", "d", "f", "g", "h", "j", "k", "l", 
		"č", "ć", "dž", "c", "v", "b", "n", "m", "Lj", "Nj", "E", "R", "T", 
		"Z", "U", "I", "O", "P", "Š", "Đ", "Ž", "A", "S", "D", "F", "G", 
		"H", "J", "K", "L", "Č", "Đ", "Dž", "C", "V", "B", "N", "M" ];
	
	public function dajSveDozvoljeneUlaze() {
		return [ UlaziIzlazi::$SR_CIRILICA ];
	}
	
	public function dajSveIzlazeZaUlaz($ulaz) {
		$idUlaza = is_array($ulaz)? $ulaz['id'] : $ulaz;

		if($idUlaza == UlaziIzlazi::$SR_CIRILICA['id'])
			return [ UlaziIzlazi::$SR_LATINICA ];
		else 
			return [ ];
	}
	
	// Ovaj zna samo cirilica -> latinica
	public function dajSveParoveUlazIzlaz() {
		return [ [ UlaziIzlazi::$SR_CIRILICA, UlaziIzlazi::$SR_LATINICA ] ];
	}

	public function podrzavaLiUlazIzlaz($ulaz, $izlaz) {
		$idUlaza = is_array($ulaz)? $ulaz['id'] : $ulaz;
		$idIzlaza = is_array($izlaz)? $izlaz['id'] : $izlaz;
		return $idUlaza == UlaziIzlazi::$SR_CIRILICA['id'] && $idIzlaza == UlaziIzlazi::$SR_LATINICA['id'];
	}
	
	public function konvertuj($tipUlaza, $ulaz, $tipIzlaza) {
		if($tipUlaza != UlaziIzlazi::$SR_CIRILICA['id'])
			throw new \LogicException("Nedozvoljen tip ulaza za ovaj konvertor - $tipUlaza");
		if($tipIzlaza != UlaziIzlazi::$SR_LATINICA['id'])
			throw new \LogicException("Nedozvoljen tip izlaza za ovaj konvertor - $tipIzlaza");
			
		return str_replace(self::$cirilica, self::$latinica, $ulaz);
	}
}
?>