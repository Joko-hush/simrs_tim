<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Auth extends CI_Controller
{

    public function index()
    {
        $tlp = get_cookie('always');
        if (!$tlp) {
            $tlp = $this->session->userdata('phone');
        }
        $user = $this->db->get_where('user', ['tlp' => $tlp])->row_array();
        $user_ip = $this->ip_models->get_client_ip_2();
        if (!$user) {
            $this->form_validation->set_rules('user', 'user', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            if ($this->form_validation->run() == false) {
                $data['title'] = 'SIMRS WEB APP';
                $this->load->view('auth/login', $data);
            } else {
                $this->_login();
            }
        } else {
            $data = [
                'phone' => $user['tlp'],
                'user' => $user['user']
            ];
            $this->session->set_userdata($data);
            $this->Logs_models->logs('login', '', '');
            redirect('pages');
        }
    }
    public function reg()
    {
        $this->form_validation->set_rules('phone', 'phone', 'required|trim');
        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', ['matches' => 'Password not match!', 'min_length' => 'password too short!']);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $user_ip = $this->ip_models->get_client_ip_2();
        $id = password_hash('123456', PASSWORD_DEFAULT);
        var_dump($id);
        die;
        if ($this->form_validation->run() == false) {
            $data['title'] = 'SIMRS WEB APP';

            $this->load->view('auth/reg', $data);
        } else {
            $username = $this->input->post('username');
            $phone = $this->phone(trim($this->input->post('phone')));
            $password = $this->input->post('password1');
            $data = [
                'user' => $username,
                'tlp' => $phone,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'created_at' => time(),
                'updated_at' => time()
            ];
            $this->db->insert('user', $data);
            $this->db->where('tlp', $phone);
            $user = $this->db->get('user')->row_array();
            $user_id = $user['id'];
            $text = "No Hp Anda baru saja mendaftarkan di aplikasi simrs.\n Di https://rsdustira.co.id/simrs_tim/ dengan user $username.";
            $this->Wa_model->sendWa($phone, $text);

            $this->Logs_models->logs('registrasi', '', '');
            $this->session->set_flashdata('message', '<div class="alert alert-success text-white" role="alert">Selamat akun Anda sudah dibuat. Silahkan masuk</div>');
            redirect('auth');
        }
    }
    private function _login()
    {
        $user = $this->input->post('user');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['user' => $user])->row_array();
        if (!$user) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-white" role="alert">Nama user tidak terdaftar atau tidak sesuai.</div>');
            redirect('auth');
        } else {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'phone' => $user['tlp'],
                    'user' => $user['user']
                ];
                $user_ip = $this->ip_models->get_client_ip_2();
                $cookie = array(
                    'name'   => 'always',
                    'value'  => $user['tlp'],
                    'expire' => (60 * 60 * 24 * 365),
                    'secure' => TRUE
                );
                set_cookie($cookie);
                $this->session->set_userdata($data);
                $this->Logs_models->logs('login', '', '');
                redirect('pages');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-white" role="alert">Password dan Nama tidak sesuai.</div>');
                redirect('auth');
            }
        }
    }
    private function phone($phone)
    {
        $phone = explode(' ', $phone);
        $n = count($phone);
        for ($i = 0; $i < $n; $i++) {
            $phones[] = $phone[$i];
        }
        $phone = implode($phones);
        $phones = explode('-', $phone);
        $x = count($phones);
        if ($x > 1) {
            $phone = implode($phones);
        } else {
            $phone = $phone;
        }
        $cekplus = substr($phone, 0, 1);
        if ($cekplus == '+') {
            $tlp = substr($phone, 1, 13);
        } elseif ($cekplus == '0') {
            $tlp = '62' . substr($phone, 1, 13);
        } else {
            $tlp = $phone;
        }
        return $tlp;
    }
    public function logout()
    {
        $this->Logs_models->logs('Logout', '', '');
        delete_cookie('always');
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success text-white" role="alert">You have been logged out.</div>');
        redirect('auth');
    }
    public function ubahPassword()
    {
        $data['title'] = 'SIMRS WEB APP';
        $user_ip = $this->ip_models->get_client_ip_2();
        $this->form_validation->set_rules('oldPassword', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password Baru', 'required|trim|min_length[6]|matches[password2]', ['matches' => 'Password not match!', 'min_length' => 'password too short!']);
        $this->form_validation->set_rules('password2', 'Konfirmasi Password Baru', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/ubahPassword', $data);
        } else {
            $old = $this->input->post('oldPassword');
            $new = password_hash($this->input->post('newPassword'), PASSWORD_DEFAULT);
            $this->db->where('tlp', $this->session->userdata('phone'));
            $user = $this->db->get('user')->row_array();
            if (password_verify($old, $user['password'])) {
                $this->db->set('password', $new);
                $this->db->where('id', $user['id']);
                $this->db->update('user');
                $this->session->set_flashdata('message', '<div class="alert alert-success text-white" role="alert">Anda berhasil merubah password.</div>');
                redirect('auth/ubahPassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-white" role="alert">Password Lama tidak sesuai.</div>');
                redirect('auth/ubahPassword');
            }
        }
    }
}
