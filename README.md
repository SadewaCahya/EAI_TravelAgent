Travel Agent Integrated System

## Daftar Isi

- [Anggota Kelompok](#anggota-kelompok)
- [Arsitektur Sistem](#arsitektur-sistem)
- [Daftar Layanan](#daftar-layanan)
- [API Documentation](#api-documentation)
- [Komunikasi Antar Layanan](#komunikasi-antar-layanan)
- [Relasi Database](#relasi-database)

## Anggota Kelompok

1. Ferdian Surya Wibowo - 120222067
2. I Komang Sadewa Cahya Sumidra -1202220086
3. Devi Hermina Silaban - 1202223188
4. Ardhava Fathi Rafi - 1202223142
5. Moses Eliyada Tambunan - 1202220256

## Arsitektur Sistem

+-------------+ +-------------+ +-------------+
| User | | Ticket | | Order |
| Service |<------+ Service |<------+ Service |
| (Port 8000) | | (Port 8000) | | (Port 8000) |
+-------------+ +-------------+ +-------------+

## Daftar Layanan

### 1. User Service (Port: 8000)

- Mengelola data pengguna (user)
- Endpoint: `/users-travels`
- Berperan sebagai:
  - Provider data user ke Order Service
  - Consumer data order untuk histori pengguna

### 2. Ticket Service (Port: 8000)

- Mengelola data tiket perjalanan
- Endpoint: `/tickets`
- Berperan sebagai:
  - Provider data tiket ke Order Service
  - Consumer data order untuk tracking penjualan

### 3. Order Service (Port: 8000)

- Mengelola transaksi pemesanan
- Endpoint: `/orders`
- Berperan sebagai:
  - Consumer data dari User dan Ticket Service
  - Provider data transaksi ke layanan lain

## API Documentation

### User Service

| Method | Endpoint            | Deskripsi         |
| ------ | ------------------- | ----------------- |
| POST   | /users-travels      | Membuat user baru |
| GET    | /users-travels      | List semua user   |
| GET    | /users-travels/{id} | Detail user       |
| PUT    | /users-travels/{id} | Update user       |
| DELETE | /users-travels/{id} | Hapus user        |

### Ticket Service

| Method | Endpoint      | Deskripsi        |
| ------ | ------------- | ---------------- |
| POST   | /tickets      | Buat tiket baru  |
| GET    | /tickets      | List semua tiket |
| GET    | /tickets/{id} | Detail tiket     |
| PUT    | /tickets/{id} | Update tiket     |
| DELETE | /tickets/{id} | Hapus tiket      |

### Order Service

| Method | Endpoint                    | Deskripsi               |
| ------ | --------------------------- | ----------------------- |
| POST   | /orders                     | Buat order baru         |
| GET    | /orders                     | List semua order        |
| GET    | /orders/{id}                | Detail order            |
| PUT    | /orders/{id}                | Update quantity order   |
| DELETE | /orders/{id}                | Hapus order             |
| GET    | /orders/users/{user_id}     | Order berdasarkan user  |
| GET    | /orders/tickets/{ticket_id} | Order berdasarkan tiket |

## Komunikasi Antar Layanan

### Alur Pembuatan Order:

1. Client request ke Order Service (POST /orders)
2. Order Service memverifikasi:
   - Ke User Service (GET /users-travels/{user_id})
   - Ke Ticket Service (GET /tickets/{ticket_id})
3. Hitung total harga berdasarkan response Ticket Service
4. Simpan order dan kembalikan response ke client

## Relasi Database

- **User Service**:
  - Tabel `users_travels` memiliki relasi one-to-many dengan `orders`
  - Setiap user bisa memiliki banyak order
- **Ticket Service**:
  - Tabel `tickets` memiliki relasi one-to-many dengan `orders`
  - Setiap tiket bisa dipesan dalam banyak order
- **Order Service**:
  - Tabel `orders` memiliki:

    - Foreign key `user_id` merujuk ke `users_travels`
    - Foreign key `ticket_id` merujuk ke `tickets`
  - Setiap order harus terhubung ke 1 user dan 1 tiket

## Link Demo API

Video Demo :[ Video Demo Tugas Pengganti UTS IAE Kelompok 6](https://youtu.be/fOsdQQM5bLw)

## Kesimpulan

**Pentingnya Integrasi Antar Layanan dalam Sistem Travel Agent**

**Sistem Travel Agent** adalah sistem terintegrasi yang melayani proses pemesanan tiket perjalanan secara digital. Sistem ini biasanya dibangun dalam bentuk layanan-layanan terpisah, seperti **User Service** (mengelola data pengguna), **Ticket Service** (mengelola data tiket perjalanan), dan **Order Service** (mengelola transaksi pemesanan). Masing-masing layanan tersebut bekerja secara independen namun harus saling terhubung agar seluruh proses bisa berjalan lancar. Kenapa kita membutuhkan sistem integrasi travel agent ?

 **Pertama**, integrasi memungkinkan layanan untuk saling bertukar data. Misalnya, ketika Order Service ingin membuat pesanan, ia perlu mendapatkan informasi tentang pengguna dan tiket dari layanan lain. Tanpa integrasi, proses ini bisa terhambat.

**Kedua**, integrasi membantu memastikan bahwa data yang digunakan itu valid. Artinya, pemesanan hanya akan diproses jika pengguna dan tiket yang dimaksud benar-benar ada. Ini penting untuk menghindari kesalahan yang bisa merugikan pengguna.

**Ketiga**, dengan adanya integrasi, sistem menjadi lebih mudah untuk dikembangkan dan dikelola. Setiap layanan bisa diperbaiki atau di-upgrade tanpa mengganggu layanan lainnya, sehingga sistem tetap berjalan dengan baik.

**Keempat,** integrasi memberikan pengalaman yang lebih lengkap bagi pengguna. Meskipun pengguna hanya melihat satu aplikasi, di balik layar ada banyak layanan yang bekerja sama untuk memberikan pengalaman yang mulus.

Kesimpulannya, sistem travel agent sangat membutuhkan integrasi antar layanan. Setiap layanan memiliki peran yang berbeda, dan semuanya harus terhubung agar proses seperti pemesanan tiket bisa berjalan dengan baik, cepat, dan aman.
