<?php

namespace Dhii\Iterator\FuncTest;

use Dhii\Iterator\CreateIteratorExceptionCapableTrait as TestSubject;
use Xpmock\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class CreateIteratorExceptionCapableTraitTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Iterator\CreateIteratorExceptionCapableTrait';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @param array $methods The methods to mock.
     *
     * @return MockObject The new instance.
     */
    public function createInstance($methods = [])
    {
        $methods = $this->mergeValues(
            $methods,
            [
            ]
        );

        $mock = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
                     ->setMethods($methods)
                     ->getMockForTrait();

        return $mock;
    }

    /**
     * Merges the values of two arrays.
     *
     * The resulting product will be a numeric array where the values of both inputs are present, without duplicates.
     *
     * @since [*next-version*]
     *
     * @param array $destination The base array.
     * @param array $source      The array with more keys.
     *
     * @return array The array which contains unique values
     */
    public function mergeValues($destination, $source)
    {
        return array_keys(array_merge(array_flip($destination), array_flip($source)));
    }

    /**
     * Creates an iterator mock instance..
     *
     * @since [*next-version*]
     *
     * @return MockObject The created iterator instance.
     */
    public function createIterator()
    {
        $mock = $this->getMockBuilder('Dhii\Iterator\IteratorInterface')
                     ->getMockForAbstractClass();

        return $mock;
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

        $this->assertInternalType(
            'object',
            $subject,
            'A valid instance of the test subject could not be created.'
        );
    }

    /**
     * Tests the iterator exception creation method.
     *
     * @since [*next-version*]
     */
    public function testCreateIteratorException()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $msg = uniqid('message-');
        $code = rand(1, 100);
        $prev = $this->createException();
        $iterator = $this->createIterator();

        $result = $reflect->_createIteratorException($msg, $code, $prev, $iterator);

        $this->assertSame($msg, $result->getMessage(), 'Expected and retrieved messages are not the same.');
        $this->assertSame($code, $result->getCode(), 'Expected and retrieved codes are not the same.');
        $this->assertSame($prev, $result->getPrevious(), 'Expected and retrieved inner exceptions are not the same.');
        $this->assertSame($iterator, $result->getIterator(), 'Expected and retrieved iterators are not the same.');
    }
}
