<?php

namespace App\Controllers;

use App\Models\InventarisModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class InventarisController extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\InventarisModel';
    protected $format    = 'json';

    /**
     * Get all inventaris
     * GET /api/inventaris
     * Optional: ?user_id=1
     */
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

    /**
     * Get single inventaris by ID
     * GET /api/inventaris/{id}
     */
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

    /**
     * Create new inventaris
     * POST /api/inventaris
     */
    public function create()
    {
        $model = new InventarisModel();

        // Get JSON input
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

    /**
     * Update inventaris
     * PUT /api/inventaris/{id}
     */
    public function update($id = null)
    {
        $model = new InventarisModel();

        // Cek apakah data ada
        if (!$model->find($id)) {
            return $this->failNotFound([
                'status'  => 'error',
                'message' => 'Data inventaris tidak ditemukan'
            ]);
        }

        // Get JSON input
        $json = $this->request->getJSON(true);

        $data = [
            'nama'                => $json['nama'] ?? null,
            'harga'               => $json['harga'] ?? null,
            'jumlah'              => $json['jumlah'] ?? null,
            'tanggal_masuk'       => $json['tanggal_masuk'] ?? null,
            'tanggal_kedaluwarsa' => $json['tanggal_kedaluwarsa'] ?? null
        ];

        // Hapus field yang null
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

    /**
     * Delete inventaris
     * DELETE /api/inventaris/{id}
     */
    public function delete($id = null)
    {
        $model = new InventarisModel();

        // Cek apakah data ada
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
}
