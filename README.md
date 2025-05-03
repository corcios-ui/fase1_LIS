# 🧾 La Cuponera SV

Sistema web en **PHP + MySQL (MariaDB)** para la publicación, compra y administración de cupones de descuento.

---

## 🧱 Arquitectura del Proyecto.

```
cupones_sv/
├── index.php                 # Inicio con ofertas destacadas
│
├── config/                  # Configuración del sistema
│   ├── database.php         # Conexión a la base de datos
│   └── rutas.php            # Constantes globales para rutas
│
├── includes/                # Elementos reutilizables
│   ├── header.php           # Cabecera con sesión y navegación
│   └── footer.php           # Pie de página y cierre HTML
│
├── assets/
│   └── css/
│       └── styles.css       # Estilos generales
│
├── controllers/             # Lógica del sistema (Controladores)
│   ├── login.php            # Verificación de sesión
│   ├── logout.php           # Cierre de sesión
│   ├── registro_cliente.php
│   ├── registro_empresa.php
│   ├── oferta.php           # Publicación de ofertas
│   ├── recuperar.php        # Recuperación de contraseña
│   └── eliminar.php         # Eliminación de usuarios
│
├── views/                   # Interfaces del usuario (Vistas)
│   ├── login.php
│   ├── registro_cliente.php
│   ├── registro_empresa.php
│   ├── publicar_oferta.php
│   ├── ver_ofertas.php
│   ├── buscar_ofertas.php
│   ├── mis_ofertas.php
│   ├── perfil_cliente.php
│   ├── perfil_empresa.php
│   ├── perfil_admin.php
│   ├── dashboard_admin.php
│   ├── empresas_pendientes.php
│   ├── historial_compras.php
│   ├── recuperar.php
│   ├── recuperacion_exitosa.php
```

---

## ⚙️ Funcionalidades Principales

- 🔐 Login para clientes, empresas y administradores
- 📝 Registro de nuevos clientes y empresas
- 🏷 Publicación de ofertas por parte de empresas
- 💰 Compra y canje de cupones por clientes
- 📊 Panel de administrador:
  - Ver empresas pendientes
  - Eliminar clientes y empresas
  - Reportes básicos
- 🔍 Búsqueda de ofertas por palabra clave
- 🔑 Recuperación de contraseña por tipo de usuario
- 📎 Estilos CSS aplicados sin frameworks


## 👥 Tipos de Usuario

| Tipo     | Descripción                                 |
|----------|---------------------------------------------|
| Cliente  | Compra y canjea ofertas                     |
| Empresa  | Publica y administra sus cupones            |
| Admin    | Control total sobre usuarios y reportes     |

---

## 📌 Notas

- Contraseñas almacenadas con `password_hash()`
- Sistema desarrollado con **estructura modular tipo MVC**
- Proyecto educativo, puede extenderse con AJAX, validaciones JS y email

---

