# E-Commerce Inventory API

Sebuah RESTful APIuntuk sistem manajemen inventaris di sebuah toko e-commerce yang memungkinkan admin untuk mengelola produk, kategori, dan melihat informasi terkait stok dan harga produk.

## 📦 Teknologi yang digunakan

- Laravel 10
- MySQL
- PHP 8.1 atau lebih
- Postman

## 🚀 Instalasi

1. Clone repository lalu buka
```bash
git clone https://github.com/zanuaraldi/e-commerce-inventory-api.git

cd e-commerce-inventory-api
```

2. Install depedency
```bash
composer install
```

3. Salin file `.env`
```bash
cp .env.example .env
```

4. Konfigurasikan database di file `.env`

5. Generate Key
```bash
php artisan key:generate
```

5. Jalankan migration dan seeder
```bash
php artisan migrate --seed
```

## ⚙️ Endpoint API

<b> Kategori </b>

- `GET /api/categories` -> Mengambil semua data kategori
- `POST /api/categories` -> Menambahkan kategori baru

<b>Produk</b>

- `GET /api/products` -> Mengambil semua data produk
- `POST /api/products` -> Menambahkan produk baru
- `GET /api/products/{id}` -> Mencari data produk berdasarkan `id`
- `PUT /api/products/{id}` -> Memperbarui data produk berdasarkan `id`
- `DELETE /api/products/{id}` -> Menghapus data produk berdasarkan `id`
- `POST /api/products/update-stock` -> Memperbarui stok produk setelah dilakukan transaksi
- `GET /api/products/search` -> Mencari produk berdasarkan nama dan kategori

<b> Inventaris </b>

- `GET /api/inventory/value` -> Mengambil total inventaris berdasarkan harga dan stok

## 🎥 Video Demo
Link video bisa klik disini