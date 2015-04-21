<?php

namespace BGP\GlagoljicaBundle\Tests\Konverzija;
use BGP\GlagoljicaBundle\Konverzija\CirLatKonvertor;
use BGP\GlagoljicaBundle\Konverzija\UlaziIzlazi;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CirLatKonvertorTest extends KernelTestCase {	
	
	/**
	 * @dataProvider providerZaCirilicaULatinicu
	 */
	public function testKonvertuj($ulaz, $ocekivaniRezultat) {
		$konvertor = new CirLatKonvertor();
		$dobijeniRezultat = 
			$konvertor->konvertuj(UlaziIzlazi::$SR_CIRILICA['id'], $ulaz, UlaziIzlazi::$SR_LATINICA['id']);
		$this->assertEquals($ocekivaniRezultat, $dobijeniRezultat);
	}
	
	public function providerZaCirilicaULatinicu() {
		return [
			[ "abcdefg", "abcdefg" ],
			[ "čćđš", "čćđš" ],
			[ "abcшђњ", "abcšđnj" ],
			[ "абвгдђе", "abvgdđe" ],
			[ "ёёёёёёё", "ёёёёёёё" ], // ruska cirilica
			[ "ひらがな", "ひらがな" ],
			[ "平仮名", "平仮名" ]
		];
	}
}
?>