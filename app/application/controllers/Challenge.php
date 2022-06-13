<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Challenge extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("front_model", 'front');
    }

    public function index()
    {
        $data = [
            'category' => $this->db->select("*")->order_by('cate_id', 'DESC')->get('chall_category')->result(),
        ];
        frontEnd_view('challenge', $data);
    }

    //ajax-------------------------------------------------------

    public function get_chall()
    {
        $data = [
            'getChall' => $this->front->getAllChall($this->input->get('category'), $this->input->get('level'))->result(),
        ];
        ajax_loadview('ajax/load_chall', $data);
    }

    public function get_detail()
    {
        $query = $this->front->challDetail(urldecode(htmlspecialchars(str_replace("'", "", $this->uri->segment(4)))));
        if ($query->num_rows() == 1) {
            $row  = $query->row();
            $data = [
                'row'    => $row,
                'solved' => $this->front->getSolvedByChall($row->id),
            ];
            ajax_loadview('ajax/chall_detail', $data);
        } else {
            echo '<div class="text-center mt-5"><i class="ti-flag-alt-2" style="font-size: 60px;"></i><h4>Challenge 404</h4></div>';
        }
    }

    public function flag_submit()
    {
        if ($this->input->post()) {
            if (is_login(false)) {
                $flag     = $this->input->post('flag');
                $id_chall = $this->input->post('id_chall');
                if ($this->db->get_where('chall_history', ['id_chall' => $id_chall, 'id_users' => $this->session->userdata('id_login')])->num_rows() == 0) {
                    $query = $this->db->get_where('chall_items', ['id' => $id_chall]);
                    if ($query->num_rows() != 0) {
                        $row = $query->row();
                        if ($row->flag == $flag) {
                            $this->db->insert('chall_history', [
                                'id_chall'   => $id_chall,
                                'id_users'   => $this->session->userdata('id_login'),
                                'created_at' => date("Y-m-d h:i:sa"),
                            ]);
                            $users = $this->db->get_where('users', ['id' => $this->session->userdata('id_login')])->row();
                            $this->db->update('users', ['points' => ($row->score + $users->points)], ['id' => $this->session->userdata('id_login')]);
                            echo 'benar';
                        } else {
                            echo 'Flag Salah :(';
                        }
                    } else {
                        echo 'Challenge 404.';
                    }
                } else {
                    echo 'Chall Ini Sudah Solved.';
                }
            } else {
                echo 'ANDA HARUS LOGIN';
            }
        }
    }

    public function get_hint()
    {
        if (is_login(false)) {
            $id_hint = $this->uri->segment(4);
            $row     = $this->db->get_where('chall_hint', ['id' => $id_hint])->row();
            echo $row->description;
        }
    }

    public function use_hint()
    {
        if (is_login(false)) {
            $id_hint = $this->uri->segment(3);
            if ($this->db->get_where('hint_users', ['id_hint' => $id_hint, 'id_users' => $this->session->userdata('id_login')])->num_rows() == 0) {
                $row = $this->db->get_where('chall_hint', ['id' => $id_hint])->row();
                $this->db->insert("hint_users", [
                    'id_hint'    => $id_hint,
                    'id_users'   => $this->session->userdata('id_login'),
                    'created_at' => date("Y-m-d h:i:sa"),
                ]);
                $users = $this->db->get_where('users', ['id' => $this->session->userdata('id_login')])->row();
                $this->db->update('users', ['points_hint' => ($row->points + $users->points_hint)], ['id' => $this->session->userdata('id_login')]);
                echo 'done';
            }
        }
    }
}