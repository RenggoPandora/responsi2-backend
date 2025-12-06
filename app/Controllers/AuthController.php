<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class AuthController extends ResourceController
{
    use ResponseTrait;

    /**
     * Register new user
     * POST /api/register
     */
    public function register()
    {
        $model = new UserModel();
        
        // Get JSON input
        $json = $this->request->getJSON(true);
        
        $data = [
            'username' => $json['username'] ?? null,
            'email'    => $json['email'] ?? null,
            'password' => $json['password'] ?? null
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

    /**
     * Login user
     * POST /api/login
     */
    public function login()
    {
        $model = new UserModel();
        
        // Get JSON input
        $json = $this->request->getJSON(true);
        
        $username = $json['username'] ?? null;
        $password = $json['password'] ?? null;

        // Validasi input
        if (empty($username) || empty($password)) {
            return $this->fail([
                'status'  => 'error',
                'message' => 'Username dan password harus diisi'
            ], 400);
        }

        // Cari user berdasarkan username
        $user = $model->where('username', $username)->first();

        if (!$user) {
            return $this->fail([
                'status'  => 'error',
                'message' => 'Username tidak ditemukan'
            ], 404);
        }

        // Verifikasi password
        if (!password_verify($password, $user['password'])) {
            return $this->fail([
                'status'  => 'error',
                'message' => 'Password salah'
            ], 401);
        }

        // Login berhasil
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
}
