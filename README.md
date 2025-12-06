# Backend API - Responsi 2 Mobile Paket 2

## Identitas Mahasiswa
- **Nama**: Renggo
- **NIM**: H1D023012
- **Shift Baru**: B
- **Shift Asal**: H

---

## 🎯 Deskripsi

Backend API untuk aplikasi **Inventaris Bahan Renggomart** yang dibangun menggunakan **CodeIgniter 4**. API ini menyediakan endpoint untuk autentikasi user dan manajemen CRUD inventaris bahan makanan.

---

## 🛠️ Teknologi yang Digunakan

- **Framework**: CodeIgniter 4.6.3
- **PHP**: 8.3.16
- **Database**: MySQL
- **Server**: PHP Built-in Development Server

---

## 📂 Struktur Folder

```
app/
├── Config/
│   ├── Routes.php           # Konfigurasi routing API
│   ├── Cors.php             # Konfigurasi CORS
│   └── Filters.php          # Konfigurasi filters
├── Controllers/
│   ├── AuthController.php   # Controller untuk autentikasi
│   └── InventarisController.php  # Controller untuk CRUD inventaris
└── Models/
    ├── UserModel.php        # Model untuk tabel users
    └── InventarisModel.php  # Model untuk tabel inventaris
```

---

## 🗄️ Struktur Database

