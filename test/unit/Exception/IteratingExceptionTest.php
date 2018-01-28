<?php

namespace Dhii\Iterator\Exception\UnitTest;

use Dhii\Util\String\StringableInterface as Stringable;
use Exception;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Xpmock\TestCase;
use Dhii\Iterator\Exception\IteratingException as TestSubject;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class IteratingExceptionTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Iterator\Exception\IteratingException';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable|null $message  The error message, if any.
     * @param int|null               $code     The error code, if any.
     * @param Exception|null         $previous The previous exception, if any.
     *
     * @return TestSubject
     */
    public function createInstance($message = null, $code = null, Exception $previous = null)
    {
        return new TestSubject($message, $code, $previous);
    }

    /**
     * Creates a new exception.
     *
     * @since [*next-version*]
     *
     * @param string $message The exception message.
     *
     * @return MockObject The new exception.
     */
    public function createException($message = '')
    {
        $mock = $this->getMockBuilder('Exception')
                     ->setConstructorArgs([$message])
                     ->getMock();

        return $mock;
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
            static::TEST_SUBJECT_CLASSNAME,
            $subject,
            'A valid instance of the test subject could not be created.'
        );
    }

    /**
     * Tests the constructor to assert whether the properties are correctly set.
     *
     * @since [*next-version*]
     */
    public function testConstructor()
    {
        $msg = uniqid('message-');
        $code = rand(0, 100);
        $prev = $this->createException();

        $subject = $this->createInstance($msg, $code, $prev);

        $this->assertEquals($msg, $subject->getMessage(), 'Expected and retrieved messages do not match.');
        $this->assertEquals($code, $subject->getCode(), 'Expected and retrieved code do not match.');
        $this->assertSame($prev, $subject->getPrevious(), 'Expected and retrieved previous are not the same.');
    }
}
