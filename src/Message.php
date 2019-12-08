<?php

namespace Spatie\Flash;

class Message
{
    public string $message;

    public ?string $class;

    public function __construct(string $message, $class = null)
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
