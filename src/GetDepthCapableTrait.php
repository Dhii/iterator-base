<?php

namespace Dhii\Iterator;

use Dhii\Util\String\StringableInterface as Stringable;
use Traversable;

/**
 * Functionality for calculating depth based on path.
 *
 * @since [*next-version*]
 */
trait GetDepthCapableTrait
{
    /**
     * Retrieves the depth based on the number of path segments.
     *
     * @since [*next-version*]
     *
     * @return int The number of levels.
     */
    protected function _getDepth()
    {
        return count($this->_getPathSegments()) - 1;
    }

    /**
     * Retrieves the path segments.
     *
     * @since [*next-version*]
     *
     * @return string[]|Stringable[]|Traversable The list of segments.
     */
    abstract protected function _getPathSegments();
}
