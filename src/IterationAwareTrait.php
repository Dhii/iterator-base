<?php

namespace Dhii\Iterator;

use Exception as RootException;
use InvalidArgumentException;
use Dhii\Util\String\StringableInterface as Stringable;

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
     * @var IterationInterface|null
     */
    protected $iteration;

    /**
     * Retrieves the iteration instance.
     *
     * @since [*next-version*]
     *
     * @return IterationInterface|null
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
     * @param IterationInterface|null $iteration The iteration instance.
     *
     * @return $this
     */
    protected function _setIteration($iteration)
    {
        if ($iteration !== null && !($iteration instanceof IterationInterface)) {
            throw $this->_createInvalidArgumentException($this->__('Invalid iteration'), null, null, $iteration);
        }

        $this->iteration = $iteration;

        return $this;
    }

    /**
     * Translates a string, and replaces placeholders.
     *
     * @since [*next-version*]
     * @see sprintf()
     *
     * @param string $string  The format string to translate.
     * @param array  $args    Placeholder values to replace in the string.
     * @param mixed  $context The context for translation.
     *
     * @return string The translated string.
     */
    abstract protected function __($string, $args = [], $context = null);

    /**
     * Creates a new invalid argument exception.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable|null $message  The error message, if any.
     * @param int|null               $code     The error code, if any.
     * @param RootException|null     $previous The inner exception for chaining, if any.
     * @param mixed|null             $argument The invalid argument, if any.
     *
     * @return InvalidArgumentException The new exception.
     */
    abstract protected function _createInvalidArgumentException(
        $message = null,
        $code = null,
        RootException $previous = null,
        $argument = null
    );
}
