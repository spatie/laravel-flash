<?php

namespace Spatie\Flash;

class Message
{
    /** @var string */
    public $message;

    /** @var string */
    public $class;

    public function __construct(string $message, $class)
    {
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
