<?php

namespace Dhii\Iterator\FuncTest;

use Dhii\Iterator\RecursiveIterationInterface;
use Xpmock\TestCase;
use Dhii\Iterator\AbstractBaseRecursiveIterator;
use Dhii\Iterator\RecursiveIteratorInterface as R;

/**
 * Tests {@see \Dhii\Iterator\AbstractBaseRecursiveIterator}.
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
            ->_getIteration($this->createIteration())
            ->_getCurrentIterableKey(null)
            ->_getCurrentIterableValue(null)
            ->_getCurrentPath([])
            ->_getElementPathSegment(null)
            ->_getInitialParentIterable([])
            ->_isElementHasChildren(false)
            ->_getElementChildren([])
            ->new();

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
        $mock = $this->mock('Dhii\\Iterator\\RecursiveIterationInterface')
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
     * Tests the mode checker method.
     *
     * @since [*next-version*]
     */
    public function testIsMode()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $reflect->_setMode(R::MODE_SELF_FIRST);
        $this->assertTrue($reflect->_isMode(R::MODE_SELF_FIRST));
        $this->assertFalse($reflect->_isMode(R::MODE_CHILD_FIRST));
        $this->assertFalse($reflect->_isMode(R::MODE_LEAVES_ONLY));

        $reflect->_setMode(R::MODE_CHILD_FIRST);
        $this->assertTrue($reflect->_isMode(R::MODE_CHILD_FIRST));
        $this->assertFalse($reflect->_isMode(R::MODE_LEAVES_ONLY));
        $this->assertFalse($reflect->_isMode(R::MODE_SELF_FIRST));

        $reflect->_setMode(R::MODE_LEAVES_ONLY);
        $this->assertTrue($reflect->_isMode(R::MODE_LEAVES_ONLY));
        $this->assertFalse($reflect->_isMode(R::MODE_CHILD_FIRST));
        $this->assertFalse($reflect->_isMode(R::MODE_SELF_FIRST));
    }

    /**
     * Tests the rewind method to ensure that the protected counterpart is also called.
     *
     * @since [*next-version*]
     */
    public function testRewindCalled()
    {
        $subject = $this->createInstance();

        $subject->mock()->_rewind([], null, $this->once());

        $subject->rewind();
    }

    /**
     * Tests the next method to ensure that the protected counterpart is also called.
     *
     * @since [*next-version*]
     */
    public function testNextCalled()
    {
        $subject = $this->createInstance();

        $subject->mock()->_next([], null, $this->once());

        $subject->next();
    }

    /**
     * Tests the current method to ensure that the protected counterpart is also called.
     *
     * @since [*next-version*]
     */
    public function testCurrentCalled()
    {
        $subject = $this->createInstance();

        $subject->mock()->_value([], null, $this->once());

        $subject->current();
    }

    /**
     * Tests the key method to ensure that the protected counterpart is also called.
     *
     * @since [*next-version*]
     */
    public function testKeyCalled()
    {
        $subject = $this->createInstance();

        $subject->mock()->_key([], null, $this->once());

        $subject->key();
    }

    /**
     * Tests the valid method to ensure that the protected counterpart is also called.
     *
     * @since [*next-version*]
     */
    public function testValidCalled()
    {
        $subject = $this->createInstance();

        $subject->mock()->_valid([], null, $this->once());

        $subject->valid();
    }

    /**
     * Tests the valid method to ensure that the protected counterpart is also called.
     *
     * @since [*next-version*]
     */
    public function testGetIterationCalled()
    {
        $subject = $this->createInstance();

        $subject->mock()->_getIteration([], null, $this->once());

        $subject->getIteration();
    }

    /**
     * Tests the creation of a recursive iteration instance.
     *
     * @since [*next-version*]
     */
    public function testCreateRecursiveIteration()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $iteration = $reflect->_createRecursiveIteration(
            $key = 'the-key',
            $value = new \DateTime(),
            $path = ['some', 'path', 'to', 'the-key']
        );

        $this->assertInstanceOf(
            'Dhii\\Iterator\\IterationInterface',
            $iteration,
            'Created iteration does not implemented expected interface.'
        );

        $this->assertInstanceOf(
            'Dhii\\Iterator\\RecursiveIterationInterface',
            $iteration,
            'Created iteration does not implemented expected interface.'
        );

        $this->assertEquals($key, $iteration->getKey());
        $this->assertSame($value, $iteration->getValue());
        $this->assertEquals($path, $iteration->getPathSegments());
    }
}
