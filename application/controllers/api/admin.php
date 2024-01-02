<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Admin extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    // get all user dan get user by id 
    public function index_get($id = 0)
    {
        $check_data = $this->User_model->getUserById($id);

        if ($id) {
            if ($check_data) {
                $this->response($check_data, RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Data cannot be found'
                ], RestController::HTTP_NOT_FOUND);
            }
        } else {
            $data = $this->User_model->getAllUser();

            $this->response($data, RestController::HTTP_OK);
        }
    }

    // add new user
    /*
    isian input:
    'name',
    'username'
    'password1'
    */
    public function index_post()
    {
        if ($this->User_model->addNewUser()) {
            $this->response([
                'status' => TRUE,
                'message' => 'Success add data to database'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Failed add data to database'
            ], 502);
        }
    }

    // update user
    /*
    isian input:
    'name',
    'username',
    'id

    usahakan format input adalah Form URL
    */
    public function index_put()
    {
        $data = [
            'name' => $this->put('name'),
            'username' => $this->put('username'),
            'id' => $this->put('id')
        ];

        if ($this->User_model->updateUserByAPI($data)) {
            $this->response($data, RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Failed add data to database'
            ], 502);
        }
    }

    // delete user
    /*
    isian input:
    'id

    usahakan format input adalah Form URL
    */
    public function index_delete()
    {
        $id = $this->delete('id');

        $check_data = $this->User_model->getUserById($id);

        if ($check_data) {
            if ($this->User_model->deleteDataUser($id)) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'Success delete user from database'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Failed delete user from database'
                ], 502);
            }
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'user can not been found'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
}
