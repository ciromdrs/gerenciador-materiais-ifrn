<?php

namespace Database\Seeders;

use App\Models\Local;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Local::create(['nome' => 'Ginásio']);
        Local::create(['nome' => 'Sala dos Servidores']);
        Local::create(['nome' => 'COAPAC']);
        Local::create(['nome' => 'Academia']);
    }
}
