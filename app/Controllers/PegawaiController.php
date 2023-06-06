<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Pegawai;

class PegawaiController extends ResourceController
{
    protected $modelNama = 'App\Models\Pegawai';
    protected $format = 'json';

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $pegawaiModel = new Pegawai();

        $data = [
            'message' => 'success',
            'data_pegawai' => $pegawaiModel->orderBy('id', 'DESC')->findAll()
        ];

        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @param int $id
     * @return mixed
     */
    public function show($id = null)
    {
        $pegawaiModel = new Pegawai();

        $pegawai = $pegawaiModel->find($id);

        if ($pegawai) {
            $data = [
                'message' => 'success',
                'data_pegawai' => $pegawai
            ];

            return $this->respond($data, 200);
        } else {
            return $this->failNotFound('Pegawai not found');
        }
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $pegawaiModel = new Pegawai();

        // Validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama'      => 'required',
            'jabatan'   => 'required',
            'bidang'    => 'required',
            'email'     => 'required|valid_email',
            'alamat'    => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'message' => $validation->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        // Insert Method
        $pegawaiModel->insert([
            'nama'      => $this->request->getVar('nama'),
            'jabatan'   => $this->request->getVar('jabatan'),
            'bidang'    => $this->request->getVar('bidang'),
            'email'     => $this->request->getVar('email'),
            'alamat'    => $this->request->getVar('alamat'),
        ]);

        $response = [
            'message' => 'Success Created!'
        ];

        return $this->respondCreated($response);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @param int $id
     * @return mixed
     */
    public function update($id = null)
    {
        $pegawaiModel = new Pegawai();

        // Check if pegawai exists
        $pegawai = $pegawaiModel->find($id);
        if (!$pegawai) {
            return $this->failNotFound('Pegawai not found');
        }

        // Validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama'      => 'required',
            'jabatan'   => 'required',
            'bidang'    => 'required',
            'email'     => 'required|valid_email',
            'alamat'    => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'message' => $validation->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        // Update Method
        $pegawaiModel->update($id, [
            'nama'      => $this->request->getVar('nama'),
            'jabatan'   => $this->request->getVar('jabatan'),
            'bidang'    => $this->request->getVar('bidang'),
            'email'     => $this->request->getVar('email'),
            'alamat'    => $this->request->getVar('alamat'),
        ]);

        $response = [
            'message' => 'Success Updated!'
        ];

        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id = null)
    {
        $pegawaiModel = new Pegawai();

        // Check if pegawai exists
        $pegawai = $pegawaiModel->find($id);
        if (!$pegawai) {
            return $this->failNotFound('Pegawai not found');
        }

        // Delete Method
        $pegawaiModel->delete($id);

        $response = [
            'message' => 'Success Deleted!'
        ];

        return $this->respondDeleted($response);
    }
}
