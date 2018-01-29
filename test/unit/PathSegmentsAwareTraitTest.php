<?php

namespace Dhii\Iterator\UnitTest;

use Dhii\Iterator\PathSegmentsAwareTrait as TestSubject;
use Xpmock\TestCase;
use Exception as RootException;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use PHPUnit_Framework_MockObject_MockBuilder as MockBuilder;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class PathSegmentsAwareTraitTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Iterator\PathSegmentsAwareTrait';

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
            ->getMockForTrait();

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
     * @return MockBuilder The builder of the mock that extends and implements the specified class and interfaces.
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

        return $this->getMockBuilder($paddingClassName);
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
     * Tests that `_setPathSegments()` works as expected.
     *
     * @since [*next-version*]
     */
    public function testSetPathSegments()
    {
        $segments = array_fill(0, rand(1, 9), uniqid('segment'));
        $subject = $this->createInstance();
        $_subject = $this->reflect($subject);

        $subject->expects($this->exactly(1))
                ->method('_normalizeIterable')
                ->with($segments)
                ->will($this->returnValue($segments));

        $_subject->pathSegments = null;
        $_subject->_setPathSegments($segments);
        $this->assertEquals($segments, $_subject->pathSegments, 'Path segments were not set correctly');
    }

    /**
     * Tests that `_setPathSegments()` works as expected when given an `stdClass` object.
     *
     * @since [*next-version*]
     */
    public function testSetPathSegmentsObject()
    {
        $segments = array_fill(0, rand(1, 9), uniqid('segment'));
        $object = (object) $segments;
        $subject = $this->createInstance();
        $_subject = $this->reflect($subject);

        $subject->expects($this->exactly(1))
            ->method('_normalizeIterable')
            ->with($segments)
            ->will($this->returnValue($segments));

        $_subject->pathSegments = null;
        $_subject->_setPathSegments($object);
        $this->assertEquals($segments, $_subject->pathSegments, 'Path segments were not set correctly');
    }

    /**
     * Tests that `_getPathSegments()` works as expected when segments are set.
     *
     * @since [*next-version*]
     */
    public function testGetPathSegments()
    {
        $segments = array_fill(0, rand(1, 9), uniqid('segment'));
        $subject = $this->createInstance();
        $_subject = $this->reflect($subject);

        $_subject->pathSegments = $segments;

        $result = $_subject->_getPathSegments();
        $this->assertEquals($segments, $result, 'Path segments were not set correctly');
    }

    /**
     * Tests that `_getPathSegments()` works as expected when segments are not set.
     *
     * @since [*next-version*]
     */
    public function testGetPathSegmentsDefault()
    {
        $subject = $this->createInstance();
        $_subject = $this->reflect($subject);

        $_subject->pathSegments = null;

        $result = $_subject->_getPathSegments();
        $this->assertEquals([], $result, 'Path segments were not set correctly');
    }
}
