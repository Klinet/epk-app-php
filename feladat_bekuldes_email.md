Egyszerűsített Pontszámító Kalkulátor - Architektúra Dokumentáció

1. Projekt áttekintés

Az "Egyszerűsített Pontszámító Kalkulátor" egy objektumorientált PHP alkalmazás, amely a hallgatók érettségi eredményei alapján kiszámítja a felvételi pontokat. Az alkalmazás figyelembe veszi az alappontokat (érettségi eredményekből) és a többletpontokat (emelt szintű érettségi és nyelvvizsga pontok), valamint naplózza a folyamatokat.

2. Architektúra és Mappa Struktúra

A projekt egy moduláris szerkezetű Composer alapú alkalmazás, amely az alábbi komponensekből áll:

/project-root
|-- src/
|   |-- Controllers/  (Adatfeldolgozás és vezérlés)
|   |-- Models/       (Adatmodellek)
|   |-- Services/     (Logika és pontszámítás)
|   |-- Interfaces/   (Interfészek a struktúrához)
|   |-- Traits/       (Többletfunkcionalitást biztosító trait-ek)
|   |-- Helpers/      (Hasznos segédfüggvények)
|   |-- Config/       (Konfigurációs állományok)
|
|-- tests/  (Automatizált PHPUnit tesztek)
|-- logs/   (Naplófájlok)
|-- vendor/ (Composer csomagok)
|-- index.php (Belépési pont a rendszerhez)

3. Fejlesztési Elvek

OOP (Objektumorientált Programozás) - Az alkalmazás modellek, vezérlők és szolgáltatások különálló komponensekből áll.

SOLID elvek - Az osztályok felelősségét minimalizáljuk, interfészek és trait-ek segítik a bővíthetőséget.

Dependency Injection - A vezérlők konstruktorban kapják meg a szolgáltatásokat.

Automatizált Tesztelés - PHPUnit tesztekkel biztosítjuk a stabil működést.

Feature Branch Workflow - Az új funkciók elkülönített ágon készülnek és merge előtt tesztelésen esnek át.

4. Feature Branch-ek

A fejlesztés során az alábbi főbb feature branch-ek léteznek:

feature/controller - Pontszámítást végző vezérlők fejlesztése

feature/models - Hallgatók, szakok, eredmények modellezése

feature/service - Pontszámítás implementálása

feature/tests - Automatizált tesztek készítése

feature/logging - Naplózási funkciók beépítése

5. Automatizált Tesztelés

A projekt PHPUnit alapú tesztelést használ. A tesztelési struktúra:

Unit tesztek - Modellek, segédfüggvények, traitek ellenőrzése

Integration tesztek - Adatok beolvasása és feldolgozása

Functional tesztek - A pontszámítás teljes folyamata

Logging tesztek - A naplózási rendszer validálása

A tesztek futtatásához:

vendor/bin/phpunit --testdox

Egy adott teszt futtatása:

vendor/bin/phpunit tests/Functional/Controllers/PontszamControllerTest.php

6. Funkcionális Működés

Az alkalmazás a homework_input.php adatok alapján a következőket végzi el:

Betölti a hallgatói adatokat

Ellenőrzi, hogy minden kötelező tantárgyból vizsgázott-e

Kiszámítja az alappontokat a legjobb eredmények alapján

Kiszámítja a többletpontokat (nyelvvizsga, emelt szintű vizsga)

Naplózza a folyamatokat egy log fájlba

Kiírja az eredményeket JSON fájlba és konzolra

A rendszer futtatása:

php index.php

Ez a dokumentáció tartalmazza a projekt felépítését, fejlesztési elveit, valamint a tesztelés és futtatás lépéseit.

