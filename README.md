Travel Agent Integrated System

## Daftar Isi
- [
- [Arsitektur Sistem](#arsitektur-sistem)
- [Daftar Layanan](#daftar-layanan)
- [API Documentation](#api-documentation)
- [Komunikasi Antar Layanan](#komunikasi-antar-layanan)
- [Relasi Database](#relasi-database)


## Arsitektur Sistem
+-------------+ +-------------+ +-------------+
| User | | Ticket | | Order |
| Service |<------+ Service |<------+ Service |
| (Port 8000) | | (Port 8001) | | (Port 8002) |
+-------------+ +-------------+ +-------------+


## Daftar Layanan

### 1. User Service (Port: 8000)
- Mengelola data pengguna (user)
- Endpoint: `/users-travels`
- Berperan sebagai:
  - Provider data user ke Order Service
  - Consumer data order untuk histori pengguna

### 2. Ticket Service (Port: 8001)
- Mengelola data tiket perjalanan
- Endpoint: `/tickets`
- Berperan sebagai:
  - Provider data tiket ke Order Service
  - Consumer data order untuk tracking penjualan

### 3. Order Service (Port: 8002)
- Mengelola transaksi pemesanan
- Endpoint: `/orders`
- Berperan sebagai:
  - Consumer data dari User dan Ticket Service
  - Provider data transaksi ke layanan lain

## API Documentation

### User Service
| Method | Endpoint            | Deskripsi                      |
|--------|---------------------|--------------------------------|
| POST   | /users-travels      | Membuat user baru              |
| GET    | /users-travels      | List semua user                |
| GET    | /users-travels/{id} | Detail user                   |
| PUT    | /users-travels/{id} | Update user                   |
| DELETE | /users-travels/{id} | Hapus user                    |

### Ticket Service
| Method | Endpoint      | Deskripsi                      |
|--------|---------------|--------------------------------|
| POST   | /tickets      | Buat tiket baru                |
| GET    | /tickets      | List semua tiket               |
| GET    | /tickets/{id} | Detail tiket                   |
| PUT    | /tickets/{id} | Update tiket                   |
| DELETE | /tickets/{id} | Hapus tiket                    |

### Order Service
| Method | Endpoint                | Deskripsi                      |
|--------|-------------------------|--------------------------------|
| POST   | /orders                 | Buat order baru                |
| GET    | /orders                 | List semua order               |
| GET    | /orders/{id}            | Detail order                   |
| PUT    | /orders/{id}            | Update quantity order          |
| DELETE | /orders/{id}            | Hapus order                    |
| GET    | /orders/users/{user_id} | Order berdasarkan user         |
| GET    | /orders/tickets/{ticket_id} | Order berdasarkan tiket    |

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

