<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!is_admin()) {
            $this->session->set_flashdata("error", "Hanya untuk role admin");
            redirect(base_url());
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Users Manager',
            'users' => $this->db->get('users')->result(),
        ];
        backEnd_view('users/users_list', $data);
    }

    public function users_edit()
    {
        $id = $this->uri->segment(4);
        if ($this->input->post()) {
            $row         = $this->db->get_where('users', ['id' => $id])->row();
            $name        = $this->input->post('name');
            $username    = $this->input->post('username');
            $email       = $this->input->post('email');
            $password    = $this->input->post('password');
            $role        = $this->input->post('role');
            $points      = $this->input->post('points');
            $points_hint = $this->input->post('points_hint');
            $bio         = $this->input->post('bio');
            $status      = $this->input->post('status');
            if ($password == null) {
                $password = $row->password;
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
            }
            $img = uploadimg([
                'path'     => 'avatar',
                'name'     => 'avatar',
                'compress' => false,
            ]);
            if ($img['result'] == 'success') {
                $gambar = $img['nama_file'];
            } else {
                $gambar = $row->avatar;
            }
            $this->db->update('users', [
                'name'        => $name,
                'email'       => $email,
                'password'    => $password,
                'username'    => $username,
                'bio'         => $bio,
                'status'      => $status,
                'points'      => $points,
                'points_hint' => $points_hint,
                'avatar'      => $gambar,
                'role'        => $role,
            ], ['id' => $id]);
            $this->session->set_flashdata('success', 'Successfully updated users.');
            redirect(base_url('admin/users'));
        } else {
            $data = [
                'title' => 'Users Edit',
                'row'   => $this->db->get_where('users', ['id' => $id])->row(),
            ];
            backEnd_view('users/users_edit', $data);
        }
    }

    public function users_delete()
    {
        $id = $this->uri->segment(4);
        if ($id) {
            $this->db->delete('users', [
                'id' => $id,
            ]);
            $this->session->set_flashdata('success', 'Successfully delete users.');
            redirect(base_url('admin/users'));
        }
    }
}