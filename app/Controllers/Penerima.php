<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelPenerima;

class Penerima extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->model = new ModelPenerima();
    }
    public function index()
    {
        $data = $this->model->orderBy('id', 'asc')->findAll();
        return $this->respond($data, 200);
    }

    public function create()
    {
        $data = $this->request->getPost();
        $data['password'] = base64_encode($data['password'] . ":" . $data['email']);

        if (!$data = $this->model->save($data)) {
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'succes' => 'Berhasil Memasukkan Data Penerima',
            ],
        ];
        return $this->respond($response);
    }

    public function show($id = null)
    {
        $data = $this->model->where('id', $id)->findAll();
        if (!$data) {
            return $this->fail("Data Tidak Ditemukan Untuk ID $id");
        }
        return $this->respond($data, 200);
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        $data['id'] = $id;
        $data['password'] = base64_encode($data['password'] . ":" . $data['email']);

        $penerima = $this->model->where('id', $id)->findAll();
        if (!$penerima) {
            return $this->failNotFound("Data Tidak Ditemukan Untuk ID $id");
        }

        if (!$data = $this->model->save($data)) {
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'succes' => 'Berhasil Mengubah Data Penerima',
            ],
        ];
        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $data = $this->model->where('id', $id)->findAll();
        if ($data) {
            $this->model->delete($id);

            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                    'succes' => 'Berhasil Menghapus Data Penerima',
                ],
            ];
            return $this->respondDeleted($response);
        }
        return $this->failNotFound("Data Tidak Ditemukan Untuk ID $id");
    }

    public function login()
    {
        helper('text');
        $tokenModel = new \App\Models\Tokens();
        $password = $this->request->getVar('HTTP_AUTHORIZATION');

        if ($this->model->findByPass(substr($password, 6))[0]) {
            $penerimaData = $this->model->findByPass(substr($password, 6))[0];
            $token = random_string('md5', 32);
            $data = [
                'token' => $token,
                'email' => $penerimaData['email'],
            ];
            $tokenModel->save($data);
            return $this->respond($data);
        } else {
            return $this->respond(
                array(
                    [
                        'message' => 'error',
                    ]
                )
            );
        }
    }
}
