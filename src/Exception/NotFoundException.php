<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Exception;

/**
 * Class NotFoundException
 *
 * @package InvoiceNinjaModule\Exception
 */
class NotFoundException extends \Exception
{
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct('Object with id: '.$message.' not found!', $code, $previous);
    }
}
