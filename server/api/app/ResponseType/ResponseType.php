<?php
namespace App\ResponseType;

interface ResponseType {

    public function convert($content, int $code);
}
