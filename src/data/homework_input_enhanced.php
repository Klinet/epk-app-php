<?php
// output: 470 (370 alappont + 100 többletpont)
// output: 476 (376 alappont + 100 többletpont)
// output: hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt
// output: hiba, nem lehetséges a pontszámítás a magyar nyelv és irodalom tárgyból elért 20% alatti eredmény miatt
// output: 220 (220 alappont + 100 többletpont)

// output: 470 (370 alappont + 100 többletpont)
$exampleData0 = [
    'azonositok' => [
        'Oktatási azonosító'=> '1234567891',
        'OM kód'=> '123451'
    ],
    'valasztott-szak' => [
        'egyetem' => 'ELTE',
        'kar' => 'IK',
        'szak' => 'Programtervező informatikus',
    ],
    'erettsegi-eredmenyek' => [
        [
            'nev' => 'magyar nyelv és irodalom',
            'tipus' => 'közép',
            'eredmeny' => '70%',
        ],
        [
            'nev' => 'történelem',
            'tipus' => 'közép',
            'eredmeny' => '70%',
        ],
        [
            'nev' => 'matematika',
            'tipus' => 'emelt',
            'eredmeny' => '50%',
        ],
        [
            'nev' => 'angol nyelv',
            'tipus' => 'közép',
            'eredmeny' => '50%',
        ],
        [
            'nev' => 'informatika',
            'tipus' => 'közép',
            'eredmeny' => '90%',
        ],
    ],
    'tobbletpontok' => [
        /*[
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'angol',
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'C1',
            'nyelv' => 'német',
        ],*/
    ],
/*'okj' => 50,
'foksz' => 70,
'bsc' => 100,
'msc' => 150,*/
    'felsofoku_vegzettsegek' => [
        [
            'tipus' => 'OKJ',
            'eredmeny' => '70%',
        ],
        [
            'tipus' => 'FOSZK',
            'eredmeny' => '60%',
        ]
    ],
];

return [$exampleData0];