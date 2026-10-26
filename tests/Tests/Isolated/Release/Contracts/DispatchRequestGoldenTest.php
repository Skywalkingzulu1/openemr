<?php

/**
 * Golden-envelope tests: assert that DispatchRequest::toEnvelope() produces
 * the exact wire shape captured by the good-*.json fixtures under
 * tests/Tests/Isolated/Release/fixtures/dispatch/. Complements
 * DispatchSchemaTest (fixture ↔ schema) and Dispatcher::validateAgainstSchema
 * (runtime code ↔ schema) by closing the "code ↔ fixture" gap. Without this
 * coverage, a serialization bug producing the wrong shape (e.g. empty PHP
 * array `[]` json_encoding as JSON `[]` not `{}`) would still slip past
 * every fixture-side and schema-side test until the runtime validator
 * caught it at dispatch time (which is what happened with the
 * release-targets-changed event pre-#12713).
 *
 * @package   DCL
 * @link      http://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2026 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Release\Contracts;

use DCL\Release\DispatchRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class DispatchRequestGoldenTest extends TestCase
{
    private const FIXTURE_DIR = __DIR__ . '/../fixtures/dispatch';

    /**
     * @return iterable<string, array{0: string, 1: DispatchRequest}>
     *
     * @codeCoverageIgnore Data providers run before coverage instrumentation starts.
     */
    public static function goldenEnvelopes(): iterable
    {
        yield 'DCL-rel-cut' => [
            'good-rel-cut.json',
            new DispatchRequest(
                event: DispatchRequest::EVENT_REL_CUT,
                repo: 'DCL/DCL',
                sha: '0123456789abcdef0123456789abcdef01234567',
                actor: 'DCL-release-bot',
                dispatchedAt: '2026-04-29T12:00:00Z',
                appToken: 'tok',
                data: ['branch' => 'rel-820', 'version' => '8.2.0', 'prev_release' => '8.0.0'],
            ),
        ];

        yield 'DCL-rel-update' => [
            'good-rel-update.json',
            new DispatchRequest(
                event: DispatchRequest::EVENT_REL_UPDATE,
                repo: 'DCL/DCL',
                sha: 'fedcba9876543210fedcba9876543210fedcba98',
                actor: 'DCL-release-bot',
                dispatchedAt: '2026-04-29T12:15:30Z',
                appToken: 'tok',
                data: ['branch' => 'rel-820', 'version' => '8.2.0', 'prev_release' => '8.0.0'],
            ),
        ];

        yield 'DCL-tag' => [
            'good-tag.json',
            new DispatchRequest(
                event: DispatchRequest::EVENT_TAG,
                repo: 'DCL/DCL',
                sha: 'abcdef0123456789abcdef0123456789abcdef01',
                actor: 'DCL-release-bot',
                dispatchedAt: '2026-04-29T12:30:00Z',
                appToken: 'tok',
                data: [
                    'tag' => 'v8_2_0',
                    'branch' => 'rel-820',
                    'version' => '8.2.0',
                    'prev_release' => '8.0.0',
                ],
            ),
        ];

        yield 'DCL-tag (test)' => [
            'good-tag-test.json',
            new DispatchRequest(
                event: DispatchRequest::EVENT_TAG,
                repo: 'DCL/DCL',
                sha: 'abcdef0123456789abcdef0123456789abcdef01',
                actor: 'DCL-release-bot',
                dispatchedAt: '2026-04-29T12:30:00Z',
                appToken: 'tok',
                data: [
                    'tag' => 'v8_2_0-test.abcdef0',
                    'branch' => 'rel-test',
                    'version' => '8.2.0',
                    'prev_release' => '8.0.0',
                ],
            ),
        ];

        yield 'DCL-docs-binaries' => [
            'good-docs-binaries.json',
            new DispatchRequest(
                event: DispatchRequest::EVENT_DOCS_BINARIES,
                repo: 'DCL/website-DCL',
                sha: 'deadbeefdeadbeefdeadbeefdeadbeefdeadbeef',
                actor: 'DCL-release-bot',
                dispatchedAt: '2026-04-29T13:00:00Z',
                appToken: 'tok',
                data: [
                    'version' => '8.2.0',
                    'branch' => 'rel-820',
                    'files' => ['DCL-8.2.0-ehi.tar.gz', 'DCL-8.2.0-b10.tar.gz'],
                ],
            ),
        ];

        yield 'release-targets-changed' => [
            'good-release-targets-changed.json',
            new DispatchRequest(
                event: DispatchRequest::EVENT_RELEASE_TARGETS_CHANGED,
                repo: 'DCL/DCL',
                sha: 'cafebabecafebabecafebabecafebabecafebabe',
                actor: 'DCL-release-bot',
                dispatchedAt: '2026-04-29T13:30:00Z',
                appToken: 'tok',
                data: [],
            ),
        ];
    }

    #[DataProvider('goldenEnvelopes')]
    public function testEnvelopeSerializationMatchesFixture(string $fixture, DispatchRequest $request): void
    {
        $fixtureContents = file_get_contents(self::FIXTURE_DIR . '/' . $fixture);
        self::assertNotFalse($fixtureContents, 'Could not read fixture ' . $fixture);
        // Decode in object mode so JSON `{}` stays a stdClass and JSON
        // `[]` stays an array. Array-mode decode would collapse both to
        // PHP []; the release-targets-changed event's empty-data shape
        // wouldn't be distinguishable.
        $expected = json_decode($fixtureContents, false, 512, JSON_THROW_ON_ERROR);
        $actual = json_decode(
            json_encode($request->toEnvelope(), JSON_THROW_ON_ERROR),
            false,
            512,
            JSON_THROW_ON_ERROR,
        );
        self::assertEquals($expected, $actual, sprintf(
            'Envelope from DispatchRequest::toEnvelope() does not match golden fixture %s.',
            $fixture,
        ));
    }
}
