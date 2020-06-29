<?php

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @param string $string
 * @return string
 */
function get_view_hash(string $string = ''): string
{
    static $hashes = [];

    if (empty($hashes[$string])) {
        $hashes[$string] = crc32($string);
    }

    return $hashes[$string];
}

/**
 * @param string $language
 */
function set_user_language($language = ''): void
{
    $session = new Session();
    $session->set('language', $language);

    app()->setLocale($language);
}
