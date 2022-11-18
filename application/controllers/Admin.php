<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    private function tgl($date)
    {
        $y = substr($date, 0, 4);
        $m = substr($date, 4, 2);
        $d = substr($date, 6, 2);
        return $y . '-' . $m . '-' . $d;
    }
    private function _tgl($date)
    {
        list($y, $m, $d) = explode('-', $date);
        return $y . $m . $d;
    }
    public function dashboard()
    {
        $data['title'] = "SIMRS WEB APP";
        $data['judul'] = "DASHBOARD";
        $user = $this->master_models->getUser($this->session->userdata('phone'));
        $user_id = $user['id'];

        $date1 = $this->input->post('date1');
        $date2 = $this->input->post('date2');
        if (!$date1) {
            $date1 = date('Ymd', strtotime('first day of this month'));
        } else {
            $date1 = $this->_tgl($date1);
        }
        if (!$date2) {
            $date2 = date('Ymd', strtotime('last day of this month'));
            $this->Logs_models->logs('Melihat data kegiatan', $this->tgl($date1), $this->tgl($date2));
        } else {
            $date2 = $this->_tgl($date2);
            $this->Logs_models->logs('Melakukan pencarian data kegiatan', $this->tgl($date1), $this->tgl($date2));
        }
        $data['date1'] = $this->tgl($date1);
        $data['date2'] = $this->tgl($date2);
        $data['kegiatan'] = $this->master_models->getAllKegiatanByDate($date1, $date2);
        $data['selesai'] = $this->master_models->getKegiatanSelesai($date1, $date2);
        $data['belum'] = $this->master_models->getKegiatanBelumSelesai($date1, $date2);
        $data['masalah'] = $this->master_models->getAllMasalah();
        $data['subunit'] = $this->master_models->getAllSubUnitbyDate($date1, $date2);
        $data['jumlahkegiatan'] = count($data['kegiatan']);
        $data['jumlahselesai'] = count($data['selesai']);
        $data['jumlahbelum'] = count($data['belum']);
        if (!$data['subunit']) {
            $data['subunit'] = $this->master_models->getAllSubUnit();
        }
        foreach ($data['subunit'] as $u) {
            $jmlUnit[] = $this->master_models->getJumlahByUnit($date1, $date2, $u['subunit']);
        }
        // var_dump($jmlUnit);
        // die;
        $data['jmlUnit'] = $jmlUnit;
        $data['jm'] = $this->master_models->getKegiatanByJenisMasalah($date1, $date2);

        $this->load->view('pages/layout/header', $data);
        $this->load->view('pages/layout/nav', $data);
        $this->load->view('pages/dashboard', $data);
        $this->load->view('pages/layout/footer', $data);
    }
    public function deleted()
    {
        $data['title'] = "SIMRS WEB APP";
        $data['judul'] = "Deleted Input";
        $user = $this->master_models->getUser($this->session->userdata('phone'));
        $user_id = $user['id'];

        $date1 = $this->input->post('date1');
        $date2 = $this->input->post('date2');
        if (!$date1) {
            $date1 = date('Ymd', strtotime('first day of this month'));
        } else {
            $date1 = $this->_tgl($date1);
        }
        if (!$date2) {
            $date2 = date('Ymd', strtotime('last day of this month'));
            $this->Logs_models->logs('Melihat data kegiatan yang dihapus', $this->tgl($date1), $this->tgl($date2));
        } else {
            $date2 = $this->_tgl($date2);
            $this->Logs_models->logs('Melakukan pencarian data yang dihapus', $this->tgl($date1), $this->tgl($date2));
        }
        $data['date1'] = $this->tgl($date1);
        $data['date2'] = $this->tgl($date2);

        $data['kegiatan'] = $this->master_models->getAllDeleted($date1, $date2);

        $this->load->view('pages/layout/header', $data);
        $this->load->view('pages/layout/nav', $data);
        $this->load->view('pages/deleted', $data);
        $this->load->view('pages/layout/footer', $data);
    }
    public function restore()
    {
        $id = $this->input->get('id');
        $this->db->set('deleted', 0);
        $this->db->where('id', $id);
        $this->db->update('kunjungan');
        $this->Logs_models->logs('mengembalikan data kegiatan yang dihapus', '', $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-white" role="alert">Data sudah di kembalikan silahkan bisa dilihat di list kegiatan pada tanggal yang tercantum.</div>');
        redirect('admin/deleted');
    }
}
