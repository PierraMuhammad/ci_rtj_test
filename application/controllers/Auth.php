<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validasi sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_model->getUser($username);

        if (!$user) {
            // user tidak ada dalam database
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Username is not registered!
            </div>');
            redirect('auth');
        }

        if (password_verify($password, $user['pass_user'])) {
            $data = [
                'user_name' => $user['user_name'],
                'role_id' => $user['role_id']
            ];
            $this->session->set_userdata($data);
            if ($user['role_id'] == 1) {
                redirect('admin');
            } else {
                redirect('user');
            }
        } else {
            // password salah
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong Password!
            </div>');
            redirect('auth');
        }
    }

    // tidak digunakan lagi karena beda studi kasus
    // public function register()
    // {
    //     $this->form_validation->set_rules('name', 'Name', 'required|trim');
    //     $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.user_name]', [
    //         'is_unique' => 'this username has already register'
    //     ]);
    //     $this->form_validation->set_rules('pass_user', 'Password', 'required|trim|min_length[3]|matches[pass_user2]', [
    //         'required' => 'password cannot empty',
    //         'matches' => 'password dont match!',
    //         'min_length' => 'password to short'
    //     ]);
    //     $this->form_validation->set_rules('pass_user2', 'Password', 'required|trim|matches[pass_user]');

    //     if ($this->form_validation->run() == false) {
    //         $data['title'] = 'User Registration';
    //         $this->load->view('templates/auth_header', $data);
    //         $this->load->view('auth/register');
    //         $this->load->view('templates/auth_footer');
    //     } else {
    //         $tanggal_waktu = new DateTime();
    //         $string_date_time = $tanggal_waktu->format('Y-m-d H:i:s');
    //         $data = [
    //             'nama_user' => htmlspecialchars($this->input->post('name', true)),
    //             'user_name' => htmlspecialchars($this->input->post('username', true)),
    //             'pass_user' => password_hash($this->input->post('pass_user'), PASSWORD_DEFAULT),
    //             'role_id' => 2,
    //             'created_user' => $string_date_time,
    //             'updated_user' => $tanggal_waktu->getTimestamp()
    //         ];

    //         $this->db->insert('user', $data);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //             Congratulation! your account has been created. Please Login
    //         </div>');
    //         redirect('auth');
    //     }
    // }

    public function logout()
    {
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You have been logout
        </div>');
        redirect('auth');
    }
}
