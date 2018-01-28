<?php

namespace Dhii\Iterator\Exception;

use Dhii\Iterator\Exception\IteratingExceptionInterface;
use Exception;
use Throwable;

/**
 * An exception that occurs while iterating, and is related to the iteration process.
 *
 * @since [*next-version*]
 */
class IteratingException extends Exception implements IteratingExceptionInterface
{
}
