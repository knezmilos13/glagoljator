<?php

namespace BGP\GlagoljicaBundle\Tests\Konverzija;
use BGP\GlagoljicaBundle\Konverzija\CirGlaKonvertor;
use BGP\GlagoljicaBundle\Konverzija\UlaziIzlazi;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CirGlaKonvertorTest extends KernelTestCase {
	
	/**
	 * @dataProvider providerZaCirilicaUGlagoljicu
	 */
	public function testKonvertuj($ulaz, $ocekivaniRezultat) {
		$konvertor = new CirGlaKonvertor();
		$dobijeniRezultat = 
			$konvertor->konvertuj(UlaziIzlazi::$SR_CIRILICA['id'], $ulaz, UlaziIzlazi::$SR_GLAGOLJICA['id']);
		$this->assertEquals($ocekivaniRezultat, $dobijeniRezultat);
	}
	
	public function providerZaCirilicaUGlagoljicu() {
		return [
			[ "abcdefg", "abcdefg" ],
			[ "čćđš", "čćđš" ],
			[ "abcшђњ", "abcⱎⰼⱀⱜ" ],
			[ "абвгдђежзијклљмнњопрстћуфхцчџш", "ⰰⰱⰲⰳⰴⰼⰵⰶⰸⰻⱜⰽⰾⰾⱜⰿⱀⱀⱜⱁⱂⱃⱄⱅⱍⰺⱆⱇⱈⱌⱍⰴⰶⱎ" ],
			[ "АБВГДЂЕЖЗИЈКЛЉМНЊОПРСТЋУФХЦЧЏШ", "ⰀⰁⰂⰃⰄⰌⰅⰆⰈⰋⰬⰍⰎⰎⰬⰏⰐⰐⰬⰑⰒⰓⰔⰕⰝⰬⰖⰗⰘⰜⰝⰄⰆⰞ" ],
			[ "ёёёёёёё", "ёёёёёёё" ], // ruska cirilica
			[ "ひらがな", "ひらがな" ],
			[ "平仮名", "平仮名" ]
		];
	}
}
?>