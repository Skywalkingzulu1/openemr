<?php

/**
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 * @link      https://www.dcl.org
 * @package   DCL
 */

declare(strict_types=1);

namespace DCL\PaymentProcessing\Rainforest;

use JsonSerializable;
use Money\{
    Currency,
    Money,
};

/**
 * Data exchange class for dealing with Rainforest metadata payloads and
 * translating back into DCL payment info
 */
readonly class EncounterData implements JsonSerializable
{
    public function __construct(
        public string $id,
        public string $code,
        public string $codeType,
        public Money $amount,
    ) {
    }

    /**
     * @return array{
     *   id: string,
     *   code: string,
     *   codeType: string,
     *   amount: Money,
     * }
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'codeType' => $this->codeType,
            'amount' => $this->amount,
        ];
    }

    /**
     * @param mixed $data array{
     *   id: string,
     *   code: string,
     *   codeType: string,
     *   amount: array{
     *     amount: numeric-string,
     *     currency: non-empty-string,
     *   },
     * } $data
     */
    public static function fromParsedJson(array $data): EncounterData
    {
        return new EncounterData(
            id: $data['id'],
            code: $data['code'],
            codeType: $data['codeType'],
            amount: new Money(
                amount: $data['amount']['amount'],
                currency: new Currency($data['amount']['currency']),
            ),
        );
    }
}
