<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class CekToken extends BaseController
{
    use ResponseTrait;

    public function cek($token = null)
    {
        $cekModel = new \App\Models\Tokens();
        $token = substr($this->request->getServer('HTTP_AUTHORIZATION'), 7);
        // $data = $cekModel->where('token', $token)->findAll();
        if ($cekModel->where('token', $token)->findAll()) {
            $data = $cekModel->where('token', $token)->findAll();
            return $this->respond($data, 200);
        } else {
            return $this->respond(
                array(
                    [
                        'message' => $token,
                        'token' => 'Data Tidak Ditemukan',
                    ]
                )
            );
        }
    }
}
