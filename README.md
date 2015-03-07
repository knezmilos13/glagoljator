# PROJEKAT: GLAGOLJATOR

Primetio sam da ne postoji sajt koji radi konverziju cirilice ili latinice u glagoljicu. Pa sam resio da napravim jedan takav i okacim ga na net. Ideja projekta je da bude zabavno-samopoboljsavajuceg karaktera, za vezbanje tehnologija (kao sto je Symfony) i vestina (kao sto je saradnja na jednom projektu), pri cemu taj projekat sam po sebi nije tezak i nema puno posla, a opet se moze prosiriti nekim featureima ako nas bas bude vise.

Lista featurea (slobodno dodati sve sto vam padne na pamet, ovo je brainstorming faza):
- **Konverzija cirilice/latinice u glagoljicu i obrnuto na fazon Google translate-a**
- **par clanaka informativnog karaktera o srpskoj glagoljici**
- mapa ... pronadjenih glagoljicnih artefakata u srbiji (zvuci kul, zar ne?)
- prevodjenje citavih sajtova na glagoljicu kao google translate sto ume
- mini JS igra za ucenje glagoljice
- ???

Svi koji hoce da ucestvuju nek mi se jave na mail, uz predlog sta bi zeleli da rade (sto moze biti nesto od navedenog ili neki novi glagoljicasti feature). Mozete me cimati i za sve tehnicke probleme, naravno.

## Struktura koda

Svi resursi idu u folder od Glagoljica bundlea (src/BGP/GlagoljicaBundle/Resources/public) umesto u top-level folder (app/Resources). Po stavljanju resursa u bundle, mora da se pokrene sledeca naredba u konzoli, u rootu projekta:  
app/console assets:install

## Konzolni alati & naredbe

*Dizanje ugradjenog php servera (iz foldera projekta, tj. foldera glagoljator):  
php app/console server:run

*Pustanje phpunit testova:  
- Pretpostavka je da se u www folderu nalaze fajlovi phpunit.phar i folder glagoljator  
php phpunit.phar -c glagoljator/app

*Osvezavanje asseta - ovo je jako bitno; svi asseti su unutar src/BGP/GlagoljicaBundle/Resources, ali da bi sajt radio, moraju da budu prebaceni u web folder. Ovo je sistem namenjen tome da ako imas sto bundlevoa, svaki ima svoje assete, a po "instalaciji" se svi kopiraju na gomilu u web folder odakle se serviraju.  
Postoje dve varijante, windosovci ce hteti ovu:    
php app/console assets:install  
A linuksovci ovu:  
php app/console assets:install --symlink