<?php

namespace Spatie\Flash\Tests;

use Spatie\Flash\Flash;
use Spatie\Flash\Message;
use Orchestra\Testbench\TestCase;

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
    public function the_flash_function_is_macroable()
    {
        Flash::macro('info', function (string $message) {
            return $this->flash(new Message($message, 'my-info-class'));
        });

        flash()->info('my message');

        $this->assertEquals('my message', flash()->message);
        $this->assertEquals('my-info-class', flash()->class);
    }

    /** @test */
    public function multiple_methods_can_be_added_in_one_go()
    {
        Flash::levels([
            'warning' => 'alert-warning',
            'error' => 'alert-error',
        ]);

        flash()->warning('my warning');
        $this->assertEquals('my warning', flash()->message);
        $this->assertEquals('alert-warning', flash()->class);

        flash()->error('my error');
        $this->assertEquals('my error', flash()->message);
        $this->assertEquals('alert-error', flash()->class);
    }

    /** @test */
    public function when_passing_a_class_name_that_is_registered_as_method_it_will_call_that_method()
    {
        flash('my message', 'custom');
        $this->assertEquals('custom', flash()->class);

        Flash::levels([
            'custom' => 'overridden-custom',
        ]);

        flash('my message', 'custom');
        $this->assertEquals('overridden-custom', flash()->class);
    }

    /** @test */
    public function empty_flash_message_returns_null()
    {
        $this->assertNull(flash()->message);
    }

    /** @test */
    public function it_can_set_a_simple_flash_message_as_array()
    {
        flash(['first message', 'second message']);

        $this->assertStringContainsString('first message', flash()->message);
        $this->assertStringContainsString('second message', flash()->message);
        $this->assertEquals('<ul><li>first message</li><li>second message</li></ul>', flash()->message);
    }

    /** @test */
    public function it_can_set_flash_message_as_array_with_a_class()
    {
        flash(['first message', 'second message'], 'my-class');

        $this->assertStringContainsString('first message', flash()->message);
        $this->assertStringContainsString('second message', flash()->message);
        $this->assertEquals('<ul><li>first message</li><li>second message</li></ul>', flash()->message);
        $this->assertEquals('my-class', flash()->class);
    }

    /** @test */
    public function it_can_set_flash_message_as_array_with_multiple_classes()
    {
        flash(['first message', 'second message'], ['my-class', 'another-class']);

        $this->assertStringContainsString('first message', flash()->message);
        $this->assertStringContainsString('second message', flash()->message);
        $this->assertEquals('<ul><li>first message</li><li>second message</li></ul>', flash()->message);
        $this->assertEquals('my-class another-class', flash()->class);
    }

    /** @test */
    public function the_flash_function_with_message_as_array_is_macroable()
    {
        Flash::macro('info', function ($message) {
            return $this->flash(new Message($message, 'my-info-class'));
        });

        flash()->info(['first message', 'second message']);

        $this->assertEquals('<ul><li>first message</li><li>second message</li></ul>', flash()->message);
        $this->assertEquals('my-info-class', flash()->class);
    }

    /** @test */
    public function multiple_methods_with_message_as_array_can_be_added_in_one_go()
    {
        Flash::levels([
            'warning' => 'alert-warning',
            'error' => 'alert-error',
        ]);

        flash()->warning(['my warning']);
        $this->assertEquals('<ul><li>my warning</li></ul>', flash()->message);
        $this->assertEquals('alert-warning', flash()->class);

        flash()->error(['my error']);
        $this->assertEquals('<ul><li>my error</li></ul>', flash()->message);
        $this->assertEquals('alert-error', flash()->class);
    }
}
