<?php

return [
    'code' => [
        'bcc' => [
            'card' => [
                'checker' => '',
                'parser' => '',
            ],
            'cash' => [
                'checker' => '',
                'parser' => '',
            ],
            'transfer' => [
                'checker' => '',
                'parser' => '',
            ]
        ],

        'mig' => [
            'card' => [
                'checker' => '',
                'parser' => '',
            ],
            'cash' => [
                'checker' => App\Classes\Process\Checker\Cash\MigChecker::class,
                'parser' => App\Classes\Process\Parser\Cash\MigParser::class,
            ],
            'transfer' => [
                'checker' => '',
                'parser' => '',
            ]
        ],
        'nur' => [
            'card' => [
                'checker' => App\Classes\Process\Checker\Card\NurbankChecker::class,
                'parser' => App\Classes\Process\Parser\Card\NurbankParser::class,
            ],
            'cash' => [
                'checker' => '',
                'parser' => '',
            ],
            'transfer' => [
                'checker' => App\Classes\Process\Checker\Transfer\NurbankChecker::class,
                'parser' => App\Classes\Process\Parser\Transfer\NurbankParser::class,
            ]
        ],
        'rbk' => [
            'card' => [
                'checker' => '',
                'parser' => '',
            ],
            'cash' => [
                'checker' => '',
                'parser' => '',
            ],
            'transfer' => [
                'checker' => '',
                'parser' => '',
            ]
        ],
    ]
];
