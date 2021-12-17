<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Exception;

use Exception;
use JetBrains\PhpStorm\Pure;

/**
 * Class InvalidParameterException
 */
class InvalidParameterException extends Exception
{
    #[Pure] public function __construct($message = '', $code = 0, Exception $previous = null)
    {
        parent::__construct('Invalid parameter: ' . $message, $code, $previous);
    }
}
