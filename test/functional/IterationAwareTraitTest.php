<?php

namespace Dhii\Iterator\Test;

use Dhii\Iterator\IterationInterface;
use Xpmock\TestCase;
use Dhii\Iterator\IterationAwareTrait;

/**
 * Tests {@see Dhii\Iterator\IterationAwareTrait}.
 *
 * @since [*next-version*]
 */
class IterationAwareTraitTest extends TestCase
{
    /**
     * The classname of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Iterator\\IterationAwareTrait';

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
            static::TEST_SUBJECT_CLASSNAME,  [],
            '',
            true,
            true,
            true,
            /* methods */ []
        );

        return $mock;
    }

    /**
     * Creates a new iteration instance.
     *
     * @since [*next-version*]
     *
     * @return IterationInterface
     */
    public function createIteration()
    {
        $mock = $this->mock('Dhii\\Iterator\\IterationInterface')
            ->getValue()
            ->getKey();

        return $mock->new();
    }

    /**
     * Tests the iteration getter and setter methods.
     *
     * @since [*next-version*]
     */
    public function testGetSetIteration()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $reflect->_setIteration($iteration = $this->createIteration());

        $this->assertSame($iteration, $reflect->_getIteration());
    }
}
