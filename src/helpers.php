<?php

use Spatie\Flash\Flash;
use Spatie\Flash\Message;

/**
 * @param string|array $text
 * @param string|array $class
 */
function flash($text = null, $class = null): Flash
{
    /** @var \Spatie\Flash\Flash $flash */
    $flash = app(Flash::class);

    if (is_null($text)) {
        return $flash;
    }

    $message = new Message($text, $class);

    $flash->flash($message);

    return $flash;
}
