# PMP Fecha de Entrega

## Objetivo

Plugin para WooCommerce que permite seleccionar una fecha de entrega únicamente en los productos que lo requieran.

---

# V1

## Cliente

- Calendario Flatpickr
- Español
- Responsive
- No escritura manual
- Solo clic

## Administración

WooCommerce → PMP Fecha de Entrega

Configuración:

- Fecha mínima
- Fecha máxima
- Intervalos bloqueados

## Producto

Nueva opción:

☐ Este producto requiere selección de fecha de entrega

## Pedido

Guardar fecha en:

- Carrito
- Checkout
- Pedido
- Emails
- Administración

---

# Arquitectura

pmp-fecha-entrega.php

↓

Settings

↓

Producto

↓

Calendar

↓

Utils

↓

JS

↓

CSS

---

# Principios

- Sin plugins externos
- Sin jQuery salvo WooCommerce
- Flatpickr integrado
- Código limpio
- PHP 8+
- WooCommerce 10+
- WordPress Coding Standards

---

# Futuras versiones

V1.1

- Mejor UX

V1.2

- Capacidad diaria

V2

- Dashboard

V3

- Google Calendar

V4

- Formularios automáticos