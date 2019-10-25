<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Jurusan extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $jurusan = $this->db->get('jurusan')->result();
        } else {
            $this->db->where('id_jurusan', $id);
            $jurusan = $this->db->get('jurusan')->result();
        }
        $this->response($jurusan, 200);
    }

    
      //Mengirim atau menambah data kontak baru
      function index_post() {
        $data = array(
                    'id_jurusan'           => $this->post('id_jurusan'),
                    'nama_jurusan'          => $this->post('nama_jurusan'));
        $insert = $this->db->insert('jurusan', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

      //Memperbarui data kontak yang telah ada
      function index_put() {
        $id = $this->put('id_jurusan');
        $data = array(
                    'id_jurusan'           => $this->post('id_jurusan'),
                    'nama_jurusan'          => $this->post('nama_jurusan'));
        $this->db->where('id_jurusan', $id);
        $update = $this->db->update('jurusan', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

     //Menghapus salah satu data kontak
     function index_delete() {
        $id = $this->delete('id_jurusan');
        $this->db->where('id_jurusan', $id);
        $delete = $this->db->delete('jurusan');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>