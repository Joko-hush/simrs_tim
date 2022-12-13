<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Meeting extends CI_Controller
{
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
        $data['judul'] = "Jadwal Acara";
        $device = $this->device();
        $data['device'] = $device;
        $date1 = date('Ymd', strtotime('first day of this month'));
        $date2 = date('Ymd', strtotime('last day of this month'));

        $this->form_validation->set_rules('unit', 'UNIT', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['kunjungan'] = [];
        } else {
            $date1 = $this->_tgl($this->input->post('date1'));
            $date2 = $this->_tgl($this->input->post('date2'));
            $kd = $this->input->post('unit');
        }
        $data['date1'] = $this->tgl($date1);
        $data['date2'] = $this->tgl($date2);
        $pertemuan = $this->Meeting_models->getMeetingByDate($date1, $date2);
        $data['meeting'] = $pertemuan;

        $this->load->view('pages/layout/header', $data);
        $this->load->view('pages/layout/nav', $data);
        $this->load->view('pages/meeting', $data);
        $this->load->view('pages/layout/footer', $data);
    }
    public function detail()
    {
        $data['title'] = "SIMRS WEB APP";
        $data['judul'] = "Jadwal Acara";
        $device = $this->device();
        $data['device'] = $device;
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $m = $this->db->get('pertemuan')->row_array();
        $data['m'] = $m;

        $this->load->view('pages/layout/header', $data);
        $this->load->view('pages/layout/nav', $data);
        $this->load->view('pages/detailmeeting', $data);
        $this->load->view('pages/layout/footer', $data);
    }
    public function save()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('tgl', 'Tanggal', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-white" role="alert">Gagal tersimpan.</div>');
            redirect('meeting');
        } else {

            $nama = $this->input->post('nama');
            $qr = $this->input->post('nama') . '.png';
            $now = time();
            $data = [
                'nama' => $nama,
                'tgl' => $this->input->post('tgl'),
                'created_at' => $now,
                'updated_at' => $now,
                'deleted' => 0,
                'deleted' => 0,
                'mulai' => $this->input->post('mulai'),
                'selesai' => $this->input->post('akhir'),
                'qr' => $qr
            ];
            $this->db->insert('pertemuan', $data);
            $sql = "SELECT id FROM SIMRS_ACT.dbo.pertemuan WHERE nama = '$nama' AND created_at = '$now' ";
            $p = $this->db->query($sql)->row_array();
            $this->Meeting_models->createqr($qr, $p['id']);
            $this->session->set_flashdata('message', '<div class="alert alert-success text-white" role="alert">Berhasil Disimpan</div>');
            redirect('meeting');
        }
    }

    public function device()
    {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        $device = "";
        if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
            $device = "Mobile";
        } else {
            $device = "PC/Laptop";
        }
        return $device;
    }
    public function daftarHadir()
    {

        $data['title'] = "SIMRS WEB APP";
        $data['judul'] = "Jadwal Acara";
        $device = $this->device();
        $data['device'] = $device;
        $id = $this->input->get('id');
        $this->db->where('pertemuan_id', $id);
        $m = $this->db->get('peserta')->result_array();
        $data['daftarhadir'] = $m;

        $this->load->view('pages/layout/header', $data);
        $this->load->view('pages/layout/nav', $data);
        $this->load->view('pages/daftarhadir', $data);
        $this->load->view('pages/layout/footer', $data);
    }
}
