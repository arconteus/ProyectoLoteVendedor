# Diseño de la Base de Datos

Descripción del diseño de la base de datos usada en este proyecto.

## Entities

### Users
Para este proyecto se usa la tabla mínima que viene por defecto en Laravel Breeze.
Esta tabla se utiliza exclusivamente para autenticación y autorización.

---

### Tabla de Lotes
Tabla que representa los puntos de venta y/o sucursales.

| Campo | Tipo | Descripción |
|------|------|-------------|
| id | bigint | Primary key |
| nombre | string | Not Null |
| direccion | string | Nullable |
| identificador | string | Unique |
| activo | boolean | Default: true |
| created_at | timestamp | Creation date |
| updated_at | timestamp | Last update |

---

### Tabla de Vendedores
Tabla que representa a los vendedores utilizando la información mínima proveniente de la API externa.

| Campo | Tipo | Descripción |
|------|------|-------------|
| id | bigint | Primary key |
| nombre | string | Not Null |
| email | string | Not Null |
| telefono | string | Phone number |
| external_id | bigint | Unique |
| lote_id | bigint | Foreign Key |
| created_at | timestamp | Creation date |
| updated_at | timestamp | Last update |

---

## Relaciones

- Un **Lote** puede tener múltiples **Vendedores**
- Un **Vendedor** pertenece a un solo **Lote**

La relación se implementa mediante la clave foránea `lote_id` en la tabla `vendedores`.

---

## Reglas de Negocio

- Cada vendedor debe tener asignado un Lote activo.
- Un vendedor solo puede pertenecer a un Lote a la vez.
- No se puede eliminar un Lote que tenga vendedores asignados.