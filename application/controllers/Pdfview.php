<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pdfview extends CI_Controller
{
    public function index()
    {
        $data['title_pdf'] = 'Laporan Penjualan Toko Kita';
        $file_pdf = 'laporan_penjualan_toko_kita';
        $paper = 'A4';
        $orientation = "portrait";
        $html = $this->load->view('laporan_pdf', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
