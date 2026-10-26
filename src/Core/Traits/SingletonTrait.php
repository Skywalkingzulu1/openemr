<?php

/**
 * @package   DCL
 *
 * @link      https://www.dcl.org
 *
 * @author    Igor Mukhin <igor.mukhin@gmail.com>
 * @copyright Copyright (c) 2025 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Core\Traits;

use LogicException;

/**
 * Usage:
 *   class ClassWithoutConstructorArguments {
 *       use SingletonTrait;
 *   }
 *
 *   class ClassWithConstructorArguments {
 *       use SingletonTrait;
 *       protected static function createInstance(): static { return new static($argumentA, $argumentB); }
 *   }
 */
trait SingletonTrait
{
    /** @var array<class-string<static>, static> */
    protected static array $instances = [];

    final public function __clone()
    {
        throw new LogicException(sprintf(
            'Cloning of %s is not allowed.',
            static::class,
        ));
    }

    public static function getInstance(): static
    {
        static::$instances[static::class] ??= static::createInstance();

        return static::$instances[static::class];
    }

    protected static function createInstance(): static
    {
        return new static(); // @phpstan-ignore-line new.static
    }
}
