<?php

use Spatie\Flash\Flash;
use Spatie\Flash\Message;

/**
 * @param  string|array  $class
 * @param  string|array  $style
 */
function flash(?string $text = null, $class = null, $style = null): Flash
{
    /** @var \Spatie\Flash\Flash $flash */
    $flash = app(Flash::class);

    if (is_null($text)) {
        return $flash;
    }

    $message = new Message($text, $class, null, $style);

    $flash->flash($message);

    return $flash;
}
