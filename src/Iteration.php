<?php

namespace Dhii\Iterator;

use Dhii\Exception\CreateInvalidArgumentExceptionCapableTrait;
use Dhii\I18n\StringTranslatingTrait;
use Dhii\Util\Normalization\NormalizeStringCapableTrait;

/**
 * Concrete implementation of an iteration.
 *
 * @since [*next-version*]
 */
class Iteration extends AbstractBaseIteration
{
    /* String normalization capability.
     *
     * @since [*next-version*]
     */
    use NormalizeStringCapableTrait;

    /* String translating capability.
     *
     * @since [*next-version*]
     */
    use StringTranslatingTrait;

    /* Ability to create Invalid Argument exceptions.
     *
     * @since [*next-version*]
     */
    use CreateInvalidArgumentExceptionCapableTrait;

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
