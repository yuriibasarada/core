<?php


namespace IwCore\error;


use Exception;
use Throwable;

class CoreException extends Exception
{
    /**
     * CoreException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}