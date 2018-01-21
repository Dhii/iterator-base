<?php

namespace Dhii\Iterator;

/**
 * Concrete implementation of an iteration.
 *
 * @since [*next-version*]
 */
class Iteration extends AbstractBaseIteration
{
    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param string|int|null $key   The iteration key.
     * @param mixed           $value The iteration value.
     */
    public function __construct($key, $value)
    {
        $this->_setKey($key)
             ->_setValue($value);
    }
}
