# VistarToko - Layanan Fotokopi & ATK Terlengkap

VistarToko adalah aplikasi web modern untuk mengelola layanan fotokopi dan toko alat tulis kantor (ATK). Aplikasi ini dirancang dengan antarmuka yang profesional, bersih, dan responsif, memberikan pengalaman pengguna yang optimal baik untuk pelanggan maupun administrator.

## ✨ Fitur Utama

- **Antarmuka Pelanggan (Guest Interface)**
  - Landing page profesional dengan desain modern.
  - Katalog produk ATK dengan fitur kategori dan pencarian.
  - Daftar layanan fotokopi dan cetak unggulan.
  - Integrasi WhatsApp untuk pemesanan langsung.
  - Lokasi toko terintegrasi dengan Google Maps.
  
- **Panel Admin (Admin Dashboard)**
  - Manajemen layanan (Fotokopi, Jilid, Cetak Foto, dll).
  - Manajemen kategori dan produk ATK.
  - Pengaturan toko (Alamat, Jam Buka, Kontak, dll).
  - Antarmuka manajemen yang intuitif dan cepat.

- **Sistem Desain Profesional**
  - Palet warna kustom: Deep Teal (Primary), Red (Urgent), Amber (Stationery).
  - Tipografi: Inter font family.
  - Ikonografi: Branding kustom "Compass-Sun".
  - Layout responsif untuk semua perangkat.

## 🚀 Teknologi

- **Backend**: Laravel 12.x
- **Frontend**: Blade Templating, Vanilla JS, Custom CSS
- **Database**: SQLite (Default)
- **Asset Manager**: Vite

## 🛠️ Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project di lokal:

1. **Clone repository**
   ```bash
   git clone [url-repository]
   cd vistar-toko
   ```

2. **Instal dependensi PHP**
   ```bash
   composer install
   ```

3. **Instal dependensi Node.js**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env` dan atur konfigurasi database.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Migrasi dan Seeding**
   Jalankan migrasi untuk membuat tabel dan mengisi data awal.
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Jalankan Aplikasi**
   Gunakan perintah berikut untuk menjalankan server development dan Vite.
   ```bash
   php artisan serve
   # Di terminal terpisah
   npm run dev
   ```

## 📁 Struktur Folder Penting

- `app/Http/Controllers/Guest`: Kontroler untuk halaman pengunjung.
- `app/Http/Controllers/Admin`: Kontroler untuk panel manajemen.
- `resources/views/layouts`: Template utama (App & Admin).
- `resources/views/guest`: View untuk pelanggan.
- `resources/views/admin`: View untuk panel admin.
- `public/favicon.svg`: Branding ikon kompas matahari.

