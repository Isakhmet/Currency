<?php


namespace App\Classes\Process\Contracts;


use App\Classes\Process\ProcessContext;


/**
 * Interface ProcessInterface
 * @package App\Classes\Process
 */
interface ProcessInterface
{

    /**
     * @return ProcessContext
     */
    public function run();

}
