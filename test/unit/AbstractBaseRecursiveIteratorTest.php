<?php

namespace Dhii\Iterator\UnitTest;

use Dhii\Iterator\AbstractBaseRecursiveIterator as TestSubject;
use Dhii\Iterator\RecursiveIterationInterface;
use Xpmock\TestCase;
use Exception as RootException;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class AbstractBaseRecursiveIteratorTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Iterator\AbstractBaseRecursiveIterator';

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
        $methods = $this->mergeValues($methods, [
            '__',
        ]);

        $mock = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
            ->setMethods($methods)
            ->getMockForAbstractClass();

        $mock->method('__')
                ->will($this->returnArgument(0));

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
     * Creates a mock that both extends a class and implements interfaces.
     *
     * This is particularly useful for cases where the mock is based on an
     * internal class, such as in the case with exceptions. Helps to avoid
     * writing hard-coded stubs.
     *
     * @since [*next-version*]
     *
     * @param string $className      Name of the class for the mock to extend.
     * @param string $interfaceNames Names of the interfaces for the mock to implement.
     *
     * @return object The object that extends and implements the specified class and interfaces.
     */
    public function mockClassAndInterfaces($className, $interfaceNames = [])
    {
        $paddingClassName = uniqid($className);
        $definition = vsprintf('abstract class %1$s extends %2$s implements %3$s {}', [
            $paddingClassName,
            $className,
            implode(', ', $interfaceNames),
        ]);
        eval($definition);

        return $this->getMockForAbstractClass($paddingClassName);
    }

    /**
     * Creates a new exception.
     *
     * @since [*next-version*]
     *
     * @param string $message The exception message.
     *
     * @return RootException The new exception.
     */
    public function createException($message = '')
    {
        $mock = $this->getMockBuilder('Exception')
            ->setConstructorArgs([$message])
            ->getMock();

        return $mock;
    }

    /**
     * Creates a new iteration instance.
     *
     * @since [*next-version*]
     *
     * @param string|int|null $key   The iteration key.
     * @param mixed           $value The iteration value.
     * @param array           $path  The path segments.
     *
     * @return RecursiveIterationInterface
     */
    public function createIteration($key = null, $value = null, $path = [])
    {
        $mock = $this->mock('Dhii\Iterator\RecursiveIterationInterface')
            ->getKey($key)
            ->getValue($value)
            ->getPathSegments($path)
            ->getDepth(count($path));

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

        $this->assertInternalType(
            'object',
            $subject,
            'A valid instance of the test subject could not be created.'
        );

        $this->assertInstanceOf(
            static::TEST_SUBJECT_CLASSNAME, $subject,
            'Subject is not a valid instance'
        );

        $this->assertInstanceOf(
            'Dhii\Iterator\RecursiveIteratorInterface', $subject,
            'Subject does not implement required interface'
        );
        $this->assertInstanceOf(
            'Dhii\Iterator\IteratorInterface', $subject,
            'Subject does not implement required interface'
        );

        $this->assertInstanceOf(
            'Iterator', $subject,
            'Subject does not implement required interface'
        );
    }

    /**
     * Tests that `rewind()` works as expected.
     *
     * @since [*next-version*]
     */
    public function testRewind()
    {
        $subject = $this->createInstance(['_rewind']);

        $subject->expects($this->exactly(1))
            ->method('_rewind');

        $subject->rewind();
    }

    /**
     * Tests that `next()` works as expected.
     *
     * @since [*next-version*]
     */
    public function testNext()
    {
        $subject = $this->createInstance(['_next']);
        $_subject = $this->reflect($subject);

        $subject->expects($this->exactly(1))
            ->method('_next');

        $subject->next();
    }

    /**
     * Tests that `current()` works as expected.
     *
     * @since [*next-version*]
     */
    public function testCurrent()
    {
        $value = uniqid('val');
        $subject = $this->createInstance(['_value']);

        $subject->expects($this->exactly(1))
            ->method('_value')
            ->will($this->returnValue($value));

        $result = $subject->current();
        $this->assertEquals($value, $result, 'Retrieved value is wrong');
    }

    /**
     * Tests that `key()` works as expected.
     *
     * @since [*next-version*]
     */
    public function testKey()
    {
        $key = uniqid('key');
        $subject = $this->createInstance(['_key']);

        $subject->expects($this->exactly(1))
            ->method('_key')
            ->will($this->returnValue($key));

        $result = $subject->key();
        $this->assertEquals($key, $result, 'Retrieved key is wrong');
    }

    /**
     * Tests that `valid()` works as expected.
     *
     * @since [*next-version*]
     */
    public function testValid()
    {
        $isValid = (bool) rand(0, 1);
        $subject = $this->createInstance(['_valid']);
        $_subject = $this->reflect($subject);

        $subject->expects($this->exactly(1))
            ->method('_valid')
            ->will($this->returnValue($isValid));

        $result = $subject->valid();
        $this->assertEquals($isValid, $result, 'Retrieved validity status is wrong');
    }

    /**
     * Tests that `getIteration()` works as expected.
     *
     * @since [*next-version*]
     */
    public function testGetIteration()
    {
        $iteration = $this->createIteration();
        $subject = $this->createInstance(['_getIteration']);

        $subject->expects($this->exactly(1))
            ->method('_getIteration')
            ->will($this->returnValue($iteration));

        $result = $subject->getIteration();
        $this->assertSame($iteration, $result, 'Retrieved iteration is wrong');
    }
}
