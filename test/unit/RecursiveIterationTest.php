<?php

namespace Dhii\Iterator\Test;

use Dhii\Iterator\RecursiveIteration;
use PHPUnit_Framework_TestCase;

/**
 * Tests {@see \Dhii\Iterator\RecursiveIteration}.
 *
 * @since [*next-version*]
 */
class RecursiveIterationTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = new RecursiveIteration('', '');

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
        $subject = new RecursiveIteration($key = 'test-key', '');

        $this->assertEquals($key, $subject->getKey());
    }

    /**
     * Tests the value getter method.
     *
     * @since [*next-version*]
     */
    public function testGetValue()
    {
        $subject = new RecursiveIteration('', $value = 'test-value');

        $this->assertEquals($value, $subject->getValue());
    }

    /**
     * Tests the path segments getter method.
     *
     * @since [*next-version*]
     */
    public function testGetPathSegments()
    {
        $subject = new RecursiveIteration('', '', $path = [
            'some',
            'path',
            'to',
            'an',
            'element'
        ]);

        $this->assertEquals($path, $subject->getPathSegments());
    }
}
