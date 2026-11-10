# Practica N. 11

## Que es una vulnerabilidad infromatica y que significa la sigla CVE
Una vulnerabilidad es una debilidad existente en un sistema que puede ser utilizada por una persona malintencionada para poner en peligro su seguridad. Las vulnerabilidades pueden ser de varios tipos, pueden ser de tipo hardware, software, procedimentales o humanas.
Las vulnerabilidades y exposiciones comunes (CVE) son un conjunto de amenazas de seguridad que se incluyen en un sistema de referencia que describe los riesgos conocidos públicamente.


## ¿En qué fecha se publicaron las correcciones para CVE-2026-109618 y CVE-2026-109619?
El 21 de octubre de 2026 a las 13:30


## ¿Qué significa ejecución remota de código (RCE) y por qué es peligrosa?
Un ataque de ejecucion remota de codigo es cuando un atacante puede ejecutar codigo malicioso en los ordenadores o la red de una organizacion. Una vulnerabilidad RCE es extremadamente peligrosa porque permite a un atacante tomar el control total de un sistema a distancia y sin autorización.


## ¿Por qué estas fallas son relevantes incluso para aplicaciones cuyo código PHP está bien programado?
Estas fallas son relevantes porque se encuentran en el motor que interpreta y ejecuta el codigo, y no necesariamente en el codigo escrito por el programador.


## ¿Qué versiones corregidas se publicaron para las ramas PHP 8.2, 8.3, 8.4 y 8.5?
El equipo de PHP publicó las siguientes versiones corregidas el 21 de octubre de 2026: 

|Rama de PHP|	|Versión corregida|
|PHP 8.2|	    |8.2.35|
|PHP 8.3|	    |8.3.36|
|PHP 8.4|	    |8.4.27|
|PHP 8.5|	    |8.5.12|

## ¿Qué riesgos implica mantener un servidor con una versión de PHP sin soporte?
Expone a la infraestructura a fallos de seguridad criticos, toma de control remota y péerdida total de datos.


## ¿Cómo consultarías de forma segura la versión de PHP instalada en XAMPP? Escribe un método y su resultado, si tienes acceso al entorno.
//# php -v
PHP 8.2.12 (cli) (built: Oct 24 2023 21:15:15) (ZTS Visual C++ 2019 x64)
Copyright (c) The PHP Group
Zend Engine v4.2.12, Copyright (c) Zend Technologies


## ¿Qué pasos debería seguir una institución antes y después de actualizar PHP en un servidor de producción?
Antes de la actualizacion

• Probar en Staging: Clonar el servidor de producción y aplicar la actualizacion ahi primero para detectar fallos.
• Analizar el codigo: Usar herramientas como PHPStan o PHP Compatibility para buscar funciones obsoletas o eliminadas.
• Revisar dependencias: Verificar que las librerias de Composer, frameworks o CMS soporten la nueva version.
• Hacer backups completos: Respaldar la base de datos, el codigo fuente y los archivos de configuracion.
• Plan de retorno (Rollback): Tener listo un comando o procedimiento rapido para regresar a la versión anterior si algo falla.

Después de la actualizacion

• Monitorear Logs: Revisar minuciosamente el archivo error.log de PHP en busca de errores o advertencias ocultas.
• Probar flujos criticos: Verificar manualmente las pasarelas de pago, inicios de sesion y registros de usuarios.
• Medir el rendimiento: Controlar el uso de CPU, memoria y tiempos de respuesta con herramientas de monitoreo.
• Optimizar OPcache: Asegurarse de reactivar y configurar el almacenamiento en caché para mantener el rendimiento.
• Limpieza: Tras unos dias de estabilidad, desinstalar la version antigua de PHP por seguridad.


## ¿Cuál es la diferencia entre actualizar PHP y corregir vulnerabilidades en el código de una aplicación?
Actualizar PHP significa cambiar el motor base del lenguaje que interpreta el servidor, mientras que corregir vulnerabilidades en el código de una aplicación implica modificar los scripts, funciones o logica escritos por los desarrolladores para esa web en particular.


## ¿Qué recomendaciones darías a una escuela que utiliza un sistema PHP accesible desde Internet?
Mantenerse alerta de actualizaciones de php para evitar vulnerabilidades como la ocurrida recientemente.