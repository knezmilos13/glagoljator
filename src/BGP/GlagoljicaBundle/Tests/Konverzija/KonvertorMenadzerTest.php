<?php

namespace BGP\GlagoljicaBundle\Tests\Konverzija;
use BGP\GlagoljicaBundle\Konverzija\Konvertor;
use BGP\GlagoljicaBundle\Konverzija\KonvertorMenadzer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/** 
 * Stara se o svim Konvertorima koji su na raspolaganju aplikaciji. Sve konvertore treba
 * prijaviti menadzeru, a onda dalje koristiti menadzer za rad sa njima, ne raditi direktno
 * sa Konvertorima jednim po jednima.
 */
class KonvertorMenadzerTest extends KernelTestCase {

	// Test:
	// Ako u menadzera stavis dva konvertora koji kontaju srpski, engleski, francuski i glagoljicu
	// kad zoves menadzerovo dajSveUlaze() treba da dobijes sve te ulaze 
	public function testDajSveUlaze() {
		// Napomena: ovde pravimo mock od interfejsa, sto se malo cudno ponasa.
		// Kod mockovanja obicne klase ne bi moralo, ali ovde pri pozivanju mock() mora da se da spisak
		// metoda koje treba mockovati, a tek onda mogu da se mockuju ispod pozivom expects() metode.
		$konvertor1 = $this->getMock('Konvertor', [ 'dajSveDozvoljeneUlaze' ]);
		$konvertor1->expects($this->once())
			->method('dajSveDozvoljeneUlaze')
			->will($this->returnValue([
				[ 'id' => 'srp', 'ime' => 'Srpski' ], [ 'id' => 'eng', 'ime' => 'Engleski' ]
			]));

		$konvertor2 = $this->getMock('Konvertor', [ 'dajSveDozvoljeneUlaze' ]);
		$konvertor2->expects($this->once())
			->method('dajSveDozvoljeneUlaze')
			->will($this->returnValue([
				[ 'id' => 'fra', 'ime' => 'Francuski' ], [ 'id' => 'srp-gl', 'ime' => 'Srpska glagoljica' ]
			]));

		$menadzer = new KonvertorMenadzer([ $konvertor1, $konvertor2 ]);
		$sviUlazi = $menadzer->dajSveUlaze();

		$this->assertEquals(
			[
				[ 'id' => 'srp', 'ime' => 'Srpski' ], [ 'id' => 'eng', 'ime' => 'Engleski' ],
				[ 'id' => 'fra', 'ime' => 'Francuski' ], [ 'id' => 'srp-gl', 'ime' => 'Srpska glagoljica' ]
			],
			$sviUlazi
		);
	}

	// Test:
	// Ako u menadzera stavis dva konvertora koji kontaju srpski->glagoljica i francuski->engleski,
	// kad zoves menadzerovo dajSveIzlaze() treba na izlazu da dobijes glagoljica, engleski 
	public function testDajSveIzlaze() {
		// Dobavljanje SVIH izlaza trazi od konvertora i sve njihove ulaze prvo (interno)
		$konvertor1 = $this->getMock('Konvertor', [ 'dajSveDozvoljeneUlaze', 'dajSveIzlazeZaUlaze' ]);

		// Dakle bice pozvano dajSveDozvoljeneUlaze od Konvertora. Ovaj zna samo "Srpski" kao ulaz.
		$konvertor1->expects($this->once())
			->method('dajSveDozvoljeneUlaze')
			->will($this->returnValue([ [ 'id' => 'srp', 'ime' => 'Srpski' ] ]));

		// Bice pozvano dajSveIzlazeZaUlaze i tu ce primiti spisak SVIH ulaza, od sebe (Srpski) i od
		// drugih konvertora. Posto ovaj kao zna srpski->glagoljica, treba da vrati glagoljicu
		$konvertor1->expects($this->once())
			->method('dajSveIzlazeZaUlaze')
			->with($this->equalTo([[ 'id' => 'srp', 'ime' => 'Srpski' ], [ 'id' => 'fra', 'ime' => 'Francuski' ]]))
			->will($this->returnValue([ [ 'id' => 'srp-gl', 'ime' => 'Srpska glagoljica' ] ]));


		$konvertor2 = $this->getMock('Konvertor', [ 'dajSveDozvoljeneUlaze', 'dajSveIzlazeZaUlaze' ]);
		$konvertor2->expects($this->once())
			->method('dajSveDozvoljeneUlaze')
			->will($this->returnValue([ [ 'id' => 'fra', 'ime' => 'Francuski' ] ]));
		$konvertor2->expects($this->once())
			->method('dajSveIzlazeZaUlaze')
			->with($this->equalTo([[ 'id' => 'srp', 'ime' => 'Srpski' ], [ 'id' => 'fra', 'ime' => 'Francuski' ]]))
			->will($this->returnValue([	[ 'id' => 'eng', 'ime' => 'Engleski' ]	]));


		$menadzer = new KonvertorMenadzer([ $konvertor1, $konvertor2 ]);
		$sviIzlazi = $menadzer->dajSveIzlaze();

		$this->assertEquals(
			[
				[ 'id' => 'srp-gl', 'ime' => 'Srpska glagoljica' ], [ 'id' => 'eng', 'ime' => 'Engleski' ]
			],
			$sviIzlazi
		);
	}

