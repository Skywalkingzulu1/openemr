<?php

/**
 * Isolated DCLChain Test
 *
 * Tests DCLChain validation functionality without database dependencies.
 * DCLChain extends Particle\Validator\Chain to provide DCL-specific
 * validation rules, particularly the listOption rule.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Validators;

use DCL\Validators\DCLChain;
use Particle\Validator\Chain;
use PHPUnit\Framework\TestCase;

class DCLChainTest extends TestCase
{
    public function testChainInheritsFromParticleChain(): void
    {
        $chain = new DCLChain('test_key', 'Test Field', false, true);
        $this->assertInstanceOf(Chain::class, $chain);
    }

    public function testChainIsInstantiable(): void
    {
        $chain = new DCLChain('test_key', 'Test Field', false, true);
        $this->assertInstanceOf(DCLChain::class, $chain);
    }

    public function testListOptionMethodExists(): void
    {
        $chain = new DCLChain('test_key', 'Test Field', false, true);
        $this->assertTrue(method_exists($chain, 'listOption'));
    }

    public function testListOptionReturnsChainForFluency(): void
    {
        $chain = new DCLChain('test_key', 'Test Field', false, true);
        $result = $chain->listOption('test_list');

        $this->assertSame($chain, $result, 'listOption should return $this for method chaining');
    }

    public function testChainCanBeConstructedWithDifferentParameters(): void
    {
        // Test with required field
        $requiredChain = new DCLChain('required_key', 'Required Field', true, false);
        $this->assertInstanceOf(DCLChain::class, $requiredChain);

        // Test with optional field
        $optionalChain = new DCLChain('optional_key', 'Optional Field', false, true);
        $this->assertInstanceOf(DCLChain::class, $optionalChain);

        // Test with different key formats
        $snakeCaseChain = new DCLChain('snake_case_key', 'Snake Case Field', false, true);
        $this->assertInstanceOf(DCLChain::class, $snakeCaseChain);
    }

    public function testChainSupportsMethodChaining(): void
    {
        $chain = new DCLChain('test_key', 'Test Field', false, true);

        // Test that we can chain multiple listOption calls
        $result = $chain->listOption('first_list')
                        ->listOption('second_list');

        $this->assertSame($chain, $result, 'Multiple listOption calls should maintain fluent interface');
    }

    public function testClassExists(): void
    {
        $this->assertTrue(class_exists(DCLChain::class));
    }

    public function testListOptionAcceptsDifferentListIds(): void
    {
        $chain = new DCLChain('test_key', 'Test Field', false, true);

        // Test with various list ID formats
        $chain->listOption('simple_list');
        $chain->listOption('list-with-dashes');
        $chain->listOption('list_with_underscores');
        $chain->listOption('123numeric_list');

        // If we get here without exceptions, the method accepts different formats
        $this->assertTrue(true);
    }
}
