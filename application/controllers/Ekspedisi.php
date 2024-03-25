<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Ekspedisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['judul'] = 'Buku Ekspedisi';
        $data['title'] = "SIMRS WEB APP";
        $tlp = $this->session->userdata('phone');
        $user = $this->master_models->getUser($tlp);
        $user_id = $user['id'];
        $date1 = $this->input->post('date1');
        $date2 = $this->input->post('date2');
        $data['subunit'] = $this->master_models->getAllSubUnit();
        if (!$date1) {
            $date1 = date('Ymd', strtotime('today'));
            $date2 = $date1;
        }
        $data['date1'] = tgl($date1);
        $data['date2'] = tgl($date2);
        $ekspedisi = $this->ekspedisiModel->getByDate($date1, $date2);
        $data['ekspedisi'] = $ekspedisi;
        $this->load->view('pages/layout/header', $data);
        $this->load->view('pages/layout/nav', $data);
        $this->load->view('pages/ekspedisi', $data);
        $this->load->view('pages/layout/footer', $data);
    }
    public function tambah()
    {
        $user = $this->master_models->getUser($this->session->userdata('phone'));
        $user_id = $user['id'];

        $this->form_validation->set_rules('nomor', 'nomor', 'trim|required');
        $this->form_validation->set_rules('perihal', 'perihal', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->Logs_models->logs('Gagal menambahkan data kegiatan', '', '');
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-white" role="alert">Unit kosong, Data tidak disimpan.</div>');
            redirect('pages');
        } else {
            $unit = $this->input->post('unit');
            $nomor = $this->input->post('nomor');
            $perihal = $this->input->post('perihal');
            $data = [
                'nomor' => $nomor,
                'perihal' => $perihal,
                'user_id' => $user_id,
                'status' => 0,
                'created_at' => time(),
                'updated_at' => time(),
                'tanggal' => date('Y-m-d'),
                'deleted' => 0
            ];
            $this->ekspedisiModel->add($data);
            $this->Logs_models->logs('menyimpan ekspedisi ke ', $unit, '');
            $this->session->set_flashdata('message', '<div class="alert alert-success text-white" role="alert">Sukses disimpan.</div>');
            redirect('ekspedisi');
        }
    }
    public function paraf()
    {
        $data['title'] = "SIMRS WEB APP";
        $data['judul'] = "FORM PARAF";
        $user = $this->master_models->getUser($this->session->userdata('phone'));
        $user_id = $user['id'];
        $id = $this->input->get('id');
        $data['kdu'] = 'user';
        $k = $this->ekspedisiModel->getById($id);
        $data['kunjungan'] = $k;
        $this->Logs_models->logs('Membuka form paraf', '', $id);

        $this->load->view('pages/layout/header', $data);
        $this->load->view('pages/layout/nav', $data);
        $this->load->view('pages/parafEkspedisi', $data);
        $this->load->view('pages/layout/footer', $data);
    }
    public function saveparaf()
    {
        $id = $this->input->post('id');
        $kdu = $this->input->post('kdu');
        $this->form_validation->set_rules('client', 'Client', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-success text-white" role="alert">Tidak ada perubahan</div>');
            redirect('pages/paraf?id=$id');
        } else {
            // $id = $this->input->post('id');
            $client = $this->input->post('client');
            $folderPath = FCPATH . "assets/img/ttd/";
            $image_parts = explode(";base64,", $_POST['signed']);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            if ($image_type == '') {
                $this->db->set('penerima', $client);
                $this->db->set('status', 1);
                $this->db->set('updated_at', time());
                $this->db->where('id', $id);
                $this->db->update('ekspedisi');
                $this->Logs_models->logs('Menambahkan paraf', $client, $id);
                $this->session->set_flashdata('message', '<div class="alert alert-success text-white" role="alert">Sukses berhasil di paraf.</div>');
                if ($kdu == 'client') {
                    redirect('paraf');
                } else {
                    redirect('ekspedisi');
                }
            } else {
                $image_base64 = base64_decode($image_parts[1]);
                $filename = uniqid() . '.' . $image_type;
                $file = $folderPath . $filename;
                file_put_contents($file, $image_base64);
                $this->db->set('paraf', $filename);
                $this->db->set('penerima', $client);
                $this->db->set('status', 1);
                $this->db->set('updated_at', time());
                $this->db->where('id', $id);
                $this->db->update('ekspedisi');
                $this->Logs_models->logs('Menambahkan paraf', $client, $id);
                $this->session->set_flashdata('message', '<div class="alert alert-success text-white" role="alert">Sukses berhasil di paraf.</div>');
                if ($kdu == 'client') {
                    redirect('paraf');
                } else {
                    redirect('ekspedisi');
                }
            }
        }
    }
    public function delete()
    {
        $id = $this->input->get('id');
        $this->db->set('deleted', 1);
        $this->db->set('updated_at', time());
        $this->db->set('deleted_at', time());
        $this->db->where('id', $id);
        $this->db->update('ekspedisi');
        $this->Logs_models->logs('menghapus ekspedisi', '', $id);
        $this->session->set_flashdata('message', '<div class="alert alert-info text-white" role="alert">Kegiatan berhasil dihapus.</div>');
        redirect('ekspedisi');
    }
}
