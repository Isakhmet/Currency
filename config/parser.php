<?php

return [
    'bcc' => [
        'card' => [
            'checker' => App\Classes\Process\Checker\Card\CenterCreditChecker::class,
            'parser' => App\Classes\Process\Parser\Card\CenterCreditParser::class,
            'method' => 'POST',
        ],
        'cash' => [
            'checker' => App\Classes\Process\Checker\Cash\CenterCreditChecker::class,
            'parser' => App\Classes\Process\Parser\Cash\CenterCreditParser::class,
            'method' => 'POST',
        ],
        'transfer' => [
            'checker' => App\Classes\Process\Checker\Transfer\CenterCreditChecker::class,
            'parser' => App\Classes\Process\Parser\Transfer\CenterCreditParser::class,
            'method' => 'POST',
        ]
    ],
    'mig' => [
        'card' => [
            'checker' => '',
            'parser' => '',
            'method' => '',
        ],
        'cash' => [
            'checker' => App\Classes\Process\Checker\Cash\MigChecker::class,
            'parser' => App\Classes\Process\Parser\Cash\MigParser::class,
            'method' => 'GET',
        ],
        'transfer' => [
            'checker' => '',
            'parser' => '',
            'method' => '',
        ]
    ],
    'nur' => [
        'card' => [
            'checker' => App\Classes\Process\Checker\Card\NurbankChecker::class,
            'parser' => App\Classes\Process\Parser\Card\NurbankParser::class,
            'method' => 'POST',
        ],
        'cash' => [
            'checker' => '',
            'parser' => '',
        ],
        'transfer' => [
            'checker' => App\Classes\Process\Checker\Transfer\NurbankChecker::class,
            'parser' => App\Classes\Process\Parser\Transfer\NurbankParser::class,
            'method' => 'POST',
        ]
    ],
    'rbk' => [
        'card' => [
            'checker' => '',
            'parser' => '',
            'method' => 'POST',
        ],
        'cash' => [
            'checker' => '',
            'parser' => '',
        ],
        'transfer' => [
            'checker' => App\Classes\Process\Checker\Transfer\RbkChecker::class,
            'parser' => App\Classes\Process\Parser\Transfer\RbkParser::class,
            'method' => 'POST',
        ]
    ],
    'nbr' => [
        'card' => [
            'checker' => '',
            'parser' => '',
        ],
        'cash' => [
            'checker' => App\Classes\Process\Checker\Cash\NationalBankChecker::class,
            'parser' => App\Classes\Process\Parser\Cash\NationalBankParser::class,
            'method' => 'POST',
        ],
        'transfer' => [
            'checker' => '',
            'parser' => '',
        ]
    ],
    'eub' => [
        'card' => [
            'checker' => App\Classes\Process\Checker\Card\EurasianBankChecker::class,
            'parser' => App\Classes\Process\Parser\Card\EurasianBankParser::class,
            'method' => 'GET',
        ],
        'cash' => [
            'checker' => App\Classes\Process\Checker\Cash\EurasianBankChecker::class,
            'parser' => App\Classes\Process\Parser\Cash\EurasianBankParser::class,
            'method' => 'GET',
        ],
        'transfer' => [
            'checker' => '',
            'parser' => '',
            'method' => '',
        ]
    ],
    'sber' => [
        'card' => [
            'checker' => '',
            'parser' => '',
            'method' => '',
        ],
        'cash' => [
            'checker' => App\Classes\Process\Checker\Cash\SberbankChecker::class,
            'parser' => App\Classes\Process\Parser\Cash\SberbankParser::class,
            'method' => 'GET',
        ],
        'transfer' => [
            'checker' => App\Classes\Process\Checker\Transfer\SberbankChecker::class,
            'parser' => App\Classes\Process\Parser\Transfer\SberbankParser::class,
            'method' => 'GET',
        ]
    ],
    'kase' => [
        'card' => [
            'checker' => '',
            'parser' => '',
            'method' => '',
        ],
        'cash' => [
            'checker' => App\Classes\Process\Checker\Cash\KaseChecker::class,
            'parser' => App\Classes\Process\Parser\Cash\KaseParser::class,
            'method' => 'GET',
        ],
        'transfer' => [
            'checker' => '',
            'parser' => '',
            'method' => '',
        ]
    ],
];
