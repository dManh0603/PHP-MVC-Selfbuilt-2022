<?php
/**
 * User: taykh
 * Date: 12/1/2022
 * Time: 1:28 PM
 **/

namespace app\core;

class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect(string $url)
    {
        header('Location: ' . $url);
    }
}