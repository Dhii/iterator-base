<?php

namespace Dhii\Iterator;

use Dhii\Iterator\Exception\IteratorExceptionInterface;

/**
 * Base functionality for a recursive iterator.
 *
 * @since [*next-version*]
 */
abstract class AbstractBaseRecursiveIterator extends AbstractRecursiveIterator implements RecursiveIteratorInterface
{
    /*
     * Adds recursion mode awareness.
     *
     * @since [*next-version*]
     */
    use ModeAwareTrait;

    /*
     * Adds current temporary iteration instance awareness.
     *
     * @since [*next-version*]
     */
    use IterationAwareTrait;

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     *
     * @throws IteratorExceptionInterface If something goes wrong while rewinding.
     */
    public function rewind()
    {
        $this->_rewind();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     *
     * @throws IteratorExceptionInterface If something goes wrong while advancing.
     */
    public function next()
    {
        $this->_next();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function current()
    {
        return $this->_value();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function key()
    {
        return $this->_key();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function valid()
    {
        return $this->_valid();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getIteration()
    {
        return $this->_getIteration();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _isMode($mode)
    {
        return $this->_getMode() & $mode;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _createRecursiveIteration($key, $value, $pathSegments = [])
    {
        return new RecursiveIteration($key, $value, $pathSegments);
    }
}
