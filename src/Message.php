<?php

namespace Spatie\Flash;

class Message
{
    public string $message;

    public ?string $class;

    public ?string $style;

    public ?string $level;

    public function __construct(string $message, $class = null, $level = null, $style = null)
    {
        if (is_array($class)) {
            $class = implode(' ', $class);
        }

        if (is_array($style)) {
            $style = implode(';', $style);
        }

        $this->message = $message;

        $this->class = $class;

        $this->level = $level;

        $this->style = $style;
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'class' => $this->class,
            'level' => $this->level,
            'style' => $this->style,
        ];
    }
}
