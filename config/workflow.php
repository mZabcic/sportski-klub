<?php

return [
    'straight'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['currentStatus']
        ],
        'supports'      => ['App\Team'],
        'places'        => ['nacrt', 'pregled', 'odbijen', 'odobren'],
        'transitions'   => [
            'to_review' => [
                'from' => 'nacrt',
                'to'   => 'pregled'
            ],
            'accept' => [
                'from' => 'pregled',
                'to'   => 'odobren'
            ],
            'reject' => [
                'from' => 'pregled',
                'to'   => 'odbijen'
            ],
            'review_again' => [
                'from' => 'odbijen',
                'to'   => 'pregled'
            ],
            'create_accept' => [
                'from' => 'nacrt',
                'to'   => 'odobren'
            ]
        ],
    ]
];
