<?php


namespace App\Classes\Process\Contracts;


use App\Classes\Process\ProcessContext;

/**
 * Class AbstractContextProcess
 * @package App\Classes\Process\Contracts
 */
abstract class AbstractContextProcess implements ProcessInterface
{

    /**
     * @var ProcessContext
     */
    protected $context;

    /**
     * AbstractContextProcess constructor.
     * @param ProcessContext $context
     */
    public function __construct($context)
    {
        $this->context = $context;
    }

    /**
     * @return ProcessContext
     */
    public function getContext(): ProcessContext
    {
        return $this->context;
    }
}
