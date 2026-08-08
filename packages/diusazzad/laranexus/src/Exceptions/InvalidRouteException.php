<?php

namespace Diusazzad\LaraNexus\Exceptions;

use Exception;

class InvalidRouteException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(string $message = "Invalid route encountered during mindmap generation.", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
