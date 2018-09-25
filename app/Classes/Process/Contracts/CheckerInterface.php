<?php


namespace App\Classes\Process\Contracts;


/**
 * Interface CheckerInterface
 * @package App\Classes\Process\Contracts
 */
interface CheckerInterface
{

    /**
     * @param string $data
     */
    public function check(string $data);

}
