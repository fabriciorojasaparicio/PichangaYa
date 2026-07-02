# 📘 DOCUMENTACIÓN DEL PROYECTO — SISTEMA DE RESERVAS DE CENTROS DEPORTIVOS

---

# 🧠 1. DESCRIPCIÓN GENERAL

Sistema SaaS para la gestión y reserva de canchas deportivas.

Permite:

* Visualizar centros deportivos
* Ver canchas disponibles
* Consultar horarios en tiempo real
* Reservar bloques de tiempo
* Gestionar usuarios (cliente, propietario, admin)

---

# 🏗️ 2. ARQUITECTURA

Frontend y backend desacoplados pero dentro del mismo proyecto:

Frontend: Vue 3 (SPA)
Backend: Laravel (API REST)
Base de datos: Supabase (PostgreSQL)

Flujo:

Usuario → Vue → API Laravel → Base de datos

---

# 🧩 3. TECNOLOGÍAS UTILIZADAS

* Laravel 10+
* Vue 3 (Composition API)
* Axios
* PostgreSQL (Supabase)
* Vite

---

# 🗄️ 4. DISEÑO DE BASE DE DATOS

## 4.1 Usuarios

Tabla: users
Campos principales:

* id
* name
* email
* password
* role_id

---

## 4.2 Roles

Tabla: roles
Valores:

* admin
* propietario
* cliente

---

## 4.3 Centros Deportivos

Tabla: centros_deportivos
Relación: pertenece a usuario (propietario)

Campos:

* id
* user_id
* nombre
* direccion
* region_id
* ciudad_id
* distrito_id
* latitud
* longitud

---

## 4.4 Canchas

Tabla: canchas
Relación: pertenece a centro_deportivo

Campos:

* id
* centro_deportivo_id
* nombre
* precio_por_bloque
* max_bloques_reserva
* activo

---

## 4.5 Deportes y Tipos

deportes
tipos_cancha
cancha_tipo (pivot)

Permite múltiples deportes por cancha.

---

## 4.6 Horarios

### Configuración

Tabla: horarios_config

Define días y horas de atención.

---

### Slots (bloques)

Tabla: horario_slots

Cada registro representa un bloque de 30 minutos.

Campos:

* cancha_id
* fecha
* hora_inicio
* hora_fin
* estado

Estados:

* libre
* reservado
* en_espera
* mantenimiento

---

## 4.7 Reservas

Tabla: reservas

Tabla: reserva_slots (pivot)

Permite:

* una reserva = múltiples bloques

---

## 4.8 Ubicación

* regiones
* ciudades
* distritos

---

# ⏰ 5. LÓGICA DE HORARIOS

* Cada cancha trabaja con bloques fijos de 30 minutos
* Los bloques se generan automáticamente
* Los usuarios reservan uno o más bloques
* Existe un límite máximo por reserva

---

# 🔐 6. AUTENTICACIÓN

Actualmente:

* Autenticación basada en sesión (Laravel)

Futuro:

* Laravel Sanctum (tokens)

---

# 📡 7. API ENDPOINTS

## Centros

GET /api/centros
GET /api/centros/{id}

---

## Canchas

GET /api/canchas/{id}/slots

---

## Reservas

POST /api/reservar

Body:

```
{
  "cancha_id": 1,
  "slots": [1,2,3]
}
```

---

## Usuario

GET /api/mis-reservas

---

# ⚙️ 8. LÓGICA DE RESERVAS

Proceso:

1. Usuario selecciona bloques
2. Sistema valida:

   * disponibilidad
   * límite de bloques
3. Se crea la reserva
4. Se bloquean los slots

Se usa:

* transacciones
* bloqueo de filas (lockForUpdate)

---

# 🖥️ 9. FRONTEND (VUE)

Estructura:

pages/

* Centros.vue
* CentroDetalle.vue
* CanchaDetalle.vue
* MisReservas.vue

components/

* CardCentro.vue
* SlotHorario.vue

services/

* api.js

---

# 🔗 10. CONEXIÓN FRONTEND - BACKEND

Uso de Axios:

baseURL: /api

Ejemplo:

api.get('/centros')

---

# 🧪 11. VALIDACIONES

* No reservar slots ocupados
* No exceder límite de bloques
* Usuario autenticado para reservar

---

# 🚀 12. ESCALABILIDAD

El sistema está preparado para:

* Pagos online
* Aplicación móvil
* Mapas interactivos
* Notificaciones
* Multi-centro por propietario (futuro)

---

# 🧱 13. ESTÁNDARES IMPLEMENTADOS

* Normalización de base de datos
* Arquitectura API REST
* Separación de responsabilidades
* Uso de relaciones pivot
* Control de concurrencia

---

# ⚠️ 14. PUNTOS CRÍTICOS

* horario_slots es el núcleo del sistema
* evitar doble reserva es prioridad
* mantener integridad en transacciones

---

# 📌 15. ROADMAP

Corto plazo:

* Login con tokens
* Cancelación de reservas
* Selección por fecha

Mediano plazo:

* UI/UX (Tailwind)
* Panel de propietario

Largo plazo:

* Pagos
* App móvil
* Geolocalización

---

# 🎯 16. RESUMEN

Sistema completo de reservas basado en slots de tiempo,
con arquitectura escalable tipo SaaS, preparado para crecimiento
y múltiples plataformas.
