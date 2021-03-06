<?php

namespace App\Listeners\Squawk;

use App\BaseFunctionalTestCase;
use App\Events\NetworkAircraftUpdatedEvent;
use App\Events\SquawkAssignmentEvent;
use App\Events\SquawkUnassignedEvent;
use App\Models\Squawk\Ccams\CcamsSquawkAssignment;
use App\Models\Squawk\Ccams\CcamsSquawkRange;
use App\Models\Vatsim\NetworkAircraft;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReserveInFirProximityTest extends BaseFunctionalTestCase
{
    /**
     * @var ReserveInFirProximity
     */
    private $listener;

    public function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow(Carbon::now());
        $this->listener = $this->app->make(ReserveInFirProximity::class);
        CcamsSquawkRange::create(
            [
                'first' => '1234',
                'last' => '1234',
            ]
        );
    }

    private function callListener(): bool
    {
        return $this->listener->handle(new NetworkAircraftUpdatedEvent(NetworkAircraft::find('BAW123')));
    }

    public function testItDoesNothingIfOutsideProximity()
    {
        $this->doesntExpectEvents(SquawkUnassignedEvent::class);
        NetworkAircraft::where('callsign', 'BAW123')->update(['latitude' => '36.09', 'longitude' => '-115.15']);
        $this->assertTrue($this->callListener());
        $this->assertDatabaseMissing(
            'ccams_squawk_assignments',
            [
                'callsign' => 'BAW123',
            ]
        );
    }

    public function testItDoesNothingIfMatchesAssigned()
    {
        $this->doesntExpectEvents(SquawkAssignmentEvent::class);
        CcamsSquawkAssignment::create(
            [
                'callsign' => 'BAW123',
                'code' => '1234'
            ]
        );

        NetworkAircraft::where('callsign', 'BAW123')->update(['latitude' => '54.66', 'longitude' => '-6.21']);
        $this->assertTrue($this->callListener());
        $this->assertDatabaseHas(
            'ccams_squawk_assignments',
            [
                'callsign' => 'BAW123',
                'code' => '1234',
            ]
        );
    }

    public function testItDoesNothingIfCodeRecentlyUpdated()
    {
        $this->doesntExpectEvents([SquawkAssignmentEvent::class, SquawkUnassignedEvent::class]);
        DB::table('network_aircraft')
            ->where('callsign', 'BAW123')
            ->update(
                [
                    'latitude' => '54.66',
                    'longitude' => '-6.21',
                    'transponder' => '0101',
                    'transponder_last_updated_at' => Carbon::now()->subMinutes(2)->addSecond()
                ]
            );
        $this->assertTrue($this->callListener());
        $this->assertDatabaseMissing(
            'ccams_squawk_assignments',
            [
                'callsign' => 'BAW123',
            ]
        );
    }

    public function testItDoesNothingIfSquawkingReservedCodeOnTheGround()
    {
        $this->doesntExpectEvents([SquawkAssignmentEvent::class, SquawkUnassignedEvent::class]);
        CcamsSquawkAssignment::create(
            [
                'callsign' => 'BAW123',
                'code' => '7212'
            ]
        );
        DB::table('network_aircraft')
            ->where('callsign', 'BAW123')
            ->update(
                [
                    'latitude' => '54.66',
                    'longitude' => '-6.21',
                    'transponder' => '7000',
                    'groundspeed' => 25,
                    'transponder_last_updated_at' => Carbon::now()->subMinutes(3),
                ]
            );
        $this->assertTrue($this->callListener());
        $this->assertDatabaseHas(
            'ccams_squawk_assignments',
            [
                'callsign' => 'BAW123',
                'code' => '7212'
            ]
        );
    }

    public function testItDoesNothingIfSquawkingBannedCodeInTheAir()
    {
        $this->doesntExpectEvents([SquawkAssignmentEvent::class, SquawkUnassignedEvent::class]);
        CcamsSquawkAssignment::create(
            [
                'callsign' => 'BAW123',
                'code' => '7212'
            ]
        );
        DB::table('network_aircraft')
            ->where('callsign', 'BAW123')
            ->update(
                [
                    'latitude' => '54.66',
                    'longitude' => '-6.21',
                    'transponder' => '7500',
                    'groundspeed' => 125,
                    'transponder_last_updated_at' => Carbon::now()->subMinutes(3),
                ]
            );
        $this->assertTrue($this->callListener());
        $this->assertDatabaseHas(
            'ccams_squawk_assignments',
            [
                'callsign' => 'BAW123',
                'code' => '7212'
            ]
        );
    }

    public function testItDoesNothingIfSquawkingRadioFailureInTheAir()
    {
        $this->doesntExpectEvents([SquawkAssignmentEvent::class, SquawkUnassignedEvent::class]);
        CcamsSquawkAssignment::create(
            [
                'callsign' => 'BAW123',
                'code' => '7212'
            ]
        );
        DB::table('network_aircraft')
            ->where('callsign', 'BAW123')
            ->update(
                [
                    'latitude' => '54.66',
                    'longitude' => '-6.21',
                    'transponder' => '7600',
                    'groundspeed' => 125,
                    'transponder_last_updated_at' => Carbon::now()->subMinutes(3),
                ]
            );
        $this->assertTrue($this->callListener());
        $this->assertDatabaseHas(
            'ccams_squawk_assignments',
            [
                'callsign' => 'BAW123',
                'code' => '7212'
            ]
        );
    }

    public function testItDoesNothingIfSquawkingMaydayInTheAir()
    {
        $this->doesntExpectEvents([SquawkAssignmentEvent::class, SquawkUnassignedEvent::class]);
        CcamsSquawkAssignment::create(
            [
                'callsign' => 'BAW123',
                'code' => '7212'
            ]
        );
        DB::table('network_aircraft')
            ->where('callsign', 'BAW123')
            ->update(
                [
                    'latitude' => '54.66',
                    'longitude' => '-6.21',
                    'transponder' => '7700',
                    'groundspeed' => 125,
                    'transponder_last_updated_at' => Carbon::now()->subMinutes(3),
                ]
            );
        $this->assertTrue($this->callListener());
        $this->assertDatabaseHas(
            'ccams_squawk_assignments',
            [
                'callsign' => 'BAW123',
                'code' => '7212'
            ]
        );
    }

    public function testItDoesFreshAssignmentIfInProximity()
    {
        $this->expectsEvents(SquawkAssignmentEvent::class);
        DB::table('network_aircraft')
            ->where('callsign', 'BAW123')
            ->update(
                [
                    'latitude' => '54.66',
                    'longitude' => '-6.21',
                    'transponder_last_updated_at' => Carbon::now()->subMinutes(2)->subSeconds(10)
                ]
            );
        $this->assertTrue($this->callListener());
        $this->assertDatabaseHas(
            'ccams_squawk_assignments',
            [
                'callsign' => 'BAW123',
                'code' => '1234',
            ]
        );
    }

    public function testItAssignsNewCodeOnUpdateIfNotConflicting()
    {
        $this->expectsEvents([SquawkAssignmentEvent::class, SquawkUnassignedEvent::class]);
        CcamsSquawkAssignment::create(
            [
                'callsign' => 'BAW123',
                'code' => '0001',
            ]
        );
        DB::table('network_aircraft')
            ->where('callsign', 'BAW123')
            ->update(
                [
                    'latitude' => '54.66',
                    'longitude' => '-6.21',
                    'transponder_last_updated_at' => Carbon::now()->subMinutes(2)->subSeconds(10)
                ]
            );
        $this->assertTrue($this->callListener());
        $this->assertDatabaseHas(
            'ccams_squawk_assignments',
            [
                'callsign' => 'BAW123',
                'code' => '1234',
            ]
        );
    }

    public function testItRemovesOldAssignmentButDoesntAssignNewIfConflict()
    {
        $this->doesntExpectEvents(SquawkAssignmentEvent::class);
        $this->expectsEvents(SquawkUnassignedEvent::class);
        CcamsSquawkAssignment::create(
            [
                'callsign' => 'BAW456',
                'code' => '1234'
            ]
        );
        CcamsSquawkAssignment::create(
            [
                'callsign' => 'BAW123',
                'code' => '0101'
            ]
        );
        DB::table('network_aircraft')
            ->where('callsign', 'BAW123')
            ->update(
                [
                    'latitude' => '54.66',
                    'longitude' => '-6.21',
                    'transponder_last_updated_at' => Carbon::now()->subMinutes(2)->subSecond()
                ]
            );

        $this->assertTrue($this->callListener());
        $this->assertDatabaseHas(
            'ccams_squawk_assignments',
            [
                'callsign' => 'BAW456',
                'code' => '1234',
            ]
        );
        $this->assertDatabaseMissing(
            'ccams_squawk_assignments',
            [
                'callsign' => 'BAW123',
            ]
        );
    }

    public function testItRemovesOldAssignmentButDoesntAssignNewIfSquawkingNonMaydayReservedCodeInTheAir()
    {
        $this->doesntExpectEvents(SquawkAssignmentEvent::class);
        $this->expectsEvents(SquawkUnassignedEvent::class);
        CcamsSquawkAssignment::create(
            [
                'callsign' => 'BAW123',
                'code' => '0101'
            ]
        );
        DB::table('network_aircraft')
            ->where('callsign', 'BAW123')
            ->update(
                [
                    'latitude' => '54.66',
                    'longitude' => '-6.21',
                    'groundspeed' => '125',
                    'transponder' => '7000',
                    'transponder_last_updated_at' => Carbon::now()->subMinutes(2)->subSecond()
                ]
            );

        $this->assertTrue($this->callListener());
        $this->assertDatabaseMissing(
            'ccams_squawk_assignments',
            [
                'callsign' => 'BAW123',
            ]
        );
    }

    public function testItDoesntAddNewAssignmentIfConflict()
    {
        $this->doesntExpectEvents(SquawkAssignmentEvent::class);
        CcamsSquawkAssignment::create(
            [
                'callsign' => 'BAW456',
                'code' => '1234'
            ]
        );
        DB::table('network_aircraft')
            ->where('callsign', 'BAW123')
            ->update(
                [
                    'latitude' => '54.66',
                    'longitude' => '-6.21',
                    'transponder_last_updated_at' => Carbon::now()->subMinutes(2)->subSecond()
                ]
            );

        $this->assertTrue($this->callListener());
        $this->assertDatabaseHas(
            'ccams_squawk_assignments',
            [
                'callsign' => 'BAW456',
                'code' => '1234',
            ]
        );
        $this->assertDatabaseMissing(
            'ccams_squawk_assignments',
            [
                'callsign' => 'BAW123',
            ]
        );
    }
}
