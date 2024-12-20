<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = collect(\Route::getRoutes())->map(function ($route) { return $route; });

        foreach($routes as $item){
            $route = $item->uri;
            $name = $item->getName();
            $display = $item->getName();
            if($name){
                \DB::table('permissions')->insert([
                    'route_name' => $name,
                    'display' => $display,
                ]);
            }
    }
    }
}
