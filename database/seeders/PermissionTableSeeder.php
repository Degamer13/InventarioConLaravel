<?php

        namespace Database\Seeders;

        use Illuminate\Database\Console\Seeds\WithoutModelEvents;
        use Illuminate\Database\Seeder;
        use Spatie\Permission\Models\Permission;

        class PermissionTableSeeder extends Seeder
        {
        /**
        * Run the database seeds.
        *
        * @return void
        */
        public function run()
        {
        $permissions = [
        'show-admin',
        'role-list',
        'role-show',
        'role-create',
        'role-edit',
        'role-delete',
        'user-list',
        'user-show',
        'user-create',
        'user-edit',
        'user-delete',
        'permission-list',
        'permission-show',
        'permission-create',
        'permission-edit',
        'permission-delete',
        'categoria-list',
        'categoria-show',
        'categoria-create',
        'categoria-edit',
        'categoria-delete',
        'producto-list',
        'producto-show',
        'producto-create',
        'producto-edit',
        'producto-delete',
        'cliente-list',
        'cliente-show',
        'cliente-create',
        'cliente-edit',
        'cliente-delete',
        'proveedor-list',
        'proveedor-show',
        'proveedor-create',
        'proveedor-edit',
        'proveedor-delete',
        'compra-list',
        'compra-show',
        'compra-create',
        'compra-edit',
        'compra-delete',
        'venta-list',
        'venta-show',
        'venta-create',
        'venta-edit',
        'venta-delete',
        'dolar-list',
        'dolar-show',
        'dolar-create',
        'dolar-edit',
        'dolar-delete',
        'total-venta',
        'total-compra'


        ];

        foreach ($permissions as $permission) {
        Permission::create(['name' => $permission]);
        }
        }
        }

