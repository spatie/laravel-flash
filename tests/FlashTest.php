<?php

namespace Spatie\Flash\Tests;

use Orchestra\Testbench\TestCase;
use Spatie\Flash\Flash;
use Spatie\Flash\Message;

class FlashTest extends TestCase
{
    /** @test */
    public function it_can_set_a_simple_flash_message()
    {
        flash('my message');

        $this->assertEquals('my message', flash()->message);
    }

    /** @test */
    public function it_can_set_a_flash_message_with_a_class()
    {
        flash('my message', 'my-class');

        $this->assertEquals('my message', flash()->message);
        $this->assertEquals('my-class', flash()->class);
    }

    /** @test */
    public function it_can_set_a_flash_message_with_multiple_classes()
    {
        flash('my message', ['my-class', 'another-class']);

        $this->assertEquals('my message', flash()->message);
        $this->assertEquals('my-class another-class', flash()->class);
    }

    /** @test */
    public function it_can_set_a_flash_message_with_level_and_meta()
    {
        flash('with meta', 'meta-class', 'success', [
            'icon' => 'check',
            'timeout' => 3000,
        ]);

        $this->assertEquals('with meta', flash()->message);
        $this->assertEquals('meta-class', flash()->class);
        $this->assertEquals('success', flash()->level);
        $this->assertTrue(flash()->getMessage()->hasMeta('icon'));
        $this->assertEquals('check', flash()->getMessage()->getMeta('icon'));
        $this->assertEquals(3000, flash()->getMessage()->getMeta('timeout'));
    }

    /** @test */
    public function the_flash_function_is_macroable()
    {
        Flash::macro('info', function (string $message) {
            return $this->flash(Message::make($message, 'my-info-class'));
        });

        flash()->info('my message');

        $this->assertEquals('my message', flash()->message);
        $this->assertEquals('my-info-class', flash()->class);
    }

    /** @test */
    public function multiple_levels_can_be_registered_at_once()
    {
        Flash::levels([
            'warning' => 'alert-warning',
            'error' => 'alert-error',
        ]);

        flash()->warning('my warning');
        $this->assertEquals('my warning', flash()->message);
        $this->assertEquals('alert-warning', flash()->class);
        $this->assertEquals('warning', flash()->level);

        flash()->error('my error');
        $this->assertEquals('my error', flash()->message);
        $this->assertEquals('alert-error', flash()->class);
        $this->assertEquals('error', flash()->level);
    }

    /** @test */
    public function when_class_is_registered_as_macro_it_takes_precedence()
    {
        // First use without macro override
        flash('my message', 'custom');
        $this->assertEquals('custom', flash()->class);

        // Now define macro override
        Flash::levels([
            'custom' => 'overridden-custom',
        ]);

        flash('my message', 'custom');
        $this->assertEquals('overridden-custom', flash()->class);
        $this->assertEquals('custom', flash()->level);
    }

    /** @test */
    public function empty_flash_message_returns_null()
    {
        $this->assertNull(flash()->message);
    }

    /** @test */
    public function meta_can_be_set_and_retrieved()
    {
        $message = Message::make('Meta test', 'info')->withMeta('icon', 'info-icon');
        flash()->flash($message);

        $this->assertTrue(flash()->getMessage()->hasMeta('icon'));
        $this->assertEquals('info-icon', flash()->getMessage()->getMeta('icon'));
    }

    /** @test */
    public function message_can_be_cast_to_string()
    {
        $message = Message::make('Stringable');
        $this->assertEquals('Stringable', (string) $message);
    }
}
