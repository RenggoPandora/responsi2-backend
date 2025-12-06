<?php

namespace App\Models;

use CodeIgniter\Model;

class InventarisModel extends Model
{
    protected $table            = 'inventaris';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'nama', 'harga', 'jumlah', 'tanggal_masuk', 'tanggal_kedaluwarsa'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'user_id'             => 'required|integer',
        'nama'                => 'required|min_length[3]|max_length[200]',
        'harga'               => 'required|integer',
        'jumlah'              => 'required|integer',
        'tanggal_masuk'       => 'required',
        'tanggal_kedaluwarsa' => 'required'
    ];
    protected $validationMessages = [
        'nama' => [
            'required'   => 'Nama barang harus diisi',
            'min_length' => 'Nama barang minimal 3 karakter'
        ],
        'harga' => [
            'required' => 'Harga harus diisi',
            'integer'  => 'Harga harus berupa angka'
        ],
        'jumlah' => [
            'required' => 'Jumlah harus diisi',
            'integer'  => 'Jumlah harus berupa angka'
        ],
        'tanggal_masuk' => [
            'required' => 'Tanggal masuk harus diisi'
        ],
        'tanggal_kedaluwarsa' => [
            'required' => 'Tanggal kedaluwarsa harus diisi'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    /**
     * Get inventaris by user_id
     */
    public function getByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }
}
