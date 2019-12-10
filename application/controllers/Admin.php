<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Menu_model', 'menu');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['users'] = $this->admin->user();
        $data['count_user'] = $this->admin->userCount();
        $data['user'] = $this->admin->getUser();
        $data['menu'] = $this->menu->menu();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function users()
    {
        $data['title'] = 'Users';
        $data['users'] = $this->admin->user();
        $data['count_user'] = $this->admin->userCount();
        $data['user'] = $this->admin->getUser();
        $data['menu'] = $this->menu->menu();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/users', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->admin->getUser();
        $data['role'] = $this->admin->role();
        $data['menu'] = $this->menu->menu();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function addRole()
    {
        $this->admin->addRole();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Role added!</div>');
        redirect('admin/role');
    }

    public function delRole($id)
    {
        $this->admin->delRole($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role has deleted!</div>');
        redirect('admin/role');
    }

    public function geteditRole()
    {
        echo json_encode($this->admin->getRoleById($_POST['id']));
    }

    public function editRole()
    {
        $this->admin->editRole($_POST['id']);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role has edited!</div>');
        redirect('admin/role');
    }

    public function roleAccess($id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->admin->getUser();
        $data['role'] = $this->admin->getRoleById($id);
        $data['menu'] = $this->menu->menu();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role_access', $data);
        $this->load->view('templates/footer');
    }

    public function changeaccess()
    {
        $roleId = $this->input->post('roleId');
        $menuId = $this->input->post('menuId');
        $this->admin->changeaccess($roleId, $menuId);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed</div>');
    }

    public function getGender()
    {
        $data = [];
        $data['male'] = $this->db->get_where('users', ['gender' => 'male'])->num_rows();
        $data['female'] = $this->db->get_where('users', ['gender' => 'female'])->num_rows();
        echo json_encode($data);
    }
}
