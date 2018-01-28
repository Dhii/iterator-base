<?php

namespace Dhii\Iterator\Test;

use Dhii\Iterator\RecursiveIteration as TestSubject;
use Xpmock\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class RecursiveIterationTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Iterator\RecursiveIteration';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @param array $methods The methods to mock.
     *
     * @return MockObject|TestSubject The new instance.
     */
    public function createInstance($methods = [], $constructorArgs = [], $disableOriginalConstructor = false)
    {
        is_array($methods) && $methods = $this->mergeValues($methods, [
            '__',
        ]);

        $builder = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
            ->setMethods($methods)
            ->setConstructorArgs($constructorArgs);
        $disableOriginalConstructor && $builder->disableOriginalConstructor();
        $mock = $builder->getMock();

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
     * Tests that the constructor works as expected.
     *
     * @since [*next-version*]
     */
    public function testConstructor()
    {
        $key = uniqid('key');
        $val = uniqid('val');
        $path = array_fill(0, rand(1, 9), uniqid('segment'));
        $subject = $this->createInstance([
            '_setKey',
            '_setValue',
            '_setPathSegments',
        ], [], true);

        $subject->expects($this->exactly(1))
            ->method('_setKey')
            ->with($key)
            ->will($this->returnSelf());
        $subject->expects($this->exactly(1))
            ->method('_setValue')
            ->with($val)
            ->will($this->returnSelf());
        $subject->expects($this->exactly(1))
            ->method('_setPathSegments')
            ->with($path)
            ->will($this->returnSelf());

        $subject->__construct($key, $val, $path);
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance(null, [], true);

        $this->assertInstanceOf(
            'Dhii\Iterator\IterationInterface',
            $subject,
            'Subject does not implement required interface'
        );
    }

    /**
     * Tests that `getPathSegments()` works as expected.
     *
     * @since [*next-version*]
     */
    public function testGetPathSegments()
    {
        $segments = array_fill(0, rand(1, 9), uniqid('segment'));
        $subject = $this->createInstance(null, [], true);
        $_subject = $this->reflect($subject);

        $_subject->path = $segments;

        $result = $subject->getPathSegments();
        $this->assertEquals($segments, $result, 'Retrieved paths segments are wrong');
    }

    /**
     * Tests that `getDepth()` works as expected.
     *
     * @since [*next-version*]
     */
    public function testGetDepth()
    {
        $segments = [uniqid('segment'), uniqid('segment')];
        $subject = $this->createInstance(['getPathSegments'], [], true);
        $_subject = $this->reflect($subject);

        $subject->expects($this->exactly(1))
                ->method('getPathSegments')
                ->will($this->returnValue($segments));

        $result = $subject->getDepth();
        $this->assertEquals(count($segments) - 1, $result, 'Retrieved depth is wrong');
    }
}
