<?php

namespace Spatie\Flash;

class Message
{
    /** @var string */
    public $message;

    /** @var string */
    public $class;

    /** @var string */
    public $level;

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
