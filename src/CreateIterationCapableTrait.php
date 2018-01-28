<?php

namespace Dhii\Iterator;

/**
 * Functionality for creating iterations.
 *
 * @since [*next-version*]
 */
trait CreateIterationCapableTrait
{
    /**
     * @param $key
     * @param mixed $value
     *
     * @return Iteration The new iteration.
     */
    protected function _createIteration($key, $value)
    {
        return new Iteration($key, $value);
    }
}
