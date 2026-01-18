# Decisiones Técnicas

## Frontend
Se decidió utilizar Blade como estructura principal del frontend y encapsular componentes Vue únicamente en las secciones que requieren mayor interactividad. Este enfoque reduce la complejidad y se alinea con una migración progresiva a Vue.

## Arquitectura
La lógica de negocio, como la importación de vendedores desde una API externa, se encapsuló en Services para evitar sobrecargar los controllers y facilitar el mantenimiento y testing del código.

## Base de Datos
Se definieron relaciones con claves foráneas para garantizar integridad referencial. No se permite eliminar un Lote que tenga Vendedores asignados.

## Alcance
No se implementó una SPA completa, roles de usuario ni Docker, ya que no eran requisitos del reto y se priorizó reducir fricción en la evaluación.