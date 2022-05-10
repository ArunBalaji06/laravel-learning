<?php

namespace App\Interfaces;

interface ResponseInterface
{
    function sendResponses($message,$data,$status);
}

