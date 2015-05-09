<?php

namespace BGP\GlagoljicaBundle\Konverzija;

class CirGlaKonvertor extends Konvertor {
	
	private static $cirilica = [ "љ", "њ", "е", "р", "т", "з", "у", "и", "о",
		"п", "ш", "ђ", "ж", "а", "с", "д", "ф", "г", "х", "ј", "к", "л",
		"ч", "ћ", "џ", "ц", "в", "б", "н", "м", "Љ", "Њ", "Е", "Р", "Т", 
		"З", "У", "И", "О", "П", "Ш", "Ђ", "Ж", "А", "С", "Д", "Ф", "Г", 
		"Х", "Ј", "К", "Л", "Ч", "Ћ", "Џ", "Ц", "В", "Б", "Н", "М" ];
	private static $glagoljica = [ "ⰾⱜ", "ⱀⱜ", "ⰵ", "ⱃ", "ⱅ", "ⰸ", "ⱆ", "ⰻ", "ⱁ",
		"ⱂ", "ⱎ", "ⰼ", "ⰶ", "ⰰ", "ⱄ", "ⰴ", "ⱇ", "ⰳ", "ⱈ", "ⱜ", "ⰽ", "ⰾ",
		"ⱍ", "ⱍⰺ", "ⰴⰶ", "ⱌ", "ⰲ", "ⰱ", "ⱀ", "ⰿ", "ⰎⰬ", "ⰐⰬ", "Ⰵ", "Ⱃ", "Ⱅ",
		"Ⰸ", "Ⱆ", "Ⰻ", "Ⱁ", "Ⱂ", "Ⱎ", "Ⰼ", "Ⰶ", "Ⰰ", "Ⱄ", "Ⰴ", "Ⱇ", "Ⰳ",
		"Ⱈ", "Ⱜ", "Ⰽ", "Ⰾ", "Ⱍ", "ⰝⰬ", "ⰄⰆ", "Ⱌ", "Ⰲ", "Ⰱ", "Ⱀ", "Ⰿ" ];
	
	public function dajSveDozvoljeneUlaze() {
		return [ UlaziIzlazi::$SR_CIRILICA ];
	}
	
	public function dajSveIzlazeZaUlaz($ulaz) {
		$idUlaza = is_array($ulaz)? $ulaz['id'] : $ulaz;

		if($idUlaza == UlaziIzlazi::$SR_CIRILICA['id'])
			return [ UlaziIzlazi::$SR_GLAGOLJICA ];
		else 
			return [ ];
	}
	
	// Ovaj zna samo cirilica -> latinica
	public function dajSveParoveUlazIzlaz() {
		return [ [ UlaziIzlazi::$SR_CIRILICA, UlaziIzlazi::$SR_GLAGOLJICA ] ];
	}

	public function podrzavaLiUlazIzlaz($ulaz, $izlaz) {
		$idUlaza = is_array($ulaz)? $ulaz['id'] : $ulaz;
		$idIzlaza = is_array($izlaz)? $izlaz['id'] : $izlaz;
		return $idUlaza == UlaziIzlazi::$SR_CIRILICA['id'] && $idIzlaza == UlaziIzlazi::$SR_GLAGOLJICA['id'];
	}
	
	public function konvertuj($tipUlaza, $ulaz, $tipIzlaza) {
		if($tipUlaza != UlaziIzlazi::$SR_CIRILICA['id'])
			throw new \LogicException("Nedozvoljen tip ulaza za ovaj konvertor - $tipUlaza");
		if($tipIzlaza != UlaziIzlazi::$SR_GLAGOLJICA['id'])
			throw new \LogicException("Nedozvoljen tip izlaza za ovaj konvertor - $tipIzlaza");
			
		return str_replace(self::$cirilica, self::$glagoljica, $ulaz);
	}
}
?>