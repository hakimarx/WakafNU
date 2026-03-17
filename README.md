# WakafNU - Platform Manajemen Wakaf Digital LWP PWNU Jatim

WakafNU adalah platform manajemen wakaf produktif dan crowdfunding berbasis digital yang dikembangkan untuk **Lembaga Wakaf & Pertanahan (LWP) PWNU Jawa Timur**. Platform ini menghubungkan Wakif, Nadzir, dan Investor dalam satu ekosistem yang transparan, profesional, dan syar'i.

## 🚀 Fitur Utama

### 1. Crowdfunding Wakaf Uang
*   Integrasi **Pakasir Payment Gateway** (QRIS, VA, E-Wallet).
*   Progress bar dana terkumpul secara real-time.
*   Update otomatis status kampanye setelah pembayaran.

### 2. Portal Investasi (BOT - Build Operate Transfer)
*   Portal khusus bagi Investor untuk mengajukan proposal kerjasama bisnis.
*   Upload Business Plan (PDF) langsung melalui sistem.
*   Manajemen status proposal (Pending, Approved, Rejected).

### 3. Manajemen Nadzir (KYC)
*   Sistem pendaftaran Nadzir dengan upload KTP dan Sertifikat BWI.
*   Panel verifikasi administrasi oleh LWP PWNU Jatim.
*   Dashboard pengelolaan aset yang ditugaskan kepada Nadzir.

### 4. Manajemen Aset Wakaf
*   Katalog aset tanah wakaf strategis.
*   Informasi legalitas, luas tanah, dan status ketersediaan aset.

## ⚙️ Tech Stack
*   **Backend**: Laravel 11 (PHP 8.2+)
*   **Frontend**: TALL Stack (Tailwind CSS, Alpine.js, Laravel Livewire 3)
*   **Database**: MySQL / MariaDB
*   **Auth**: Laravel Jetstream
*   **Payment**: Pakasir Snap API

## 🛠️ Instalasi

1.  Clone repository:
    ```bash
    git clone https://github.com/hakimarx/WakafNU.git
    cd WakafNU
    ```

2.  Install dependencies:
    ```bash
    composer install
    npm install && npm run build
    ```

3.  Setup Environment:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  Configure Database & Pakasir:
    Update file `.env` dengan kredensial database dan API Keys Pakasir Anda.

5.  Migrate & Seed:
    ```bash
    php artisan migrate --seed
    ```

6.  Run the application:
    ```bash
    php artisan serve
    ```

## 👥 Aktor Sistem
*   **Admin (LWP)**: Verifikator pendaftaran dan pengelola aset utama.
*   **Nadzir**: Pengelola operasional aset di lapangan.
*   **Investor**: Mitra kerjasama produktif aset wakaf.
*   **Wakif**: Masyarakat umum pemberi wakaf uang.

---
Developed for **LWP PWNU Jawa Timur** - *Meningkatkan martabat umat melalui wakaf produktif.*
