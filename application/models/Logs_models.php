<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Logs_models extends CI_Model
{
    public function logs($text, $dari, $jadi)
    {
        $user = $this->master_models->getUser($this->session->userdata('phone'));
        $id = $user['id'];
        $ip = $this->ip_models->get_client_ip_2();
        $log = [
            'user_id' => $id,
            'device' => $ip,
            'aktifitas' => $text,
            'waktu' => time(),
            'dari' => $dari,
            'menjadi' => $jadi
        ];
        $this->db->insert('logs', $log);
    }

    public function getLogByUser()
    {
        $user = $this->master_models->getUser($this->session->userdata('phone'));
        $id = $user['id'];
        $sql = "SELECT * FROM SIMRS_ACT.dbo.[logs] WHERE user_id = $id
                ORDER BY waktu DESC
                ";
        return $this->db->query($sql)->result_array();
    }
    public function getLogs()
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.[logs]
                ORDER BY waktu DESC
                ";
        return $this->db->query($sql)->result_array();
    }
}
