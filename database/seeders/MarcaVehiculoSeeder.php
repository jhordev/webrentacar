<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MarcaVehiculo;

class MarcaVehiculoSeeder extends Seeder
{
    public function run(): void
    {
        $marcas = [
            // === AUTOS ===
            ['marca' => 'Toyota', 'tipo_vehiculo' => 'auto'],
            ['marca' => 'Honda', 'tipo_vehiculo' => 'auto'],
            ['marca' => 'Nissan', 'tipo_vehiculo' => 'auto'],
            ['marca' => 'Chevrolet', 'tipo_vehiculo' => 'auto'],
            ['marca' => 'Volkswagen', 'tipo_vehiculo' => 'auto'],
            ['marca' => 'Ford', 'tipo_vehiculo' => 'auto'],
            ['marca' => 'Hyundai', 'tipo_vehiculo' => 'auto'],
            ['marca' => 'Kia', 'tipo_vehiculo' => 'auto'],
            ['marca' => 'Mazda', 'tipo_vehiculo' => 'auto'],
            ['marca' => 'Suzuki', 'tipo_vehiculo' => 'auto'],

            // === MOTOS ===
            ['marca' => 'Yamaha', 'tipo_vehiculo' => 'moto'],
            ['marca' => 'Honda', 'tipo_vehiculo' => 'moto'],
            ['marca' => 'Suzuki', 'tipo_vehiculo' => 'moto'],
            ['marca' => 'Kawasaki', 'tipo_vehiculo' => 'moto'],
            ['marca' => 'Bajaj', 'tipo_vehiculo' => 'moto'],
            ['marca' => 'TVS', 'tipo_vehiculo' => 'moto'],
            ['marca' => 'Italika', 'tipo_vehiculo' => 'moto'],
            ['marca' => 'Vento', 'tipo_vehiculo' => 'moto'],
            ['marca' => 'Lifan', 'tipo_vehiculo' => 'moto'],
            ['marca' => 'Hero', 'tipo_vehiculo' => 'moto'],
        ];

        foreach ($marcas as $m) {
            MarcaVehiculo::create($m);
        }
    }
}
