<?php
 
require APPPATH . '/libraries/REST_Controller.php';
 
class dosen extends REST_Controller {
 
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
 
    // show data dosen
    function index_get() {
        $nid = $this->get('nid');
        if ($nid == '') {
            $dosen = $this->db->get('dosen')->result();
        } else {
            $this->db->where('nid', $nid);
            $dosen = $this->db->get('dosen')->result();
        }
        $this->response($dosen, 200);
    }
 
    // insert new data to dosen
    function index_post() {
        $data = array(
                    'nid'           => $this->post('nid'),
                    'nm_dosen'      => $this->post('nm_dosen'),
                    'id_jurusan'    => $this->post('id_jurusan'),
                    'alamat'        => $this->post('alamat'));
        $insert = $this->db->insert('dosen', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // update data dosen
    function index_put() {
        $nid = $this->put('nid');
        $data = array(
                    'nid'        => $this->put('nid'),
                    'nm_dosen'   => $this->put('nm_dosen'),
                    'id_jurusan' => $this->put('id_jurusan'),
                    'alamat'     => $this->put('alamat'));
        $this->db->where('nid', $nid);
        $update = $this->db->update('dosen', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // delete dosen
    function index_delete() {
        $nid = $this->delete('nid');
        $this->db->where('nid', $nid);
        $delete = $this->db->delete('dosen');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
}
?>