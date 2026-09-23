<?php

namespace Tests\Unit;

use App\GrowthStatus;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class GrowthStatusTest extends TestCase
{
    #[DataProvider('zScoreClassifications')]
    public function test_classifies_z_score_using_the_required_boundaries(float $zScore, GrowthStatus $expected): void
    {
        $this->assertSame($expected, GrowthStatus::fromZScore($zScore));
    }

    /**
     * @return array<string, array{float, GrowthStatus}>
     */
    public static function zScoreClassifications(): array
    {
        return [
            'above minus two is normal' => [-1.999, GrowthStatus::Normal],
            'minus two is normal' => [-2.0, GrowthStatus::Normal],
            'below minus two is short' => [-2.001, GrowthStatus::Pendek],
            'minus three is short' => [-3.0, GrowthStatus::Pendek],
            'below minus three is severely short' => [-3.001, GrowthStatus::SangatPendek],
        ];
    }
}
