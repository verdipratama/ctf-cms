<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('front_model', 'front');
    }

    public function search_get()
    {
        if ($this->input->post()) {
            $query = $this->input->post('query');
            redirect(base_url("search/$query"));
        } else {
            show_404();
        }
    }

    public function search()
    {
        if ($this->uri->segment(2)) {
            $this->load->library('pagination');
            $page        = $this->uri->segment(3);
            $query       = $this->uri->segment(2);
            $websettings = $this->db->select('content_perpage')->where('id', 1)->get('websettings')->row();
            $config      = [
                'base_url'         => base_url("search/$query"),
                'total_rows'       => $this->front->getSearch($query),
                'per_page'         => $websettings->content_perpage,
                'use_page_numbers' => false,
                'full_tag_open'    => '<ul class="pagination justify-content-center">',
                'full_tag_close'   => '</ul>',
                'attributes'       => ['class' => 'page-link'],
                'first_link'       => false,
                'last_link'        => false,
                'first_tag_open'   => '<li class="page-item">',
                'first_tag_close'  => '</li>',
                'prev_link'        => '&laquo',
                'prev_tag_open'    => '<li class="page-item">',
                'prev_tag_close'   => '</li>',
                'next_link'        => '&raquo',
                'next_tag_open'    => '<li class="page-item">',
                'next_tag_close'   => '</li>',
                'last_tag_open'    => '<li class="page-item">',
                'last_tag_close'   => '</li>',
                'cur_tag_open'     => '<li class="page-item active"><a href="#" class="page-link">',
                'cur_tag_close'    => '<span class="sr-only"></span></a></li>',
                'num_tag_open'     => '<li class="page-item">',
                'num_tag_close'    => '</li>',
            ];
            $this->pagination->initialize($config);
            $data = [
                'title'       => 'Search',
                'row'         => $this->front->getContentSearch($websettings->content_perpage, $page, $query)->result(),
                'random_post' => $this->db->select("*")->order_by('id', 'RANDOM')->limit(3)->get('content_item')->result(),
            ];
            frontEnd_view('content_search', $data);
        } else {
            redirect(base_url());
        }
    }

    public function get_slug()
    {
        $slug         = _getSlug(1);
        $content_type = $this->db->get_where('content_type', ['type_slug' => $slug, 'type_status' => '1']);
        $site_pages   = $this->front->get_slug('site_pages', 'seo_slug', $slug, '1');
        $content_item = $this->front->get_slug('content_item', 'seo_slug', $slug, 'Publish');
        if ($content_type->num_rows() == 1) {
            $this->type_content($content_type);
        } else if ($site_pages->num_rows() == 1) {
            $this->site_pages($site_pages);
        } else if ($content_item->num_rows() == 1) {
            $this->content_item($content_item);
        } else {
            show_404();
        }
    }

    public function type_content($row)
    {
        $this->load->library('pagination');
        $row         = $row->row();
        $category_by = $this->uri->segment(2);
        $websettings = $this->db->select('content_perpage')->where('id', 1)->get('websettings')->row();
        $category_by = $this->db->get_where('content_category', ['c_slug' => $category_by]);
        if ($category_by->num_rows() == 1) {
            $category_by  = $category_by->row();
            $getAllByType = $this->front->getAllByType($row->id, $category_by->id);
            $result       = $this->front->getContentByType($websettings->content_perpage, ($this->uri->segment(3)), $row->id, $category_by->id)->result();
            $titles       = $category_by->c_title;
            $path_base    = base_url("$row->type_slug/$category_by->c_slug");
        } else {
            $result       = $this->front->getContentByType($websettings->content_perpage, ($this->uri->segment(2)), $row->id)->result();
            $getAllByType = $this->front->getAllByType($row->id);
            $titles       = '';
            $path_base    = base_url($row->type_slug);
        }
        $config = [
            'base_url'         => $path_base,
            'total_rows'       => $getAllByType,
            'per_page'         => $websettings->content_perpage,
            'use_page_numbers' => false,
            'full_tag_open'    => '<ul class="pagination justify-content-center">',
            'full_tag_close'   => '</ul>',
            'attributes'       => ['class' => 'page-link'],
            'first_link'       => false,
            'last_link'        => false,
            'first_tag_open'   => '<li class="page-item">',
            'first_tag_close'  => '</li>',
            'prev_link'        => '&laquo',
            'prev_tag_open'    => '<li class="page-item">',
            'prev_tag_close'   => '</li>',
            'next_link'        => '&raquo',
            'next_tag_open'    => '<li class="page-item">',
            'next_tag_close'   => '</li>',
            'last_tag_open'    => '<li class="page-item">',
            'last_tag_close'   => '</li>',
            'cur_tag_open'     => '<li class="page-item active"><a href="#" class="page-link">',
            'cur_tag_close'    => '<span class="sr-only"></span></a></li>',
            'num_tag_open'     => '<li class="page-item">',
            'num_tag_close'    => '</li>',
        ];
        $this->pagination->initialize($config);
        $data = [
            'title'       => $row->type_title . " - " . $titles,
            'type'        => $row,
            'row'         => $result,
            'category'    => $this->db->get_where('content_category', ['c_type' => $row->id])->result(),
            'random_post' => $this->db->select("*")->where('type', $row->id)->order_by('id', 'RANDOM')->limit(3)->get('content_item')->result(),
        ];
        hit_visit('content_type', $row->id);
        frontEnd_view('content_type', $data);
    }

    public function content_item($row)
    {
        $row   = $row->row();
        $query = $this->front->getDetailContent($row->seo_slug);
        if ($query->num_rows() == 1) {
            $this->load->helper("file");
            $data = [
                'title'       => $row->title,
                'row'         => $query->row(),
                'category'    => $this->db->get_where('content_category', ['c_type' => $row->type])->result(),
                'type'        => $this->db->get_where('content_type', ['id' => $row->type])->row(),
                'random_post' => $this->db->select("*")->where('type', $row->type)->order_by('id', 'RANDOM')->limit(3)->get('content_item')->result(),
                'get_gallery' => get_filenames("./public/storage/gallery/$row->id/"),
            ];
            hit_visit('content_item', $row->id);
            frontEnd_view('content_item', $data);
        } else {
            show_404();
        }
    }

    public function site_pages($row)
    {
        $row  = $row->row();
        $data = [
            'title'       => $row->title,
            'pagecontent' => $row->content,
            'row'         => $row,
        ];
        hit_visit('site_pages', $row->id);
        frontEnd_view('site_pages', $data);
    }
}