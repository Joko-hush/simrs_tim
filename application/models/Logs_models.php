<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Logs_models extends CI_Model
{
    public function logs($id, $text)
    {
        $log = [
            'user_id' => $id,
            'aktifitas' => $text,
            'waktu' => time()
        ];
        $this->db->insert('log_lindu', $log);
    }
}
