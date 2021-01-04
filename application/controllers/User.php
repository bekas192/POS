<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    function __construct(){
        parent:: __construct();
        check_not_login();
        check_admin();  
        $this->load->library('form_validation');
        $this->load->model('user_m');
    }
	
	public function index()
	{
        
        
        $data['row'] = $this->user_m->get()->result();

		$this->template->load('template', 'user/user_data', $data);
    }
    
    public function add()
    {
       
        $this->form_validation->set_rules('name','Nama','required');
        $this->form_validation->set_rules('username','Username','required|min_length[5]|is_unique[user.username]');
        $this->form_validation->set_rules('password','Password','required|min_length[5]');
        $this->form_validation->set_rules('passconf','Konfirmasi Password','required|min_length[5]|matches[password]', 
        array('matches' => '%s Tidak Sesuai Dengan Password')
        );
        $this->form_validation->set_rules('level','Level','required');

        $this->form_validation->set_message('required','%s Masih Kosong Silahkan Diisi');
        $this->form_validation->set_message('min_length','%s Minimal 5 Karakter');
        $this->form_validation->set_message('is_unique','%s Data Sudah Digunakan, Silahkan Ganti');
        $this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

        if ($this->form_validation->run()== FALSE){
            $this->template->load('template', 'user/user_form_add');
        } else {
            $post = $this->input->post(null,TRUE);
            $this->user_m->add($post);
            if ($this->db->affected_rows >0){
                echo "<script> alert('Data Berhasil Disimpan');</script>";

            }
            redirect('user');
        } 
    }

    public function edit($id)
    {
       
        $this->form_validation->set_rules('name','Nama','required');
        $this->form_validation->set_rules('username','Username','required|min_length[5]|callback_username_check');

        if ($this->input->post('password')){
        $this->form_validation->set_rules('password','Password','min_length[5]');
        $this->form_validation->set_rules('passconf','Konfirmasi Password','min_length[5]|matches[password]', 
        array('matches' => '%s Tidak Sesuai Dengan Password')
        );
        }
        if ($this->input->post('passconf')){
           
            $this->form_validation->set_rules('passconf','Konfirmasi Password','min_length[5]|matches[password]', 
            array('matches' => '%s Tidak Sesuai Dengan Password')
            );
        }
        $this->form_validation->set_rules('level','Level','required');

        $this->form_validation->set_message('required','%s Masih Kosong Silahkan Diisi');
        $this->form_validation->set_message('min_length','%s Minimal 5 Karakter');
        $this->form_validation->set_message('is_unique','%s Data Sudah Digunakan, Silahkan Ganti');
        $this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

        if ($this->form_validation->run()== FALSE){
            $query = $this->user_m->get($id);
            if ($query->num_rows()>0){
                $data['row'] = $query->row();
                $this->template->load('template', 'user/user_form_edit',$data);
            } else {
                echo "<script> alert('Data Tidak Ditemukan');</script>";
                redirect('user');
            }
            
        } else {
            $post = $this->input->post(null,TRUE);
            $this->user_m->edit($post);
            if ($this->db->affected_rows() > 0) {
                echo "<script> alert('Data Berhasil Disimpan');</script>";

            }
            redirect('user');
        } 
    }

    function username_check()
    {
        $post = $this->input->post(null,TRUE);
        $query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND user_id != '$post[user_id]'");
        if ($query->num_rows >0){
            $this->form_validation->set_message('username_check','{field} ini sudah dipakai , Silahkan ganti');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function del()
    {
        $id = $this->input->post('user_id');
        $this->user_m->del($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script> alert('Data Berhasil Dihapus');</script>";

        }
        redirect('user');
    }
}
