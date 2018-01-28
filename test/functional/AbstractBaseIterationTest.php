<?php

namespace Dhii\Iterator\FuncTest;

use Dhii\Iterator\AbstractBaseIteration;
use Xpmock\TestCase;

/**
 * Tests {@see \Dhii\Iterator\AbstractBaseIteration}.
 *
 * @since [*next-version*]
 */
class AbstractBaseIterationTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Iterator\\AbstractBaseIteration';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return AbstractBaseIteration
     */
    public function createInstance()
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME);

        return $mock->new();
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInstanceOf(
            static::TEST_SUBJECT_CLASSNAME, $subject,
            'Subject is not a valid instance'
        );

        $this->assertInstanceOf(
            'Dhii\\Iterator\\IterationInterface', $subject,
            'Subject is not a valid instance'
        );
    }

    /**
     * Tests the key getter method.
     *
     * @since [*next-version*]
     */
    public function testGetKey()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $reflect->_setKey($key = 'test-key');

        $this->assertEquals($key, $subject->getKey());
    }

    /**
     * Tests the value getter method.
     *
     * @since [*next-version*]
     */
    public function testGetValue()
    {
        date_default_timezone_set('UTC');

        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $reflect->_setValue($value = new \DateTime());

        $this->assertEquals($value, $subject->getValue());
    }
}
