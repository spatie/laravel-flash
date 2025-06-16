<?php

namespace Spatie\Flash;

class Message
{
    public string $message;

    public ?string $class;

    public ?string $level;

    protected array $meta = [];

    public function __construct(
        string $message,
        string|array|null $class = null,
        ?string $level = null
    ) {
        $this->message = $message;
        $this->class = is_array($class) ? implode(' ', $class) : $class;
        $this->level = $level;
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'class' => $this->class,
            'level' => $this->level,
            'meta' => $this->meta,
        ];
    }

    public function withMeta(string $key, mixed $value): static
    {
        $this->meta[$key] = $value;

        return $this;
    }

    public function hasMeta(string $key): bool
    {
        return array_key_exists($key, $this->meta);
    }

    public function getMeta(string $key, mixed $default = null): mixed
    {
        return $this->meta[$key] ?? $default;
    }

    public static function make(
        string $message,
        string|array|null $class = null,
        ?string $level = null
    ): static {
        return new static($message, $class, $level);
    }

    public function __toString(): string
    {
        return $this->message;
    }
}
