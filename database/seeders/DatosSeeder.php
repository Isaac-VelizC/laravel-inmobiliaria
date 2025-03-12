<?php

namespace Database\Seeders;

use App\Models\Oficina;
use App\Models\Persona;
use App\Models\PropiedadesTipo;
use App\Models\TipoPropiedad;
use App\Models\TipoTraspaso;
use App\Models\User;
use App\Models\VentasTipo;
use Illuminate\Database\Seeder;

class DatosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Oficina::create([
            'name' => 'Oficina Central',
            'address' => 'Potosí, calle Padilla Nº66, zona central',
            'city' => 'Potosí',
            'country' => 'Bolivia',
        ]);

        TipoPropiedad::create([
            'name' => 'Casa',
            'detail' => 'Vivienda unifamiliar que ofrece espacios para vivir, como dormitorios, cocina y sala de estar.'
        ]);

        TipoPropiedad::create([
            'name' => 'Departamento',
            'detail' => 'Unidad habitacional ubicada dentro de un edificio que comparte áreas comunes.'
        ]);

        TipoPropiedad::create([
            'name' => 'Local Comercial',
            'detail' => 'Espacio destinado a actividades comerciales, como tiendas o restaurantes.'
        ]);

        TipoPropiedad::create([
            'name' => 'Terreno',
            'detail' => 'Extensión de tierra sin edificar, que puede ser utilizada para construcción futura.'
        ]);

        TipoTraspaso::create([
            'name' => 'Venta Directa',
            'detail' => 'Transacción en la que el comprador adquiere la propiedad directamente del vendedor sin intermediarios.'
        ]);

        TipoTraspaso::create([
            'name' => 'Venta en Contado',
            'detail' => 'Transacción donde el comprador paga el total del precio de la propiedad al momento de la compra.'
        ]);

        User::create([
            'name' => 'Rachel Starr',
            'email' => 'isa.veliz@gmail.com',
            'password' => bcrypt('IsaacVelizAdmin'),
            'rol' => 'Admin'
        ]);

        User::create([
            'name' => 'Maria',
            'email' => 'maria@gmail.com',
            'password' => bcrypt('MariAAdmin'),
            'rol' => 'Admin'
        ]);

        User::create([
            'name' => 'Karla',
            'email' => 'karla.rosa@gmail.com',
            'password' => bcrypt('KarlaSecretaria'),
            'rol' => 'Secretaria'
        ]);

        Persona::create([
            'name' => 'Karla',
            'surnames' => 'Rosa',
            'ci' => '9876543',
            'phone' => '29847239',
            'address' => 'Calle Rosas',
            'id_user' => 3,
        ]);
    }
}
