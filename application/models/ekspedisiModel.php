<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class ekspedisiModel extends CI_Model
{
    public function getAll()
    {
        $this->db->where('deleted', 0);
        $this->db->order_by('tanggal', 'desc');
        return $this->db->get('ekspedisi')->result_array();
    }
    public function getById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('ekspedisi')->row_array();
    }
    public function getByDate($date1, $date2)
    {
        $sql = "SELECT * FROM ekspedisi WHERE deleted = 0 AND CONVERT(VARCHAR(8), tanggal, 112) BETWEEN '$date1' AND '$date2'
        ";
        return $this->db->query($sql)->result_array();
    }
    public function addParaf($id, $penerima, $paraf)
    {
        $this->db->set('penerima', $penerima);
        $this->db->set('paraf', $paraf);
        $this->db->set('status', 1);
        $this->db->set('updated_at', time());
        $this->db->where('id', $id);
        $this->db->update('ekspedisi');
    }
    public function add($data)
    {
        $this->db->insert('ekspedisi', $data);
    }
    public function delete($id)
    {
        $this->db->set('deleted', 1);
        $this->db->set('deleted_at', time());
        $this->db->where('id', $id);
        return $this->db->update('ekspedisi');
    }
    public function edit($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('ekspedisi', $data);
    }
}