### Tabel: `users`
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Tabel: `inventaris`
```sql
CREATE TABLE inventaris (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nama VARCHAR(200) NOT NULL,
    harga INT NOT NULL,
    jumlah INT NOT NULL,
    tanggal_masuk VARCHAR(50) NOT NULL,
    tanggal_kedaluwarsa VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

---

## 📡 API Endpoints

### Base URL
```
http://localhost:8080/api
```

### 1. **Register User**
**Endpoint:** `POST /api/register`

**Request Body:**
```json
{
  "username": "renggo",
  "email": "renggo@gmail.com",
  "password": "123456"
}
```

**Response Success (201):**
```json
{
  "status": "success",
  "message": "Registrasi berhasil",
  "data": {
    "id": 1,
    "username": "renggo",
    "email": "renggo@gmail.com"
  }
}
```

**Response Error (400):**
```json
{
  "status": "error",
  "message": "Registrasi gagal",
  "errors": {
    "username": "Username sudah digunakan",
    "email": "Email sudah terdaftar"
  }
}
```

---

### 2. **Login User**
**Endpoint:** `POST /api/login`

**Request Body:**
```json
{
  "username": "renggo",
  "password": "123456"
}
```

**Response Success (200):**
```json
{
  "status": "success",
  "message": "Login berhasil",
  "data": {
    "id": 1,
    "username": "renggo",
    "email": "renggo@gmail.com"
  }
}
```

**Response Error (401):**
```json
{
  "status": "error",
  "message": "Password salah"
}
```

---

### 3. **Get All Inventaris**
**Endpoint:** `GET /api/inventaris?user_id={user_id}`

**Response Success (200):**
```json
{
  "status": "success",
  "message": "Data inventaris berhasil diambil",
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "nama": "Beras Premium",
      "harga": 85000,
      "jumlah": 50,
      "tanggal_masuk": "2025-12-01",
      "tanggal_kedaluwarsa": "2026-12-01",
      "created_at": "2025-12-06 12:00:00",
      "updated_at": "2025-12-06 12:00:00"
    }
  ]
}
```

---

### 4. **Get Single Inventaris**
**Endpoint:** `GET /api/inventaris/{id}`

**Response Success (200):**
```json
{
  "status": "success",
  "message": "Data inventaris ditemukan",
  "data": {
    "id": 1,
    "user_id": 1,
    "nama": "Beras Premium",
    "harga": 85000,
    "jumlah": 50,
    "tanggal_masuk": "2025-12-01",
    "tanggal_kedaluwarsa": "2026-12-01"
  }
}
```

**Response Error (404):**
```json
{
  "status": "error",
  "message": "Data inventaris tidak ditemukan"
}
```

---

### 5. **Create Inventaris**
**Endpoint:** `POST /api/inventaris`

**Request Body:**
```json
{
  "user_id": 1,
  "nama": "Beras Premium",
  "harga": 85000,
  "jumlah": 50,
  "tanggal_masuk": "2025-12-01",
  "tanggal_kedaluwarsa": "2026-12-01"
}
```

**Response Success (201):**
```json
{
  "status": "success",
  "message": "Data inventaris berhasil ditambahkan",
  "data": {
    "id": 1,
    "user_id": 1,
    "nama": "Beras Premium",
    "harga": 85000,
    "jumlah": 50,
    "tanggal_masuk": "2025-12-01",
    "tanggal_kedaluwarsa": "2026-12-01"
  }
}
```

**Response Error (400):**
```json
{
  "status": "error",
  "message": "Gagal menambahkan data inventaris",
  "errors": {
    "nama": "Nama barang minimal 3 karakter",
    "harga": "Harga harus berupa angka"
  }
}
```

---

### 6. **Update Inventaris**
**Endpoint:** `PUT /api/inventaris/{id}`

**Request Body:**
```json
{
  "nama": "Beras Super Premium",
  "harga": 95000,
  "jumlah": 45,
  "tanggal_masuk": "2025-12-01",
  "tanggal_kedaluwarsa": "2026-12-01"
}
```

**Response Success (200):**
```json
{
  "status": "success",
  "message": "Data inventaris berhasil diupdate",
  "data": {
    "id": 1,
    "user_id": 1,
    "nama": "Beras Super Premium",
    "harga": 95000,
    "jumlah": 45,
    "tanggal_masuk": "2025-12-01",
    "tanggal_kedaluwarsa": "2026-12-01",
    "created_at": "2025-12-06 12:00:00",
    "updated_at": "2025-12-06 13:00:00"
  }
}
```

**Response Error (404):**
```json
{
  "status": "error",
  "message": "Data inventaris tidak ditemukan"
}
```

---

### 7. **Delete Inventaris**
**Endpoint:** `DELETE /api/inventaris/{id}`

**Response Success (200):**
```json
{
  "status": "success",
  "message": "Data inventaris berhasil dihapus"
}
```

**Response Error (404):**
```json
{
  "status": "error",
  "message": "Data inventaris tidak ditemukan"
}
```

---

## 💡 Penjelasan Kode

### 1. **Routes.php**

File konfigurasi routing untuk semua endpoint API.

```php
$routes->group('api', ['namespace' => 'App\Controllers'], function($routes) {
    // Authentication Routes
    $routes->post('register', 'AuthController::register');
    $routes->post('login', 'AuthController::login');
    
    // Inventaris Routes (CRUD)
    $routes->get('inventaris', 'InventarisController::index');
    $routes->get('inventaris/(:num)', 'InventarisController::show/$1');
    $routes->post('inventaris', 'InventarisController::create');
    $routes->put('inventaris/(:num)', 'InventarisController::update/$1');
    $routes->delete('inventaris/(:num)', 'InventarisController::delete/$1');
});
```

**Penjelasan:**
- Semua route dikelompokkan dengan prefix `/api`
- `(:num)` adalah placeholder untuk parameter ID (integer)
- Route otomatis di-handle oleh method yang sesuai di controller

---

### 2. **Cors.php**

Konfigurasi CORS untuk mengizinkan request dari frontend.

```php
public array $default = [
    'allowedOrigins'         => ['*'],
    'allowedOriginsPatterns' => [],
    'allowedHeaders'         => ['*'],
    'allowedMethods'         => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS', 'PATCH'],
    'exposedHeaders'         => [],
    'maxAge'                 => 7200,
    'supportsCredentials'    => false,
];
```

**Penjelasan:**
- `allowedOrigins => ['*']`: Mengizinkan semua origin (untuk development)
- `allowedMethods`: Method HTTP yang diizinkan
- `maxAge`: Durasi cache preflight request (2 jam)

---

### 3. **Filters.php**

Konfigurasi filters yang diterapkan pada request.

```php
public array $globals = [
    'before' => [
        'csrf' => ['except' => ['api/*']],
        'cors',
    ],
];
```

**Penjelasan:**
- CSRF protection di-disable untuk route `/api/*`
- CORS filter diterapkan secara global
- Filter dijalankan sebelum request masuk ke controller

---

### 4. **UserModel.php**

Model untuk tabel `users` dengan validasi dan auto hash password.

```php
protected $allowedFields = ['username', 'email', 'password'];

protected $validationRules = [
    'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
    'email'    => 'required|valid_email|is_unique[users.email]',
    'password' => 'required|min_length[6]'
];

protected $beforeInsert = ['hashPassword'];
protected $beforeUpdate = ['hashPassword'];

protected function hashPassword(array $data)
{
    if (isset($data['data']['password'])) {
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
    }
    return $data;
}
```

**Penjelasan:**
- `allowedFields`: Field yang boleh di-insert/update
- `validationRules`: Aturan validasi otomatis
- `beforeInsert/beforeUpdate`: Callback untuk hash password sebelum save
- `password_hash()`: Menggunakan bcrypt untuk enkripsi password

---

### 5. **InventarisModel.php**

Model untuk tabel `inventaris` dengan validasi.

```php
protected $allowedFields = [
    'user_id', 'nama', 'harga', 'jumlah', 
    'tanggal_masuk', 'tanggal_kedaluwarsa'
];

protected $validationRules = [
    'user_id'             => 'required|integer',
    'nama'                => 'required|min_length[3]|max_length[200]',
    'harga'               => 'required|integer',
    'jumlah'              => 'required|integer',
    'tanggal_masuk'       => 'required',
    'tanggal_kedaluwarsa' => 'required'
];

public function getByUserId($userId)
{
    return $this->where('user_id', $userId)->findAll();
}
```

**Penjelasan:**
- Validasi memastikan semua field required dan tipe data benar
- `getByUserId()`: Custom method untuk filter inventaris by user
- `useTimestamps`: Otomatis set created_at dan updated_at

---

### 6. **AuthController.php**

Controller untuk menangani autentikasi user.

#### **Method: register()**
```php
public function register()
{
    $model = new UserModel();
    
    $data = [
        'username' => $this->request->getJSON()->username ?? null,
        'email'    => $this->request->getJSON()->email ?? null,
        'password' => $this->request->getJSON()->password ?? null
    ];

    if ($model->insert($data)) {
        $response = [
            'status'  => 'success',
            'message' => 'Registrasi berhasil',
            'data'    => [
                'id'       => $model->getInsertID(),
                'username' => $data['username'],
                'email'    => $data['email']
            ]
        ];
        return $this->respondCreated($response);
    } else {
        $response = [
            'status'  => 'error',
            'message' => 'Registrasi gagal',
            'errors'  => $model->errors()
        ];
        return $this->fail($response, 400);
    }
}
```

**Penjelasan:**
- Mengambil data dari JSON body request
- Insert ke database via UserModel
- Password otomatis di-hash oleh callback model
- Return response dengan status code 201 (Created) jika berhasil
- Return error dengan detail validasi jika gagal

#### **Method: login()**
```php
public function login()
{
    $model = new UserModel();
    
    $json = $this->request->getJSON(true);
    $username = $json['username'] ?? null;
    $password = $json['password'] ?? null;

    if (empty($username) || empty($password)) {
        return $this->fail([
            'status'  => 'error',
            'message' => 'Username dan password harus diisi'
        ], 400);
    }

    $user = $model->where('username', $username)->first();

    if (!$user) {
        return $this->fail([
            'status'  => 'error',
            'message' => 'Username tidak ditemukan'
        ], 404);
    }

    if (!password_verify($password, $user['password'])) {
        return $this->fail([
            'status'  => 'error',
            'message' => 'Password salah'
        ], 401);
    }

    $response = [
        'status'  => 'success',
        'message' => 'Login berhasil',
        'data'    => [
            'id'       => $user['id'],
            'username' => $user['username'],
            'email'    => $user['email']
        ]
    ];

    return $this->respond($response);
}
```

**Penjelasan:**
- Validasi input tidak boleh kosong
- Cari user berdasarkan username
- Verifikasi password dengan `password_verify()`
- Return data user (tanpa password) jika berhasil
- Return error sesuai kasus (404 user not found, 401 wrong password)

---

### 7. **InventarisController.php**

Controller untuk menangani CRUD inventaris.

#### **Method: index() - Get All**
```php
public function index()
{
    $model = new InventarisModel();
    $userId = $this->request->getGet('user_id');

    if ($userId) {
        $data = $model->where('user_id', $userId)->findAll();
    } else {
        $data = $model->findAll();
    }

    return $this->respond([
        'status'  => 'success',
        'message' => 'Data inventaris berhasil diambil',
        'data'    => $data
    ]);
}
```

**Penjelasan:**
- Support filter by user_id via query parameter
- Return semua data jika tidak ada filter
- Menggunakan `findAll()` dari Model

#### **Method: show() - Get by ID**
```php
public function show($id = null)
{
    $model = new InventarisModel();
    $data = $model->find($id);

    if ($data) {
        return $this->respond([
            'status'  => 'success',
            'message' => 'Data inventaris ditemukan',
            'data'    => $data
        ]);
    } else {
        return $this->failNotFound([
            'status'  => 'error',
            'message' => 'Data inventaris tidak ditemukan'
        ]);
    }
}
```

**Penjelasan:**
- Parameter `$id` dari URL segment
- Menggunakan `find()` untuk get by primary key
- Return 404 jika data tidak ditemukan

#### **Method: create() - Insert**
```php
public function create()
{
    $model = new InventarisModel();

    $json = $this->request->getJSON(true);

    $data = [
        'user_id'             => $json['user_id'] ?? null,
        'nama'                => $json['nama'] ?? null,
        'harga'               => $json['harga'] ?? null,
        'jumlah'              => $json['jumlah'] ?? null,
        'tanggal_masuk'       => $json['tanggal_masuk'] ?? null,
        'tanggal_kedaluwarsa' => $json['tanggal_kedaluwarsa'] ?? null
    ];

    if ($model->insert($data)) {
        $response = [
            'status'  => 'success',
            'message' => 'Data inventaris berhasil ditambahkan',
            'data'    => [
                'id' => $model->getInsertID(),
                ...$data
            ]
        ];
        return $this->respondCreated($response);
    } else {
        return $this->fail([
            'status'  => 'error',
            'message' => 'Gagal menambahkan data inventaris',
            'errors'  => $model->errors()
        ], 400);
    }
}
```

**Penjelasan:**
- Ambil semua data dari JSON body
- Insert via model dengan validasi otomatis
- Return ID baru dari `getInsertID()`
- Return error validasi jika gagal

#### **Method: update() - Update**
```php
public function update($id = null)
{
    $model = new InventarisModel();

    if (!$model->find($id)) {
        return $this->failNotFound([
            'status'  => 'error',
            'message' => 'Data inventaris tidak ditemukan'
        ]);
    }

    $json = $this->request->getJSON(true);

    $data = [
        'nama'                => $json['nama'] ?? null,
        'harga'               => $json['harga'] ?? null,
        'jumlah'              => $json['jumlah'] ?? null,
        'tanggal_masuk'       => $json['tanggal_masuk'] ?? null,
        'tanggal_kedaluwarsa' => $json['tanggal_kedaluwarsa'] ?? null
    ];

    $data = array_filter($data, function($value) {
        return $value !== null;
    });

    if ($model->update($id, $data)) {
        return $this->respond([
            'status'  => 'success',
            'message' => 'Data inventaris berhasil diupdate',
            'data'    => $model->find($id)
        ]);
    } else {
        return $this->fail([
            'status'  => 'error',
            'message' => 'Gagal mengupdate data inventaris',
            'errors'  => $model->errors()
        ], 400);
    }
}
```

**Penjelasan:**
- Cek apakah data dengan ID tersebut ada
- Filter field yang null (partial update)
- Update via model dengan validasi
- Return data terbaru setelah update

#### **Method: delete() - Delete**
```php
public function delete($id = null)
{
    $model = new InventarisModel();

    if (!$model->find($id)) {
        return $this->failNotFound([
            'status'  => 'error',
            'message' => 'Data inventaris tidak ditemukan'
        ]);
    }

    if ($model->delete($id)) {
        return $this->respondDeleted([
            'status'  => 'success',
            'message' => 'Data inventaris berhasil dihapus'
        ]);
    } else {
        return $this->fail([
            'status'  => 'error',
            'message' => 'Gagal menghapus data inventaris'
        ], 400);
    }
}
```

**Penjelasan:**
- Cek apakah data ada sebelum delete
- Menggunakan soft delete jika diaktifkan di model
- Return success message tanpa data

---

## 🚀 Instalasi & Setup

### 1. **Clone Repository**
```bash
git clone <repository-url>
cd responsi2-backend
```

### 2. **Install Dependencies**
```bash
composer install
```

### 3. **Setup Database**
```bash
# Buat database
mysql -u root -p
CREATE DATABASE responsi2_inventory;
USE responsi2_inventory;

# Jalankan SQL script untuk create tables
SOURCE database.sql;
```

### 4. **Konfigurasi Environment**
```bash
# Copy env ke .env
cp env .env

# Edit .env
nano .env
```

Konfigurasi `.env`:
```env
CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = responsi2_inventory
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

### 5. **Jalankan Server**
```bash
# Development server
php spark serve

# Atau dengan host dan port custom
php spark serve --host=0.0.0.0 --port=8080
```

Server akan berjalan di: `http://localhost:8080`

---

## 🧪 Testing API

### Menggunakan cURL:

**Register:**
```bash
curl -X POST http://localhost:8080/api/register \
  -H "Content-Type: application/json" \
  -d '{"username":"renggo","email":"renggo@gmail.com","password":"123456"}'
```

**Login:**
```bash
curl -X POST http://localhost:8080/api/login \
  -H "Content-Type: application/json" \
  -d '{"username":"renggo","password":"123456"}'
```

**Create Inventaris:**
```bash
curl -X POST http://localhost:8080/api/inventaris \
  -H "Content-Type: application/json" \
  -d '{
    "user_id": 1,
    "nama": "Beras Premium",
    "harga": 85000,
    "jumlah": 50,
    "tanggal_masuk": "2025-12-01",
    "tanggal_kedaluwarsa": "2026-12-01"
  }'
```

**Get All Inventaris:**
```bash
curl http://localhost:8080/api/inventaris?user_id=1
```

**Update Inventaris:**
```bash
curl -X PUT http://localhost:8080/api/inventaris/1 \
  -H "Content-Type: application/json" \
  -d '{
    "nama": "Beras Super Premium",
    "harga": 95000,
    "jumlah": 45,
    "tanggal_masuk": "2025-12-01",
    "tanggal_kedaluwarsa": "2026-12-01"
  }'
```

**Delete Inventaris:**
```bash
curl -X DELETE http://localhost:8080/api/inventaris/1
```

---

## 📝 Catatan Penting

### Security:
- ✅ Password di-hash menggunakan bcrypt
- ✅ CSRF protection disabled untuk API routes
- ✅ Input validation di level model
- ✅ CORS configured untuk allow cross-origin requests

### Best Practices:
- ✅ RESTful API design
- ✅ Consistent response format (status, message, data)
- ✅ Proper HTTP status codes
- ✅ Error handling dengan detail error
- ✅ Database relationships dengan foreign key

### Development Tips:
- Gunakan Postman untuk testing API
- Enable debug mode di `.env` untuk development
- Check `writable/logs` untuk error logs
- Gunakan database migration untuk production

---

## 📄 Lisensi

Project ini dibuat untuk keperluan tugas Responsi 2 Mobile Programming.

---

**Dibuat dengan ❤️ menggunakan CodeIgniter 4**

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
