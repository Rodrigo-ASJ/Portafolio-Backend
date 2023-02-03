### Pasos para hacer un deploy en Railway:
- Crear una base de datos MySQL
- Añadir en la ultima linea en el env del Repositorio la siguiente linea de código: 
  ``` NIXPACKS_BUILD_CMD=composer install &&migrate --force```
- crear una Branch para el deploy y eliminar el archivo composer.lock
