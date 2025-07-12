# NUSA DEWA - Shrimp Breeding Innovation Platform

**Innovation Meets Aquaculture**

NUSA DEWA adalah platform web yang mendukung program pemuliaan induk udang vannamei berteknologi tinggi, menggabungkan bioteknologi modern dengan pengalaman puluhan tahun di bidang akuakultur. Aplikasi ini dirancang untuk memfasilitasi diseminasi informasi, pengelolaan program breeding, serta memperkuat jaringan antara pusat riset, hatchery, dan petambak lokal.

## 🚀 Instalasi dan Penggunaan Awal

### Persyaratan Sistem

-   PHP 8.1+
-   Composer 2.0+
-   MySQL 8.0+ atau MariaDB 10.3+
-   Node.js 16+
-   Laravel 10+

### Langkah-langkah Setup Awal

1. **Clone Repository**

    ```bash
    git clone https://github.com/your-repo/nusa-dewa.git
    cd nusa-dewa
    ```

2. **Instal Dependencies**

    ```bash
    composer install
    npm install
    npm run build
    ```

3. **Setup Environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Konfigurasi Database**
    - Buat database baru di MySQL/MariaDB
    - Update file `.env` dengan kredensial database:
        ```env
        DB_DATABASE=nusa_dewa
        DB_USERNAME=username
        DB_PASSWORD=password
        ```

### Migrasi Database dan Seeding

1. **Jalankan Migrasi**

    ```bash
    php artisan migrate
    ```

2. **Jalankan Seeder**

    ```bash
    php artisan db:seed
    ```

    Seeder yang tersedia:

    - `TeamMemberSeeder`: Data tim inti BPIU2K
    - `UserSeeder`: Data pengguna default
    - `PostSeeder`: Konten dasar platform

3. **Untuk development, jalankan:**
    ```bash
    php artisan migrate:fresh --seed
    ```
    _Perintah ini akan me-reset database dan mengisi data dummy_

## 🔐 Default Login

**Admin Access:**

-   Email: admin@nusadewa.id
-   Password: password

> ⚠️ Untuk alasan keamanan, harap ubah kredensial default saat digunakan dalam lingkungan produksi.

## 🛠 Development Tools

-   **Local Server:**
    ```bash
    php artisan serve
    ```

## 📬 Kontak

Silakan hubungi kami untuk informasi lebih lanjut atau kolaborasi:

-   Email: surat.buat.adi@gmail.com

---

PRADStudio © 2025 NUSA DEWA – Empowering Genetics for Sustainable Aquaculture
