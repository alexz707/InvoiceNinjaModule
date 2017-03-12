<?php

namespace InvoiceNinjaModule\Exception;

/**
 * Class ClientNotFoundException
 *
 * @package InvoiceNinjaModule\Exception
 */
class ClientNotFoundException extends \Exception
{
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct('Client id: '.$message.' not found!', $code, $previous);
    }
}
