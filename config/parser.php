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
    'ntb' => [
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
    'eur' => [
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
];
