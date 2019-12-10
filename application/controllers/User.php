<?php
defined('BASEPATH') or exit('No direct script access allowed');


class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('User_model', 'user');
        $this->load->model('Menu_model', 'menu');
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->user->getUser();
        $data['menu'] = $this->menu->menu();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->user->getUser();
        $data['menu'] = $this->menu->menu();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->user->editProfile();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile has edited!</div>');
            redirect('user');
        }
    }

    public function changepassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->user->getUser();
        $data['menu'] = $this->menu->menu();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[5]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Repeat Password', 'required|trim|matches[new_password1]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $this->user->changePassword();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has changed!</div>');
            redirect('user/changepassword');
        }
    }

    public function address()
    {
        $data['title'] = 'My Address';
        $data['user'] = $this->user->getUser();
        $data['menu'] = $this->menu->menu();
        $data['address'] = $this->user->getAddress();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/address', $data);
        $this->load->view('templates/footer');
    }

    public function addAddress()
    {
        $this->user->addAddress();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Address has Added!</div>');
        redirect('user/address');
    }

    public function delAddress($id)
    {
        $this->user->delAddress($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Address has deleted!</div>');
        redirect('user/address');
    }

    public function geteditAddress()
    {
        echo json_encode($this->user->getAddressById($_POST['id']));
    }

    public function editAddress($id)
    {

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');
        $this->form_validation->set_rules('label', 'Label', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Form Edit Address';
            $data['user'] = $this->user->getUser();
            $data['menu'] = $this->menu->menu();
            $data['address'] = $this->user->getAddressById($id);
            $data['label'] = ['Home', 'Office', 'Apartement', 'Hotel'];
            $data['description'] = ['First Address', 'Temporary Address'];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_address', $data);
            $this->load->view('templates/footer');
        } else {
            $this->user->editAddress();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Address has edited!</div>');
            redirect('user/address');
        }
    }

    public function shop()
    {
        $data['title'] = 'Shop';
        $data['user'] = $this->user->getUser();
        $data['menu'] = $this->menu->menu();
        $data['item'] = $this->user->item();
        $data['address'] = $this->user->getAddressByDes();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/shop', $data);
        $this->load->view('templates/footer');
    }

    public function getitem()
    {
        echo json_encode($this->user->getItemById($_POST['id']));
    }
}
