<?php
class Product extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $name = $this->input->post('name');
            $description = $this->input->post('description');
            $price = $this->input->post('price');
            $currency = $this->input->post('currency');
    
            // ---Handle image upload---
            $config['upload_path'] = './images/'; // here path to images directory
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 2048; // Maximum file size in KB
    
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
                $image_name = $upload_data['file_name'];
            } else {
                $image_name = ''; // If upload fails
            }
    
            $data = array(
                'name' => $name,
                'description' => $description,
                'image' => $image_name,
                'price' => $price,
                'currency' => $currency
            );
    
            $status =  $this->user_model->insertUser($data);
            if ($status == true) {
                $this->session->set_flashdata('success', 'Successfully Added');
                redirect(base_url('product/index'));
            } else {
                $this->session->set_flashdata('error', 'Error');
                $this->load->view('user/add_user');
            }
        } else {
            $this->load->view('user/add_user');
        }
    }

    function index()
    {
        $data['products'] = $this->user_model->getUsers();
        $this->load->view('user/index', $data);
    }
    

    function edit($id)
{
    $data['product'] = $this->user_model->getUser($id);
    $data['id'] = $id;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $price = $this->input->post('price');
        $currency = $this->input->post('currency');

        // Check if a new image is being uploaded
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './images/'; // Path to your images directory
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 2048; // Maximum file size in KB

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
                $image_name = $upload_data['file_name'];

                // Delete previous image if exists
                $prev_image = $data['product']->image;
                if (!empty($prev_image)) {
                    unlink('./images/' . $prev_image);
                }
            } else {
                // Handle upload error
                $this->session->set_flashdata('error', 'Image upload error: ' . $this->upload->display_errors());
                redirect(base_url('product/edit/' . $id));
            }
        } else {
            // No new image, keep the existing one
            $image_name = $data['product']->image;
        }

        $data = array(
            'name' => $name,
            'description' => $description,
            'image' => $image_name,
            'price' => $price,
            'currency' => $currency
        );

        $status = $this->user_model->updateUser($data, $id);
        if ($status == true) {
            $this->session->set_flashdata('success', 'Successfully Updated');
            redirect(base_url('product/index'));
        } else {
            $this->session->set_flashdata('error', 'Error');
            $this->load->view('user/edit_product');
        }
    }

    $this->load->view('user/edit_product', $data);
}


    function delete($id)
    {
        if(is_numeric($id))
        {
            $status =$this->user_model->deleteUser($id);
            if ($status == true) {
                $this->session->set_flashdata('deleted', 'successfully Deleted');
                redirect(base_url('product/index/'));
            } else {
                $this->session->set_flashdata('error', 'Error');
                redirect(base_url('product/index/'));
            }
        }
    }
}
