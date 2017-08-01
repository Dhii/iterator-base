<?php

namespace Dhii\Iterator;

/**
 * Functionality for something that is aware of a trait.
 *
 * @since [*next-version*]
 */
trait IterationAwareTrait
{
    /**
     * The iteration instance.
     *
     * @since [*next-version*]
     *
     * @var IterationInterface
     */
    protected $iteration;

    /**
     * Retrieves the iteration instance.
     *
     * @since [*next-version*]
     *
     * @return IterationInterface
     */
    protected function _getIteration()
    {
        return $this->iteration;
    }

    /**
     * Sets the iteration instance.
     *
     * @since [*next-version*]
     *
     * @param IterationInterface $iteration The iteration instance.
     *
     * @return $this
     */
    protected function _setIteration(IterationInterface $iteration)
    {
        $this->iteration = $iteration;

        return $this;
    }
}
