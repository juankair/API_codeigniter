<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Biodata extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function table_name(){
        return 'biodata';
    }

    function index_get() {

        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get($this->table_name())->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get($this->table_name())->result();
        }
        $this->response($kontak, 200);
    }

    function index_post(){
        $data = array(
            'id' => $this->post('id'),
            'nama' => $this->post('nama'),
            'alamat' => $this->post('alamat')
        );
        $insert = $this->db->insert($this->table_name(),$data);
        if ($insert) {
            $this->response($data,200);
        }else{
            $this->response(array('status'=> 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id' => $this->put('id'),
                    'nama' => $this->put('nama'),
                    'alamat' => $this->put('alamat'));
        $this->db->where('id', $id);
        $update = $this->db->update($this->table_name(), $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete($this->table_name());
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>