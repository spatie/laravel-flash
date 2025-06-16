<?php

use Spatie\Flash\Flash;
use Spatie\Flash\Message;

if (!function_exists('flash')) {
    /**
     * Flash a message to the session or return the Flash instance.
     *
     * @param  string|null           $text
     * @param  string|array|null     $class
     * @param  string|null           $level
     * @param  array                 $meta
     * @return \Spatie\Flash\Flash
     */
    function flash(
        ?string $text = null,
        string|array|null $class = null,
        ?string $level = null,
        array $meta = []
    ): Flash {
        /** @var \Spatie\Flash\Flash $flash */
        $flash = app(Flash::class);

        if (is_null($text)) {
            return $flash;
        }

        $message = Message::make($text, $class, $level);

        foreach ($meta as $key => $value) {
            $message->withMeta($key, $value);
        }

        $flash->flash($message);

        return $flash;
    }
}
