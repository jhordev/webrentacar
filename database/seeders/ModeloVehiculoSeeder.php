<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MarcaVehiculo;
use App\Models\ModeloVehiculo;

class ModeloVehiculoSeeder extends Seeder
{
    public function run(): void
    {
        // Map por tipo_vehiculo => marca => [modelos únicos]
        $map = [
            'auto' => [
                'Toyota'      => ['Corolla', 'Camry', 'RAV4'],
                'Honda'       => ['Civic', 'Accord', 'CR-V'],
                'Nissan'      => ['Sentra', 'Altima', 'X-Trail'],
                'Chevrolet'   => ['Onix', 'Tracker', 'Captiva'],
                'Volkswagen'  => ['Jetta', 'Tiguan', 'Virtus'],
                'Ford'        => ['Focus', 'Ranger', 'Bronco'],
                'Hyundai'     => ['Elantra', 'Tucson', 'Santa Fe'],
                'Kia'         => ['Rio', 'Seltos', 'Sportage'],
                'Mazda'       => ['Mazda3', 'CX-5', 'CX-30'],
                'Suzuki'      => ['Swift', 'Vitara', 'S-Cross'],
            ],
            'moto' => [
                'Yamaha'      => ['MT-07', 'YZF-R3', 'Tenere 700'],
                'Honda'       => ['CB125F', 'CB300R', 'CRF300L'],
                'Suzuki'      => ['GSX-R150', 'Gixxer 250', 'V-Strom 250'],
                'Kawasaki'    => ['Ninja 400', 'Z650', 'Versys 650'],
                'Bajaj'       => ['Pulsar NS200', 'Dominar 400', 'Avenger 220'],
                'TVS'         => ['Apache RTR 160', 'Raider 125', 'Ntorq 125'],
                'Italika'     => ['FT150', 'DM200', 'RC250'],
                'Vento'       => ['Rocketman 250', 'Terra 250', 'Phantom 150'],
                'Lifan'       => ['KPR200', 'LF150-2E', 'LF200 GY-5'],
                'Hero'        => ['Hunk 160R', 'XPulse 200', 'Glamour 125'],
            ],
        ];

        $marcas = MarcaVehiculo::all();

        foreach ($marcas as $marca) {
            $tipo   = $marca->tipo_vehiculo;      // 'auto' | 'moto'
            $nombre = $marca->marca;

            // Si no hay definición para esa marca/tipo, la saltamos (sin default)
            if (!isset($map[$tipo][$nombre])) {
                continue;
            }

            foreach ($map[$tipo][$nombre] as $modelo) {
                // UNIQUE global en 'modelo': evita duplicados en re-seed
                ModeloVehiculo::firstOrCreate(
                    ['modelo' => $modelo],               // clave única
                    ['marca_id' => $marca->id]           // valores adicionales
                );
            }
        }
    }
}
