<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Challenge extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!is_admin()) {
            $this->session->set_flashdata("error", "Hanya untuk role admin");
            redirect(base_url());
        }
        $this->load->model("challenge_model", 'chall');
    }

    public function index()
    {
        $data = [
            'title' => 'Challenge List',
            'row'   => $this->chall->get_chall(),
        ];
        backEnd_view("challenge/list", $data);
    }

    public function create()
    {
        if ($this->input->post()) {
            $title       = $this->input->post('title');
            $description = $this->input->post('content');
            $flag        = $this->input->post('flag');
            $score       = $this->input->post('score');
            $category    = $this->input->post('category');
            $level       = $this->input->post('level');
            $status      = $this->input->post('status');
            $this->db->insert('chall_items', [
                'title'       => $title,
                'description' => $description,
                'flag'        => $flag,
                'score'       => $score,
                'category'    => $category,
                'author'      => $this->session->userdata("id_login"),
                'level'       => $level,
                'status'      => $status,
                'created_at'  => date("Y-m-d h:i:sa"),
            ]);
            $this->session->set_flashdata('success', 'Successfully added a new challenge.');
            redirect(base_url('admin/challenge'));
        } else {
            $data = [
                'title'    => 'Challenge Create',
                'category' => $this->db->get("chall_category")->result(),

            ];
            backEnd_view("challenge/create", $data);
        }
    }

    public function edit()
    {
        $id_chall = $this->uri->segment(4);
        if ($this->input->post()) {
            $title       = $this->input->post('title');
            $description = $this->input->post('content');
            $flag        = $this->input->post('flag');
            $score       = $this->input->post('score');
            $category    = $this->input->post('category');
            $level       = $this->input->post('level');
            $status      = $this->input->post('status');
            $this->db->update('chall_items', [
                'title'       => $title,
                'description' => $description,
                'flag'        => $flag,
                'score'       => $score,
                'category'    => $category,
                'author'      => $this->session->userdata("id_login"),
                'level'       => $level,
                'status'      => $status,
                'created_at'  => date("Y-m-d h:i:sa"),
            ], ['id' => $id_chall]);
            if ($this->input->post('save') == 'save') {
                $this->session->set_flashdata('success', 'Successfully update challenge.');
                redirect(base_url("admin/challenge/edit/$id_chall"));
            } else {
                $this->session->set_flashdata('success', 'Successfully update challenge.');
                redirect(base_url('admin/challenge'));
            }
        } else {
            $data = [
                'title'    => 'Challenge Edit',
                'row'      => $this->db->get_where("chall_items", ['id' => $id_chall])->row(),
                'category' => $this->db->get("chall_category")->result(),

            ];
            backEnd_view("challenge/edit", $data);
        }
    }

    public function delete()
    {
        $id = $this->uri->segment(4);
        $this->db->delete('chall_items', ['id' => $id]);
        $this->db->delete('chall_hint', ['id_chall' => $id]);
        $this->db->delete('chall_history', ['id_chall' => $id]);
        $this->session->set_flashdata("success", "Successfully cleared Challenge.");
        redirect(base_url("admin/challenge"));
    }

    public function hint_index()
    {
        $id_chall = $this->uri->segment(3);
        $chall    = $this->db->get_where("chall_items", ['id' => $id_chall]);
        if ($chall->num_rows() != 0) {
            $chall = $chall->row();
            $data  = [
                'title'    => "Hint For $chall->title",
                'row'      => $this->db->get_where("chall_hint", ['id_chall' => $id_chall])->result(),
                'id_chall' => $id_chall,
            ];
            backEnd_view("challenge/hint_list", $data);
        } else {
            redirect(base_url("admin/challenge"));
        }
    }

    public function hint_create()
    {
        $id_chall = $this->uri->segment(3);
        if ($this->input->post()) {
            $description = $this->input->post('content');
            $score       = $this->input->post('score');
            $this->db->insert('chall_hint', [
                'id_chall'    => $id_chall,
                'description' => $description,
                'points'      => $score,
                'created_at'  => date("Y-m-d h:i:sa"),
            ]);
            $this->session->set_flashdata('success', 'Successfully added a new hint.');
            redirect(base_url("admin/hint/$id_chall"));
        } else {
            $data = [
                'title' => 'Hint Create',
            ];
            backEnd_view("challenge/hint_create", $data);
        }
    }

    public function hint_edit()
    {
        $id_chall = $this->uri->segment(3);
        $id_hint  = $this->uri->segment(5);
        if ($this->input->post()) {
            $description = $this->input->post('content');
            $score       = $this->input->post('score');
            $this->db->update('chall_hint', [
                'id_chall'    => $id_chall,
                'description' => $description,
                'points'      => $score,
                'created_at'  => date("Y-m-d h:i:sa"),
            ], ['id' => $id_hint]);
            $this->session->set_flashdata('success', 'Successfully update hint.');
            redirect(base_url("admin/hint/$id_chall"));
        } else {
            $data = [
                'title' => 'Hint Edit',
                'row'   => $this->db->get_where("chall_hint", ['id' => $id_hint])->row(),
            ];
            backEnd_view("challenge/hint_edit", $data);
        }
    }

    public function hint_delete()
    {
        $id_chall = $this->uri->segment(3);
        $id       = $this->uri->segment(5);
        $this->db->delete('chall_hint', ['id' => $id]);
        $this->db->delete('hint_users', ['id_hint' => $id]);
        $this->session->set_flashdata("success", "Successfully cleared Hint.");
        redirect(base_url("admin/hint/$id_chall"));
    }

    public function cate_index()
    {
        if ($this->input->post()) {
            $title = $this->input->post('title');
            $icon  = $this->input->post('icon');
            $this->db->insert("chall_category", [
                'cate_icon'  => $icon,
                'cate_title' => $title,
                'cate_slug'  => sluggenerate($title),
                'created_at' => date("Y-m-d h:i:sa"),
            ]);
            $this->session->set_flashdata('success', 'Successfully added a new category.');
            redirect(base_url("admin/category"));
        } else {
            $data = [
                'title' => 'Category List',
                'row'   => $this->db->get_where("chall_category")->result(),
            ];
            backEnd_view("challenge/category_list", $data);
        }
    }

    public function cate_edit()
    {
        if ($this->input->post()) {
            if ($this->input->post('id')) {
                $id    = $this->input->post('id');
                $title = $this->input->post('title');
                $icon  = $this->input->post('icon');
                $slug  = $this->input->post('slug');
                $this->db->update("chall_category", [
                    'cate_icon'  => $icon,
                    'cate_title' => $title,
                    'cate_slug'  => sluggenerate($slug),
                    'created_at' => date("Y-m-d h:i:sa"),
                ], ['cate_id' => $id]);
                $this->session->set_flashdata('success', 'Successfully update category.');
                redirect(base_url("admin/category"));
            }
        } else {
            $id  = $this->uri->segment(4);
            $row = $this->db->get_where('chall_category', ['cate_id' => $id])->row();
            echo '	<input type="hidden" name="id" value="' . $row->cate_id . '">
			<div class="mb-1">
				<label for="exampleFormControlInput1" class="form-label">Icon</label>
				<input type="text" name="icon" value="' . $row->cate_icon . '" class="form-control" placeholder="uil-code" required>
			</div>
			<div class="mb-1">
				<label for="exampleFormControlInput1" class="form-label">Title Category</label>
				<input type="text" name="title" class="form-control" value="' . $row->cate_title . '" placeholder="Title" required>
			</div>
			<div class="mb-1">
				<label for="exampleFormControlInput1" class="form-label">Slug</label>
				<input type="text" name="slug" value="' . $row->cate_slug . '" class="form-control" placeholder="slug" required>
			</div>';
        }
    }

    public function cate_delete()
    {
        $id = $this->uri->segment(4);
        $this->db->delete("chall_category", ['cate_id' => $id]);
        $this->session->set_flashdata('success', 'Successfully delete category.');
        redirect(base_url("admin/category"));
    }
}