<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Post extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
        //load model("model name","instance to refer postmodel in this controller. Call Ali as A")
        $this->load->model("postmodel","post");
    }
 
    //upload to database from view form
    function create()
    {
        if(@$_POST['create_post'])
        {
            $data = $_POST['post'];
            $data['post_date'] = date('Y-m-d H:i:s');
            //$this->instance of postmodel->function in postmodel
            $this->post->add($data);
            $this->session->set_flashdata('message',"Post created successfully");
            redirect("post");
        }
        $this->load->view("post/create");
    }

    //fetch all details from db
    function index()
    {
        $data['posts'] = $this->post->getAll();
        $this->load->view("post/index",$data);
    }

    //function to edit by get id from view
    function edit()
    {
        $id = $this->uri->segment(3);
        $post = $this->post->getById($id);
        if(!$post)
        {
            redirect("post");
        }
        if(@$_POST['update_post'])
        {
            $postdata = $_POST['post'];
            $this->post->update($postdata,$id);
            $this->session->set_flashdata('message',"Post updated successfully");
            redirect("post");
        }
        $data['post'] = $post;
        $this->load->view("post/edit",$data);
    }

    //function to delete
    function delete()
    {
        $id = $this->uri->segment(3);
        $this->post->delete($id);
        $this->session->set_flashdata('message',"Post deleted successfully");
        redirect("post");
    }
}