<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_send_email extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'User_m'
            ));
    }

    /**
     * Kirim email dengan SMTP Gmail.
     *
     */
    public function index()
    {
        $email = $this->User_m->send_verifikasi_link('teguhfitrianto79@gmail.com','aaaaaaaaa');
        if ($email == '1') {
            $this->session->set_flashdata('success', 'Berhasil Kirim Email');
        }else{
            $this->session->set_flashdata('error', 'Berhasil Kirim Email');
        }
        redirect('user/login');
    }

    // public function index()
    // {
    //   // Konfigurasi email
    //     $config = [
    //         'mailtype'  => 'html',
    //         'charset'   => 'utf-8',
    //         'protocol'  => 'smtp',
    //         'smtp_host' => 'mail.owlcats.com',
    //         'smtp_user' => 'teguh.fitrianto@owlcats.com',  // Email gmail
    //         'smtp_pass'   => 'bhasyinsey166',  // Password gmail
    //         'smtp_crypto' => 'ssl',
    //         'smtp_port'   => 465,
    //         'crlf'    => "\r\n",
    //         'newline' => "\r\n"
    //     ];

    //     // Load library email dan konfigurasinya
    //     $this->load->library('email', $config);

    //     // Email dan nama pengirim
    //     $this->email->from('teguh.fitrianto@owlcats.com', 'owlcats.com');

    //     // Email penerima
    //     $this->email->to('teguhfitrianto79@gmail.com'); // Ganti dengan email tujuan

    //     // Lampiran email, isi dengan url/path file
    //     // $this->email->attach('https://images.pexels.com/photos/169573/pexels-photo-169573.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');

    //     // Subject email
    //     $this->email->subject('Kirim Email dengan SMTP Gmail CodeIgniter | owlcats.com');

    //     // Isi email
    //     $this->email->message("Ini adalah contoh email yang dikirim menggunakan SMTP Gmail pada CodeIgniter.<br><br> Klik <strong><a href='https://masrud.com/kirim-email-smtp-gmail-codeigniter/' target='_blank' rel='noopener'>disini</a></strong> untuk melihat tutorialnya.");
    //     $this->email->message("Ini adalah contoh email yang dikirim menggunakan SMTP Gmail pada CodeIgniter.<br><br> Klik <strong><a href='https://masrud.com/kirim-email-smtp-gmail-codeigniter/' target='_blank' rel='noopener'>disini</a></strong> untuk melihat tutorialnya.");

    //     // Tampilkan pesan sukses atau error
    //     if ($this->email->send()) {
    //         echo 'Sukses! email berhasil dikirim.';
    //     } else {
    //         echo 'Error! email tidak dapat dikirim.';
    //     }
    // }
}