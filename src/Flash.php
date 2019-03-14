<?php

namespace Spatie\Flash;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Traits\Macroable;

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
        $this->session->flash('laravel_flash_message', $message->toArray());
    }

    public function __get($name)
    {
        return $this->getMessage()->$name;
    }
}