=== MkRapel Regiones y Ciudades de Chile para WC ===
Contributors: Marketing Rapel
Tags: woocommerce, chile, comunas, wordpress, checkout, cl, currency, tienda, envios, despachos, php, wc, mkrapel, marketing rapel, marketing, rapel, regiones, states, chilean's states, city, cities
Requires at least: 5.0
Requires PHP: 5.6 or greater
Tested up to: 5.5
Stable tag: 5.4
MySQL: 5.6 or greater
Language: Spanish
License: GPLv3 or later

== Description ==
Nueva versión del Plugin con las Regiones y Comunas de Chile actualizado al 2020, permitiendo usar las ciudades para establecer las Zonas de Despacho y permite personalizar los Formularios de Pago usados para el Envío y Facturación en WooCommerce.

= País Soportado =
 * Chile
 
= Zonas de Envío =
Como hemos cambiado el orden de los campos en el CheckOut habitual de WooCommerce, ahora puedes establecer tus zonas de despacho según las Ciudades/Comunas dentro de Chile, permitiendo valores de despacho diferentes entre cada ciudad, ya sea por cercanía a la tienda o por cualquier otra variable que tú desees.

= Formularios de Pago =
Desde la versión 4.0.0 hemos agregado una nueva sección que permite modificar, editar y crear nuevos campos para los formularios de facturación y envío, logrando que puedas personalizar la forma que deseas usar las características del plugin.

== Installation ==

Para instalar el plugin realice los siguientes pasos:

1. Descargue el plugin 'wc-ciudades-y-regiones-de-chile.zip' desde el repositorio oficial de WordPress.
2. Ingrese a su sitio web y suba el Plugin 'wc-ciudades-y-regiones-de-chile.zip' en la opción Plugins > Agregar Nuevo.
3. Active el plugin a traves del menú 'Plugins' en WordPress.

Puedes buscar este plugin directamente en el repositorio de WordPress desde la sección Pugins > Agegar Nuevo, haciendo click en Instalar y luego en Activar para poder usarlo.

= Configuración en WooCommerce =

1. Ingresar a WooCommerce > Ajustes > Envios.
2. Agregar una nueva “Zona de Envío”.
3. Completar con los datos solicitados y al momento de seleccionar en “Añadir método de envío” se debe seleccionar la opción “Despachos por Ciudad”, quedand con el título “Filtro de envío por Ciudades”.
4. Editar Método de Envio “Filtro de envío por Ciudades” para agregar las ciudades de la Región que estarán con sus respectivos valores de despacho.
5. Ciudades disponibles según la Región seleccionada e ingresada como Zona de Envío principal, recuerda mantener en No la opción de Método de Envío Único por si deseas agregar nuevos métodos de envío a la misma Región.
6. Personaliza los Formularios de Pago para la facturación y de envío de la forma que desees, permitiendo cambiar el orden de los cambios, nuevos campos o incluso desactivar aquellos que no necesitas utilizar.
7. Disfruta del plugin.

== Frequently Asked Questions ==

= ¿Cuenta con el listado de las Comunas de Chile? =
Para el desarrollo de este plugin fue utilizada la información disponible en los registros de la Biblioteca del Congreso Nacional de Chile con un total de 346 comunas.

= ¿Cuenta con el listado de las Regiones de Chile? =
Para el desarrollo de este plugin fue utilizada la información disponible en los registros dela Biblioteca del Congreso Nacional de Chile con un total de 16 regiones.

= ¿Se puede agregar una misma comuna en dos Métodos de Envío "Envío por Ciudad CL" con valores distintos? =
En la versión actual del plugin no es posible, por el momento, ya que se entiende que uno de los dos métodos de envío "Envío por Ciudad CL" es más importante que el otro, por lo que es recomendable tener un sólo valor de envío para cada comuna o ciudad.

= ¿Puedo usar las abreviaturas de montos predefinidas de WooCommerce? =
Si es posible para cada una de los Métodos de Envíos que determines con nuestro plugin, pudiendo usar el siguiente listado a modo de ejemplo:
* Valor según cantidad de productos a comprar: 50*[qty]
* Valor según cantidad de productos a comprar y un monto fijo: 100 + ( 50 * [qty] )
* Valor según un porcentaje del costo de todos los productos a comprar: 0.20 * [cost]
* Valor según un porcentaje del costo de todos los productos a comprar y un monto fijo: 400 + ( 0.20 * [cost] )
* Valor según monto mínimo (minimo="") para despacho gratuito, de lo contrario aplica valor del despacho (valor): [free valor="5500" minimo="10000"]

= ¿Puedo desactivar el campo RUN/Pasaporte? =
Con la nueva versión del plugin 4.0.0 se puede desactivar cualquier campo de los Formularios de Facturación y de Envío en el momento que lo deseas, como también determinar aquellos que son obligatorios y aquellos opcionales

