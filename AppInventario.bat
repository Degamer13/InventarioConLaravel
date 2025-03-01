@echo off
echo Iniciando Laragon...
cd C:\laragon
start laragon.exe

echo Esperando que Laragon se inicie...
timeout /t 5 /nobreak

echo Navegando al proyecto Laravel...
cd C:\laragon\www\inventario

echo Iniciando npm run dev...
start cmd /k "npm run dev"

echo Iniciando php artisan serve...
start cmd /k "php artisan serve --host=0.0.0.0 --port=8000"

echo Todo listo. Presiona una tecla para cerrar.
pause

