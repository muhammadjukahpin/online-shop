<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member_model extends CI_Model
{
    public function addItem()
    {
        $name = htmlspecialchars($this->input->post('name', true));
        $email = htmlspecialchars($this->input->post('email', true));
        $no = htmlspecialchars($this->input->post('no_hp', true));
        $no_hp = "62" . $no;
        $category = htmlspecialchars($this->input->post('category', true));
        $name_item = htmlspecialchars($this->input->post('name_item', true));
        $price = htmlspecialchars($this->input->post('price', true));
        $description = htmlspecialchars($this->input->post('description', true));

        $upload_image = $_FILES['image']['name'];
        if ($upload_image) {
            $config['upload_path'] = './asset/img/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect('member/addItem');
            }
        } else {
            $this->session->set_flashdata('message', 'Image Filed is required!');
            redirect('member/addItem');
        }

        $data = [
            'email' => $email,
            'name' => $name,
            'no_hp' => $no_hp,
            'image' => $image,
            'category' => $category,
            'name_item' => $name_item,
            'price' => $price,
            'description' => $description
        ];

        $this->db->insert('user_shop', $data);
    }

    public function getItem()
    {
        $email = $this->session->userdata('email');
        return $this->db->get_where('user_shop', ['email' => $email])->result_array();
    }

    public function getItemById($id)
    {
        $email = $this->session->userdata('email');
        return $this->data = $this->db->get_where('user_shop', ['id' => $id, 'email' => $email])->row_array();
    }

    public function delItem($id)
    {
        $email = $this->session->userdata('email');
        $old_image = $this->data['image'];
        unlink(FCPATH . '/asset/img/' . $old_image);
        $this->db->delete('user_shop', ['id' => $id, 'email' => $email]);
        if ($this->db->affected_rows() < 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Item cannot delete!</div>');
            redirect('member');
        }
    }
    public function editItem()
    {
        $id = $this->input->post('id');
        if (!$id) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Item cannot edit!</div>');
            redirect('member');
        }

        $no = htmlspecialchars($this->input->post('no_hp', true));
        $no_hp = "62" . $no;
        $category = htmlspecialchars($this->input->post('category', true));
        $name_item = htmlspecialchars($this->input->post('name_item', true));
        $price = htmlspecialchars($this->input->post('price', true));
        $description = htmlspecialchars($this->input->post('description', true));

        $upload_image = $_FILES['image']['name'];
        if ($upload_image) {
            $config['upload_path'] = './asset/img/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $old_image = $this->data['image'];
                unlink(FCPATH . '/asset/img/' . $old_image);
                $image = $this->upload->data('file_name');
                $this->db->set('image', $image);
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect('member/editItem');
            }
        }

        $this->db->set('no_hp', $no_hp);
        $this->db->set('category', $category);
        $this->db->set('name_item', $name_item);
        $this->db->set('price', $price);
        $this->db->set('description', $description);
        $this->db->where('id', $id);
        $this->db->update('user_shop');
    }
}
