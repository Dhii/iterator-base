<?php

namespace Dhii\Iterator\FuncTest;

use Dhii\Iterator\CreateRecursiveIterationCapableTrait as TestSubject;
use Xpmock\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class CreateRecursiveIterationCapableTraitTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Iterator\CreateRecursiveIterationCapableTrait';

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
     * Tests the creation method to assert that the iteration instance is correctly created.
     *
     * @since [*next-version*]
     */
    public function testCreateRecursiveIteration()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $key = uniqid('key-');
        $value = uniqid('value-');
        $path = [
            uniqid('segment-'),
            uniqid('segment-'),
            uniqid('segment-'),
        ];

        $result = $reflect->_createRecursiveIteration($key, $value, $path);

        $this->assertEquals($key, $result->getKey(), 'Expected and retrieved keys do not match.');
        $this->assertEquals($value, $result->getValue(), 'Expected and retrieved values do not match.');
        $this->assertEquals($path, $result->getPathSegments(), 'Expected and retrieved path segments do not match.');
    }
}
