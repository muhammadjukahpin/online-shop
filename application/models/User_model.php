<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $data = [];
    public function getUser()
    {
        $email = $this->session->userdata('email');
        return $this->data = $this->db->get_where('users', ['email' => $email])->row_array();
    }

    public function editProfile()
    {
        $name = htmlspecialchars($this->input->post('name', true));
        $email = htmlspecialchars($this->input->post('email', true));

        $upload_image = $_FILES['image']['name'];
        if ($upload_image) {
            $config['upload_path'] = './asset/img/';
            $config['allowed_types'] = 'gif|jpeg|jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $old_image = $this->data['image'];
                if ($old_image != 'male.jpg' && $old_image != 'female.jpeg') {
                    unlink(FCPATH . '/property/img/' . $old_image);
                }

                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect('user/edit');
            }
        }

        $this->db->set('name', $name);
        $this->db->where('email', $email);
        $this->db->update('users');
    }

    public function changePassword()
    {
        $current_password = htmlspecialchars($this->input->post('current_password', true));
        $new_password = htmlspecialchars($this->input->post('new_password1', true));

        if (!password_verify($current_password, $this->data['password'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Current Password is wrong!</div>');
            redirect('user/changepassword');
        } else {
            if ($new_password == $current_password) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password does not be the same as current password!</div>');
                redirect('user/changepassword');
            } else {
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                $this->db->set('password', $password_hash);
                $this->db->where('email', $this->data['email']);
                $this->db->update('users');
            }
        }
    }

    public function getAddress()
    {
        $email = $this->session->userdata('email');
        return $this->db->get_where('user_address', ['email' => $email])->result_array();
    }

    public function getAddressById($id)
    {
        $email = $this->session->userdata('email');
        return $this->db->get_where('user_address', ['id' => $id, 'email' => $email])->row_array();
    }

    public function getAddressByDes()
    {
        $des = "First Address";
        $email = $this->session->userdata('email');
        return $this->db->get_where('user_address', ['email' => $email, 'description' => $des])->row_array();
    }


    public function addAddress()
    {
        $email = $this->input->post('email');
        $name = htmlspecialchars($this->input->post('name', true));
        $address = htmlspecialchars($this->input->post('address', true));
        $no_hp = htmlspecialchars($this->input->post('no_hp', true));
        $label = htmlspecialchars($this->input->post('label', true));
        $description = htmlspecialchars($this->input->post('description', true));

        $data = [
            'email' => $email,
            'name' => $name,
            'address' => $address,
            'no_hp' => $no_hp,
            'label' => $label,
            'description' => $description
        ];

        $this->db->insert('user_address', $data);
    }

    public function delAddress($id)
    {
        $email = $this->session->userdata('email');
        $this->db->delete('user_address', ['id' => $id, 'email' => $email]);
        if ($this->db->affected_rows() < 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Address cannot delete!</div>');
            redirect('user/address');
        }
    }

    public function editAddress()
    {
        $id = htmlspecialchars($this->input->post('id', true));
        if (!$id) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Address cannot edit!</div>');
            redirect('user/address');
        }
        $name = htmlspecialchars($this->input->post('name', true));
        $address = htmlspecialchars($this->input->post('address', true));
        $no_hp = htmlspecialchars($this->input->post('no_hp', true));
        $label = htmlspecialchars($this->input->post('label', true));
        $description = htmlspecialchars($this->input->post('description', true));

        $this->db->set('name', $name);
        $this->db->set('address', $address);
        $this->db->set('no_hp', $no_hp);
        $this->db->set('label', $label);
        $this->db->set('description', $description);
        $this->db->where('id', $id);
        $this->db->update('user_address');
    }

    public function item()
    {
        return $this->db->get('user_shop')->result_array();
    }

    public function getItemById($id)
    {
        return $this->db->get_where('user_shop', ['id' => $id])->row_array();
    }
}
