# Sistema de Inventario API

API REST para gestión de inventario desarrollada con Laravel.

## Autenticación

La API utiliza JWT (JSON Web Token). Las rutas protegidas requieren el header:

```
Authorization: Bearer <token>
```

Obtienes el token al hacer login en `/api/auth/login`.

---

## Endpoints

### Auth

#### POST `/api/auth/register`

Registra un nuevo usuario. **No requiere autenticación.**

**Body:**
```json
{
    "name": "Juan Pérez",
    "email": "juan@example.com",
    "password": "secret123"
}
```

**Respuesta 201:**
```json
{
    "message": "Usuario registrado exitosamente",
    "user": {
        "id": 1,
        "name": "Juan Pérez",
        "email": "juan@example.com"
    }
}
```

---

#### POST `/api/auth/login`

Inicia sesión y devuelve un token JWT. **No requiere autenticación.**

**Body:**
```json
{
    "email": "juan@example.com",
    "password": "secret123"
}
```

**Respuesta 200:**
```json
{
    "message": "Login exitoso",
    "token": "eyJhbGciOiJIUzI1NiIs...",
    "user": {
        "id": 1,
        "name": "Juan Pérez",
        "email": "juan@example.com"
    }
}
```

---

### Categorías

#### GET `/api/categorias`

Lista todas las categorías. **Requiere autenticación.**

**Respuesta 200:**
```json
[
    {
        "id": 1,
        "nombre": "Electrónica",
        "descripcion": "Dispositivos electrónicos",
        "created_at": "2026-09-03T10:00:00.000000Z",
        "updated_at": "2026-09-03T10:00:00.000000Z"
    }
]
```

---

#### POST `/api/categorias`

Crea una categoría. **Requiere autenticación.**

**Body:**
```json
{
    "nombre": "Electrónica",
    "descripcion": "Dispositivos electrónicos"
}
```

**Respuesta 201:**
```json
{
    "id": 1,
    "nombre": "Electrónica",
    "descripcion": "Dispositivos electrónicos"
}
```

---

#### PUT `/api/categorias/{id}`

Actualiza una categoría. **Requiere autenticación.**

**Body:**
```json
{
    "nombre": "Electrónica Actualizada",
    "descripcion": "Nueva descripción"
}
```

**Respuesta 200:**
```json
{
    "id": 1,
    "nombre": "Electrónica Actualizada",
    "descripcion": "Nueva descripción"
}
```

---

#### DELETE `/api/categorias/{id}`

Elimina una categoría. **Requiere autenticación.**

**Respuesta 200:**
```json
{
    "message": "Categoria eliminada con exito"
}
```

---

### Proveedores

#### GET `/api/proveedores`

Lista todos los proveedores. **Requiere autenticación.**

**Respuesta 200:**
```json
[
    {
        "id": 1,
        "nombre": "Proveedor ABC",
        "contacto": "Carlos López",
        "telefono": "5551234567",
        "email": "contacto@abc.com",
        "created_at": "2026-09-03T10:00:00.000000Z",
        "updated_at": "2026-09-03T10:00:00.000000Z"
    }
]
```

---

#### POST `/api/proveedores`

Crea un proveedor. **Requiere autenticación.**

**Body:**
```json
{
    "nombre": "Proveedor ABC",
    "contacto": "Carlos López",
    "telefono": "5551234567",
    "email": "contacto@abc.com"
}
```

**Respuesta 201:**
```json
{
    "id": 1,
    "nombre": "Proveedor ABC",
    "contacto": "Carlos López",
    "telefono": "5551234567",
    "email": "contacto@abc.com"
}
```

---

#### PUT `/api/proveedores/{id}`

Actualiza un proveedor. **Requiere autenticación.**

**Body:**
```json
{
    "nombre": "Proveedor ABC Actualizado",
    "contacto": "Carlos López",
    "telefono": "5559876543",
    "email": "nuevo@abc.com"
}
```

**Respuesta 200:**
```json
{
    "id": 1,
    "nombre": "Proveedor ABC Actualizado",
    "contacto": "Carlos López",
    "telefono": "5559876543",
    "email": "nuevo@abc.com"
}
```

---

#### DELETE `/api/proveedores/{id}`

Elimina un proveedor. **Requiere autenticación.**

**Respuesta 200:**
```json
{
    "message": "Proveedor eliminado con exito"
}
```

---

### Productos

#### GET `/api/productos`

Lista todos los productos con categoría y proveedor. **Requiere autenticación.**

**Respuesta 200:**
```json
[
    {
        "nombre": "Laptop HP",
        "descripcion": "Laptop 15 pulgadas",
        "precio": 15000.00,
        "stock_actual": 25,
        "categoria": "Electrónica",
        "proveedor": "Proveedor ABC"
    }
]
```

---

#### POST `/api/productos`

Crea un producto. **Requiere autenticación.**

**Body:**
```json
{
    "nombre": "Laptop HP",
    "descripcion": "Laptop 15 pulgadas",
    "precio": 15000.00,
    "stock_actual": 25,
    "categoria_id": 1,
    "proveedor_id": 1
}
```

**Respuesta 201:**
```json
{
    "id": 1,
    "nombre": "Laptop HP",
    "descripcion": "Laptop 15 pulgadas",
    "precio": 15000.00,
    "stock_actual": 25,
    "categoria_id": 1,
    "proveedor_id": 1
}
```

---

#### PUT `/api/productos/{id}`

Actualiza un producto. **Requiere autenticación.**

**Body:**
```json
{
    "nombre": "Laptop HP Actualizada",
    "descripcion": "Laptop 17 pulgadas",
    "precio": 18000.00,
    "stock_actual": 20,
    "categoria_id": 1,
    "proveedor_id": 1
}
```

**Respuesta 200:**
```json
{
    "id": 1,
    "nombre": "Laptop HP Actualizada",
    "descripcion": "Laptop 17 pulgadas",
    "precio": 18000.00,
    "stock_actual": 20,
    "categoria_id": 1,
    "proveedor_id": 1
}
```

---

#### DELETE `/api/productos/{id}`

Elimina un producto. **Requiere autenticación.**

**Respuesta 200:**
```json
{
    "message": "Producto no encontrado"
}
```

---

### Movimientos de Stock

#### GET `/api/movimientos`

Lista todos los movimientos con producto y usuario. **Requiere autenticación.**

**Respuesta 200:**
```json
[
    {
        "id": 1,
        "producto": "Laptop HP",
        "usuario": "Juan Pérez",
        "tipo": "entrada",
        "cantidad": 10,
        "motivo": "Reabastecimiento",
        "created_at": "2026-09-03T10:00:00.000000Z"
    }
]
```

---

#### POST `/api/movimientos`

Registra un movimiento de stock (entrada o salida). **Requiere autenticación.**

**Body:**
```json
{
    "producto_id": 1,
    "user_id": 1,
    "tipo": "entrada",
    "cantidad": 10,
    "motivo": "Reabastecimiento"
}
```

Valores permitidos para `tipo`: `"entrada"` o `"salida"`.

**Respuesta 201:**
```json
{
    "message": "Movimiento registrado correctamente",
    "producto_id": 1,
    "tipo": "entrada",
    "cantidad": 10,
    "stock_anterior": 25,
    "stock_nuevo": 35
}
```

---

## Errores comunes

| Código | Descripción |
|--------|-------------|
| 401 | Token no proporcionado, inválido o expirado |
| 403 | No tienes permisos para realizar esta acción |
| 404 | Recurso no encontrado |
| 422 | Datos de entrada inválidos |
| 500 | Error interno del servidor |
