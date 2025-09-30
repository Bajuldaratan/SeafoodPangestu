# 🦐 Seafood Pangestu - Sistem Kasir Restoran

Aplikasi kasir restoran dengan tampilan **Neo-Brutalism** yang modern dan fungsional.

## ✨ Fitur Utama

- 🔐 **Login System** (Admin & User)
- 🍽️ **Menu Management** (CRUD operations)
- 🛒 **Order System** dengan quantity
- 📋 **Transaction History**
- 🔍 **Search & Filter** berdasarkan kategori
- 📱 **Responsive Design** (Mobile-friendly)
- 🎨 **Neo-Brutalism UI** yang elegan

## 🚀 Deployment ke Railway

### 1. Setup Database Gratis

1. Buka [Railway.app](https://railway.app)
2. Login dengan GitHub
3. Create New Project → Add MySQL
4. Copy **DATABASE_URL** dari environment variables

### 2. Deploy Aplikasi

1. Connect GitHub repository
2. Add environment variables:
   ```
   DATABASE_URL=mysql://user:pass@host:port/dbname
   ```
3. Deploy otomatis akan berjalan

### 3. Initialize Database

Setelah deploy, jalankan:
```bash
php init_db.php
```

## 🔧 Local Development

### Prerequisites
- PHP 8.0+
- MySQL/MariaDB
- Web server (Apache/Nginx/PHP built-in)

### Setup
1. Clone repository
2. Import `pwl_kasir_restoran.sql` ke database
3. Jalankan web server:
   ```bash
   php -S localhost:8000
   ```

## 👤 Default Login

- **Admin**: `admin` / `admin`
- **User**: Registrasi terlebih dahulu

## 📱 Screenshots

### Login Page
- Neo-brutalism design dengan border tebal
- Form validation yang jelas
- Info login default

### Dashboard
- Grid menu dengan card design
- Filter kategori dan pencarian
- Admin controls (tambah/edit/hapus)

### Menu Management
- Form tambah/edit menu
- Upload gambar
- Status management

## 🛠️ Tech Stack

- **Backend**: PHP 8.0+
- **Database**: MySQL
- **Frontend**: Bootstrap 5.2, Custom CSS
- **Design**: Neo-Brutalism
- **Deployment**: Railway.app

## 🎨 Design System

### Colors
- **Primary**: #000 (Black)
- **Secondary**: #FFF (White)
- **Success**: #28A745 (Green)
- **Danger**: #DC3545 (Red)
- **Warning**: #FFC107 (Yellow)
- **Info**: #17A2B8 (Blue)

### Typography
- **Font**: Segoe UI, Tahoma, Geneva, Verdana
- **Weight**: Bold untuk headers
- **Transform**: UPPERCASE untuk buttons

### Components
- **Borders**: 3-4px solid black
- **Shadows**: 3-8px offset shadows
- **Spacing**: Consistent padding/margins
- **Buttons**: High contrast dengan hover effects

## 📄 License

MIT License - Feel free to use for personal/commercial projects.

## 🤝 Contributing

1. Fork repository
2. Create feature branch
3. Commit changes
4. Push to branch
5. Create Pull Request

---

**❤️**
