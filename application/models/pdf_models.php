<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class pdf_models extends CI_Model
{
    public function createPdf($html, $title, $filename)
    {

        $data['title_pdf'] = $title;
        $file_pdf = $filename;
        $paper = 'A4';
        $orientation = "portrait";
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
