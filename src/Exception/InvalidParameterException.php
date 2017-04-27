<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Exception;

/**
 * Class InvalidParameterException
 *
 * @package InvoiceNinjaModule\Exception
 */
class InvalidParameterException extends \Exception
{
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct('Invalid parameter: '.$message, $code, $previous);
    }
}
