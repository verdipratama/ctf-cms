<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('front_model', 'front');
    }

    public function index()
    {
        $this->load->library('pagination');
        $page   = $this->input->get('per_page');
        $config = [
            'allow_get_array'   => true,
            'page_query_string' => true,
            'base_url'          => base_url("users"),
            'total_rows'        => $this->front->countUsers(),
            'per_page'          => 100,
            'use_page_numbers'  => false,
            'full_tag_open'     => '<ul class="pagination">',
            'full_tag_close'    => '</ul>',
            'attributes'        => ['class' => 'page-link'],
            'first_link'        => false,
            'last_link'         => false,
            'first_tag_open'    => '<li class="page-item">',
            'first_tag_close'   => '</li>',
            'prev_link'         => '&laquo',
            'prev_tag_open'     => '<li class="page-item">',
            'prev_tag_close'    => '</li>',
            'next_link'         => '&raquo',
            'next_tag_open'     => '<li class="page-item">',
            'next_tag_close'    => '</li>',
            'last_tag_open'     => '<li class="page-item">',
            'last_tag_close'    => '</li>',
            'cur_tag_open'      => '<li class="page-item active" aria-current="page"><a class="page-link" href="javascript:void(0)"> ',
            'cur_tag_close'     => '<span class="sr-only">(current)</span></a></li>',
            'num_tag_open'      => '<li class="page-item">',
            'num_tag_close'     => '</li>',
        ];

        $this->pagination->initialize($config);

        $data['users'] = $this->front->users_list(100, $page)->result();
        frontEnd_view('users_list', $data);
    }

    public function settings()
    {
        if (is_login(false)) {
            if ($this->input->post()) {
                $this->db->update("users", [
                    'name' => preg_replace("/[^a-zA-Z]/", "", _POST('name')),
                    'bio'  => _POST('bio'),
                ], ['id' => $this->session->userdata('id_login')]);
                $this->session->set_flashdata('success', 'Berhasil update account.');
                redirect(base_url("users/settings"));
            } else {
                $data['row']           = $this->db->select("users.*,(points - points_hint) as points_asli")->where(['id' => $this->session->userdata('id_login')])->get("users")->row();
                $data['galleryavatar'] = array_diff(scandir("./public/storage/avatar/default/"), array('.', '..'));
                frontEnd_view("users_settings", $data);
            }
        } else {
            redirect(base_url());
        }
    }

    public function change_password()
    {
        if (is_login(false)) {
            if ($this->input->post()) {
                $old_password = $this->input->post('old_password');
                $new_password = password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);
                $row          = $this->db->get_where('users', ['id' => $this->session->userdata('id_login')])->row();
                if (password_verify($old_password, $row->password)) {
                    $this->db->update('users', ['password' => $new_password], ['id' => $this->session->userdata('id_login')]);
                    setcookie('velixs_id', $row->id, time() + (10 * 365 * 24 * 60 * 60), '/');
                    setcookie('velixs_token', hash('ripemd160', $new_password), time() + (10 * 365 * 24 * 60 * 60), '/');
                    $this->session->set_flashdata('success', 'Berhasil update password.');
                    echo 'berhasil';
                } else {
                    echo 'Password Salah!';
                }
            } else {
                echo 'mau ngapain';
            }
        } else {
            echo 'Sessi anda hilang.';
        }
    }

    public function change_username()
    {
        if (is_login(false)) {
            if ($this->input->post()) {
                $new_username = sluggenerate($this->input->post('new_username'));
                if ($this->db->get_where('users', ['username' => $new_username])->num_rows() == 0) {
                    $this->db->update('users', ['username' => $new_username], ['id' => $this->session->userdata('id_login')]);
                    $this->session->set_flashdata('success', 'Berhasil update username.');
                    echo 'berhasil';
                } else {
                    echo 'Username sudah di gunakan akun lain';
                }
            } else {
                echo 'Ngapain goblok';
            }
        } else {
            echo 'Sesi Anda Hilang';
        }
    }

    public function change_email()
    {
        if (is_login(false)) {
            if ($this->input->post()) {
                $new_email = $this->input->post('new_email');
                $password  = $this->input->post('password');
                $user      = $this->db->get_where('users', ['id' => $this->session->userdata('id_login')])->row();
                if (password_verify($password, $user->password)) {
                    if ($this->db->get_where('users', ['email' => $new_email])->num_rows() == 0) {
                        $this->db->update('users', ['email' => $new_email], ['id' => $this->session->userdata('id_login')]);
                        $this->session->set_flashdata('success', 'Berhasil update Email.');
                        echo 'berhasil';
                    } else {
                        echo 'Email sudah di gunakan akun lain';
                    }
                } else {
                    echo 'Password Salah!';
                }
            } else {
                echo 'Ngapain goblok';
            }
        } else {
            echo 'Sesi Anda Hilang';
        }
    }

    public function change_avatar()
    {
        if (is_login(false)) {
            if ($this->input->post()) {
                $avatar = $this->input->post('avatar');
                $this->db->update('users', ['avatar' => $avatar], ['id' => $this->session->userdata('id_login')]);
                $this->session->set_flashdata('success', 'Berhasil update Avatar.');
                echo 'berhasil';
            } else {
                echo 'Ngapain gblk';
            }
        } else {
            echo 'Sesi Anda hilang.';
        }
    }

    public function upload_avatar()
    {
        if (is_login(false)) {
            if ($this->input->post('image')) {
                $data          = $_POST["image"];
                $image_array_1 = explode(";", $data);
                $image_array_2 = explode(",", $image_array_1[1]);
                $data          = base64_decode($image_array_2[1]);
                $filename      = uniqid(rand(), true) . '.jpg';
                $this->db->update('users', ['avatar' => $filename], ['id' => $this->session->userdata('id_login')]);
                $imageName = "./public/storage/avatar/$filename";
                file_put_contents($imageName, $data);
                echo $this->input->post('image');
            } else {
                echo 'kesalahan';
            }
        } else {
            echo 'notlogin';
        }
    }

    public function get_users()
    {
        $username = $this->uri->segment(2);
        $query    = $this->db->select("users.*,(points - points_hint) as points_asli")->where(['username' => $username])->get("users");
        if ($query->num_rows() != 0) {
            $row             = $query->row();
            $data['row']     = $row;
            $getsolved       = $this->front->statisticCategorySolved($row->id);
            $category_solved = '';
            $count_solved    = '';
            $random_color    = '';
            foreach ($getsolved->result() as $r) {
                if ($category_solved == '') {
                    $category_solved = "'$r->titlecate'";
                } else {
                    $category_solved = "$category_solved,'$r->titlecate'";
                }
            }
            foreach ($getsolved->result() as $c) {
                if ($count_solved == '') {
                    $count_solved = $c->jumlah;
                } else {
                    $count_solved = "$count_solved,$r->jumlah";
                }
            }
            foreach ($getsolved->result() as $c) {
                if ($random_color == '') {
                    $random_color = sprintf("#%06x", rand(0, 16777215));
                } else {
                    $random_color = "'$random_color'," . "'" . sprintf("#%06x", rand(0, 16777215)) . "'";
                }
            }
            $data['category_solved']  = $category_solved;
            $data['count_solved']     = $count_solved;
            $data['random_color']     = $random_color;
            $data['list_challSolved'] = $this->front->getChallSolved($row->id);
            frontEnd_view('users_view', $data);
        } else {
            echo 'Users tidak di temukan';
        }
    }

    // ajax ---------------------------------------------
    public function profile_header()
    {
        if (is_login()) {
            $user = $this->db->select("users.*,(points - points_hint) as points_asli")->where(['id' => $this->session->userdata('id_login')])->get("users")->row();
            if ($user->role == 'admin') {
                $jikaadmin = '<li><a href="' . base_url("admin") . '"><em class="icon uil-bolt-alt"></em><span>Admin Panel</span></a></li>';
            } else {
                $jikaadmin = '';
            }
            echo '<div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
      <div class="user-card">
          <div class="user-avatar">
              <img src="' . _storage("avatar/$user->avatar") . '" onerror="this.onerror=null;this.src=`' . _storage("avatar/default.jpg") . '`;">
          </div>
          <div class="user-info">
              <span class="lead-text">' . $user->name . '</span>
              <span class="sub-text">' . $user->email . '</span>
          </div>
          <div class="user-action">
              <a class="btn btn-icon mr-n2" href="' . base_url("users/settings") . '"><em class="icon ni ni-setting"></em></a>
          </div>
      </div>
      </div>
      <div class="dropdown-inner user-account-info">
          <h6 class="overline-title-alt">My Points</h6>
          <div class="user-balance">' . format_number($user->points_asli) . '</div>
          <div class="user-balance-sub">Hint <span>- ' . format_number($user->points_hint) . ' <span class="currency currency-usd">Points</span></span></div>
      </div>
      <div class="dropdown-inner">
          <ul class="link-list">
              ' . $jikaadmin . '
              <li><a href="' . base_url("users/$user->username") . '"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
              <li><a href="' . base_url("auth/logout") . '"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
          </ul>
      </div>';
        } else {
            echo '  <div class="dropdown-inner user-account-info text-center">
          <h6 class="overline-title-alt">Guest</h6>
          <a href="' . base_url("auth/login") . '" class="btn btn-sm btn-primary">login</a>
          <a href="' . base_url("auth/register") . '" class="btn btn-sm btn-dark">register</a>
      </div>';
        }
    }
}