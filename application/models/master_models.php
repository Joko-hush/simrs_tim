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
    public function getUserExId($tlp)
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.[user] WHERE NOT tlp = '$tlp'                
                ";
        return $this->db->query($sql)->result_array();
    }
    public function getUserNameById($id)
    {
        $sql = "SELECT nama = user FROM [user] WHERE id = $id                
                ";
        return $this->db->query($sql)->row_array();
    }
    public function getUserById($id)
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.[user] WHERE id = $id                
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
    public function getAllSubUnitbyDate($date1, $date2)
    {
        $sql = "SELECT
                    subunit =  U.sub_unit
                FROM
                    [SIMRS_ACT].[dbo].[kunjungan] K
                    INNER JOIN [SIMRS_ACT].[dbo].[m_unit] U ON U.id = K.unit_id 
                WHERE
                    CONVERT ( VARCHAR ( 8 ), waktu, 112 ) BETWEEN '$date1' 
                    AND '$date2'                     
                    AND deleted = 0
                    GROUP BY U.sub_unit              
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
    public function getAllKegiatan($date1, $date2)
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.[kunjungan]
                WHERE CONVERT(VARCHAR(8),waktu,112) BETWEEN '$date1' AND '$date2' deleted = 0 
                ORDER BY waktu           
                ";
        return $this->db->query($sql)->result_array();
    }
    public function getAllDeleted($date1, $date2)
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.kunjungan
                WHERE CONVERT(VARCHAR(8),waktu,112) BETWEEN '$date1' AND '$date2' AND deleted = 1  ORDER BY waktu               
                ";
        return $this->db->query($sql)->result_array();
    }
    public function getAllDeletedByUser($date1, $date2, $user_id)
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.kunjungan
                WHERE CONVERT(VARCHAR(8),waktu,112) BETWEEN '$date1' AND '$date2' AND deleted = 1 AND user_id = $user_id ORDER BY waktu               
                ";
        return $this->db->query($sql)->result_array();
    }
    public function getAllKegiatanByDate($date1, $date2)
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.kunjungan A
	            INNER JOIN SIMRS_ACT.dbo.[user] B ON B.id = A.user_id
                WHERE CONVERT(VARCHAR(8),waktu,112) BETWEEN '$date1' AND '$date2' AND deleted = 0 
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
        $data['user'] = $this->db->query($sql)->result_array();
        $sql2 = "SELECT * FROM SIMRS_ACT.dbo.[kunjungan]
                WHERE CONVERT(VARCHAR(8),waktu,112) BETWEEN '$date1' AND '$date2' AND partner like '%,$user%' AND deleted = 0 
                ORDER BY waktu            
                ";
        $data['partner'] = $this->db->query($sql2)->result_array();
        return $data;
    }
    public function getKegiatanSelesai($date1, $date2)
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.[kunjungan]
                WHERE CONVERT(VARCHAR(8),waktu,112) BETWEEN '$date1' AND '$date2' AND status = 1 AND deleted = 0 
                ORDER BY waktu            
                ";
        return $this->db->query($sql)->result_array();
    }
    public function getKegiatanBelumSelesai($date1, $date2)
    {
        $sql = "SELECT * FROM SIMRS_ACT.dbo.[kunjungan]
                WHERE CONVERT(VARCHAR(8),waktu,112) BETWEEN '$date1' AND '$date2' AND status = 0 AND deleted = 0 
                ORDER BY waktu            
                ";
        return $this->db->query($sql)->result_array();
    }
    public function getJumlahByUnit($date1, $date2, $unit)
    {
        $sql = "SELECT
                    jumlah = COUNT ( U.sub_unit ) 
                FROM
                    [SIMRS_ACT].[dbo].[kunjungan] K
                    INNER JOIN [SIMRS_ACT].[dbo].[m_unit] U ON U.id = K.unit_id 
                WHERE
                    CONVERT ( VARCHAR ( 8 ), waktu, 112 ) BETWEEN '$date1' 
                    AND '$date2' 
                    AND U.sub_unit = '$unit'
                    AND deleted = 0
                    ";
        $jml = $this->db->query($sql)->row_array();

        $data = [
            'unit' => $unit,
            'jml' => $jml
        ];

        return $data;
    }
    public function getKegiatanByJenisMasalah($date1, $date2)
    {
        $sql1 = "SELECT masalah, id from [SIMRS_ACT].[dbo].[jenis_masalah]";
        $m = $this->db->query($sql1)->result_array();
        foreach ($m as $m) {
            $m_id = $m['id'];
            $sql = "SELECT
                        jm = count(U.masalah)
                    FROM
                        [SIMRS_ACT].[dbo].[kunjungan] K
                        INNER JOIN [SIMRS_ACT].[dbo].[jenis_masalah] U ON U.id = K.masalah_id
                    WHERE
                        CONVERT ( VARCHAR ( 8 ), waktu, 112 ) BETWEEN '$date1' 
                        AND '$date2' 
                        AND deleted = 0
                        AND K.masalah_id = $m_id
                    ";
            $c = $this->db->query($sql)->row_array();
            $data[] = [
                'm' => $m['masalah'],
                'jm' => $c['jm']
            ];
        }
        return $data;
    }
}
