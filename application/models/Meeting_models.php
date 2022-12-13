<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Meeting_models extends CI_Model
{
    public function getMeetingByDate($date1, $date2)
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.pertemuan WHERE deleted = 0 AND CONVERT(VARCHAR(8),tgl,112) BETWEEN '$date1' AND '$date2'
    ";

        $hasil = $this->db->query($sql)->result_array();
        return $hasil;
    }
    public function createqr($name, $id)
    {
        $url = base_url('absen/index');
        $data['url'] = $url;

        $params['data'] = $url . '?id=' . $id;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH . "assets/img/qrcode/$name";
        $this->ciqrcode->generate($params);
        return 'OK';
    }
}
