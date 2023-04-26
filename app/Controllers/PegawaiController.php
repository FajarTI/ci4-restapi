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
        $data = [
            'message' => 'success',
            'data_pegawai' => model($this->modelNama)->orderBy('id','DESC')->findAll()
        ];

        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //Validation
        $rules = $this->validate([
            'nama'      => 'required',
            'jabatan'   => 'required',
            'bidang'    => 'required',
            'email'     => 'required',
            'alamat'    => 'required',
        ]);

        if(!$rules){
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        //Insert Method
        model($this->modelNama)->insert([
            'nama'      => esc($this->request->getVar('nama')),
            'jabatan'   => esc($this->request->getVar('jabatan')),
            'bidang'    => esc($this->request->getVar('bidang')),
            'email'     => esc($this->request->getVar('email')),
            'alamat'    => esc($this->request->getVar('alamat')),
        ]);

        $response = [
            'message' => 'Success Created!'
        ];

        return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
