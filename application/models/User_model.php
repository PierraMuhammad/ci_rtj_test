<?php

class User_model extends CI_Model
{
    public function getAllUser()
    {
        return $this->db->select('Id_user, nama_user, user_name, role_id, created_user')->get('user')->result_array();
    }

    public function getUser($username)
    {
        return $this->db->select('Id_user, nama_user, user_name, role_id, created_user')->get_where('user', ['user_name' => $username])->row_array();
    }

    public function getUserById($id)
    {
        return $this->db->select('Id_user, nama_user, user_name, role_id, created_user')->get_where('user', ['Id_user' => $id])->row_array();
    }

    public function addNewUser()
    {
        $tanggal_waktu = new DateTime();
        $string_date_time = $tanggal_waktu->format('Y-m-d H:i:s');
        $data = [
            'nama_user' => htmlspecialchars($this->input->post('name', true)),
            'user_name' => htmlspecialchars($this->input->post('username', true)),
            'pass_user' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'role_id' => 2,
            'created_user' => $string_date_time,
            'updated_user' => $tanggal_waktu->getTimestamp()
        ];

        return $this->db->insert('user', $data);
    }

    public function updateUser()
    {
        $tanggal_waktu = new DateTime();
        $data = [
            'nama_user' => htmlspecialchars($this->input->post('name', true)),
            'user_name' => htmlspecialchars($this->input->post('username', true)),
            'role_id' => 2,
            'updated_user' => $tanggal_waktu->getTimestamp()
        ];

        return $this->db->where('Id_user', $this->input->post('id'))->update('user', $data);
    }

    public function updateUserByAPI($data_input)
    {
        $tanggal_waktu = new DateTime();
        $data = [
            'nama_user' => $data_input['name'],
            'user_name' => $data_input['username'],
            'role_id' => 2,
            'updated_user' => $tanggal_waktu->getTimestamp()
        ];

        return $this->db->where('Id_user', $data_input['id'])->update('user', $data);
    }

    public function deleteDataUser($id)
    {
        return $this->db->where('Id_user', $id)->delete('user');
    }
}
