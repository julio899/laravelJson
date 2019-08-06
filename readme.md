<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
</p>

## Entorno de Desarrollo

- PHP 7.2.4-1+b1.
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Composer version 1.7.2


## Instalacion
- descargar o clonar el proyecto 
    $ git clone git@github.com:julio899/laravelJson.git
- composer install.
- copiar y modificar con los datos de accesos para la base de datos

        cp .env.example .env
        # luego modificar el archivo .env
        # con sus datos de acceso a mysql
        
- colocar los datos de acceso para mysql.
    se encuentra en el archivo .env (esta en la raiz del proyecto)
    ubicar el apartado de MySQL y colocar  User, Pass, Name DataBase  
    
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=wptestlaravel
        DB_USERNAME=root
        DB_PASSWORD=
 - luego de colocar sus datos de conexion a la base de datos
   por consola ir al directorio raiz del proyecto y ejecutar lo siguiente
   que es para generar las tablas en la BD
   [IMPORTANTE AGREGAR LA PRIMERA LICENCIA PARA DEMO ]
        
        php artisan migrate:install
        php artisan migrate:refresh && php artisan db:seed --class=DemoLic


- Ejecutar el servidor

        php artisan serve

## License realizado bajo la plataforma [ Laravel framework ] 

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
