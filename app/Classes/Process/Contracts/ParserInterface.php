<?php


namespace App\Classes\Process\Parser;


/**
 * Interface ParserInterface
 * @package App\Classes\Process\Parser
 */
interface ParserInterface
{

    /**
     * @param string $data
     * @return array
     */
    public function parse(string $data): array;

}
