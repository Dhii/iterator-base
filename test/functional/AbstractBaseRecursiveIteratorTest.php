<?php

namespace Dhii\Iterator\FuncTest;

use Xpmock\TestCase;
use Dhii\Iterator\AbstractBaseRecursiveIterator;

/**
 * Tests {@see Dhii\Iterator\AbstractBaseRecursiveIterator}.
 *
 * @since [*next-version*]
 */
class AbstractBaseRecursiveIteratorTest extends TestCase
{
    /**
     * The classname of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Iterator\AbstractBaseRecursiveIterator';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return AbstractBaseRecursiveIterator
     */
    public function createInstance()
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->_getCurrentIterableKey()
            ->_getCurrentIterableValue()
            ->_getCurrentPath()
            ->_getElementPathSegment()
            ->_getInitialParentIterable()
            ->_isElementHasChildren()
            ->_getElementChildren()
            ->new();

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
            static::TEST_SUBJECT_CLASSNAME, $subject,
            'Subject is not a valid instance'
        );

        $this->assertInstanceOf(
            'Dhii\\Iterator\\RecursiveIteratorInterface', $subject,
            'Subject is not a valid instance'
        );
        $this->assertInstanceOf(
            'Dhii\\Iterator\\IteratorInterface', $subject,
            'Subject is not a valid instance'
        );

        $this->assertInstanceOf(
            'Iterator', $subject,
            'Subject is not a valid instance'
        );
    }
}
