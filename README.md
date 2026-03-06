# SIPRAKERIN - Sistem Informasi Prakerin

SIPRAKERIN (Sistem Informasi Prakerin) adalah aplikasi berbasis web yang digunakan untuk mengelola data **Praktik Kerja Industri (Prakerin)** siswa di **UPT Komputer Universitas PGRI Madiun (UNIPMA)**.

Sistem ini membantu proses pendataan siswa prakerin, pengelolaan asal sekolah, jurusan, serta pencatatan jurnal kegiatan selama pelaksanaan prakerin.

Aplikasi ini dikembangkan menggunakan **framework Laravel** dengan tampilan antarmuka berbasis **Tailwind CSS**.

---

# 📌 Fitur Utama

* Pendataan Siswa Prakerin
* Manajemen Data Sekolah
* Manajemen Data Jurusan
* Pencatatan Jurnal Kegiatan Prakerin
* Tampilan Detail Data Prakerin
* Tampilan Detail Jurnal Kegiatan
* Fitur Cetak Data Prakerin
* Fitur Cetak Jurnal Kegiatan
* Tampilan Print Friendly
* Integrasi Database PostgreSQL

---

# 🛠️ Teknologi yang Digunakan

| Teknologi    | Keterangan                   |
| ------------ | ---------------------------- |
| Laravel      | Framework backend PHP        |
| Tailwind CSS | Framework CSS untuk tampilan |
| PostgreSQL   | Database                     |
| Supabase     | Hosting database PostgreSQL  |
| Vercel       | Deployment aplikasi          |
| Git          | Version control              |
| GitHub       | Repository project           |

---

# 📂 Struktur Folder Penting

```
app/
│
├── Http/
│   └── Controllers/
│       ├── PrakerinController.php
│       └── JurnalController.php
│
├── Models/
│   ├── Prakerin.php
│   ├── Sekolah.php
│   ├── Jurusan.php
│   └── Jurnal.php
│
resources/
└── views/
    ├── prakerin/
    │   ├── create.blade.php
    │   ├── list.blade.php
    │   └── show.blade.php
    │
    ├── jurnal/
    │   ├── index.blade.php
    │   └── print-detail.blade.php
    │
    └── welcome.blade.php
```

---

# 🗄️ Struktur Database

## Tabel `prakerin`

| Field                  | Type      | Keterangan               |
| ---------------------- | --------- | ------------------------ |
| id                     | integer   | Primary Key              |
| no_pendataan           | string    | Nomor pendataan siswa    |
| nis                    | string    | Nomor induk siswa        |
| nama_siswa             | string    | Nama siswa               |
| id_sekolah             | integer   | Relasi ke tabel sekolah  |
| id_jurusan             | integer   | Relasi ke tabel jurusan  |
| tanggal_mulai_prakerin | date      | Tanggal mulai prakerin   |
| tanggal_akhir_prakerin | date      | Tanggal selesai prakerin |
| created_at             | timestamp | Waktu dibuat             |
| updated_at             | timestamp | Waktu diperbarui         |

---

## Tabel `sekolah`

| Field        | Type    |
| ------------ | ------- |
| id           | integer |
| nama_sekolah | string  |

---

## Tabel `jurusan`

| Field        | Type    |
| ------------ | ------- |
| id           | integer |
| nama_jurusan | string  |

---

## Tabel `jurnal`

| Field       | Type      |
| ----------- | --------- |
| id          | integer   |
| no_jurnal   | string    |
| prakerin_id | integer   |
| tanggal     | date      |
| tempat      | string    |
| kegiatan    | text      |
| waktu       | timestamp |
| created_at  | timestamp |
| updated_at  | timestamp |

---

# 🔗 Relasi Model

## Prakerin

* belongsTo → Sekolah
* belongsTo → Jurusan
* hasMany → Jurnal

## Jurnal

* belongsTo → Prakerin

---

# ⚙️ Cara Instalasi

### 1 Clone Repository

```
git clone https://github.com/GalihToti/jurnalpkl-upt
```

### 2 Masuk ke Folder Project

```
cd jurnalpkl-upt
```

### 3 Install Dependency Laravel

