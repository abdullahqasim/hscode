<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HSCode;

class HSCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['hscode_id' => '71131900'],
            ['hscode_id' => '401691'],
            ['hscode_id' => '570299'],
            ['hscode_id' => '9701910000'],
            ['hscode_id' => '9701910000'],
            ['hscode_id' => '9101210000'],
            ['hscode_id' => '9706000000'],
            ['hscode_id' => '5805000000'],
            ['hscode_id' => '9705100090'],
            ['hscode_id' => '9706100000'],
            ['hscode_id' => '9701910000'],
            ['hscode_id' => '4414109000'],
            ['hscode_id' => '9403208000'],
            ['hscode_id' => '8306290000'],
            ['hscode_id' => '940599009'],
            ['hscode_id' => '940521500'],
            ['hscode_id' => '590320100'],
            ['hscode_id' => '590320100'],
            ['hscode_id' => '940159000'],
            ['hscode_id' => '940159000'],
            ['hscode_id' => '590320100'],
            ['hscode_id' => '590320100'],
            ['hscode_id' => '590320100'],
            ['hscode_id' => '590320100'],
            ['hscode_id' => '590320100'],
            ['hscode_id' => '940179000'],
            ['hscode_id' => '940179000'],
            ['hscode_id' => '940179000'],
            ['hscode_id' => '940179000'],
            ['hscode_id' => '940179000'],
            ['hscode_id' => '940179000'],
            ['hscode_id' => '940360100'],
            ['hscode_id' => '940360100'],
            ['hscode_id' => '940139000'],
            ['hscode_id' => '940139000'],
            ['hscode_id' => '940139000'],
            ['hscode_id' => '940139000'],
            ['hscode_id' => '9401390000'],
        ];
        HSCode::insert($data);
    }
}
