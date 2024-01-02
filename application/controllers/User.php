<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        $data['title'] = 'Welcome to Home Landing';

        if ($this->session->userdata('user_name')) {
            $data['user'] = $this->User_model->getUser($this->session->userdata('user_name'));
        }
        $this->load->view('home_landing', $data);
    }
}
