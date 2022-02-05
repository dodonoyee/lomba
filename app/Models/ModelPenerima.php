<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenerima extends Model
{
    protected $table = 'penerima';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password', 'nama'];
    protected $validationRules = [
        'email' => 'required|valid_email',
        'password' => 'required',
        'nama' => 'required',
    ];

    protected $validationMessages = [
        'email' => [
            'required' => 'Masukkan Email Terlebih Dahulu',
            'valid_email' => 'Masukkan Email Yang Valid Terlebih Dahulu',
        ],

        'password' => [
            'required' => 'Masukkan Email Terlebih Dahulu',
        ],

        'nama' => [
            'required' => 'Masukkan Email Terlebih Dahulu',
        ],
    ];

    public function findById($id)
    {
        $data = $this->where('id', $id)->find();
        if ($data) {
            return $data;
        }
        return false;
    }

    public function findByPass($password)
    {
        $data = $this->where('password', $password)->find();
        if ($data) {
            return $data;
        }
        return false;
    }
}
