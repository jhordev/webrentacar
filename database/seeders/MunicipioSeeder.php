<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Municipio;

class MunicipioSeeder extends Seeder
{
    public function run(): void
    {
        $municipios = [
            // 1. Aguascalientes
            ['estado_id' => 1, 'nombre' => 'Aguascalientes'],
            ['estado_id' => 1, 'nombre' => 'Calvillo'],
            ['estado_id' => 1, 'nombre' => 'Jesús María'],

            // 2. Baja California
            ['estado_id' => 2, 'nombre' => 'Tijuana'],
            ['estado_id' => 2, 'nombre' => 'Mexicali'],
            ['estado_id' => 2, 'nombre' => 'Ensenada'],

            // 3. Baja California Sur
            ['estado_id' => 3, 'nombre' => 'La Paz'],
            ['estado_id' => 3, 'nombre' => 'Los Cabos'],
            ['estado_id' => 3, 'nombre' => 'Loreto'],

            // 4. Campeche
            ['estado_id' => 4, 'nombre' => 'Campeche'],
            ['estado_id' => 4, 'nombre' => 'Carmen'],
            ['estado_id' => 4, 'nombre' => 'Champotón'],

            // 5. Chiapas
            ['estado_id' => 5, 'nombre' => 'Tuxtla Gutiérrez'],
            ['estado_id' => 5, 'nombre' => 'San Cristóbal de las Casas'],
            ['estado_id' => 5, 'nombre' => 'Tapachula'],

            // 6. Chihuahua
            ['estado_id' => 6, 'nombre' => 'Chihuahua'],
            ['estado_id' => 6, 'nombre' => 'Ciudad Juárez'],
            ['estado_id' => 6, 'nombre' => 'Delicias'],

            // 7. Ciudad de México
            ['estado_id' => 7, 'nombre' => 'Iztapalapa'],
            ['estado_id' => 7, 'nombre' => 'Coyoacán'],
            ['estado_id' => 7, 'nombre' => 'Benito Juárez'],

            // 8. Coahuila
            ['estado_id' => 8, 'nombre' => 'Saltillo'],
            ['estado_id' => 8, 'nombre' => 'Torreón'],
            ['estado_id' => 8, 'nombre' => 'Monclova'],

            // 9. Colima
            ['estado_id' => 9, 'nombre' => 'Colima'],
            ['estado_id' => 9, 'nombre' => 'Manzanillo'],
            ['estado_id' => 9, 'nombre' => 'Tecomán'],

            // 10. Durango
            ['estado_id' => 10, 'nombre' => 'Durango'],
            ['estado_id' => 10, 'nombre' => 'Gómez Palacio'],
            ['estado_id' => 10, 'nombre' => 'Lerdo'],

            // 11. Guanajuato
            ['estado_id' => 11, 'nombre' => 'León'],
            ['estado_id' => 11, 'nombre' => 'Irapuato'],
            ['estado_id' => 11, 'nombre' => 'Celaya'],

            // 12. Guerrero
            ['estado_id' => 12, 'nombre' => 'Acapulco'],
            ['estado_id' => 12, 'nombre' => 'Chilpancingo'],
            ['estado_id' => 12, 'nombre' => 'Iguala'],

            // 13. Hidalgo
            ['estado_id' => 13, 'nombre' => 'Pachuca'],
            ['estado_id' => 13, 'nombre' => 'Tulancingo'],
            ['estado_id' => 13, 'nombre' => 'Tizayuca'],

            // 14. Jalisco
            ['estado_id' => 14, 'nombre' => 'Guadalajara'],
            ['estado_id' => 14, 'nombre' => 'Zapopan'],
            ['estado_id' => 14, 'nombre' => 'Puerto Vallarta'],

            // 15. Estado de México
            ['estado_id' => 15, 'nombre' => 'Toluca'],
            ['estado_id' => 15, 'nombre' => 'Ecatepec'],
            ['estado_id' => 15, 'nombre' => 'Naucalpan'],

            // 16. Michoacán
            ['estado_id' => 16, 'nombre' => 'Morelia'],
            ['estado_id' => 16, 'nombre' => 'Uruapan'],
            ['estado_id' => 16, 'nombre' => 'Zamora'],

            // 17. Morelos
            ['estado_id' => 17, 'nombre' => 'Cuernavaca'],
            ['estado_id' => 17, 'nombre' => 'Jiutepec'],
            ['estado_id' => 17, 'nombre' => 'Temixco'],

            // 18. Nayarit
            ['estado_id' => 18, 'nombre' => 'Tepic'],
            ['estado_id' => 18, 'nombre' => 'Bahía de Banderas'],
            ['estado_id' => 18, 'nombre' => 'Compostela'],

            // 19. Nuevo León
            ['estado_id' => 19, 'nombre' => 'Monterrey'],
            ['estado_id' => 19, 'nombre' => 'San Nicolás de los Garza'],
            ['estado_id' => 19, 'nombre' => 'Guadalupe'],

            // 20. Oaxaca
            ['estado_id' => 20, 'nombre' => 'Oaxaca de Juárez'],
            ['estado_id' => 20, 'nombre' => 'Juchitán de Zaragoza'],
            ['estado_id' => 20, 'nombre' => 'Salina Cruz'],

            // 21. Puebla
            ['estado_id' => 21, 'nombre' => 'Puebla'],
            ['estado_id' => 21, 'nombre' => 'Tehuacán'],
            ['estado_id' => 21, 'nombre' => 'Atlixco'],

            // 22. Querétaro
            ['estado_id' => 22, 'nombre' => 'Querétaro'],
            ['estado_id' => 22, 'nombre' => 'San Juan del Río'],
            ['estado_id' => 22, 'nombre' => 'El Marqués'],

            // 23. Quintana Roo
            ['estado_id' => 23, 'nombre' => 'Cancún'],
            ['estado_id' => 23, 'nombre' => 'Chetumal'],
            ['estado_id' => 23, 'nombre' => 'Playa del Carmen'],

            // 24. San Luis Potosí
            ['estado_id' => 24, 'nombre' => 'San Luis Potosí'],
            ['estado_id' => 24, 'nombre' => 'Soledad de Graciano Sánchez'],
            ['estado_id' => 24, 'nombre' => 'Matehuala'],

            // 25. Sinaloa
            ['estado_id' => 25, 'nombre' => 'Culiacán'],
            ['estado_id' => 25, 'nombre' => 'Mazatlán'],
            ['estado_id' => 25, 'nombre' => 'Los Mochis'],

            // 26. Sonora
            ['estado_id' => 26, 'nombre' => 'Hermosillo'],
            ['estado_id' => 26, 'nombre' => 'Cajeme'],
            ['estado_id' => 26, 'nombre' => 'Nogales'],

            // 27. Tabasco
            ['estado_id' => 27, 'nombre' => 'Villahermosa'],
            ['estado_id' => 27, 'nombre' => 'Cárdenas'],
            ['estado_id' => 27, 'nombre' => 'Comalcalco'],

            // 28. Tamaulipas
            ['estado_id' => 28, 'nombre' => 'Reynosa'],
            ['estado_id' => 28, 'nombre' => 'Tampico'],
            ['estado_id' => 28, 'nombre' => 'Matamoros'],

            // 29. Tlaxcala
            ['estado_id' => 29, 'nombre' => 'Tlaxcala'],
            ['estado_id' => 29, 'nombre' => 'Apizaco'],
            ['estado_id' => 29, 'nombre' => 'Huamantla'],

            // 30. Veracruz
            ['estado_id' => 30, 'nombre' => 'Veracruz'],
            ['estado_id' => 30, 'nombre' => 'Xalapa'],
            ['estado_id' => 30, 'nombre' => 'Córdoba'],

            // 31. Yucatán
            ['estado_id' => 31, 'nombre' => 'Mérida'],
            ['estado_id' => 31, 'nombre' => 'Valladolid'],
            ['estado_id' => 31, 'nombre' => 'Tizimín'],

            // 32. Zacatecas
            ['estado_id' => 32, 'nombre' => 'Zacatecas'],
            ['estado_id' => 32, 'nombre' => 'Fresnillo'],
            ['estado_id' => 32, 'nombre' => 'Jerez'],
        ];

        foreach ($municipios as $municipio) {
            Municipio::create($municipio);
        }
    }
}
