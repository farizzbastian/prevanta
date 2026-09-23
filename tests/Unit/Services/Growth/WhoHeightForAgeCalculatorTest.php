<?php

namespace Tests\Unit\Services\Growth;

use App\Gender;
use App\GrowthStatus;
use App\Services\Growth\WhoHeightForAgeCalculator;
use Carbon\CarbonImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class WhoHeightForAgeCalculatorTest extends TestCase
{
    private WhoHeightForAgeCalculator $calculator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->calculator = new WhoHeightForAgeCalculator(
            dirname(__DIR__, 4).DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'who',
        );
    }

    public function test_boys_median_at_birth_has_zero_z_score_and_uses_length_for_age(): void
    {
        $birthDate = CarbonImmutable::parse('2026-01-01');

        $result = $this->calculator->calculate(
            Gender::LakiLaki,
            $birthDate,
            $birthDate,
            49.8842,
        );

        $this->assertSame(0.0, $result->zScore);
        $this->assertSame(GrowthStatus::Normal, $result->status);
        $this->assertSame('PB/U', $result->indicator);
        $this->assertSame(0, $result->ageInDays);
    }

    public function test_girls_median_after_two_year_transition_uses_height_for_age(): void
    {
        $birthDate = CarbonImmutable::parse('2024-01-01');

        $result = $this->calculator->calculate(
            Gender::Perempuan,
            $birthDate,
            $birthDate->addDays(731),
            85.7299,
        );

        $this->assertSame(0.0, $result->zScore);
        $this->assertSame(GrowthStatus::Normal, $result->status);
        $this->assertSame('TB/U', $result->indicator);
        $this->assertSame(731, $result->ageInDays);
    }

    public function test_short_height_is_classified_from_who_lms_values(): void
    {
        $birthDate = CarbonImmutable::parse('2026-01-01');

        $result = $this->calculator->calculate(
            Gender::LakiLaki,
            $birthDate,
            $birthDate,
            45.1519,
        );

        $this->assertSame(-2.5, $result->zScore);
        $this->assertSame(GrowthStatus::Pendek, $result->status);
    }

    public function test_rejects_measurement_outside_the_zero_to_five_year_standard(): void
    {
        $birthDate = CarbonImmutable::parse('2020-01-01');

        $this->expectException(InvalidArgumentException::class);

        $this->calculator->calculate(
            Gender::LakiLaki,
            $birthDate,
            $birthDate->addDays(1857),
            110,
        );
    }
}
