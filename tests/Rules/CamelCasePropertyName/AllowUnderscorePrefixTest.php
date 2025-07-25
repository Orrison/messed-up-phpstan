<?php

declare(strict_types = 1);

namespace Orrison\MessedUpPhpstan\Tests\Rules\CamelCasePropertyName;

use Orrison\MessedUpPhpstan\Rules\CamelCasePropertyName\CamelCasePropertyNameRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/**
 * @extends RuleTestCase<CamelCasePropertyNameRule>
 */
class AllowUnderscorePrefixTest extends RuleTestCase
{
    public function testExampleClass(): void
    {
        $this->analyse([
            __DIR__ . '/Fixture/ExampleClass.php',
        ], [
            ['Property name "is_http_response" is not in camelCase.', 9],
            ['Property name "IsHttpResponse" is not in camelCase.', 11],
            ['Property name "isHTTPResponse" is not in camelCase.', 13],
            ['Property name "IsHTTPResponse" is not in camelCase.', 15],
            ['Property name "ISHTTPRESPONSE" is not in camelCase.', 17],
            ['Property name "_isHTTPResponse" is not in camelCase.', 21],
        ]);
    }

    public static function getAdditionalConfigFiles(): array
    {
        return [__DIR__ . '/config/allow_underscore_prefix.neon'];
    }

    protected function getRule(): Rule
    {
        return self::getContainer()->getByType(CamelCasePropertyNameRule::class);
    }
}
