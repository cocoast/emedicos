<p align="center"><a href="#"><img src="public/img/logo.png" width="400"></a> </p>
<p align="center">COO System</p>

## Acerca de COO
Coo se puede interpretar como un asistente, para las operaciones del día a día, de las Instutucion de Salud. Supervisa los objetivos y se asegura de que todos los Equipos, departamentos y partes de la cadena de producción funcionen correctamente. 
Por otro lado la leyenda Chilota del COO, nos dice que es un ave de color parduzco, de grandes ojos redondos y brillantes, muy parecida, en tamaño y formas a una lechuza, la cual vuela por los cielos nocturnos de la isla de chiloe deteniendose en las ventanas, picoteando las ventanas atrayendo la atencion de los enfermos....

COO es una herramienta en desarrollo, que pretende ser utilizada para ayudar en la gestion de operaciones de equipos (medicos, industriales, informaticos, etc.) dentro de establecimientos de salud, con el fin de llevar un control de manera simple y facil de convenios, vida de los equipos, Calidad, etc.



## Instalacion 
### Requerimientos:
- **[PHP 7.4]**
- **[Apache 2.4]**
- **[Mysql 15.1]**
- **[Composer 2.1]**
- **[Laravel 8]** 
- **[npm 6.14]**


### Paso 1 
Luego de instalar y configurar servidor apache, mysql y composer clonar proyecto. 

### Paso 2 
# Habilitar en ini.php
- **extension=intl**
- **extension=gd**

### Paso 3
# Instalacion de Dependencias: 
Dentro de la Carpeta del Proyecto (/emedicos) Ejecutar: 
- **composer install**
- **npm install**
	

### Paso 4 
# Configuracion de la Base de Datos
- **[Crear Archivo .env Definiendo conexion a Base de Datos para ello se adjunta documento .env.example ]**
- **[crear Base de Datos (mismo nombre qe la definida en .env)]**

### Paso 5
# Generar una clave
La clave de aplicación es una cadena aleatoria almacenada en la clave APP_KEY dentro del archivo .env. Notarás que también falta.
Para crear la nueva clave e insertarla automáticamente en el .env, ejecutaremos:

- **php artisan key:generate**

### Paso 6 
# Ejecutar Migraciones y Seeders 

- **php artisan migrate**
- **php artisan db:seed**


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
The COO System is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Coo System

