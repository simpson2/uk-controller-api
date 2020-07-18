<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddLondonFlightInformationRegionData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $firId = DB::table('flight_information_regions')
            ->insertGetId(
                [
                    'identification_code' => 'EGTT',
                    'created_at' => Carbon::now(),
                ]
            );

        DB::table('flight_information_region_boundaries')->insert(
            [
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N055.00.00.000',
                    'start_longitude' => 'E005.00.00.000',
                    'finish_latitude' => 'N054.30.01.192',
                    'finish_longitude' => 'E004.32.36.161',
                    'description' => 'Northern boundary to near TIPAN/UNVAR',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N054.30.01.192',
                    'start_longitude' => 'E004.32.36.161',
                    'finish_latitude' => 'N053.59.17.840',
                    'finish_longitude' => 'E004.05.28.691',
                    'description' => 'Just north of LONAM',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N053.59.17.840',
                    'start_longitude' => 'E004.05.28.691',
                    'finish_latitude' => 'N053.34.08.558',
                    'finish_longitude' => 'E003.42.30.982',
                    'description' => 'LONAM - Area near LARDI',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N053.34.08.558',
                    'start_longitude' => 'E003.42.30.982',
                    'finish_latitude' => 'N053.27.55.001',
                    'finish_longitude' => 'E003.36.56.002',
                    'description' => 'LARDI - Just north of TOPPA',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N053.27.55.001',
                    'start_longitude' => 'E003.36.56.002',
                    'finish_latitude' => 'N053.10.30.461',
                    'finish_longitude' => 'E003.21.57.010',
                    'description' => 'TOPPA, GODOS',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N053.10.30.461',
                    'start_longitude' => 'E003.21.57.010',
                    'finish_latitude' => 'N052.57.32.551',
                    'finish_longitude' => 'E003.11.07.732',
                    'description' => 'MIMVA, KOLAG',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N052.57.32.551',
                    'start_longitude' => 'E003.11.07.732',
                    'finish_latitude' => 'N052.37.05.380',
                    'finish_longitude' => 'E002.54.03.740',
                    'description' => 'RAVLO, MOLIX, LAMSO',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N052.37.05.380',
                    'start_longitude' => 'E002.54.03.740',
                    'finish_latitude' => 'N052.28.34.950',
                    'finish_longitude' => 'E002.47.46.021',
                    'description' => 'NAVPI',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N052.28.34.950',
                    'start_longitude' => 'E002.47.46.021',
                    'finish_latitude' => 'N052.23.20.378',
                    'finish_longitude' => 'E002.43.29.798',
                    'description' => 'Line below NAVPI above SOMVA',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N052.23.20.378',
                    'start_longitude' => 'E002.43.29.798',
                    'finish_latitude' => 'N052.13.52.770',
                    'finish_longitude' => 'E002.35.21.300',
                    'description' => 'SOMVA',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N052.13.52.770',
                    'start_longitude' => 'E002.35.21.300',
                    'finish_latitude' => 'N051.52.30.850',
                    'finish_longitude' => 'E002.17.41.870',
                    'description' => 'REDFA, RINIS',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N051.52.30.850',
                    'start_longitude' => 'E002.17.41.870',
                    'finish_latitude' => 'N051.42.23.288',
                    'finish_longitude' => 'E002.09.44.230',
                    'description' => 'XAMAN, RIMBU',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N051.42.23.288',
                    'start_longitude' => 'E002.09.44.230',
                    'finish_latitude' => 'N051.30.00.000',
                    'finish_longitude' => 'E002.00.00.000',
                    'description' => 'SUMUM, GILTI',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N051.30.00.000',
                    'start_longitude' => 'E002.00.00.000',
                    'finish_latitude' => 'N051.07.00.001',
                    'finish_longitude' => 'E002.00.00.000',
                    'description' => 'RAPIX, VABIK, KONAN',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N051.07.00.001',
                    'start_longitude' => 'E002.00.00.000',
                    'finish_latitude' => 'N051.00.00.000',
                    'finish_longitude' => 'E001.28.00.001',
                    'description' => 'RINTI',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N051.00.00.000',
                    'start_longitude' => 'E001.28.00.001',
                    'finish_latitude' => 'N050.40.00.001',
                    'finish_longitude' => 'E001.28.00.001',
                    'description' => 'MOTOX, IRKUN, DEVAL, SOVAT',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N050.40.00.001',
                    'start_longitude' => 'E001.28.00.001',
                    'finish_latitude' => 'N050.00.00.000',
                    'finish_longitude' => 'W000.15.00.000',
                    'description' => 'XIDIL, XAMAB, SITET',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N050.00.00.000',
                    'start_longitude' => 'W000.15.00.000',
                    'finish_latitude' => 'N050.00.00.000',
                    'finish_longitude' => 'W002.00.00.000',
                    'description' => 'NEVIL, KOTEM, GARMI, BOLRO, ORIST, ORTAC',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N050.00.00.000',
                    'start_longitude' => 'W002.00.00.000',
                    'finish_latitude' => 'N049.49.29.000',
                    'finish_longitude' => 'W003.02.03.000',
                    'description' => 'ORTAC, LELNA, LORKU, SKESO',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N049.49.29.000',
                    'start_longitude' => 'W003.02.03.000',
                    'finish_latitude' => 'N049.47.07.000',
                    'finish_longitude' => 'W003.15.34.000',
                    'description' => 'MANIG',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N049.47.07.000',
                    'start_longitude' => 'W003.15.34.000',
                    'finish_latitude' => 'N049.44.14.000',
                    'finish_longitude' => 'W003.31.46.000',
                    'description' => 'SALCO',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N049.44.14.000',
                    'start_longitude' => 'W003.31.46.000',
                    'finish_latitude' => 'N049.39.05.000',
                    'finish_longitude' => 'W004.00.05.000',
                    'description' => 'ANNET',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N049.39.05.000',
                    'start_longitude' => 'W004.00.05.000',
                    'finish_latitude' => 'N049.35.25.000',
                    'finish_longitude' => 'W004.19.49.000',
                    'description' => 'LIZAD',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N049.35.25.000',
                    'start_longitude' => 'W004.19.49.000',
                    'finish_latitude' => 'N049.24.38.000',
                    'finish_longitude' => 'W005.15.59.000',
                    'description' => 'OGAGI, PIKOD',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N049.24.38.000',
                    'start_longitude' => 'W005.15.59.000',
                    'finish_latitude' => 'N049.17.30.000',
                    'finish_longitude' => 'W005.51.35.000',
                    'description' => 'CAMBO',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N049.17.30.000',
                    'start_longitude' => 'W005.51.35.000',
                    'finish_latitude' => 'N049.00.26.000',
                    'finish_longitude' => 'W007.12.53.000',
                    'description' => 'MOSIS',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N049.00.26.000',
                    'start_longitude' => 'W007.12.53.000',
                    'finish_latitude' => 'N048.49.59.999',
                    'finish_longitude' => 'W008.00.00.000',
                    'description' => 'South-west corner of FIR',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N048.49.59.999',
                    'start_longitude' => 'W008.00.00.000',
                    'finish_latitude' => 'N051.00.00.000',
                    'finish_longitude' => 'W008.00.00.000',
                    'description' => 'TAKAS, BISKI, RATKA, GAPLI, TURLU, ARKIL, LESLU',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N051.00.00.000',
                    'start_longitude' => 'W008.00.00.000',
                    'finish_latitude' => 'N051.14.24.000',
                    'finish_longitude' => 'W007.34.05.000',
                    'description' => 'LESLU, LEDGO',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N051.14.24.000',
                    'start_longitude' => 'W007.34.05.000',
                    'finish_latitude' => 'N051.29.55.000',
                    'finish_longitude' => 'W007.05.37.000',
                    'description' => 'SAMON, MOPAT',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N051.29.55.000',
                    'start_longitude' => 'W007.05.37.000',
                    'finish_latitude' => 'N051.37.09.000',
                    'finish_longitude' => 'W006.52.11.000',
                    'description' => 'NORLA',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N051.37.09.000',
                    'start_longitude' => 'W006.52.11.000',
                    'finish_latitude' => 'N051.46.56.000',
                    'finish_longitude' => 'W006.33.48.000',
                    'description' => 'EVRIN',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N051.46.56.000',
                    'start_longitude' => 'W006.33.48.000',
                    'finish_latitude' => 'N051.57.10.000',
                    'finish_longitude' => 'W006.14.21.000',
                    'description' => 'BANBA',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N051.57.10.000',
                    'start_longitude' => 'W006.14.21.000',
                    'finish_latitude' => 'N052.09.31.000',
                    'finish_longitude' => 'W005.50.32.000',
                    'description' => 'SLANY',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N052.09.31.000',
                    'start_longitude' => 'W005.50.32.000',
                    'finish_latitude' => 'N052.14.30.000',
                    'finish_longitude' => 'W005.40.49.000',
                    'description' => 'BAKUR',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N052.14.30.000',
                    'start_longitude' => 'W005.40.49.000',
                    'finish_latitude' => 'N052.19.59.999',
                    'finish_longitude' => 'W005.30.00.000',
                    'description' => 'Corner by BAKUR',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N052.19.59.999',
                    'start_longitude' => 'W005.30.00.000',
                    'finish_latitude' => 'N055.00.00.000',
                    'finish_longitude' => 'W005.30.00.000',
                    'description' => 'VATRY, MORAG, LIPGO, DEXEN, LIFFY, BAGSO, BOYNE to Top left of FIR',
                    'created_at' => Carbon::now(),
                ],
                [
                    'flight_information_region_id' => $firId,
                    'start_latitude' => 'N055.00.00.000',
                    'start_longitude' => 'W005.30.00.000',
                    'finish_latitude' => 'N055.00.00.000',
                    'finish_longitude' => 'E005.00.00.000',
                    'description' => 'Top line of FIR',
                    'created_at' => Carbon::now(),
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('flight_information_regions')->where('identification_code', 'EGTT')->delete();
    }
}
