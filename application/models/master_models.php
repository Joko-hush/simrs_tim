<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class master_models extends CI_Model
{
    public function getUser($tlp)
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.[user] WHERE tlp = '$tlp'                
                ";
        return $this->db->query($sql)->row_array();
    }
    public function getAllUnit()
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.m_unit WHERE isactive = 1                
                ";
        return $this->db->query($sql)->result_array();
    }
    public function getAllSubUnit()
    {
        $sql = "SELECT instal = instalasi, unit, subunit = sub_unit FROM SIMRS_ACT.dbo.m_unit WHERE isactive = 1
                ORDER BY sub_unit,instalasi               
                ";
        return $this->db->query($sql)->result_array();
    }
    public function getSubUnit($subunit)
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.m_unit WHERE sub_unit = '$subunit'
                ORDER BY sub_unit,instalasi               
                ";
        return $this->db->query($sql)->row_array();
    }
    public function getAllSubUnitByUnit($unit)
    {
        $sql = "SELECT unit = sub_unit FROM SIMRS_ACT.dbo.m_unit WHERE isactive = 1 AND id = '$unit'               
                ";
        return $this->db->query($sql)->row_array();
    }
    public function getAllMasalah()
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.jenis_masalah               
                ";
        return $this->db->query($sql)->result_array();
    }
    public function getAllKegiatan()
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.kunjungan where deleted <> 1 ORDER BY waktu               
                ";
        return $this->db->query($sql)->result_array();
    }
    public function getAllKegiatanByDate($date1, $date2)
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.kunjungan
                WHERE CONVERT(VARCHAR(8),waktu,112) BETWEEN '$date1' AND '$date2' AND deleted <> 1 
                ORDER BY user_id             
                ";
        return $this->db->query($sql)->result_array();
    }
    public function getKegiatanById($id)
    {
        $sql = "SELECT * FROM [SIMRS_ACT].[dbo].[kunjungan]
                WHERE id = $id           
                ";
        return $this->db->query($sql)->row_array();
    }
    public function getAllKegiatanByUser($date1, $date2, $user)
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.[kunjungan]
                WHERE CONVERT(VARCHAR(8),waktu,112) BETWEEN '$date1' AND '$date2' AND user_id = $user AND deleted = 0 
                ORDER BY waktu            
                ";
        return $this->db->query($sql)->result_array();
    }
}
