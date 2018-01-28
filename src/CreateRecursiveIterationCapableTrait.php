<?php

namespace Dhii\Iterator;

use Dhii\Util\String\StringableInterface;

/**
 * Common functionality for objects that can create recursive iteration instances.
 *
 * @since [*next-version*]
 */
trait CreateRecursiveIterationCapableTrait
{
    /**
     * Creates a new recursive iteration instance.
     *
     * @since [*next-version*]
     *
     * @param string|StringableInterface|null $key          The iteration key, if any.
     * @param mixed|null                      $value        The iteration value, if any.
     * @param string[]|StringableInterface[]  $pathSegments The segments of the path to the iteration.
     *
     * @return RecursiveIterationInterface The created instance.
     */
    protected function _createRecursiveIteration($key, $value, $pathSegments = [])
    {
        return new RecursiveIteration($key, $value, $pathSegments);
    }
}
