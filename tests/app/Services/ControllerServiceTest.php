<?php

namespace App\Services;

use App\BaseFunctionalTestCase;

class ControllerServiceTest extends BaseFunctionalTestCase
{
    /**
     * @var ControllerService
     */
    private $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(ControllerService::class);
    }

    public function testItCreatesLegacyControllerPositionsDependency()
    {
        $expected = [
            'EGLL_S_TWR' => [
                'frequency' => 118.5,
                'top-down' => [
                    'EGLL',
                ],
            ],
            'EGLL_N_APP' => [
                'frequency' => 119.72,
                'top-down' => [
                    'EGLL',
                ],
            ],
            'LON_S_CTR' => [
                'frequency' => 129.42,
                'top-down' => [
                    'EGLL',
                ],
            ],
            'LON_C_CTR' => [
                'frequency' => 127.1,
                'top-down' => [
                    'EGBB',
                ],
            ],
        ];

        $actual = $this->service->getLegacyControllerPositionsDependency();
        $this->assertSame($expected, $actual);
    }

    public function testItCreatesLegacyAirfieldOwnershipDependency()
    {
        $expected = [
            'EGLL' => [
                'EGLL_S_TWR',
                'EGLL_N_APP',
                'LON_S_CTR',
            ],
            'EGBB' => [
                'LON_C_CTR',
            ],
        ];

        $actual = $this->service->getLegacyAirfieldOwnershipDependency();
        $this->assertSame($expected, $actual);
    }

    /**
     * @dataProvider controllerLevelProvider
     */
    public function testItGetsControllerLevelFromCallsign(string $value, string $expected)
    {
        $this->assertEquals($expected, ControllerService::getControllerLevelFromCallsign($value));
    }

    public function controllerLevelProvider(): array
    {
        return [
            ['', ''],
            ['EGKK_DEL', 'DEL'],
            ['EGKK_GND', 'GND'],
            ['EGKK_TWR', 'TWR'],
            ['EGKK_APP', 'APP'],
            ['LON_S_CTR', 'CTR'],
            ['egkk_del', 'DEL'],
            ['egkk_gnd', 'GND'],
            ['egkk_twr', 'TWR'],
            ['egkk_app', 'APP'],
            ['lon_s_ctr', 'CTR'],
        ];
    }

    /**
     * @dataProvider controllerFacilityProvider
     */
    public function testItGetsControllerFacilityFromCallsign(string $value, string $expected)
    {
        $this->assertEquals($expected, ControllerService::getControllerFacilityFromCallsign($value));
    }

    public function controllerFacilityProvider(): array
    {
        return [
            ['EGKK', 'EGKK'],
            ['EGKK_DEL', 'EGKK'],
            ['EGKK_TWR', 'EGKK'],
            ['SCO_CTR', 'SCO'],
            ['LTC_CTR', 'LTC'],
            ['STC_1_CTR', 'STC'],
            ['LON_S_CTR', 'LON'],
            ['egkk', 'EGKK'],
            ['egkk_del', 'EGKK'],
            ['egkk_twr', 'EGKK'],
            ['sco_ctr', 'SCO'],
            ['ltc_ctr', 'LTC'],
            ['stc_ctr', 'STC'],
            ['lon_s_ctr', 'LON'],
        ];
    }
}
