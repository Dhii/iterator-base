<?php

namespace Dhii\Iterator;

use Dhii\Util\String\StringableInterface as Stringable;
use Traversable;

/**
 * Represents an iteration in a recursive iterator.
 *
 * @since [*next-version*]
 */
class RecursiveIteration extends AbstractBaseIteration implements RecursiveIterationInterface
{
    /**
     * An array of path segments.
     *
     * @since [*next-version*]
     *
     * @var array
     */
    protected $path;

    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param string|int|null                   $key   The iteration key.
     * @param mixed                             $value The iteration value.
     * @param string[]|Stringable[]|Traversable $path  A list of path segments.
     */
    public function __construct($key, $value, $path = [])
    {
        $this->_setKey($key)
             ->_setValue($value)
             ->_setPathSegments($path);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getPathSegments()
    {
        return $this->path;
    }

    /**
     * Sets the path segments.
     *
     * @since [*next-version*]
     *
     * @param string[]|Stringable[]|Traversable $path A list of path segments.
     */
    protected function _setPathSegments($path)
    {
        $this->path = $path;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getDepth()
    {
        return count($this->getPathSegments()) - 1;
    }
}
