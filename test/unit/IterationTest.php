<?php

namespace Dhii\Iterator\Test;

use Dhii\Iterator\Iteration;
use PHPUnit_Framework_TestCase;

/**
 * Tests {@see \Dhii\Iterator\Iteration}.
 *
 * @since [*next-version*]
 */
class IterationTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = new Iteration('', '');

        $this->assertInstanceOf(
            'Dhii\\Iterator\\IterationInterface',
            $subject,
            'Subject does not implement expected parent.'
        );
    }

    /**
     * Tests the key getter method.
     *
     * @since [*next-version*]
     */
    public function testGetKey()
    {
        $subject = new Iteration($key = 'test-key', '');

        $this->assertEquals($key, $subject->getKey());
    }

    /**
     * Tests the value getter method.
     *
     * @since [*next-version*]
     */
    public function testGetValue()
    {
        $subject = new Iteration('', $value = 'test-value');

        $this->assertEquals($value, $subject->getValue());
    }
}
