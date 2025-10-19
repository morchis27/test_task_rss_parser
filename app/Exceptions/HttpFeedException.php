<?php

namespace App\Exceptions;

use Exception;

class HttpFeedException extends Exception
{
    protected $message = 'Failed to create http feed';

    protected $code = 500;
}
