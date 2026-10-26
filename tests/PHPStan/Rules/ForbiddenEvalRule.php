<?php

/**
 * Custom PHPStan Rule to Forbid eval()
 *
 * Prevents use of PHP's eval() language construct, which executes arbitrary
 * PHP code from a string.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\PHPStan\Rules;

use PhpParser\Node;
use PhpParser\Node\Expr\Eval_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<Eval_>
 */
class ForbiddenEvalRule implements Rule
{
    public function getNodeType(): string
    {
        return Eval_::class;
    }

    /**
     * @param Eval_ $node
     * @return list<\PHPStan\Rules\IdentifierRuleError>
     */
    public function processNode(Node $node, Scope $scope): array
    {
        return [
            RuleErrorBuilder::message(
                'eval() is forbidden. It executes arbitrary PHP code and is a critical security risk.'
            )
                ->identifier('DCL.forbiddenEval')
                ->tip('Refactor to avoid dynamic code execution entirely')
                ->build()
        ];
    }
}
