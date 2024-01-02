<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model');
    }

    public function index()
    {
        $data['title'] = 'RTJ - Admin';
        $data['user'] = $this->User_model->getUser($this->session->userdata('user_name'));
        $data['data_user'] = $this->User_model->getAllUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index');
        $this->load->view('templates/footer');
    }

    public function profile()
    {
        $data['title'] = 'RTJ - Profile Admin';
        $data['user'] = $this->User_model->getUser($this->session->userdata('user_name'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/profile');
        $this->load->view('templates/footer');
    }

    public function view_user($id)
    {
        $data['title'] = 'RTJ - View User';
        $data['user'] = $this->User_model->getUser($this->session->userdata('user_name'));
        $data['view_user'] = $this->User_model->getUserById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/view_user');
        $this->load->view('templates/footer');
    }

    public function edit_user($id)
    {
        $data['title'] = 'RTJ - Edit User';
        $data['user'] = $this->User_model->getUser($this->session->userdata('user_name'));
        $data['edit_user'] = $this->User_model->getUserById($id);

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.user_name]', [
            'is_unique' => 'this username has already register'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_user');
            $this->load->view('templates/footer');
        } else {
            if ($this->User_model->updateUser()) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Congratulations! a new user has been updated
                </div>');
                redirect('admin');
            }
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Failed to update User!
            </div>');
            redirect('admin/edit_user');
        }
    }

    public function add_user()
    {
        $data['title'] = 'RTJ - Add New User';
        $data['user'] = $this->User_model->getUser($this->session->userdata('user_name'));

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.user_name]', [
            'is_unique' => 'this username has already register'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'password cannot empty',
            'matches' => 'password dont match!',
            'min_length' => 'password to short'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/add_user');
            $this->load->view('templates/footer');
        } else {
            if ($this->User_model->addNewUser()) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Congratulations! a new user has been added
                </div>');
                redirect('admin');
            }
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Failed to add new User!
            </div>');
            redirect('admin/add_user');
        }
    }

    public function delete_user($id)
    {
        $this->User_model->deleteDataUser($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Success to delete User
        </div>');
        redirect('admin');
    }
}