	// Test:
	// Ako u menadzera stavis dva konvertora koji kontaju srpski->glagoljica i francuski->engleski,
	// kad zoves menadzerovo dajSveIzlazeZaUlaz(srpski) treba na izlazu da dobijes samo glagoljica 
	public function testDajSveIzlazeZaUlaz() {
		$konvertor1 = $this->getMock('Konvertor', [ 'dajSveIzlazeZaUlaz' ]);
		$konvertor1->expects($this->once())
			->method('dajSveIzlazeZaUlaz')
			->with($this->equalTo([ 'id' => 'srp', 'ime' => 'Srpski' ]))
			->will($this->returnValue([ [ 'id' => 'srp-gl', 'ime' => 'Srpska glagoljica' ] ]));


		$konvertor2 = $this->getMock('Konvertor', [ 'dajSveIzlazeZaUlaz' ]);
		$konvertor2->expects($this->once())
			->method('dajSveIzlazeZaUlaz')
			->with($this->equalTo([ 'id' => 'srp', 'ime' => 'Srpski' ]))
			->will($this->returnValue([	]));


		$menadzer = new KonvertorMenadzer([ $konvertor1, $konvertor2 ]);
		$sviIzlazi = $menadzer->dajSveIzlazeZaUlaz([ 'id' => 'srp', 'ime' => 'Srpski' ]);

		$this->assertEquals(
			[ [ 'id' => 'srp-gl', 'ime' => 'Srpska glagoljica' ] ],
			$sviIzlazi
		);
	}

	// Test:
	// Jedan konvertor konta srpski->glagoljica i engleski->francuski
	// Drugi koncertor konta glagoljica->srpski i francuski->engleski
	// Ako ima das kao ulaz srpski i francuski, treba da dobijes glagoljicu i engleski
	public function testDajSveIzlazeZaUlaze() {
		$konvertor1 = $this->getMock('Konvertor', [ 'dajSveIzlazeZaUlaze' ]);
		$konvertor1->expects($this->once())
			->method('dajSveIzlazeZaUlaze')
			->with($this->equalTo([ [ 'id' => 'srp', 'ime' => 'Srpski' ], [ 'id' => 'fra', 'ime' => 'Francuski' ] ]))
			->will($this->returnValue([ [ 'id' => 'srp-gl', 'ime' => 'Srpska glagoljica' ] ]));


		$konvertor2 = $this->getMock('Konvertor', [ 'dajSveIzlazeZaUlaze' ]);
		$konvertor2->expects($this->once())
			->method('dajSveIzlazeZaUlaze')
			->with($this->equalTo([ [ 'id' => 'srp', 'ime' => 'Srpski' ], [ 'id' => 'fra', 'ime' => 'Francuski' ] ]))
			->will($this->returnValue([ [ 'id' => 'eng', 'ime' => 'Engleski' ] ]));


		$menadzer = new KonvertorMenadzer([ $konvertor1, $konvertor2 ]);
		$sviIzlazi = $menadzer->dajSveIzlazeZaUlaze([ [ 'id' => 'srp', 'ime' => 'Srpski' ], [ 'id' => 'fra', 'ime' => 'Francuski' ]]);

		$this->assertEquals(
			[ [ 'id' => 'srp-gl', 'ime' => 'Srpska glagoljica' ], [ 'id' => 'eng', 'ime' => 'Engleski' ] ],
			$sviIzlazi
		);
	}

	// Test:
	// Jedan konvertor konta srpski->glagoljica, drugi francuski->engleski
	// Kada zoves dajSveParoveUlazIzlaz() treba njih da dobijes
	public function testDajSveParoveUlazIzlaz() {
		$konvertor1 = $this->getMock('Konvertor', [ 'dajSveParoveUlazIzlaz' ]);
		$konvertor1->expects($this->once())
			->method('dajSveParoveUlazIzlaz')
			->will($this->returnValue([ 
				[ [ 'id' => 'srp', 'ime' => 'Srpski' ], [ 'id' => 'srp-gl', 'ime' => 'Srpska glagoljica' ] ]
			]));

		$konvertor2 = $this->getMock('Konvertor', [ 'dajSveParoveUlazIzlaz' ]);
		$konvertor2->expects($this->once())
			->method('dajSveParoveUlazIzlaz')
			->will($this->returnValue([ 
				[ [ 'id' => 'eng', 'ime' => 'Engleski' ], [ 'id' => 'fra', 'ime' => 'Francuski' ] ]
			]));


		$menadzer = new KonvertorMenadzer([ $konvertor1, $konvertor2 ]);
		$sviParovi = $menadzer->dajSveParoveUlazIzlaz();

		$this->assertEquals(
			[ 
				[ [ 'id' => 'srp', 'ime' => 'Srpski' ], [ 'id' => 'srp-gl', 'ime' => 'Srpska glagoljica' ] ],
				[ [ 'id' => 'eng', 'ime' => 'Engleski' ], [ 'id' => 'fra', 'ime' => 'Francuski' ] ]
			],
			$sviParovi
		);
	}

// TODO: ostale funkcije
	/*


	private function dajSveParoveUlazIzlaz() {
		$sviParovi = [ ];
		foreach($this->konvertori as $konvertor) {
			array_merge($sviParovi, $konvertor->dajSveParoveUlazIzlaz());
		}

		// Nema testiranja sta je jedinstveno, po logici sistema ne sme imati duplikata ulaz-izlaz,
		// tj. ne bi smelo da postoji vise konvertora koji znaju istu stvar da konvertuju (nema logike)
		return $sviParovi;
	}
	*/
	
}

?>