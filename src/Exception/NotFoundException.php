<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Exception;

use Exception;
use JetBrains\PhpStorm\Pure;

/**
 * Class NotFoundException
 */
class NotFoundException extends Exception
{
    #[Pure] public function __construct($message = '', $code = 0, Exception $previous = null)
    {
        parent::__construct('Object with id: ' . $message . ' not found!', $code, $previous);
    }
}
