<?php

namespace App\Exceptions;

use Exception;

class LifeHackerNotParsedException extends Exception
{
    protected $message = 'Failed to parse Life Hacker feed';

    protected $code = 500;
}
