<?php

namespace App\Exceptions;

use Exception;

class ErrorException extends Exception
{
    protected string $location;
    protected string $msg;
    protected string $alert;

    public function __construct(string $location, string $msg, string $alert)
    {
        parent::__construct();
        $this->location = $location;
        $this->msg      = $msg;
        $this->alert    = $alert;
    }


    public function render() {
        return back($this->location)->with([
            $this->alert => $this->message
        ]);
    }
}
