<?php
 
require APPPATH . '/libraries/REST_Controller.php';
 
class krs extends REST_Controller {
 
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
 
    // show data krs
    function index_get() {
        $nim = $this->get('nim');
        if ($nim == '') {
            $krs = $this->db->get('krs')->result();
        } else {
            $this->db->where('nim', $nim);
            $krs = $this->db->get('krs')->result();
        }
        $this->response($krs, 200);
    }
 
    // insert new data to krs
    function index_post() {
        $data = array(
                    'nim'           => $this->post('nim'),
                    'nama'          => $this->post('nama'),
                    'nmmk'          => $this->post('nmmk'),
                    'nm_dosen'      => $this->post('nmmk'),
                    'prodi'         => $this->post('prodi'));
        $insert = $this->db->insert('krs', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // update data krs
    function index_put() {
        $nim = $this->put('nim');
        $data = array(
                    'nim'       => $this->put('nim'),
                    'nama'      => $this->put('nama'),
                    'nmmk'      => $this->put('nmmk'),
                    'nm_dosen'  => $this->put('nm_dosen'),
                    'prodi'     => $this->put('prodi'));
        $this->db->where('nim', $nim);
        $update = $this->db->update('krs', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // delete krs
    function index_delete() {
        $nim = $this->delete('nim');
        $this->db->where('nim', $nim);
        $delete = $this->db->delete('krs');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
}
?>