# Website Perpustakaan Telkom University Purwokerto

Proyek ini adalah sistem portal perpustakaan berbasis Laravel yang memungkinkan pengguna untuk mencari dan meminjam buku, serta memungkinkan administrator untuk mengelola koleksi buku, kategori, anggota, dan riwayat peminjaman secara efisien dan aman.

## Overview

### User Dashboard

* Pengguna dapat melihat dashboard pribadi yang berisi informasi akun, riwayat peminjaman, dan status peminjaman buku.
* Menelusuri katalog buku berdasarkan kategori, judul, atau pengarang.
* Melakukan proses peminjaman buku secara digital.
* Melihat status peminjaman (aktif, jatuh tempo, dikembalikan).
* Mengelola profil pengguna, termasuk mengubah data seperti NIM, prodi, angkatan, dan foto profil.

### Admin Dashboard

* Pusat kontrol sistem, tempat admin yang terotorisasi mengelola seluruh data yang ada dalam sistem.
* Mengelola data buku, termasuk menambahkan, mengedit, menghapus, dan mengelompokkan berdasarkan kategori.
* Manajemen kategori untuk mengatur struktur koleksi buku.
* Manajemen anggota (user): melihat detail pengguna, mengedit informasi, atau menghapus akun.
* Pengelolaan peminjaman dan verifikasi pengembalian buku.
* Melihat dan mengunduh riwayat aktivitas peminjaman untuk keperluan administrasi dan audit.

### Security and Permissions

* Role-based Access Control (RBAC): Sistem memiliki peran akses berbeda, seperti admin dan user dalam mengelola data dan peminjaman buku.
* Authentication and Authorization: Proses login terproteksi untuk memastikan hanya pengguna terdaftar yang dapat mengakses dashboard.
* Input Validation & Sanitization: Untuk mencegah serangan XSS dan menjaga integritas data sistem.
* Password Hashing: Sistem menyimpan sandi pengguna menggunakan hashing yang aman (Bcrypt/Argon2 melalui Laravel Auth).

## Tech Stack

**Frontend:** Blade Engine

**Backend:** Laravel

**Database:** MySQL

**Authentication:** JWT or Sanctum

## Run Locally

Clone project menggunakan git

~~~bash
git clone https://github.com/dhindaanz/PAW_Kelompok2.git
~~~

Masuk ke folder project

~~~bash
cd PAW_Kelompok2
~~~

Install composer untuk kebutuhan project

~~~bash
composer install
~~~

atau, jika untuk keperluan produksi gunakan perintah ini

~~~bash
composer install --no-dev
~~~

Migrasi database table dan data dummy

~~~bash
php artisan migrate --seed
~~~

Buat symbolic link untuk penyimpanan

~~~bash
php artisan storage:link
~~~

Jalankan server

~~~bash
composer run dev
~~~

## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`APP_NAME`
`APP_KEY`
`APP_URL`
`APP_DEBUG`
`APP_ENV`

`DB_CONNECTION`
`DB_HOST`
`DB_DATABASE`
`DB_USERNAME`
`DB_PASSWORD`

`MAIL_MAILER`
`MAIL_HOST`
`MAIL_PORT`
`MAIL_USERNAME`
`MAIL_PASSWORD`
`MAIL_ENCRYPTION`
`MAIL_FROM_ADDRESS`

## Acknowledgements

* [Laravel](https://laravel.com/docs/11.x)
* [MySQL](https://dev.mysql.com/doc)
