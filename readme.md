## Instalacion:

- 1. despues de descargado, en cmd ir a la ruta del proyecto: cd ruta_proyecto
- 2. ejecutar: composer update
- 3. ejecutar: php artisan key:generate
- 4. configurar .env (sino existe renombrar .env-example a .env)  y poner datos de conexion a la base de datos.
- 5. configurar el archivo config/database.php con los datos de acceso a  la base de datos.
- 6. ejecutar la migracion para las transacciones.
- 7. iniciar el servidor: php artisan serve
- 8. abrir en el navegador localhost:8000/
- 9. click en IR A TRANSACCION
- 10. click en crear nueva transacción demo
- 11. digitar los datos de la transacicon basicos
- 12. click pagar.
- 13. completar prueba.
- 14. despues de 7 minutos navegar a localhost:8000/transacciones para ver nuevo estado de la transaccion.
