<?php

use function Laravel\Prompts\error;

function getWebContent(string $url)
{
    $content = file_get_contents($url);
    $file = fopen($url, 'w');

    if ($file) {
        chmod($url, 0600);
        fwrite($file, $content);
        fclose($file);
    }
    return $file;
}
