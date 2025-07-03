# Final Project - Sistem E-Voting

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red" alt="Laravel Version">
  <img src="https://img.shields.io/badge/License-MIT-blue.svg" alt="License">
</p>

## Deskripsi
Sistem E-Voting berbasis web yang dibangun menggunakan Laravel. Aplikasi ini memudahkan proses pemilihan secara digital, mulai dari pendaftaran kandidat, validasi pemilih, hingga rekapitulasi hasil suara secara real-time. Cocok digunakan untuk pemilihan ketua OSIS, BEM, organisasi, dan lain-lain.

## Table of Contents
- [Fitur](#fitur)
- [Instalasi](#instalasi)
- [Penggunaan](#penggunaan)
- [Kontribusi](#kontribusi)
- [Lisensi](#lisensi)
- [Credit](#credit)

## Fitur
- Autentikasi multi-role (admin, pemilih)
- Validasi pemilih dan status voting
- Manajemen kandidat (tambah, hapus, upload foto)
- Dashboard statistik hasil voting
- Rekapitulasi suara real-time
- Notifikasi dan feedback interaktif
- Responsive design (mobile & desktop)

## Instalasi
1. **Clone repository:**
   ```bash
   git clone <repo-url>
   ```
2. **Masuk ke direktori project:**
   ```bash
   cd <nama-folder>
   ```
3. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```
4. **Copy file .env dan konfigurasi:**
   ```bash
   cp .env.example .env
   # Edit konfigurasi database dan environment sesuai kebutuhan
   ```
5. **Generate key dan migrate database:**
   ```bash
   php artisan key:generate
   php artisan migrate
   ```
6. **Jalankan server:**
   ```bash
   php artisan serve
   ```

## Penggunaan
- Akses aplikasi di [http://localhost:8000](http://localhost:8000)
- Register/login sesuai role (admin, kandidat, pemilih)
- Admin dapat mengelola kandidat dan memvalidasi pemilih
- Pemilih dapat memilih kandidat yang tersedia satu kali
- Lihat hasil voting secara real-time di dashboard

## Kontribusi
Kontribusi sangat terbuka! Silakan fork repository ini, buat branch baru untuk fitur atau perbaikan, lalu ajukan pull request. Pastikan kode sudah teruji sebelum mengajukan PR.

## Lisensi
Project ini menggunakan lisensi MIT. Lihat file [LICENSE](LICENSE) untuk detail.

## Credit
- [Laravel](https://laravel.com/)
- [Blade UI Kit](https://blade-ui-kit.com/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Kontributor lain jika ada]
