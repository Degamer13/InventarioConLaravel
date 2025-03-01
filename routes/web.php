<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CodigoBarrasController;
use App\Http\Controllers\{
    HomeController,
    AdminHomeController,
    CategoriaController,
    ProductoController,
    ClienteController,
    ProveedorController,
    PrecioController,
    CompraController,
    VentaController


};

// Login
Route::get('/', function () {
    return view("auth.login");
});
// Rutas de autenticación
Auth::routes();

// Ruta del panel principal
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Ruta para la vista adminhome con el controlador
Route::get('/panel-admin', [AdminHomeController::class, 'index'])->name('adminhome');

// Rutas protegidas para el sistema de inventario
Route::middleware(['auth'])->group(function () {
    Route::resources([
        'categorias' => CategoriaController::class,
        'productos' => ProductoController::class,
        'clientes' => ClienteController::class,
        'proveedores' => ProveedorController::class,
        'precios'=> PrecioController::class,
        'users'=> UserController::class,
        'roles'=> RoleController::class,
        'permissions'=>PermissionController::class,
        'compras'=>CompraController::class,
        'ventas'=>VentaController::class
    ]);
Route::get('ventas/obtenerPrecioDolar', [VentaController::class, 'obtenerPrecioDolar'])->name('ventas.obtenerPrecioDolar');

Route::get('ventas/{id}/pdf', [VentaController::class, 'generatePdf'])->name('ventas.pdf');

Route::get('ventas/total', [VentaController::class, 'totalVentas'])->name('ventas.total');

Route::get('/totales', [VentaController::class, 'totalesVentas'])->name('totales.index');
Route::get('totales/compras', [CompraController::class, 'totalesCompras'])->name('totales.compras');
Route::get('/producto/{id}/generar-pdf', [ProductoController::class, 'generarPdf'])->name('productos.generarPdf');

});

