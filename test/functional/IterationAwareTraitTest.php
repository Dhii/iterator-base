<?php

namespace Dhii\Iterator\Test;

use Dhii\Iterator\IterationInterface;
use Xpmock\TestCase;
use Dhii\Iterator\IterationAwareTrait;
use InvalidArgumentException;

/**
 * Tests {@see \Dhii\Iterator\IterationAwareTrait}.
 *
 * @since [*next-version*]
 */
class IterationAwareTraitTest extends TestCase
{
    /**
     * The classname of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Iterator\\IterationAwareTrait';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return IterationAwareTrait
     */
    public function createInstance()
    {
        // Create mock
        $mock = $this->getMockForTrait(
            static::TEST_SUBJECT_CLASSNAME,  [],
            '',
            true,
            true,
            true,
            /* methods */ []
        );

        $mock->method('__')
                ->will($this->returnArgument(0));
        $mock->method('_createInvalidArgumentException')
                ->will($this->returnCallback(function ($message) {
                    return $this->createInvalidArgumentException($message);
                }));

        return $mock;
    }

    /**
     * Creates a new Invalid Argument exception.
     *
     * @since [*next-version*]
     *
     * @param string $message The error message.
     *
     * @return InvalidArgumentException The new exception.
     */
    public function createInvalidArgumentException($message = '')
    {
        $mock = $this->getMockBuilder('InvalidArgumentException')
                ->setMethods(['getMessage'])
                ->getMock();

        $mock->method('getMessage')
                ->will($this->returnValue($message));

        return $mock;
    }

    /**
     * Creates a new iteration instance.
     *
     * @since [*next-version*]
     *
     * @return IterationInterface
     */
    public function createIteration()
    {
        $mock = $this->mock('Dhii\\Iterator\\IterationInterface')
            ->getValue()
            ->getKey();

        return $mock->new();
    }

    /**
     * Tests the iteration getter and setter methods.
     *
     * @since [*next-version*]
     */
    public function testGetSetIteration()
    {
        $data = $this->createIteration();
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $reflect->_setIteration($data);

        $this->assertSame($data, $reflect->_getIteration());
    }

    /**
     * Tests that a null value can be successfully set and retrieved.
     *
     * @since [*next-version*]
     */
    public function testGetSetIterationNull()
    {
        $data = null;
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $reflect->_setIteration($data);

        $this->assertSame($data, $reflect->_getIteration());
    }

    /**
     * Tests that setting an invalid iteration fails correctly.
     *
     * @since [*next-version*]
     */
    public function testGetSetIterationFailure()
    {
        $data = new \stdClass();
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $this->setExpectedException('InvalidArgumentException');
        $reflect->_setIteration($data);
    }
}
