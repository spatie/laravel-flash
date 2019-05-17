<?php

namespace Spatie\Flash;

class Message
{
    /** @var string|array */
    public $message;

    /** @var string */
    public $class;

    public function __construct($message, $class)
    {
        if (is_array($message)) {
            $concat = collect($message)->map(function ($msg) {
                return '<li>' . $msg . '</li>';
            })
            ->implode('');

            $message = '<ul>'. $concat .'</ul>';
        }

        if (is_array($class)) {
            $class = implode(' ', $class);
        }

        $this->message = $message;

        $this->class = $class;
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'class' => $this->class,
        ];
    }
}
