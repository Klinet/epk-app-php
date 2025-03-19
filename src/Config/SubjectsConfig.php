<?php

/**
 * Szakokhoz tartozó kötelező és választható tantárgyak konfigurációja.
 *
 * - Minden szakhoz meghatározza a kötelező és választható tantárgyakat.
 * - A kötelező tantárgyakból minden hallgatónak vizsgát kell tennie.
 * - A választható tantárgyakból a legjobb pontszámot elérőt kell figyelembe venni az alappont számításánál.
 */

return [
    // Programtervező informatikus szak követelményei
    'Programtervező informatikus' => [
        'kotelezo_tantargyak' => ['magyar nyelv és irodalom', 'történelem', 'matematika'], // Kötelező tárgyak
        'valaszthato_tantargyak' => ['angol nyelv', 'informatika', 'biológia', 'fizika', 'kémia'] // Választható tárgyak
    ],

    // Anglisztika szak követelményei
    'Anglisztika' => [
        'kotelezo_tantargyak' => ['angol nyelv', 'történelem', 'matematika'], // Kötelező tárgyak
        'valaszthato_tantargyak' => ['francia', 'német', 'olasz', 'orosz', 'spanyol'] // Választható tárgyak
    ]
];




/*Az ELTE IK - Programtervező informatikus:  -
Kötelező: matematika  -
Kötelezően választható: biológia vagy fizika vagy informatika vagy kémia
A PPKE BTK – Anglisztika:  -
!! Kötelező: angol (emelt szinten)  -
Kötelezően választható: francia vagy német vagy olasz vagy orosz vagy spanyol
vagy történelem */


// pontszámítás nem lehetséges, ha a
// kötelező tárgyakból nem viszgázott
// valamely tárgyból 20% alatt viszgázott
// egyetlen kötelezően választható tárgyból sem viszgázott

/* Az alappontszám megállapításához csak a kötelező tárgy pontértékét és a legjobban
sikerült kötelezően választható tárgy pontértékét kell összeadni és az így kapott
összeget megduplázni.
*/


// többletpont számítás
// Nyelvvizsga: B2/középfokú komplex: 28 pont
// Nyelvvizsga: C1/felsőfokú komplex: 40 pont
// Emelt szintű érettségi esetén Vizsgatárgyanként: 50 pont
// egyazon nyelvből tett le több sikeres nyelvvizsgát pl B2 és C1 akkor a nagyobb pontszámot kell (40 pont) számolni).



