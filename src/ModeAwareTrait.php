<?php

namespace Dhii\Iterator;

/**
 * Functionality for something that is aware of a recursion mode.
 *
 * @since [*next-version*]
 */
trait ModeAwareTrait
{
    /**
     * The recursion mode.
     *
     * @see RecursiveIteratorInterface::MODE_SELF_FIRST
     * @see RecursiveIteratorInterface::MODE_CHILD_FIRST
     * @see RecursiveIteratorInterface::MODE_LEAVES_ONLY
     * @since [*next-version*]
     *
     * @var int
     */
    protected $mode;

    /**
     * Retrieves the recursion mode.
     *
     * @since [*next-version*]
     *
     * @return int
     */
    protected function _getMode()
    {
        return $this->mode;
    }

    /**
     * Sets the recursion mode.
     *
     * @since [*next-version*]
     *
     * @param int $mode The recursion mode.
     *
     * @return $this
     */
    protected function _setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }
}
