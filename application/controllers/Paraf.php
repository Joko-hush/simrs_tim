<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Paraf extends CI_Controller
{
    public function index()
    {
        $this->load->view('pages/wellcome');
    }
    public function shareparaf()
    {
        $data['title'] = "SIMRS WEB APP";
        $data['judul'] = "FORM PARAF";
        $id = $this->input->get('id');
        $data['kdu'] = 'client';
        $k = $this->db->get_where('kunjungan', ['id' => $id])->row_array();
        $data['kunjungan'] = $k;

        $this->load->view('pages/layout/header', $data);
        $this->load->view('pages/layout/nav', $data);
        $this->load->view('pages/kegiatan', $data);
        $this->load->view('pages/layout/footer', $data);
    }
}
