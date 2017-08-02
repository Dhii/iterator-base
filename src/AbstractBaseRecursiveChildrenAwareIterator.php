<?php

namespace Dhii\Iterator;

use Dhii\Data\Hierarchy\ChildrenAwareInterface;

/**
 * Base functionality for a recursive iterator of children aware items.
 *
 * @since [*next-version*]
 */
abstract class AbstractBaseRecursiveChildrenAwareIterator extends AbstractBaseRecursiveIterator
{
    /**
     *{@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _isElementHasChildren($value)
    {
        return ($value instanceof ChildrenAwareInterface) && $value->hasChildren();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function &_getElementChildren($value)
    {
        $children = ($value instanceof ChildrenAwareInterface)
            ? $value->getChildren()
            : [];

        return $children;
    }
}
