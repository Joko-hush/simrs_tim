<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Absen extends CI_Controller
{
    public function index()
    {
        $data['title'] = "SIMRS WEB APP";
        $data['judul'] = "DAFTAR HADIR";
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $m = $this->db->get('pertemuan')->row_array();
        $data['m'] = $m;


        $this->load->view('pages/layout/header', $data);
        $this->load->view('pages/layout/nav', $data);
        $this->load->view('pages/hadir', $data);
        $this->load->view('pages/layout/footer', $data);
    }
    public function hadir()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('pangkat', 'Pangkat', 'trim|required');
        if ($this->form_validation->run() == false) {
            $id = $this->input->post('id');
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-white" role="alert">Data tidak lengkap. Gagal tersimpan. Silahkan diulangi.</div>');
            redirect("Absen/index?id=$id");
        } else {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $pangkat = $this->input->post('pangkat');
            $unit = $this->input->post('unit');
            $folderPath = FCPATH . "assets/img/ttd/";
            $image_parts = explode(";base64,", $_POST['signed']);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $filename = uniqid() . '.' . $image_type;
            $file = $folderPath . $filename;
            file_put_contents($file, $image_base64);
            $data = [
                'pertemuan_id' => $id,
                'nama' => $nama,
                'pangkat' => $pangkat,
                'bagian' => $unit,
                'ttd' => $filename,
                'created_at' => time(),
                'updated_at' => time()
            ];
            $this->db->insert('peserta', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success text-white" role="alert">Terimakasih, data kehadiran anda sudah tersimpan.</div>');
            redirect("Absen/index?id=$id");
        }
    }
}
