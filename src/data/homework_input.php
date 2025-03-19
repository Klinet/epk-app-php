<?php
// output: 470 (370 alappont + 100 többletpont)
// output: 476 (376 alappont + 100 többletpont)
// output: hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt
// output: hiba, nem lehetséges a pontszámítás a magyar nyelv és irodalom tárgyból elért 20% alatti eredmény miatt
// output: 220 (220 alappont + 100 többletpont)

// output: 470 (370 alappont + 100 többletpont)
$exampleData0 = [
    'azonositok' => [
        'Oktatási azonosító'=> '11111111111',
        'OM kód'=> '111111'
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
            'eredmeny' => '80%',
        ],
        [
            'nev' => 'matematika',
            'tipus' => 'emelt',
            'eredmeny' => '90%',
        ],
        [
            'nev' => 'angol nyelv',
            'tipus' => 'közép',
            'eredmeny' => '94%',
        ],
        [
            'nev' => 'informatika',
            'tipus' => 'közép',
            'eredmeny' => '95%',
        ],
    ],
    'tobbletpontok' => [
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'angol',
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'C1',
            'nyelv' => 'német',
        ],
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
            'tipus' => 'FOKSZ',
            'eredmeny' => '60%',
        ]
    ],
];

// output: 476 (376 alappont + 100 többletpont)
$exampleData1 = [
    'azonositok' => [
        'Oktatási azonosító'=> '22222222222',
        'OM kód'=> '222222'
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
            'eredmeny' => '80%',
        ],
        [
            'nev' => 'matematika',
            'tipus' => 'emelt',
            'eredmeny' => '90%',
        ],
        [
            'nev' => 'angol nyelv',
            'tipus' => 'közép',
            'eredmeny' => '94%',
        ],
        [
            'nev' => 'informatika',
            'tipus' => 'közép',
            'eredmeny' => '95%',
        ],
        [
            'nev' => 'fizika',
            'tipus' => 'közép',
            'eredmeny' => '98%',
        ],
    ],
    'tobbletpontok' => [
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'angol',
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'C1',
            'nyelv' => 'német',
        ],
    ],
];

// output: hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt
$exampleData2 = [
    'azonositok' => [
        'Oktatási azonosító'=> '33333333333',
        'OM kód'=> '333333'
    ],
    'valasztott-szak' => [
        'egyetem' => 'ELTE',
        'kar' => 'IK',
        'szak' => 'Programtervező informatikus',
    ],
    'erettsegi-eredmenyek' => [
        [
            'nev' => 'matematika',
            'tipus' => 'emelt',
            'eredmeny' => '90%',
        ],
        [
            'nev' => 'angol nyelv',
            'tipus' => 'közép',
            'eredmeny' => '94%',
        ],
        [
            'nev' => 'informatika',
            'tipus' => 'közép',
            'eredmeny' => '95%',
        ],
    ],
    'tobbletpontok' => [
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'angol',
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'C1',
            'nyelv' => 'német',
        ],
    ],
];

// output: hiba, nem lehetséges a pontszámítás a magyar nyelv és irodalom tárgyból elért 20% alatti eredmény miatt
$exampleData3 = [
    'azonositok' => [
        'Oktatási azonosító'=> '44444444444',
        'OM kód'=> '444444'
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
            'eredmeny' => '15%',
        ],
        [
            'nev' => 'történelem',
            'tipus' => 'közép',
            'eredmeny' => '80%',
        ],
        [
            'nev' => 'matematika',
            'tipus' => 'emelt',
            'eredmeny' => '90%',
        ],
        [
            'nev' => 'angol nyelv',
            'tipus' => 'közép',
            'eredmeny' => '94%',
        ],
        [
            'nev' => 'informatika',
            'tipus' => 'közép',
            'eredmeny' => '95%',
        ],
    ],
    'tobbletpontok' => [
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'angol',
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'C1',
            'nyelv' => 'német',
        ],
    ],
];

// én csináltam egy 'Anglisztika" szakosat is
// output: 180 (80 alappont + 100 többletpont)
$exampleData4 = [
    'azonositok' => [
        'Oktatási azonosító'=> '55555555555',
        'OM kód'=> '555555'
    ],
    'valasztott-szak' => [
        'egyetem' => 'ELTE',
        'kar' => 'BTK',
        'szak' => 'Anglisztika',
    ],
    'erettsegi-eredmenyek' => [
        [
            'nev' => 'angol nyelv',
            'tipus' => 'emelt',
            'eredmeny' => '20%',
        ],
        [
            'nev' => 'történelem',
            'tipus' => 'közép',
            'eredmeny' => '20%',
        ],
        [
            'nev' => 'matematika',
            'tipus' => 'emelt',
            'eredmeny' => '20%',
        ],
        [
            'nev' => 'olasz',
            'tipus' => 'közép',
            'eredmeny' => '20%',
        ],
        [
            'nev' => 'orosz',
            'tipus' => 'közép',
            'eredmeny' => '20%',
        ],
        [
            'nev' => 'spanyol',
            'tipus' => 'közép',
            'eredmeny' => '20%',
        ],
    ],
    'tobbletpontok' => [
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'francia',
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'C1',
            'nyelv' => 'német',
        ],
    ],
];

// Összes adat visszaadása egy tömbben
// vagy exampleData[1] index szerint kérem
return [$exampleData0, $exampleData1, $exampleData2, $exampleData3, $exampleData4];