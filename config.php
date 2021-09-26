<?php

define("URL_BASE","http://localhost/teste-onewebbr/public_html");

function url(string $uri = null): string
{
    if($uri){
        return URL_BASE . "/{$uri}";
    }
}

return URL_BASE;
