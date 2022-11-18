<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Aktivity extends CI_Controller
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
    public function aktivitasPerUser()
    {
        $data['title'] = "SIMRS WEB APP";
        $data['judul'] = "Aktivitas Anda";
        $this->Logs_models->logs('Melakukan pencarian data aktivitas', '', '');

        $logs = $this->Logs_models->getLogByUser();
        $data['logs'] = $logs;

        $this->load->view('pages/layout/header', $data);
        $this->load->view('pages/layout/nav', $data);
        $this->load->view('pages/aktivitas', $data);
        $this->load->view('pages/layout/footer', $data);
    }

    public function aktivitasUser()
    {
        $data['title'] = "SIMRS WEB APP";
        $data['judul'] = "Aktivitas User";
        $this->Logs_models->logs('Melakukan pencarian data aktivitas', '', '');

        $logs = $this->Logs_models->getLogs();
        $data['logs'] = $logs;

        $this->load->view('pages/layout/header', $data);
        $this->load->view('pages/layout/nav', $data);
        $this->load->view('pages/aktivitas', $data);
        $this->load->view('pages/layout/footer', $data);
    }
}
