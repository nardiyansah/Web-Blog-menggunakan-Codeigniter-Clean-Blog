<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Blog_model');

        if(isset($_SESSION)){
            
        }else{
            $_SESSION['status'] == 'logout';
        }        
    }
    
    public function index($offset = 0)
    {
        $this->load->library('pagination');

        $config['base_url'] = site_url('blog/index/');
        $config['total_rows'] = $this->Blog_model->getTotalBlogs();
        $config['per_page'] = 3;

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();

        if($this->input->get()){
            if($_GET['find']==''){
                $data['blogs'] = $this->Blog_model->getBlog($config['per_page'], $offset);
            }else{
                $data['blogs'] = $this->Blog_model->getFilterBlog($_GET['find'], $config['per_page'], $offset);
            }
        }else{
            $data['blogs'] = $this->Blog_model->getBlog($config['per_page'], $offset);
        }
        $this->load->view('templates/header');
        $this->load->view('blog', $data);
        $this->load->view('templates/footer');
    }

    public function detail($url)
    {
        $data['blog'] = $this->Blog_model->getSingleBlog('url', $url);

        $this->load->view('templates/header');
        $this->load->view('detail', $data);
        $this->load->view('templates/footer');
    }

    public function add(){
        if(isset($_SESSION)){
            if($_SESSION['status'] == 'login'){

            }else{
                redirect(base_url());
            }
        }else{
            redirect(base_url());
        }
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required|alpha_dash');
        $this->form_validation->set_rules('content', 'Content', 'required');
        
        if($this->form_validation->run())
        {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('cover'))
                {
                    echo $this->upload->display_errors();
                    exit;
                }
                else
                {
                    $data['cover'] = $this->upload->data()['file_name'];
                }

            $data['title'] = $this->input->post('title');
            $data['content'] = $this->input->post('content');
            $data['url'] = $this->input->post('url');
            $id = $this->Blog_model->insertBlog($data);

            if($id){
                $this->session->set_flashdata('message','<div class="alert alert-success">Data berhasil ditambahkan</div>');
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-warning">Data tidak berhasil ditambahkan</div>');
            }
            
        }
        $this->load->view('templates/header');
        $this->load->view('form_add');
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        if(isset($_SESSION)){
            if($_SESSION['status'] == 'login'){

            }else{
                redirect(base_url());
            }
        }else{
            redirect(base_url());
        }
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required|alpha_dash');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if($this->form_validation->run())
        {
            if($_FILES['cover']['name'] == '' | $_FILES['cover']['name'] == null){
                
            }else{
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('cover'))
                {
                    echo $this->upload->display_errors();
                    exit;
                }
                else
                {
                    $data['cover'] = $this->upload->data()['file_name'];
                }
            }
            $data['title'] = $this->input->post('title');
            $data['content'] = $this->input->post('content');
            $data['url'] = $this->input->post('url');
            $ide = $this->Blog_model->updateBlog($id, $data);

            if($ide){
                $this->session->set_flashdata('message','<div class="alert alert-success">Data berhasil diubah</div>');
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-warning">Data tidak berhasil diubah</div>');
            }
            
        }

        $update['update'] = $this->Blog_model->getSingleBlog('id', $id);
        $update['id'] = $id;
        $this->load->view('templates/header');
        $this->load->view('form_edit', $update);
        $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        if(isset($_SESSION)){
            if($_SESSION['status'] == 'login'){

            }else{
                redirect(base_url());
            }
        }else{
            redirect(base_url());
        }
        $this->Blog_model->deleteBlog($id);
        redirect(base_url());
    }

    public function login()
    {
        if($this->input->post()){
            if($_POST['username'] == 'admin' && $_POST['password'] == 'admin'){
                $_SESSION['status'] = 'login';
                redirect(base_url());
            }else{
                $_SESSION['status'] = 'logout';
                $this->session->set_flashdata('message', '<div class="alert alert-warning">Username/Password tidak valid</div>');
                redirect(site_url('blog/login'));
            }
        }else{
            $_SESSION['status'] = 'logout';
        }
        $this->load->view('templates/header');
        $this->load->view('login');
        $this->load->view('templates/footer');
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(
        site_url('blog/login')
        );
    }
}

/* End of file Blog.php */
