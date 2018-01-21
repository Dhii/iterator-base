<?php

namespace Dhii\Iterator\FuncTest;

use Dhii\Iterator\IterationAwareTrait;
use Dhii\Iterator\RecursiveIteratorInterface;
use Xpmock\TestCase;

/**
 * Tests {@see \Dhii\Iterator\ModeAwareTrait}.
 *
 * @since [*next-version*]
 */
class ModeAwareTraitTest extends TestCase
{
    /**
     * The classname of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Iterator\\ModeAwareTrait';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return IterationAwareTrait
     */
    public function createInstance()
    {
        // Create mock
        $mock = $this->getMockForTrait(
            static::TEST_SUBJECT_CLASSNAME, [],
            '',
            true,
            true,
            true,
            /* methods */
            []
        );

        return $mock;
    }

    /**
     * Tests the mode getter and setter methods.
     *
     * @since [*next-version*]
     */
    public function testGetSetMode()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $reflect->_setMode($mode = RecursiveIteratorInterface::MODE_SELF_FIRST);
        $this->assertEquals($mode, $reflect->_getMode());

        $reflect->_setMode($mode = RecursiveIteratorInterface::MODE_CHILD_FIRST);
        $this->assertEquals($mode, $reflect->_getMode());

        $reflect->_setMode($mode = RecursiveIteratorInterface::MODE_LEAVES_ONLY);
        $this->assertEquals($mode, $reflect->_getMode());
    }
}
