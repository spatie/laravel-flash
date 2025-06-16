<?php

namespace Spatie\Flash;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Traits\Macroable;

/** @mixin \Spatie\Flash\Message */
class Flash
{
    use Macroable;

    protected const SESSION_KEY = 'laravel_flash_message';

    public function __construct(
        protected readonly Session $session
    ) {}

    public function __get(string $name)
    {
        return $this->getMessage()?->$name ?? null;
    }

    public function getMessage(): ?Message
    {
        $data = $this->session->get(self::SESSION_KEY);

        if (!is_array($data)) {
            return null;
        }

        ['message' => $message, 'class' => $class, 'level' => $level] = $data + ['message' => null, 'class' => null, 'level' => null];

        if ($message === null || $class === null || $level === null) {
            return null;
        }

        return new Message($message, $class, $level);
    }

    public function flash(Message $message): void
    {
        if ($message->class && static::hasMacro($message->class)) {
            $method = $message->class;

            $this->$method($message->message);
            return;
        }

        $this->flashMessage($message);
    }

    public function flashMessage(Message $message): void
    {
        $this->session->flash(self::SESSION_KEY, $message->toArray());
    }

    public static function levels(array $methodClasses): void
    {
        foreach ($methodClasses as $method => $class) {
            self::macro($method, function (string $message) use ($class, $method) {
                $this->flashMessage(new Message($message, $class, $method));
            });
        }
    }

    public function forget(): void
    {
        $this->session->forget(self::SESSION_KEY);
    }

    public function hasMessage(): bool
    {
        return $this->session->has(self::SESSION_KEY);
    }

    public function getRaw(): array
    {
        return $this->session->get(self::SESSION_KEY, []);
    }
}
