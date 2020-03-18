<?php

namespace Spatie\Flash;

class Message
{
    public string $message;

    public ?string $class;

    public ?string $level;

    public function __construct(string $message, $class = null, $level = null)
    {
        if (is_array($class)) {
            $class = implode(' ', $class);
        }

        $this->message = $message;

        $this->class = $class;

        $this->level = $level;
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'class' => $this->class,
            'level' => $this->level,
        ];
    }
}
