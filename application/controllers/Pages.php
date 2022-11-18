<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Pages extends CI_Controller
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
	public function index()
	{
		$data['title'] = "SIMRS WEB APP";
		$data['judul'] = "LIST KEGIATAN";
		$user = $this->master_models->getUser($this->session->userdata('phone'));
		$user_id = $user['id'];


		$date1 = $this->input->post('date1');
		$date2 = $this->input->post('date2');
		if (!$date1) {
			$date1 = date('Ymd', strtotime('today'));
		} else {
			$date1 = $this->_tgl($date1);
		}
		if (!$date2) {
			$date2 = date('Ymd', strtotime('today'));
			$this->Logs_models->logs('membuka data kegiatan', $this->tgl($date1), $this->tgl($date2));
		} else {
			$date2 = $this->_tgl($date2);
			$this->Logs_models->logs('Melakukan pencarian data kegiatan', $this->tgl($date1), $this->tgl($date2));
		}
		$data['date1'] = $this->tgl($date1);
		$data['date2'] = $this->tgl($date2);


		$data['kegiatan'] = $this->master_models->getAllKegiatanByUser($date1, $date2, $user_id);
		$data['masalah'] = $this->master_models->getAllMasalah();
		$data['subunit'] = $this->master_models->getAllSubUnit();

		$this->load->view('pages/layout/header', $data);
		$this->load->view('pages/layout/nav', $data);
		$this->load->view('pages/index', $data);
		$this->load->view('pages/layout/footer', $data);
	}
	public function tambahKegiatan()
	{
		$user = $this->master_models->getUser($this->session->userdata('phone'));
		$user_id = $user['id'];


		$this->form_validation->set_rules('unit', 'Unit', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->Logs_models->logs('Gagal menambahkan data kegiatan', '', '');
			$this->session->set_flashdata('message', '<div class="alert alert-danger text-white" role="alert">Unit kosong, Data tidak disimpan.</div>');
			redirect('pages');
		} else {
			$unit = $this->input->post('unit');
			$jp = $this->input->post('jp');
			$masalah = trim($this->input->post('masalah'));
			$penyelsaian = trim($this->input->post('penyelsaian'));
			$subunit = $this->master_models->getSubUnit($unit);

			$instalasi = $subunit['instalasi'];
			$unit_id = $subunit['id'];
			$data = [
				'waktu' => date('Y-m-d H:i:s'),
				'instalasi' => $instalasi,
				'unit_id' => $unit_id,
				'masalah_id' => $jp,
				'masalah' => $masalah,
				'penyelsaian' => $penyelsaian,
				'mengetahui' => '',
				'paraf' => '',
				'datecreated' => time(),
				'dateupdated' => time(),
				'user_id' => $user_id,
				'status' => 0,
				'deleted' => 0
			];
			$this->db->insert('kunjungan', $data);
			$this->Logs_models->logs('Berhasil menambahkan data kegiatan', $unit, '');
			$this->session->set_flashdata('message', '<div class="alert alert-success text-white" role="alert">Sukses disimpan.</div>');
			redirect('pages');
		}
	}
	public function paraf()
	{
		$data['title'] = "SIMRS WEB APP";
		$data['judul'] = "FORM PARAF";
		$user = $this->master_models->getUser($this->session->userdata('phone'));
		$user_id = $user['id'];
		$id = $this->input->get('id');
		$k = $this->db->get_where('kunjungan', ['id' => $id])->row_array();
		$data['kunjungan'] = $k;
		$this->Logs_models->logs('Membuka form paraf', '', $id);

		$this->load->view('pages/layout/header', $data);
		$this->load->view('pages/layout/nav', $data);
		$this->load->view('pages/kegiatan', $data);
		$this->load->view('pages/layout/footer', $data);
	}
	public function saveparaf()
	{
		$id = $this->input->post('id');
		$client = $this->input->post('client');

		$folderPath = FCPATH . "assets/img/ttd/";
		$image_parts = explode(";base64,", $_POST['signed']);
		$image_type_aux = explode("image/", $image_parts[0]);
		$image_type = $image_type_aux[1];
		$image_base64 = base64_decode($image_parts[1]);
		$filename = uniqid() . '.' . $image_type;
		$file = $folderPath . $filename;
		file_put_contents($file, $image_base64);

		$this->db->set('mengetahui', $client);
		$this->db->set('paraf', $filename);
		$this->db->set('status', 1);
		$this->db->set('dateupdated', time());
		$this->db->where('id', $id);
		$this->db->update('kunjungan');
		$this->Logs_models->logs('Menambahkan paraf', $client, $id);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-white" role="alert">Sukses berhasil di paraf.</div>');
		redirect('pages');
	}
	public function delete()
	{
		$id = $this->input->get('id');
		$this->db->set('deleted', 1);
		$this->db->set('dateupdated', time());
		$this->db->where('id', $id);
		$this->db->update('kunjungan');
		$this->Logs_models->logs('menghapus kegiatan', '', $id);
		$this->session->set_flashdata('message', '<div class="alert alert-info text-white" role="alert">Kegiatan berhasil dihapus.</div>');
		redirect('pages');
	}
	public function edit()
	{
		$data['title'] = "SIMRS WEB APP";
		$data['judul'] = "FORM EDIT";
		$user = $this->master_models->getUser($this->session->userdata('phone'));
		$user_id = $user['id'];
		$id = $this->input->get('id');
		$k = $this->db->get_where('kunjungan', ['id' => $id])->row_array();
		$data['kunjungan'] = $k;

		$data['masalah'] = $this->master_models->getAllMasalah();
		$data['subunit'] = $this->master_models->getAllSubUnit();
		$this->Logs_models->logs('membuka form edit', '', $id);
		$this->load->view('pages/layout/header', $data);
		$this->load->view('pages/layout/nav', $data);
		$this->load->view('pages/editkegiatan', $data);
		$this->load->view('pages/layout/footer', $data);
	}
	public function prosesEdit()
	{
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$unit = $this->input->post('unit');
		$subunit = $this->master_models->getSubUnit($unit);
		$instalasi = $subunit['instalasi'];
		$unit_id = $subunit['id'];
		$this->db->set('instalasi', $instalasi);
		$this->db->set('unit_id', $unit_id);
		$masalah_id = $this->input->post('jp');
		$this->db->set('masalah_id', $masalah_id);
		$masalah = trim($this->input->post('masalah'));
		$this->db->set('masalah', $masalah);
		$penyelsaian = trim($this->input->post('penyelsaian'));
		$this->db->set('penyelsaian', $penyelsaian);
		$mengetahui = $this->input->post('client');
		$this->db->set('mengetahui', $mengetahui);
		$mengetahui = $this->input->post('client');
		$this->db->set('mengetahui', $mengetahui);

		$folderPath = FCPATH . "assets/img/ttd/";
		$image_parts = explode(";base64,", $_POST['signed']);
		$image_type_aux = explode("image/", $image_parts[0]);
		$image_type = $image_type_aux[1];
		$image_base64 = base64_decode($image_parts[1]);
		$filename = uniqid() . '.' . $image_type;
		$file = $folderPath . $filename;
		file_put_contents($file, $image_base64);
		// $this->db->set('paraf', $filename);

		$this->db->set('dateupdated', time());
		if ($image_type == 'png') {
			$this->db->set('status', 1);
			$this->db->set('paraf', $filename);
		}

		$this->db->update('kunjungan');
		$this->Logs_models->logs('mengubah data kegiatan', '', $id);
		$this->session->set_flashdata('message', '<div class="alert alert-info text-white" role="alert">Kegiatan berhasil diedit.</div>');
		redirect('pages');
	}
	public function lihatKunjungan()
	{
		$id = $this->input->get('id');
		$data['title'] = "SIMRS WEB APP";
		$data['judul'] = "Detil Kegiatan";
		$user = $this->master_models->getUser($this->session->userdata('phone'));
		$user_id = $user['id'];

		$data['k'] = $this->master_models->getKegiatanById($id);
		$this->Logs_models->logs('Melihat detil kegiatan', '', $id);

		$this->load->view('pages/layout/header', $data);
		$this->load->view('pages/layout/nav', $data);
		$this->load->view('pages/lihat', $data);
		$this->load->view('pages/layout/footer', $data);
	}
}
