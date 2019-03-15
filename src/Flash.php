<?php

namespace Spatie\Flash;

use Illuminate\Support\Traits\Macroable;
use Illuminate\Contracts\Session\Session;

/** @mixin \Spatie\Flash\Message */
class Flash
{
    use Macroable;

    /** @var \Illuminate\Contracts\Session\Session */
    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function __get(string $name)
    {
        return $this->getMessage()->$name ?? null;
    }

    public function getMessage(): ?Message
    {
        $flashedMessageProperties = $this->session->get('laravel_flash_message');

        if (! $flashedMessageProperties) {
            return null;
        }

        return new Message($flashedMessageProperties['message'], $flashedMessageProperties['class']);
    }

    public function flash(Message $message): void
    {
        if ($message->class && static::hasMacro($message->class)) {
            $methodName = $message->class;

            $this->$methodName($message->message);

            return;
        }

        $this->flashMessage($message);
    }

    public function flashMessage(Message $message): void
    {
        $this->session->flash('laravel_flash_message', $message->toArray());
    }

    public static function levels(array $methodClasses): void
    {
        foreach ($methodClasses as $method => $classes) {
            self::macro($method, function (string $message) use ($classes) {
                return $this->flashMessage(new Message($message, $classes));
            });
        }
    }
}
