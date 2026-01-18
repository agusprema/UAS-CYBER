# README
## Website PHP – Analisis Celah Keamanan

---

## 1. Deskripsi Proyek

Website ini merupakan proyek pembelajaran yang dibuat menggunakan **PHP native**, **MySQL**, dan **Bootstrap 5** dengan desain modern.  
Tujuan utama website ini adalah untuk **menganalisis dan memahami beberapa celah keamanan pada aplikasi web**.

---

## 2. Fitur Utama

Website memiliki fitur berikut:
- Landing page (sebelum login)
- Sistem login menggunakan PHP session
- Dashboard setelah login
- Edit profil pengguna
- Simulasi pembelian
- Reset password
- Halaman debug

---

## 3. Kebutuhan Sistem

Untuk menjalankan website ini dibutuhkan:
- PHP versi **7.4** atau lebih baru
- MySQL / MariaDB
- Web server:
  - XAMPP / Laragon / WAMP
- Browser modern (Chrome, Edge, Firefox)

---

## 4. Cara Menjalankan Website

### 4.1 Menyimpan Project
Salin folder project ke direktori web server:

**XAMPP**
C:\xampp\htdocs\(nama folder)

**Laragon**
C:\laragon\www\(nama folder)

---

### 4.2 Setup Database
1. Buka **phpMyAdmin**
2. Buat database baru dengan nama:vuln_site
3. 3. Import file `db.sql` ke database tersebut

---

### 4.3 Konfigurasi Database
Pastikan konfigurasi koneksi database di file PHP:

```php
$conn = mysqli_connect("localhost", "root", "", "vuln_site");
```

---

### 4.4 Menjalankan Website

Buka browser dan akses:

http://localhost/vuln-site/

---

## 5. Akun Contoh

Gunakan akun berikut untuk login:

Username: user1
Password: password123

---

## 6. Daftar Celah Keamanan
| **NO** |      **Nama Celah**     | **Lokasi File** |
|:------:|:-----------------------:|:---------------:|
|    1   |     Mass Assignment     |   profile.php   |
|    2   | Race Condition          |   purchase.php  |
|    3   | Insecure Password Reset |    reset.php    |
|    4   |  Information Disclosure |    debug.php    |