= ¿Se puede usar con el plugin Chilexpress Shipping for WooCommerce? =
Si, donde para la opción de "Activar/Desactivar envíos vía Chilexpress" debe estar sin marcar para que pueda tomar la información correspondiente a las Regiones y Comunas de nuestro plugin, el resto de la configuración del plugin de Chilexpress se puede hacer sin inconvenientes.

= ¿Se puede usar con el plugin Shipit y Despacho vía Starken para WooCommerce? =
No, porque retira el campo de las Regiones y la reemplaza por el listado de las comunas que posee el propio plugin.

== Screenshots ==

1. CheckOut con el Plugin instalado y activo.
2. Desglose de las 16 Regiones de Chile al 2020 con filtro.
3. Desglose de las 346 Comunas de Chile al 2020 con filtro.
4. Zonas de Envío establecida para la ciudad seleccionada.
5. Cambio de tipo de envío según la opción seleccionada.
6. Zonas de Envío en WooCommerce.
7. Configuración de la Zona de Envío según Región y seleccionando el método "Despachos por Ciudad".
8. Zona de Envío con el Método "Filtro de envío por Ciudades".
9. Configuración del Método "Filtro de envío por Ciudades".
10. Ciudades disponibles según la Región seleccionada e ingresada como Zona de Envío principal.
11. Ciudades disponibles según la Región seleccionada e ingresada como Zona de Envío principal.
12. Ciudades disponibles según la Región seleccionada e ingresada como Zona de Envío principal.
13. Ciudades disponibles según la Región seleccionada e ingresada como Zona de Envío principal.
14. Ciudades disponibles según la Región seleccionada e ingresada como Zona de Envío principal.
15. Diseño del Formulario de Pago de Facturación y Envío
16. Opción de Personalización del Formulario de Pago de Facturación y Envío
17. Opción de Personalización del Formulario de Pago de Facturación y Envío

== Changelog ==

= v4.3.0 - 17.12.2021
* Setting: Modificación en las abreviaturas de las Regiones y Comunas. Recurso aportado por Javier Bassino
* Setting: Ajuste General en el código del plugin para WC 6.0
* Fixed: Revisión código a nivel general


= v4.2.0 - 15.02.2021 =
* Revision: Compatibilidad con plugin Chilexpress Shipping for WooCommerce
* Revision: Compatibilidad con plugin Despacho vía Starken para WooCommerce
* Revision: Compatibilidad con plugin Shipit
* Setting: Ajuste General en el código del plugin
* Setting: Incorporación Valor Mínimo para envíos Gratuitos
* Fixed: Revisión código a nivel general
* Fixed: Error de escritura en una comuna. Notificado por Ricardo Padilla

= v4.1.0 - 17.12.2020 =
* Fixed: Error de vinculación de un archivo. Notificado por Anthony Ortega

= v4.0.0 - 28.11.2020 =
* Agregado: Edición del Formulario de Pago para Facturación y Envíos
* Agregado: Personalización del Formulario de Pago para Facturación y Envíos
* Agregado: Campos por defecto para el Formulario de Pago para Facturación
* Agregado: Menú del plugin en la sección de WooCommerce
* Setting: Ajuste General en el código del plugin
* Setting: Ajuste en base a recomendaciones de WordPress
* Setting: Ajuste en base a recomendaciones de Usuarios
* Test: Ajustes de Compatibilidad en WooCommerce
* Test: Ajustes de Compatibilidad en WordPress
* Test: Ajustes de Compatibilidad a nivel de Uso del Plugin
* Test: Ajustes de Compatibilidad a nivel de Uso del Formulario de Pago por los Usuarios
* Fixed: Zonas de Despacho en CheckOut
* Fixed: Versión antigua del Formulario de Pago

= v3.5.0 - 11.09.2020 =
* Setting: Ajuste General en el código del plugin
* Setting: Ajuste en base a recomendaciones de WordPress
* Test: Ajustes de Compatibiidad en WooCommerce

= v3.1.0 - 24.08.2020 =
* Setting: Ajuste General en el código del plugin
* Setting: Ajuste en base a recomendaciones de WordPress

= v3.0.0 - 20.08.2020 =
* Setting: Ajuste General en el código del plugin
* Fixed: Compatibilidad con WooCommerce
* Fixed: Zonas de Despacho en CheckOut

= v2.2.0 - 14.08.2020 =
* Setting: Ajuste General en el código del plugin
* Fixed: Seguridad del plugin

= v2.1.0 - 11.08.2020 =
* Setting: Ajuste en listado Regiones/Provincias y Ciudades/Comunas
* Setting: Ajuste General en el código del plugin

= v2.0.0 - 10.08.2020 =
* Design: Versión Inicial del Plugin
* Test: Pruebas en WordPress
* Test: Ajustes de Visibilidad en WooCommerce