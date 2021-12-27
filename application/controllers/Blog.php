<?php
class Blog extends CI_Controller
{
    function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('Blog_model');
        $this->load->helper('url');
    }
    public function index(){
        $data['blogs']=$this->Blog_model->getBlogs();
        $this->load->view('blogs', $data);
    }
    public function detail($url){
        $data['blogs']=$this->Blog_model->getSingleBlog('url', $url);
        $this->load->view('detail', $data);
    }
    public function add(){
        if($this->input->post())
        {
            $data['title']=$this->input->post('title');
            $data['content']=$this->input->post('content');
            $data['url']=$this->input->post('url');
        $id=$this->Blog_model->insertBlog($data);
        if($id)
            echo "Data berhasil disimpan";
        else
            echo "Data gagal disimpan";
        }
        $this->load->view('form_add');
    }
    public function edit($id){
        $data['blog']=$this->Blog_model->getSingleBlog('id',$id);
        if($this->input->post())
        {
            $post['title'] = $this->input->post('title');
            $post['content'] = $this->input->post('content');
            $post['url'] = $this->input->post('url');
            $id = $this->Blog_model->updateBlog($id, $post);
            if($id)
                echo "Data berhasil disimpan";
            else
                echo "Data gagal disimpan"; 
        }
        $this->load->view('form_edit',$data);        
    }
    public function delete($id){
        $this->Blog_model->deleteBlog($id);
        redirect();
    }
}
?>