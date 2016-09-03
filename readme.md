## Instalacion:

- 1. despues de descargado, en cmd ir a la ruta del proyecto: cd ruta_proyecto
- 2. ejecutar: composer update
- 3. configurar .env (sino existe renombrar .env-example a .env)  y poner datos de conexion a la base de datos.
- 4. configurar el archivo config/database.php con los datos de acceso a  la base de datos.
- 5. ejecutar la migracion para las transacciones.
- 6. iniciar el servidor: php artisan serve
- 7. abrir en el navegador localhost:8000/
- 8. click en IR A TRANSACCION
- 9. click en crear nueva transacción demo
- 10. digitar los datos de la transacicon basicos
- 11. click pagar.
- 12. completar prueba.
- 13. despues de 7 minutos navegar a localhost:8000/transacciones para ver nuevo estado de la transaccion.
