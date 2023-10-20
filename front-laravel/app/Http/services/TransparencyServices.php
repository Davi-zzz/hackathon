<?php

namespace App\Http\services;


class TransparencyServices
{

    public static function getWebContent()
    {
        $urls = ["https://transparencia.to.gov.br/#!repasse_duod%C3%A9cimo"];
        foreach ($urls as $url) {
            if (!file_exists($url)) {
                $content = file_get_contents($url);
                $file = fopen($url, 'w');

                if ($file) {
                    chmod($url, 0600);
                    fwrite($file, $content);
                    fclose($file);
                }
            }
        }
        return $file;
    }

    public static function testeGetWebContent()
    {
        $urls = ["https://transparencia.to.gov.br/#!repasse_duod%C3%A9cimo"];
        foreach ($urls as $url) {
            if (!file_exists($url)) {
                $content = file_get_contents($url);
                dd($content);
                $file = fopen($url, 'w');

                if ($file) {
                    chmod($url, 0600);
                    fwrite($file, $content);
                    fclose($file);
                }
            }
        }
    }
}
