<?php

namespace Dhii\Iterator\FuncTest;

use Dhii\Data\Hierarchy\ChildrenAwareInterface;
use stdClass;
use Xpmock\TestCase;
use Dhii\Iterator\AbstractBaseRecursiveChildrenAwareIterator;

/**
 * Tests {@see Dhii\Iterator\AbstractBaseRecursiveChildrenAwareIterator}.
 *
 * @since [*next-version*]
 */
class AbstractBaseRecursiveChildrenAwareIteratorTest extends TestCase
{
    /**
     * The classname of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Iterator\AbstractBaseRecursiveChildrenAwareIterator';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return AbstractBaseRecursiveChildrenAwareIterator
     */
    public function createInstance()
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->_getCurrentIterableKey()
            ->_getCurrentIterableValue()
            ->_getElementPathSegment()
            ->_getInitialParentIterable()
            ->new();

        return $mock;
    }

    /**
     * Creates a new children aware mock instance for testing purposes.
     *
     * @since [*next-version*]
     *
     * @param array $children The children of the instance to create.
     *
     * @return ChildrenAwareInterface
     */
    public function createChildrenAwareInstance($children = [])
    {
        $mock = $this->mock('Dhii\\Data\\Hierarchy\\ChildrenAwareInterface')
            ->getChildren($children)
            ->hasChildren(count($children) > 0);

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

    /**
     * Tests the method that determines whether an iteration item has children.
     *
     * @since [*next-version*]
     */
    public function testIsElementHasChildren()
    {
        $subject    = $this->createInstance();
        $reflect    = $this->reflect($subject);

        $noChildren = $this->createChildrenAwareInstance([]);
        $this->assertFalse($reflect->_isElementHasChildren($noChildren));

        $hasChildren = $this->createChildrenAwareInstance([1, 'test', 59.99]);
        $this->assertTrue($reflect->_isElementHasChildren($hasChildren));

        $notChildrenAware = ['just', 'some', 'array'];
        $this->assertFalse($reflect->_isElementHasChildren($notChildrenAware));
    }

    /**
     * Tests the method that determines the children for an iteration item.
     *
     * @since [*next-version*]
     */
    public function testIsElementGetChildren()
    {
        $subject    = $this->createInstance();
        $reflect    = $this->reflect($subject);

        $children   = [1, 'two', 'test', 'subArray' => ['a', 'b', 'c']];
        $caInstance = $this->createChildrenAwareInstance($children);
        $this->assertEquals($children, $reflect->_getElementChildren($caInstance));

        $notChildrenAware = ['just', 'some', 'array'];
        $this->assertEmpty($reflect->_getElementChildren($notChildrenAware));
    }
}

