<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Movimiento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table("users")->updateOrInsert(["id" => 4], [
            "name" => "Fernando Nieva",
            "email" => "nieva.cronos@gmail.com",
            "password" => "$2y$12$auFW/t9llOkWGQPNhb6pzOmhHIOZxw.LPs1ZztRzeJKuktYh.C6zC",
            "created_at" => "2026-05-25 23:37:54",
            "updated_at" => "2026-05-25 23:37:54",
        ]);

        $categorias = [
            [1, "Alimentación"],[2, "Transporte"],[3, "Vivienda"],
            [4, "Salud"],[5, "Entretenimiento"],[6, "Educación"],
            [7, "Servicios"],[8, "Trabajo"],[9, "Inversiones"],[10, "Otros"],
        ];
        foreach ($categorias as [$id, $nombre]) {
            Categoria::updateOrCreate(["id" => $id], ["nombre" => $nombre]);
        }

        $subcategorias = [
            [1,"Supermercado",1],[2,"Restaurantes",1],[3,"Delivery",1],[4,"Cafetería",1],
            [5,"Combustible",2],[6,"Uber/Taxi",2],[7,"Transporte público",2],[8,"Estacionamiento",2],
            [9,"Alquiler",3],[10,"Electricidad",3],[11,"Agua",3],[12,"Internet",3],[13,"Gas",3],
            [14,"Farmacia",4],[15,"Médico",4],[16,"Seguro",4],[17,"Gimnasio",4],
            [18,"Cine",5],[19,"Streaming",5],[20,"Videojuegos",5],[21,"Salidas",5],
            [22,"Cursos",6],[23,"Libros",6],[24,"Suscripciones",6],
            [25,"Teléfono",7],[26,"Seguros",7],[27,"Suscripciones",7],
            [28,"Sueldo",8],[29,"Freelance",8],[30,"Bonos",8],
            [31,"Acciones",9],[32,"Cripto",9],[33,"Plazo fijo",9],[34,"Fondos",9],
            [35,"Regalos",10],[36,"Ropa",10],[37,"Impuestos",10],[38,"Varios",10],
        ];
        foreach ($subcategorias as [$id, $nombre, $categoria_id]) {
            Subcategoria::updateOrCreate(["id" => $id], ["nombre" => $nombre, "categoria_id" => $categoria_id]);
        }

        DB::table("metas_ahorro")->updateOrInsert(["id" => 1], [
            "user_id" => 4, "nombre" => "Viaje a Europa",
            "monto_objetivo" => 500000.00, "monto_actual" => 330000.00,
            "fecha_limite" => "2026-12-31",
        ]);
        DB::table("metas_ahorro")->updateOrInsert(["id" => 2], [
            "user_id" => 4, "nombre" => "Fondo de Emergencia",
            "monto_objetivo" => 1000000.00, "monto_actual" => 20000.00,
            "fecha_limite" => "2027-06-30",
        ]);

        DB::table("presupuestos")->updateOrInsert(["id" => 2], [
            "user_id" => 4, "categoria_id" => 3,
            "limite_mensual" => 100000.00, "mes" => 6, "año" => 2026,
        ]);
        DB::table("presupuestos")->updateOrInsert(["id" => 4], [
            "user_id" => 4, "categoria_id" => 1,
            "limite_mensual" => 50000.00, "mes" => 6, "año" => 2026,
        ]);

        $movimientos = [
            [1,"2026-06-02","ingreso",350000.00,8,28,null],[2,"2026-06-05","ingreso",25000.00,8,29,null],
            [3,"2026-06-10","ingreso",12000.00,8,30,null],[4,"2026-06-15","ingreso",8000.00,9,31,null],
            [5,"2026-06-20","ingreso",5000.00,9,33,null],[6,"2026-06-03","egreso",80000.00,3,9,null],
            [7,"2026-06-04","egreso",45000.00,1,1,null],[8,"2026-06-07","egreso",12000.00,3,10,null],
            [9,"2026-06-08","egreso",8500.00,7,25,null],[10,"2026-06-12","egreso",15000.00,2,5,null],
            [11,"2026-06-14","egreso",5500.00,4,14,null],[12,"2026-06-19","egreso",5000.00,5,21,null],
            [13,"2026-06-05","ahorro",20000.00,null,null,2],[14,"2026-06-15","ahorro",10000.00,null,null,1],
            [15,"2026-06-20","ahorro",15000.00,null,null,null],[16,"2026-06-21","ahorro",20000.00,10,38,1],
            [17,"2026-06-21","ahorro",300000.00,10,38,1],
        ];
        foreach ($movimientos as [$id, $fecha, $tipo, $monto, $categoria_id, $subcategoria_id, $meta_ahorro_id]) {
            Movimiento::updateOrCreate(["id" => $id], [
                "user_id" => 4, "fecha" => $fecha, "tipo" => $tipo,
                "monto" => $monto, "categoria_id" => $categoria_id,
                "subcategoria_id" => $subcategoria_id, "meta_ahorro_id" => $meta_ahorro_id,
            ]);
        }
    }
}