```
composer install
```

### 4 Copy File Environment

```
cp .env.example .env
```

### 5 Generate Application Key

```
php artisan key:generate
```

### 6 Konfigurasi Database

Edit file `.env`

```
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=jurnalpkl
DB_USERNAME=postgres
DB_PASSWORD=password
```
atau sesuaikan dengan database yang anda gunakan

Jika menggunakan **Supabase**:

```
DB_CONNECTION=pgsql
DB_HOST=aws-1-ap-southeast-1.pooler.supabase.com
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres.ladaszeoqciwaoecczgy
DB_PASSWORD=jurnalpklupt
```

---

### 7 Jalankan Migration Database

```
php artisan migrate
```

---

### 8 Jalankan Server Laravel

```
php artisan serve
```

Buka browser:

```
http://127.0.0.1:8000
```

---

# ▶️ Cara Penggunaan Sistem

## 1. Menambahkan Data Prakerin

1. Buka halaman **Pendataan Prakerin**
2. Klik tombol **Tambah Data**
3. Isi data berikut:

* Nomor Pendataan
* NIS
* Nama Siswa
* Asal Sekolah
* Jurusan
* Tanggal Mulai Prakerin
* Tanggal Akhir Prakerin

4. Klik **Simpan**

Data prakerin akan tersimpan di database.

---

## 2. Melihat Data Prakerin

1. Buka halaman **Daftar Prakerin**
2. Sistem akan menampilkan seluruh data prakerin
3. Klik **Detail** untuk melihat informasi lengkap siswa

---

## 3. Menambahkan Jurnal Kegiatan

1. Buka halaman **Jurnal**
2. Klik **Tambah Jurnal**
3. Isi data berikut:

* Nomor Jurnal
* Tanggal
* Tempat Kegiatan
* Kegiatan yang dilakukan

4. Klik **Simpan**

Data jurnal akan tersimpan dan terhubung dengan data prakerin siswa.

---

## 4. Melihat Detail Jurnal

1. Buka halaman **Daftar Jurnal**
2. Pilih data jurnal
3. Klik **Detail**

Sistem akan menampilkan informasi kegiatan secara lengkap.

---

## 5. Mencetak Data

Sistem menyediakan fitur cetak untuk:

* Form Pendataan Prakerin
* Jurnal Kegiatan

Langkah mencetak:

1. Buka halaman **Detail**
2. Klik tombol **Cetak**
3. Sistem akan membuka halaman print
4. Pilih **Print** atau **Save as PDF**

Dokumen akan dicetak dalam format yang rapi dan siap digunakan.

---

# 🌐 Deployment

Aplikasi ini dapat di-deploy menggunakan:

* Vercel
* Railway
* Shared Hosting
* VPS Server

Database dapat menggunakan:

* Supabase (PostgreSQL)
* PostgreSQL lokal
* Railway PostgreSQL

---


## 👨‍💻 Tim Pengembang

Proyek **Website Jurnal Prakerin UPT Komputer Universitas PGRI Madiun** dikembangkan oleh tim yang terdiri dari 7 orang.

### Daftar Pengembang

| No | Nama                     | Peran                                  |
|----|--------------------------|----------------------------------------|
| 1  | Galih Toti Ilham Prayoga | Pengembang Utama (Fullstack Developer) |
| 2  | Indra Wibisana           | Frontend Developer                     |
| 3  | Aelul Artta Alfranowo    | Database Engineer                      |
| 4  | Beryl Syah Rafif         | Backend Developer                      |
| 5  | Aldio Wahitra Ghaffar    | Perancangan Flowchart                  |
| 6  | Fadhil Nur Ramadhani     | Penguji Sistem Keamanan                |
| 7  | Abraham Haneef           | Koordinator                            |

Project ini dibuat sebagai bagian dari kegiatan **Praktik Kerja Lapangan (PKL)** di :
**UPT Komputer Universitas PGRI Madiun**

---

# 📄 Lisensi

Project ini dibuat untuk tujuan **pembelajaran dan pengembangan sistem informasi prakerin**.

Penggunaan dan pengembangan lebih lanjut diperbolehkan untuk keperluan pendidikan.
