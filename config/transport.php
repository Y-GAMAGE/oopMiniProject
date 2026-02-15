<?php

return [
    'sri-lanka' => [
        'kandy' => [
            'air' => [
                'available' => true,
                'description' => 'Fly to Bandaranaike International Airport (CMB) in Colombo, then take a 3-hour drive or train to Kandy.',
                'nearest_airport' => 'Bandaranaike International Airport (CMB)',
                'distance' => '115 km from Colombo'
            ],
            'train' => [
                'available' => true,
                'description' => 'Scenic train journey from Colombo Fort station takes approximately 2.5-3 hours through beautiful landscapes.',
                'duration' => '2.5-3 hours',
                'route' => 'Colombo Fort to Kandy'
            ],
            'road' => [
                'available' => true,
                'description' => 'Well-connected by highways from major cities. Private cars, taxis, and bus services available from Colombo and other districts.',
                'duration' => '3-4 hours from Colombo',
                'options' => ['Private car', 'Bus', 'Taxi']
            ]
        ],
        'colombo' => [
            'air' => [
                'available' => true,
                'description' => 'Bandaranaike International Airport (CMB) is 35 km from Colombo city center.',
                'nearest_airport' => 'Bandaranaike International Airport (CMB)',
                'distance' => '35 km'
            ],
            'train' => [
                'available' => true,
                'description' => 'Colombo Fort is the main railway station with connections to all parts of the country.',
                'main_station' => 'Colombo Fort'
            ],
            'road' => [
                'available' => true,
                'description' => 'Well-connected by road to all major cities. Highways and expressways available.',
                'options' => ['Bus', 'Taxi', 'Private car', 'Tuk-tuk']
            ]
        ],
        'galle' => [
            'air' => [
                'available' => true,
                'description' => 'Fly to Bandaranaike International Airport (CMB), then take a 2-hour drive via Southern Expressway.',
                'nearest_airport' => 'Bandaranaike International Airport (CMB)',
                'distance' => '116 km'
            ],
            'train' => [
                'available' => true,
                'description' => 'Coastal train from Colombo offers stunning ocean views. Journey takes about 2.5-3 hours.',
                'duration' => '2.5-3 hours',
                'route' => 'Colombo to Galle'
            ],
            'road' => [
                'available' => true,
                'description' => 'Southern Expressway makes it a 2-hour drive from Colombo. Regular bus services available.',
                'duration' => '2 hours via expressway',
                'options' => ['Private car', 'Bus', 'Taxi']
            ]
        ]
    ],

    'japan' => [
        'tokyo' => [
            'air' => [
                'available' => true,
                'description' => 'Tokyo has two major airports: Narita International Airport (NRT) 60km from city center, and Haneda Airport (HND) 14km from city center.',
                'airports' => ['Narita (NRT)', 'Haneda (HND)']
            ],
            'train' => [
                'available' => true,
                'description' => 'Extensive rail network including JR lines, Shinkansen bullet train, and metro system. Narita Express and Tokyo Monorail connect airports.',
                'options' => ['Shinkansen', 'JR Lines', 'Metro', 'Narita Express']
            ],
            'road' => [
                'available' => true,
                'description' => 'Well-connected highways. Highway buses available from major cities. Public transport is more recommended.',
                'options' => ['Highway bus', 'Taxi', 'Rental car']
            ]
        ],
        'kyoto' => [
            'air' => [
                'available' => true,
                'description' => 'Nearest airports are Osaka Itami (ITM) 50km away and Kansai International (KIX) 75km away. Train connection from both airports.',
                'nearest_airports' => ['Osaka Itami (ITM)', 'Kansai (KIX)']
            ],
            'train' => [
                'available' => true,
                'description' => 'Shinkansen from Tokyo takes 2 hours 15 minutes. Well-connected by JR and private rail lines. Kyoto Station is the main hub.',
                'duration' => '2 hours 15 minutes from Tokyo',
                'options' => ['Shinkansen', 'JR Lines', 'Private railways']
            ],
            'road' => [
                'available' => true,
                'description' => 'Highway buses available from major cities. Excellent local bus network within Kyoto.',
                'options' => ['Highway bus', 'Local bus', 'Taxi', 'Bicycle rental']
            ]
        ]
    ],

    'france' => [
        'paris' => [
            'air' => [
                'available' => true,
                'description' => 'Charles de Gaulle Airport (CDG) is 25km northeast, and Orly Airport (ORY) is 13km south of Paris.',
                'airports' => ['Charles de Gaulle (CDG)', 'Orly (ORY)']
            ],
            'train' => [
                'available' => true,
                'description' => 'Extensive metro, RER, and TGV high-speed rail network. Connected to all major European cities.',
                'options' => ['Metro', 'RER', 'TGV']
            ],
            'road' => [
                'available' => true,
                'description' => 'Well-connected by highways. Bus services available but metro is more convenient.',
                'options' => ['Bus', 'Taxi', 'Rental car']
            ]
        ]
    ],

    // Add more countries and districts as needed...
];
