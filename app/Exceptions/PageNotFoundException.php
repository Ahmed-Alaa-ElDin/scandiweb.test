<?php

namespace App\Exceptions;

class PageNotFoundException extends \Exception {
    protected $message = "File Not Found 404";
    protected $code = 404;
}