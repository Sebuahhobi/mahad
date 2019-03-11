<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    date_default_timezone_set('Asia/jakarta');
class Super_admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        chek_login();
        $this->load->model('admin_model');
        $this->load->model('model_select');
        $this->load->model('mhs_kamar_model');
        $this->load->model('Data_orang_tua_model');
        $this->load->model('Super_admin_model');
        $this->load->model('Menu_admin_model');
        $this->load->model('Menu_super_admin_model');
        $this->load->model('Mhs_orang_tua_model');
        $this->load->model('Mhs_kamar_model');
        $this->load->model('Kamar_ikhwan_model');
        $this->load->model('Kamar_akhwat_model');
        $this->load->model('Pembayaran_model');
        $this->load->model('Daftar_mhs_model');

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in())
	{
            // redirect them to the login page
            redirect('auth/login', 'refresh');
	}
        else{
            $total_mhs=$this->db->count_all('daftar_mhs');
            $total_orang_tua=$this->db->count_all('data_orang_tua');
            $this->db->distinct();
            $query1=$this->db->get('mhs_kamar_ikhwan');
            foreach($query1->result() as $data_kamar){
                $kamar_terpakai=$data_kamar->id_kamar;
            }
            $jumlah_user_auth=$this->db->count_all('users');
            $jumlah_group_ion_auth=$this->db->count_all('groups');
            $jumlah_kamar_penuh=$this->db->get_where('kamar_ikhwan',array('status'=>'p'));
            $jumlah_admin=$this->db->get_where('users_groups',array('group_id'=>1));
            $jumlah_kamar=$this->db->get('kamar_ikhwan');
            $jumlah_user_login=$this->db->get_where('users',array('status_login'=>1));
            $data = array(
            'total_mhs'                   => $total_mhs,
            'data_orang_tua'              => $total_orang_tua,
            'kamar_terpakai'              => $kamar_terpakai,
            'jumlah_user_auth'            => $jumlah_user_auth,
            'jumlah_group_ion_auth'       => $jumlah_group_ion_auth,
            'jumlah_kamar_penuh'          => $jumlah_kamar_penuh->num_rows(),
            'jumlah_admin'                => $jumlah_admin->num_rows(),
            'jumlah_kamar'                => $jumlah_kamar->num_rows(),
            'jumlah_user_login'           => $jumlah_user_login->num_rows()
        );
            //$total_mhs=$this->db->count_all('daftar_mhs');
            $this->template->load('template_Super_Admin','super_admin/index',$data);
        }
    }
    function ion_auth_list(){
        
        $super_admin = $this->Super_admin_model->get_all();
        $data = array(
            'super_admin_data' => $super_admin
        );
        $this->template->load('template_Super_Admin','super_admin/users_list',$data);
    }

    public function read($id) 
    {
        $row = $this->Super_admin_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'ip_address' => $row->ip_address,
		'username' => $row->username,
		'password' => $row->password,
		'salt' => $row->salt,
		'email' => $row->email,
		'activation_code' => $row->activation_code,
		'forgotten_password_code' => $row->forgotten_password_code,
		'forgotten_password_time' => $row->forgotten_password_time,
		'remember_code' => $row->remember_code,
		'created_on' => $row->created_on,
		'last_login' => $row->last_login,
		'active' => $row->active,
		'first_name' => $row->first_name,
		'last_name' => $row->last_name,
		'company' => $row->company,
		'phone' => $row->phone,
	    );
            $this->load->view('super_admin/users_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('super_admin/ion_auth_list'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('super_admin/create_action'),
	    'id' => set_value('id'),
	    'ip_address' => set_value('ip_address'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'salt' => set_value('salt'),
	    'email' => set_value('email'),
	    'activation_code' => set_value('activation_code'),
	    'forgotten_password_code' => set_value('forgotten_password_code'),
	    'forgotten_password_time' => set_value('forgotten_password_time'),
	    'remember_code' => set_value('remember_code'),
	    'created_on' => set_value('created_on'),
	    'last_login' => set_value('last_login'),
	    'active' => set_value('active'),
	    'first_name' => set_value('first_name'),
	    'last_name' => set_value('last_name'),
	    'company' => set_value('company'),
	    'phone' => set_value('phone'),
	);
        $this->template->load('template_Super_Admin','super_admin/users_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'ip_address' => $this->input->post('ip_address',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'salt' => $this->input->post('salt',TRUE),
		'email' => $this->input->post('email',TRUE),
		'activation_code' => $this->input->post('activation_code',TRUE),
		'forgotten_password_code' => $this->input->post('forgotten_password_code',TRUE),
		'forgotten_password_time' => $this->input->post('forgotten_password_time',TRUE),
		'remember_code' => $this->input->post('remember_code',TRUE),
		'created_on' => $this->input->post('created_on',TRUE),
		'last_login' => $this->input->post('last_login',TRUE),
		'active' => $this->input->post('active',TRUE),
		'first_name' => $this->input->post('first_name',TRUE),
		'last_name' => $this->input->post('last_name',TRUE),
		'company' => $this->input->post('company',TRUE),
		'phone' => $this->input->post('phone',TRUE),
	    );

            $this->Super_admin_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('super_admin/ion_auth_list'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Super_admin_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('super_admin/update_action'),
		'id' => set_value('id', $row->id),
		'ip_address' => set_value('ip_address', $row->ip_address),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'salt' => set_value('salt', $row->salt),
		'email' => set_value('email', $row->email),
		'activation_code' => set_value('activation_code', $row->activation_code),
		'forgotten_password_code' => set_value('forgotten_password_code', $row->forgotten_password_code),
		'forgotten_password_time' => set_value('forgotten_password_time', $row->forgotten_password_time),
		'remember_code' => set_value('remember_code', $row->remember_code),
		'created_on' => set_value('created_on', $row->created_on),
		'last_login' => set_value('last_login', $row->last_login),
		'active' => set_value('active', $row->active),
		'first_name' => set_value('first_name', $row->first_name),
		'last_name' => set_value('last_name', $row->last_name),
		'company' => set_value('company', $row->company),
		'phone' => set_value('phone', $row->phone),
	    );
            $this->template->load('template_Super_Admin','super_admin/users_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('super_admin/ion_auth_list'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'ip_address' => $this->input->post('ip_address',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'salt' => $this->input->post('salt',TRUE),
		'email' => $this->input->post('email',TRUE),
		'activation_code' => $this->input->post('activation_code',TRUE),
		'forgotten_password_code' => $this->input->post('forgotten_password_code',TRUE),
		'forgotten_password_time' => $this->input->post('forgotten_password_time',TRUE),
		'remember_code' => $this->input->post('remember_code',TRUE),
		'created_on' => $this->input->post('created_on',TRUE),
		'last_login' => $this->input->post('last_login',TRUE),
		'active' => $this->input->post('active',TRUE),
		'first_name' => $this->input->post('first_name',TRUE),
		'last_name' => $this->input->post('last_name',TRUE),
		'company' => $this->input->post('company',TRUE),
		'phone' => $this->input->post('phone',TRUE),
	    );

            $this->Super_admin_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('super_admin/ion_auth_list'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Super_admin_model->get_by_id($id);

        if ($row) {
            $this->Super_admin_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('super_admin'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('super_admin/ion_auth_list'));
        }
    }
    
    //list akun
    function list_akun(){
        // set the flash data error message if there is one
	$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

	//list the users
        $this->data['users'] = $this->ion_auth->users()->result();
	foreach ($this->data['users'] as $k => $user)
	{
            $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
	}
        $this->template->load('template_Super_Admin','admin_mahad_2014/akun_mhs/index',$this->data);
	//$this->_render_page('auth/index', $this->data);
    }
    
    //menu admin
    public function create_menu_admin() //menu admin
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('super_admin/create_action_menu_admin'),
    	    'id' => set_value('id'),
    	    'judul' => set_value('judul'),
    	    'link' => set_value('link'),
    	    'icon' => set_value('icon'),
    	    'IsParent' => set_value('IsParent'),
    	    'status_aktif' => set_value('status_aktif'),
	);
        $this->template->load('template_Super_Admin','super_admin/menu_admin/menu_admin_form', $data);
    }
    
    function menu_admin_list(){ //menu admin
        $menu_admin = $this->Menu_admin_model->get_all();

        $data = array(
            'menu_admin_data' => $menu_admin
        );

        $this->template->load('template_Super_Admin','super_admin/menu_admin/menu_admin_list', $data);
    }
    public function create_action_menu_admin() //menu admin
    {
        $this->rules_menu_admin();

        if ($this->form_validation->run() == FALSE) {
            $this->create_menu_admin();
        } else {
            $data = array(
		'judul' => $this->input->post('judul',TRUE),
		'link' => $this->input->post('link',TRUE),
		'icon' => $this->input->post('icon',TRUE),
		'IsParent' => $this->input->post('IsParent',TRUE),
		'status_aktif' => $this->input->post('status_aktif',TRUE),
	    );

            $this->Menu_admin_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('super_admin/menu_admin_list'));
        }
    }
    
    public function update_menu_admin($id) //menu admin
    {
        $row = $this->Menu_admin_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('super_admin/update_action_menu_admin'),
		'id' => set_value('id', $row->id),
		'judul' => set_value('judul', $row->judul),
		'link' => set_value('link', $row->link),
		'icon' => set_value('icon', $row->icon),
		'IsParent' => set_value('IsParent', $row->IsParent),
		'status_aktif' => set_value('status_aktif', $row->status_aktif),
	    );
            $this->template->load('template_Super_Admin','super_admin/menu_admin/menu_admin_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('super_admin/menu_admin_list'));
        }
    }
    
    public function update_action_menu_admin() 
    {
        $this->rules_menu_admin();

        if ($this->form_validation->run() == FALSE) {
            $this->update_menu_admin($this->input->post('id', TRUE));
        } else {
            $data = array(
		'judul' => $this->input->post('judul',TRUE),
		'link' => $this->input->post('link',TRUE),
		'icon' => $this->input->post('icon',TRUE),
		'IsParent' => $this->input->post('IsParent',TRUE),
		'status_aktif' => $this->input->post('status_aktif',TRUE),
	    );

            $this->Menu_admin_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('super_admin/menu_admin_list'));
        }
    }
    
    public function delete_menu_admin($id) 
    {
        $row = $this->Menu_admin_model->get_by_id($id);

        if ($row) {
            $this->Menu_admin_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('super_admin/menu_admin_list'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('super_admin/menu_admin_list'));
        }
    }
    
    function rules_menu_admin()
    {
        $this->form_validation->set_rules('judul', 'judul', 'trim|required');
    	//$this->form_validation->set_rules('link', 'link', 'trim|required');
    	//$this->form_validation->set_rules('icon', 'icon', 'trim|required');
    	$this->form_validation->set_rules('IsParent', 'isparent', 'trim|required');
    	$this->form_validation->set_rules('status_aktif', 'status aktif', 'trim|required');

    	$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    //menu super admin
    public function create_menu_super_admin() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('super_admin/create_action_menu_super_admin'),
    	    'id' => set_value('id'),
    	    'judul' => set_value('judul'),
    	    'link' => set_value('link'),
    	    'icon' => set_value('icon'),
    	    'IsParent' => set_value('IsParent'),
    	    'status_aktif' => set_value('status_aktif'),
	);
        $this->template->load('template_Super_Admin','super_admin/menu_super_admin/menu_admin_form', $data);
    }
    
    public function create_action_menu_super_admin() 
    {
        $this->rules_menu_super_admin();

        if ($this->form_validation->run() == FALSE) {
            $this->create_menu_super_admin();
        } else {
            $data = array(
		'judul' => $this->input->post('judul',TRUE),
		'link' => $this->input->post('link',TRUE),
		'icon' => $this->input->post('icon',TRUE),
		'IsParent' => $this->input->post('IsParent',TRUE),
		'status_aktif' => $this->input->post('status_aktif',TRUE),
	    );

            $this->Menu_super_admin_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('super_admin/menu_super_admin_list'));
        }
    }
    
    function menu_super_admin_list(){
        $menu_super_admin = $this->Menu_super_admin_model->get_all();

        $data = array(
            'menu_super_admin_data' => $menu_super_admin
        );

        $this->template->load('template_Super_Admin','super_admin/menu__admin/menu_admin_list', $data);
    }

    public function delete_menu_super_admin($id) 
    {
        $row = $this->Menu_super_admin_model->get_by_id($id);

        if ($row) {
            $this->Menu_super_admin_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('super_admin/menu_super_admin_list'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('super_admin/menu_super_admin_list'));
        }
    }
    
    public function update_menu_super_admin($id) 
    {
        $row = $this->Menu_super_admin_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('super_admin/update_action_menu_super_admin'),
		'id' => set_value('id', $row->id),
		'judul' => set_value('judul', $row->judul),
		'link' => set_value('link', $row->link),
		'icon' => set_value('icon', $row->icon),
		'IsParent' => set_value('IsParent', $row->IsParent),
		'status_aktif' => set_value('status_aktif', $row->status_aktif),
	    );
            $this->template->load('template_Super_Admin','super_admin/menu_super_admin/menu_admin_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('super_admin/menu_super_admin_list'));
        }
    }
    
    public function update_action_menu_super_admin() 
    {
        $this->rules_menu_super_admin();

        if ($this->form_validation->run() == FALSE) {
            $this->update_menu_super_admin($this->input->post('id', TRUE));
        } else {
            $data = array(
		'judul' => $this->input->post('judul',TRUE),
		'link' => $this->input->post('link',TRUE),
		'icon' => $this->input->post('icon',TRUE),
		'IsParent' => $this->input->post('IsParent',TRUE),
		'status_aktif' => $this->input->post('status_aktif',TRUE),
	    );

            $this->Menu_super_admin_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('super_admin/menu_super_admin_list'));
        }
    }
    
    function rules_menu_super_admin()
    {
        $this->form_validation->set_rules('judul', 'judul', 'trim|required');
    	//$this->form_validation->set_rules('link', 'link', 'trim|required');
    	//$this->form_validation->set_rules('icon', 'icon', 'trim|required');
    	$this->form_validation->set_rules('IsParent', 'isparent', 'trim|required');
    	$this->form_validation->set_rules('status_aktif', 'status aktif', 'trim|required');

    	$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    public function excel_menu_super_admin()
    {
        $this->load->helper('exportexcel');
        $namaFile = "menu_super_admin.xls";
        $judul = "menu_super_admin";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Judul");
	xlsWriteLabel($tablehead, $kolomhead++, "Link");
	xlsWriteLabel($tablehead, $kolomhead++, "Icon");
	xlsWriteLabel($tablehead, $kolomhead++, "IsParent");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Aktif");

	foreach ($this->Menu_super_admin_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->judul);
	    xlsWriteLabel($tablebody, $kolombody++, $data->link);
	    xlsWriteLabel($tablebody, $kolombody++, $data->icon);
	    xlsWriteNumber($tablebody, $kolombody++, $data->IsParent);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_aktif);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word_menu_super_admin()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=menu_super_admin.doc");

        $data = array(
            'menu_super_admin_data' => $this->Menu_super_admin_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('super_admin/menu_super_admin/menu_super_admin_doc',$data);
    }

    public function _rules() 
    {        
    	//$this->form_validation->set_rules('ip_address', 'ip address', 'trim|required');
    	$this->form_validation->set_rules('username', 'username', 'trim|required');
    	$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[8]|max_length[20]');
    	//$this->form_validation->set_rules('salt', 'salt', 'trim|required');
    	$this->form_validation->set_rules('email', 'email', 'trim|required|min_length[8]|max_length[20]');
    	//$this->form_validation->set_rules('activation_code', 'activation code', 'trim|required');
    	//$this->form_validation->set_rules('forgotten_password_code', 'forgotten password code', 'trim|required');
    	//$this->form_validation->set_rules('forgotten_password_time', 'forgotten password time', 'trim|required');
    	//$this->form_validation->set_rules('remember_code', 'remember code', 'trim|required');
    	//$this->form_validation->set_rules('created_on', 'created on', 'trim|required');
    	//$this->form_validation->set_rules('last_login', 'last login', 'trim|required');
    	//$this->form_validation->set_rules('active', 'active', 'trim|required');
    	$this->form_validation->set_rules('first_name', 'first name', 'trim|required');
    	$this->form_validation->set_rules('last_name', 'last name', 'trim|required');
    	$this->form_validation->set_rules('company', 'company', 'trim|required');
    	$this->form_validation->set_rules('phone', 'phone', 'trim|required');

    	$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    //Mahasiswa
    function mhs_list_ikhwan()
    {
        $daftar_mhs     = $this->admin_model->get_all();

        $data = array(
            'daftar_mhs_data' => $daftar_mhs
        );

        $this->template->load('template_Super_Admin','super_admin/daftar_mhs/daftar_mhs_list_ikhwan', $data);
    }
    function mhs_list_all_ikhwan()
    {
        $daftar_mhs     = $this->admin_model->get_all();

        $data = array(
            'daftar_mhs_data' => $daftar_mhs
        );

        $this->template->load('template_Super_Admin','super_admin/daftar_mhs/daftar_mhs_list_all_ikhwan', $data);
    }
    
    public function create_mhs() 
    {
        $data = array(
            'button'          => 'Create',
            'action'          => site_url('super_admin/create_action_mhs'),
    	    'id'              => set_value('id'),
    	    'nama'            => set_value('nama'),
    	    'npm'             => set_value('npm'),
    	    'fakultas'        => set_value('fakultas'),
    	    'jurusan'         => set_value('jurusan'),
    	    'semester'        => set_value('semester'),
    	    'kamar'           => set_value('kamar'),
    	    //'operator' => set_value('operator'),
    	    'noHP'            => set_value('noHP'),
            'j_k'             => set_value('j_k'),
            'ttl'             => set_value('ttl'),
            'sertifikat_ldik' => set_value('sertifikat_ldik'),
            'foto'            => set_value('foto'),

            'err_foto'        => '',
            'bahasa'          => set_value('bahasa'),
            'hobi'            => set_value('hobi'),
            'keahlian'        => set_value('keahlian'),
            'cita_cita'       => set_value('cita_cita'),
            'tgl_lahir'       => set_value('tgl_lahir'),
    
    	    'nama_Ayah'    => set_value('nama_Ayah'),
    	    'noHP_Ayah'    => set_value('noHP_Ayah'),
    	    'nama_Ibu'     => set_value('nama_Ibu'),
    	    'noHP_Ibu'     => set_value('noHP_Ibu'),
    	    'provinsi'     => set_value('provinsi'),
    	    'kab'          => set_value('kab'),
    	    'kec'          => set_value('kec'),
    	    'desa'         => set_value('desa'),
    	    'rt'           => set_value('rt'),
            'judul_mhs'    => 'Form Pendaftaran Mahasiswa',
            'judul_ortu'   => 'Form Orang Tua',
            'cancel'       => base_url('super_admin/mhs_list_all_ikhwan')

	    );
        $this->template->load('template_Super_Admin','super_admin/daftar_mhs/daftar_mhs_form', $data);
    } 
    
    
        
    public function create_action_mhs() 
    {
        $config['upload_path']          = './assets/gambar';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['overwrite']            = TRUE;
        $config['encrypt_name']         = TRUE;
        $config['max_width']            = 2000;
        $config['max_height']           = 2000;

 
        $this->load->library('upload', $config);

        $this->rules_mhs();

        if ($this->form_validation->run() == FALSE) {
            $this->create_mhs();
        }
        elseif(! $this->upload->do_upload("foto")){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('msg',$error);
            $this->create_mhs();
        }
        else {
            unset($_SESSION['msg']);
            date_default_timezone_set('Asia/jakarta');
            $user=$this->ion_auth->user()->row(); 
            if(empty($this->input->post('tgl_lahir',TRUE)))
                $tgl="";
            else
                $tgl=date('Y-m-d', strtotime($this->input->post('tgl_lahir',TRUE)));
            
            $data1 = array('upload_data' => $this->upload->data());
            
                $data = array(
                    'nama'            => $this->input->post('nama',TRUE),
                    'npm'             => $this->input->post('npm',TRUE),
                    'fakultas'        => $this->input->post('fakultas',TRUE),
                    'jurusan'         => $this->input->post('jurusan',TRUE),
                    'semester'        => $this->input->post('semester',TRUE),
                    'kamar'           => $this->input->post('kamar',TRUE),
                    //'operator' => $this->input->post('operator',TRUE),
                    'operator'        => $user->first_name.' '.$user->last_name,
                    'noHP'            => $this->input->post('noHP',TRUE),
                    'j_k'             => $this->input->post('j_k',TRUE),
                    'ttl'             => $this->input->post('ttl',TRUE),
                    'sertifikat_ldik' => $this->input->post('sertifikat_ldik',TRUE),
                    'foto'            => $data1['upload_data']['file_name'],
                    'bahasa'          => implode(" ",$this->input->post('bahasa',TRUE)),
                    'hobi'            => $this->input->post('hobi',TRUE),
                    'keahlian'        => $this->input->post('keahlian',TRUE),
                    'cita_cita'       => $this->input->post('cita_cita',TRUE),
                    'tgl_lahir'       => $tgl,
                );
                $this->admin_model->insert_mhs($data);
            
            //kamar_mhs
            $ambil_id_mhs   = $this->db->get_where('daftar_mhs',array('npm'=>$this->input->post('npm',TRUE)));
            if($this->input->post('j_k',TRUE)=='L'){
                $ambil_id_kamar = $this->db->get_where('kamar_ikhwan',array('id'=>$this->input->post('kamar',TRUE)));
                foreach ($ambil_id_mhs->result() as $main){
                    foreach ($ambil_id_kamar->result() as $mhs){
                        $kamar_id=$mhs->id;
                        $mhs_id=$main->id;

                    }
                }
            
                $data_kamar=array(
                    'id_mhs'   => $main->id,  
                    'id_kamar' => $mhs->id
                );
                $this->mhs_kamar_model->insert_ikhwan($data_kamar);
            }
            elseif($this->input->post('j_k',TRUE)=='P'){
                $ambil_id_kamar = $this->db->get_where('kamar_akhwat',array('id'=>$this->input->post('kamar',TRUE)));
                foreach ($ambil_id_mhs->result() as $main){
                    foreach ($ambil_id_kamar->result() as $mhs){
                        $kamar_id=$mhs->id;
                        $mhs_id=$main->id;

                    }
                }
            
                $data_kamar=array(
                    'id_mhs'   => $mhs_id,  
                    'id_kamar' => $kamar_id
                );
                $this->mhs_kamar_model->insert_akhwat($data_kamar);
            }
            
             //Data orang tua
            foreach ($ambil_id_mhs->result() as $mhs1){
                    $mhs_id=$mhs1->id;
            }
            $data_orang_tua = array(
        		'nama_Ayah' => $this->input->post('nama_Ayah',TRUE),
        		'noHP_Ayah' => $this->input->post('noHP_Ayah',TRUE),
        		'nama_Ibu' => $this->input->post('nama_Ibu',TRUE),
        		'noHP_Ibu' => $this->input->post('noHP_Ibu',TRUE),
        		'provinsi' => $this->input->post('provinsi',TRUE),
        		'kab' => $this->input->post('kab',TRUE),
        		'kec' => $this->input->post('kec',TRUE),
        		'desa' => $this->input->post('desa',TRUE),
        		'rt' => $this->input->post('rt',TRUE),
                'id_mhs' => $mhs_id
	        );

            $this->Data_orang_tua_model->insert($data_orang_tua);
            //END data orang tua
            
            $this->session->set_flashdata('message', 'Data berhasil di tambah.');
            redirect(site_url('super_admin/mhs_list_ikhwan'));
        }
    }

    public function update_mhs($id) 
    {
        $row = $this->admin_model->get_by_id($id);
        $get_data_orang_tua= $this->db->get_where('data_orang_tua',array('id_mhs'=>$id));
        foreach ($get_data_orang_tua->result() as $row1) {
            
        }
        //$row1= $this->Data_orang_tua_model->get_by_id($row->id);

        if ($row) {
            $data = array(
                'button'          => 'Update',
                'action'          => site_url('super_admin/update_action_mhs'),
        		'id'              => set_value('id', $row->id),
        		'nama'            => set_value('nama', $row->nama),
        		'npm'             => set_value('npm', $row->npm),
        		'fakultas'        => set_value('fakultas', $row->fakultas),
        		'jurusan'         => set_value('jurusan', $row->jurusan),
        		'semester'        => set_value('semester', $row->semester),
        		'kamar'           => set_value('kamar', $row->kamar),
        		//'operator'        => set_value('operator', $row->operator),
        		'noHP'            => set_value('noHP', $row->noHP),
                'j_k'             => set_value('j_k',$row->j_k),
                'ttl'             => set_value('ttl',$row->ttl),
                'sertifikat_ldik' => set_value('sertifikat_ldik',$row->sertifikat_ldik),
                'foto'            => set_value('foto',$row->foto),
                'bahasa'          => set_value('bahasa',$row->bahasa),
                'hobi'            => set_value('hobi',$row->hobi),
                'keahlian'        => set_value('keahlian',$row->keahlian),
                'cita_cita'       => set_value('cita_cita',$row->cita_cita),
                'tgl_lahir'       => set_value('tgl_lahir',$row->tgl_lahir),
                
                'nama_Ayah'       => set_value('nama_Ayah', $row1->nama_Ayah),
        		'noHP_Ayah'       => set_value('noHP_Ayah', $row1->noHP_Ayah),
        		'nama_Ibu'        => set_value('nama_Ibu', $row1->nama_Ibu),
        		'noHP_Ibu'        => set_value('noHP_Ibu', $row1->noHP_Ibu),
        		'provinsi'        => set_value('provinsi', $row1->provinsi),
        		'kab'             => set_value('kab', $row1->kab),
        		'kec'             => set_value('kec', $row1->kec),
        		'desa'            => set_value('desa', $row1->desa),
        		'rt'              => set_value('rt', $row1->rt),
                'judul_mhs'       => 'Update Data Mahasiswa',
                'judul_ortu'      => 'Update Data Orang Tua'
	    );
            $this->template->load('template_Super_Admin','super_admin/daftar_mhs/daftar_mhs_form', $data);
        } else {
            //$this->session->set_flashdata('message', 'Data berhasil di update.');
            redirect(site_url('super_admin/mhs_list_ikhwan'));
        }
    }
    
    public function update_action_mhs() 
    {
        $config['upload_path']          = './assets/gambar';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['overwrite']            = TRUE;
        $config['encrypt_name']         = TRUE;
        $config['max_width']            = 2000;
        $config['max_height']           = 2000;
 
        $this->load->library('upload', $config);

        $this->rules_mhs();

        if ($this->form_validation->run() == FALSE) {
            $this->update_mhs();
        }
        elseif(! $this->upload->do_upload("foto")){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('msg',$error);
            $this->update_mhs();
        }
        else {
            unset($_SESSION['msg']);
            date_default_timezone_set('Asia/jakarta');
            $user=$this->ion_auth->user()->row(); 
            if(empty($this->input->post('tgl_lahir',TRUE)))
                $tgl="";
            else
                $tgl=date('Y-m-d', strtotime($this->input->post('tgl_lahir',TRUE)));
            
            $data1 = array('upload_data' => $this->upload->data());
            
                $data = array(
                    'nama'            => $this->input->post('nama',TRUE),
                    'npm'             => $this->input->post('npm',TRUE),
                    'fakultas'        => $this->input->post('fakultas',TRUE),
                    'jurusan'         => $this->input->post('jurusan',TRUE),
                    'semester'        => $this->input->post('semester',TRUE),
                    'kamar'           => $this->input->post('kamar',TRUE),
                    //'operator' => $this->input->post('operator',TRUE),
                    'operator'        => $user->first_name.' '.$user->last_name,
                    'noHP'            => $this->input->post('noHP',TRUE),
                    'j_k'             => $this->input->post('j_k',TRUE),
                    'ttl'             => $this->input->post('ttl',TRUE),
                    'sertifikat_ldik' => $this->input->post('sertifikat_ldik',TRUE),
                    'foto'            => $data1['upload_data']['file_name'],
                    'bahasa'          => implode(" ",$this->input->post('bahasa',TRUE)),
                    'hobi'            => $this->input->post('hobi',TRUE),
                    'keahlian'        => $this->input->post('keahlian',TRUE),
                    'cita_cita'       => $this->input->post('cita_cita',TRUE),
                    'tgl_lahir'       => $tgl,
                );
                $this->admin_model->update_mhs($this->input->post('id', TRUE), $data);
            
            //kamar_mhs
            $ambil_id_mhs   = $this->db->get_where('daftar_mhs',array('npm'=>$this->input->post('npm',TRUE)));
            if($this->input->post('j_k',TRUE)=='L'){
                $ambil_id_kamar = $this->db->get_where('kamar_ikhwan',array('id'=>$this->input->post('kamar',TRUE)));
                foreach ($ambil_id_mhs->result() as $main){
                    foreach ($ambil_id_kamar->result() as $mhs){
                        $kamar_id=$mhs->id;
                        $mhs_id=$main->id;

                    }
                }
            
                $data_kamar=array(
                    'id_mhs'   => $mhs_id,  
                    'id_kamar' => $kamar_id
                );
                $this->mhs_kamar_model->update_ikhwan($this->input->post('id', TRUE), $data_kamar);
            }
            elseif($this->input->post('j_k',TRUE)=='P'){
                $ambil_id_kamar = $this->db->get_where('kamar_akhwat',array('id'=>$this->input->post('kamar',TRUE)));
                foreach ($ambil_id_mhs->result() as $main){
                    foreach ($ambil_id_kamar->result() as $mhs){
                        $kamar_id=$mhs->id;
                        $mhs_id=$main->id;

                    }
                }
            
                $data_kamar=array(
                    'id_mhs'   => $mhs_id,  
                    'id_kamar' => $kamar_id
                );
                $this->mhs_kamar_model->update_akhwat($this->input->post('id', TRUE), $data_kamar);
            }
            
             //Data orang tua
            foreach ($ambil_id_mhs->result() as $mhs1){
                    $mhs_id=$mhs1->id;
            }
            $data_orang_tua = array(
                'nama_Ayah' => $this->input->post('nama_Ayah',TRUE),
                'noHP_Ayah' => $this->input->post('noHP_Ayah',TRUE),
                'nama_Ibu' => $this->input->post('nama_Ibu',TRUE),
                'noHP_Ibu' => $this->input->post('noHP_Ibu',TRUE),
                'provinsi' => $this->input->post('provinsi',TRUE),
                'kab' => $this->input->post('kab',TRUE),
                'kec' => $this->input->post('kec',TRUE),
                'desa' => $this->input->post('desa',TRUE),
                'rt' => $this->input->post('rt',TRUE),
                'id_mhs' => $mhs_id
            );

            $this->Data_orang_tua_model->update($this->input->post('id', TRUE), $data_orang_tua);
            //END data orang tua
            
            $this->session->set_flashdata('message', 'Data berhasil di update.');
            redirect(site_url('super_admin/mhs_list_ikhwan'));
        }
    }
    
    public function delete_mhs($id) 
    {
        $row = $this->admin_model->get_by_id($id);
        if ($row) {
            $this->admin_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus data berhasil.');
            redirect(site_url('super_admin/mhs_list_ikhwan'));
        } else {
            $this->session->set_flashdata('message', 'Hapus data gagal.');
            redirect(site_url('super_admin/mhs_list_ikhwan'));
        }
    }
    
    
    public function rules_mhs() 
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required|min_length[3]|max_length[30]',
                        array('required'   => 'Kolom %s harus di isi!',
                              'min_length' => 'Min. 3 karakter..',
                              'max_length' => 'Max. 30 karakter..')
                );
	    $this->form_validation->set_rules('npm', 'npm', 'trim|required|is_natural|min_length[9]|max_length[9]|is_unique[daftar_mhs.npm]',
                        array('required'   => 'Kolom %s harus di isi!',
                              'is_natural'=> 'Isi hanya angka!',
                              'min_length' => 'Min. 9 karakter..',
                              'max_length' => 'Max. 9 karakter..',
                              'is_unique'  => '%s ini sudah ada!')
                );
    	$this->form_validation->set_rules('fakultas', 'fakultas', 'trim|required', array('required'   => 'Kolom %s harus di isi!'));
    	//$this->form_validation->set_rules('jurusan', 'jurusan', 'trim|required', array('required'   => 'Kolom %s harus di isi!'));
    	$this->form_validation->set_rules('semester', 'semester', 'trim|required', array('required'   => 'Kolom %s harus di isi!'));
    	$this->form_validation->set_rules('kamar', 'kamar', 'trim|required', array('required'   => 'Kolom %s harus di isi!'));
            
    	//$this->form_validation->set_rules('operator', 'operator', 'trim|d');
    	$this->form_validation->set_rules('noHP', 'nohp', 'trim|required|is_natural|min_length[11]|max_length[12]|is_unique[daftar_mhs.noHP]',
                            array('required'   => 'Kolom %s harus di isi!',
                                  'is_natural'=> 'Isi hanya angka!',
                                  'min_length' => 'Min. 11 karakter..',
                                  'max_length' => 'Max. 12 karakter..',
                                  'is_unique'  => '%s ini sudah pernah di buat!')
                    );
        $this->form_validation->set_rules('j_k', 'j_k', 'trim|required',array('required'   => 'Jenis kelamin harus di pilih!'));
        $this->form_validation->set_rules('ttl', 'ttl', 'trim|required|min_length[4]|max_length[30]',
                        array('required'   => 'Kolom tempat lahir harus di isi!',
                              'min_length' => 'Min. 4 karakter..',
                              'max_length' => 'Max. 30 karakter..'));
        $this->form_validation->set_rules('sertifikat_ldik', 'sertifikat_ldik', 'trim');
        //$this->form_validation->set_rules('foto', 'foto', 'trim|required',array('required'   => 'Kolom %s harus di isi!'));
    
        if (empty($_FILES['foto']['name']))
        {
            $this->form_validation->set_rules('foto', 'foto', 'required',array('required'   => 'Foto harus di upload!'));
        }
        
       
        $this->form_validation->set_rules('hobi', 'hobi', 'trim|required|min_length[4]|max_length[30]',
                        array('required'   => 'Kolom %s harus di isi!',
                              'min_length' => 'Min. 4 karakter..',
                              'max_length' => 'Max. 30 karakter..'));
        $this->form_validation->set_rules('keahlian', 'keahlian', 'trim|required|min_length[4]|max_length[20]',
                        array('required'   => 'Kolom %s harus di isi!',
                              'min_length' => 'Min. 4 karakter..',
                              'max_length' => 'Max. 20 karakter..'));
        $this->form_validation->set_rules('cita_cita', 'cita_cita', 'trim|required|min_length[4]|max_length[15]',
                        array('required'   => 'Kolom %s harus di isi!',
                              'min_length' => 'Min. 4 karakter..',
                              'max_length' => 'Max. 15 karakter..'));
        $this->form_validation->set_rules('tgl_lahir', 'tgl_lahir', 'trim|required',array('required'   => 'Kolom %s harus di isi!'));
        
        //rules data orang tua
        $this->form_validation->set_rules('nama_Ayah', 'nama ayah', 'trim|required|min_length[3]|max_length[30]',
                        array('required'   => 'Kolom %s harus di isi!',
                              'min_length' => 'Min. 3 karakter..',
                              'max_length' => 'Max. 30 karakter..')
                );
            
    	$this->form_validation->set_rules('noHP_Ayah', 'nohp ayah', 'trim|required|is_natural|min_length[11]|max_length[12]',
                            array('required'   => 'Kolom %s harus di isi!',
                                  'is_natural'=> 'Isi hanya angka!',
                                  'min_length' => 'Min. 11 karakter..',
                                  'max_length' => 'Max. 12 karakter..')
                    );
                    
    	$this->form_validation->set_rules('nama_Ibu', 'nama ibu', 'trim|required|min_length[3]|max_length[30]',
                            array('required'   => 'Kolom %s harus di isi!',
                                  'min_length' => 'Min. 3 karakter..',
                                  'max_length' => 'Max. 30 karakter..')
                    );
                

    	$this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required', array('required'   => 'Kolom %s harus di isi!'));
    	$this->form_validation->set_rules('kab', 'kab', 'trim|required', array('required'   => 'Kolom %s harus di isi!'));
    	$this->form_validation->set_rules('kec', 'kec', 'trim|required', array('required'   => 'Kolom %s harus di isi!'));
    	$this->form_validation->set_rules('desa', 'desa', 'trim|required', array('required'   => 'Kolom %s harus di isi!'));
    	$this->form_validation->set_rules('rt', 'rt', 'trim|required|regex_match[/[0-9]{2}\/[0-9]{2}/]',
                            array('required'   => 'Kolom rt/rw harus di isi!',
                                  'regex_match'    => 'Kolom rt/rw harus menggunakan /. ex: 02/04!'));
            //END rules data orang tua

    	$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>'); 
    }
    
    //END mahasiswa
    
    //Data orang tua
    function data_orang_tua_list()
    {
        $data_orang_tua = $this->Data_orang_tua_model->get_all();

        $data = array(
            'data_orang_tua_data' => $data_orang_tua,
            'judul'               => 'List Data Orang Tua'
        );

        $this->template->load('template_Super_Admin','super_admin/data_orang_tua/data_orang_tua_list', $data);
    }
    
    //END data orang tua
    
    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "users.xls";
        $judul = "users";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
    	xlsWriteLabel($tablehead, $kolomhead++, "Ip Address");
    	xlsWriteLabel($tablehead, $kolomhead++, "Username");
    	xlsWriteLabel($tablehead, $kolomhead++, "Password");
    	xlsWriteLabel($tablehead, $kolomhead++, "Salt");
    	xlsWriteLabel($tablehead, $kolomhead++, "Email");
    	xlsWriteLabel($tablehead, $kolomhead++, "Activation Code");
    	xlsWriteLabel($tablehead, $kolomhead++, "Forgotten Password Code");
    	xlsWriteLabel($tablehead, $kolomhead++, "Forgotten Password Time");
    	xlsWriteLabel($tablehead, $kolomhead++, "Remember Code");
    	xlsWriteLabel($tablehead, $kolomhead++, "Created On");
    	xlsWriteLabel($tablehead, $kolomhead++, "Last Login");
    	xlsWriteLabel($tablehead, $kolomhead++, "Active");
    	xlsWriteLabel($tablehead, $kolomhead++, "First Name");
    	xlsWriteLabel($tablehead, $kolomhead++, "Last Name");
    	xlsWriteLabel($tablehead, $kolomhead++, "Company");
    	xlsWriteLabel($tablehead, $kolomhead++, "Phone");

	foreach ($this->Super_admin_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ip_address);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->salt);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->activation_code);
	    xlsWriteLabel($tablebody, $kolombody++, $data->forgotten_password_code);
	    xlsWriteNumber($tablebody, $kolombody++, $data->forgotten_password_time);
	    xlsWriteLabel($tablebody, $kolombody++, $data->remember_code);
	    xlsWriteNumber($tablebody, $kolombody++, $data->created_on);
	    xlsWriteNumber($tablebody, $kolombody++, $data->last_login);
	    xlsWriteLabel($tablebody, $kolombody++, $data->active);
	    xlsWriteLabel($tablebody, $kolombody++, $data->first_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->last_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->company);
	    xlsWriteLabel($tablebody, $kolombody++, $data->phone);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=users.doc");

        $data = array(
            'users_data' => $this->Super_admin_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('super_admin/users_doc',$data);
    }
    
    //create akun Super Admin
	public function create_akun_super_admin()
    {
        $this->data['title'] = $this->lang->line('create_user_heading');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_super_admin())//cek login
        {
            redirect('auth', 'refresh');
        }

        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;
       
        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'trim|required|min_length[3]|max_length[30]',
                        array('required'   => 'Kolom %s harus di isi!',
                              'min_length' => 'Min. 3 karakter..',
                              'max_length' => 'Max. 30 karakter..')
                );
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'trim|required|min_length[3]|max_length[30]',
                        array('required'   => 'Kolom %s harus di isi!',
                              'min_length' => 'Min. 3 karakter..',
                              'max_length' => 'Max. 30 karakter..')
                );
        if($identity_column!=='email')
        {
            $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        }
        else
        {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim|required|is_natural|min_length[11]|max_length[12]|is_unique[users.phone]',
                array('required'   => 'Kolom %s harus di isi!',
                      'is_natural' => 'Isi hanya angka!',
                      'min_length' => 'Min. 11 karakter..',
                      'max_length' => 'Max. 12 karakter..',
                      'is_unique'  => 'No. HP ini sudah pernah di buat!')
                );
                
        //$this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                //'company'    => $this->input->post('company'),
                'phone'      => $this->input->post('phone'),
            );
        }
        /*if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        }*/
        if ($this->form_validation->run() == true && $this->ion_auth->register_super_admin($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("super_admin/data_akun_list", 'refresh');
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name'        => 'first_name',
                'id'          => 'first_name',
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Nama depan',
                'value'       => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name'        => 'last_name',
                'id'          => 'last_name',
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Nama belakang',
                'value'       => $this->form_validation->set_value('last_name'),
            );
            $this->data['identity'] = array(
                'name'        => 'identity',
                'id'          => 'identity',
                'type'        => 'text',
                
                'value'       => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name'        => 'email',
                'id'          => 'email',
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Email',
                'value'       => $this->form_validation->set_value('email'),
            );
            /*$this->data['company'] = array(
                'name'        => 'company',
                'id'          => 'company',
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Company',
                'value'       => $this->form_validation->set_value('company'),
            );*/
            $this->data['phone'] = array(
                'name'        => 'phone',
                'id'          => 'phone',
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'No. HP',
                'value'       => $this->form_validation->set_value('phone'),
            );
            $this->data['password'] = array(
                'name'        => 'password',
                'id'          => 'password',
                'type'        => 'password',
                'class'       => 'form-control',
                'placeholder' => 'Kata sandi',
                'value'       => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name'        => 'password_confirm',
                'id'          => 'password_confirm',
                'type'        => 'password',
                'class'       => 'form-control',
                'placeholder' => 'Konfirmasi kata sandi',
                'value'       => $this->form_validation->set_value('password_confirm'),
            );

            $this->template->load('template_Super_Admin','super_admin/akun/create_akun_super_admin_form', $this->data);
        }
    }
    //END create akun Super Admin
    //
    //create akun Admin
	public function create_akun_admin()
    {
        $this->data['title'] = $this->lang->line('create_user_heading');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())//cek login
        {
            redirect('auth', 'refresh');
        }

        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;
       
        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'trim|required|min_length[3]|max_length[30]',
                        array('required'   => 'Kolom %s harus di isi!',
                              'min_length' => 'Min. 3 karakter..',
                              'max_length' => 'Max. 30 karakter..')
                );
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'trim|required|min_length[3]|max_length[30]',
                        array('required'   => 'Kolom %s harus di isi!',
                              'min_length' => 'Min. 3 karakter..',
                              'max_length' => 'Max. 30 karakter..')
                );
        if($identity_column!=='email')
        {
            $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        }
        else
        {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim|required|is_natural|min_length[11]|max_length[12]|is_unique[users.phone]',
                array('required'   => 'Kolom %s harus di isi!',
                      'is_natural' => 'Isi hanya angka!',
                      'min_length' => 'Min. 11 karakter..',
                      'max_length' => 'Max. 12 karakter..',
                      'is_unique'  => 'No. HP ini sudah pernah di buat!')
                );
                
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'company'    => $this->input->post('company'),
                'phone'      => $this->input->post('phone'),
            );
        }
        /*if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        }*/
        if ($this->form_validation->run() == true && $this->ion_auth->register_admin($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("super_admin/data_akun_list", 'refresh');
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name'        => 'first_name',
                'id'          => 'first_name',
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Nama depan',
                'value'       => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name'        => 'last_name',
                'id'          => 'last_name',
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Nama belakang',
                'value'       => $this->form_validation->set_value('last_name'),
            );
            $this->data['identity'] = array(
                'name'        => 'identity',
                'id'          => 'identity',
                'type'        => 'text',
                
                'value'       => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name'        => 'email',
                'id'          => 'email',
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Email',
                'value'       => $this->form_validation->set_value('email'),
            );
            $this->data['company'] = array(
                'name'        => 'company',
                'id'          => 'company',
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Company',
                'value'       => $this->form_validation->set_value('company'),
            );
            $this->data['phone'] = array(
                'name'        => 'phone',
                'id'          => 'phone',
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'No. HP',
                'value'       => $this->form_validation->set_value('phone'),
            );
            $this->data['password'] = array(
                'name'        => 'password',
                'id'          => 'password',
                'type'        => 'password',
                'class'       => 'form-control',
                'placeholder' => 'Kata sandi',
                'value'       => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name'        => 'password_confirm',
                'id'          => 'password_confirm',
                'type'        => 'password',
                'class'       => 'form-control',
                'placeholder' => 'Konfirmasi kata sandi',
                'value'       => $this->form_validation->set_value('password_confirm'),
            );

            $this->template->load('template_Super_Admin','super_admin/akun/create_akun_admin_form', $this->data);
        }
    }
    //END create akun Admin
    
    //create akun mhs
    public function create_akun_mhs()
    {
        $this->data['title'] = $this->lang->line('create_user_heading');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())//cek login
        {
            redirect('auth', 'refresh');
        }

        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;
       
        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'trim|required|min_length[3]|max_length[30]',
                        array('required'   => 'Kolom %s harus di isi!',
                              'min_length' => 'Min. 3 karakter..',
                              'max_length' => 'Max. 30 karakter..')
                );
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'trim|required|min_length[3]|max_length[30]',
                        array('required'   => 'Kolom %s harus di isi!',
                              'min_length' => 'Min. 3 karakter..',
                              'max_length' => 'Max. 30 karakter..')
                );
        /*if($identity_column!=='email')
        {
            $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        }
        else
        {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }*/
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|is_natural|min_length[9]|max_length[9]|is_unique[users.email]|is_natural',
                        array('required'   => 'Kolom %s harus di isi!',
                              'is_natural'=> 'Isi hanya angka!',
                              'min_length' => 'Min. 9 karakter..',
                              'max_length' => 'Max. 9 karakter..',
                              'is_natural' => 'Isi hanya angka!',
                              'is_unique'  => 'NPM ini sudah ada!')
                );
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim|required|is_natural|min_length[11]|max_length[12]|is_unique[users.phone]',
                array('required'   => 'Kolom %s harus di isi!',
                      'is_natural' => 'Isi hanya angka!',
                      'min_length' => 'Min. 11 karakter..',
                      'max_length' => 'Max. 12 karakter..',
                      'is_unique'  => 'No. HP ini sudah pernah di buat!')
                );
        //$this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                //'company'    => $this->input->post('company'),
                'phone'      => $this->input->post('phone'),
            );
        }
        /*if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        }*/
        if ($this->form_validation->run() == true && $this->ion_auth->register_mhs($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("super_admin/data_akun_list", 'refresh');
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name'        => 'first_name',
                'id'          => 'first_name',
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Nama depan',
                'value'       => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name'        => 'last_name',
                'id'          => 'last_name',
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Nama belakang',
                'value'       => $this->form_validation->set_value('last_name'),
            );
           /* $this->data['identity'] = array(
                'name'        => 'identity',
                'id'          => 'identity',
                'type'        => 'text',
                
                'value'       => $this->form_validation->set_value('identity'),
            );*/
            $this->data['email'] = array(
                'name'        => 'email',
                'id'          => 'email',
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'NPM',
                'value'       => $this->form_validation->set_value('email'),
            );
            /*$this->data['company'] = array(
                'name'        => 'company',
                'id'          => 'company',
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'Company',
                'value'       => $this->form_validation->set_value('company'),
            );*/
            $this->data['phone'] = array(
                'name'        => 'phone',
                'id'          => 'phone',
                'type'        => 'text',
                'class'       => 'form-control',
                'placeholder' => 'No. HP',
                'value'       => $this->form_validation->set_value('phone'),
            );
            $this->data['password'] = array(
                'name'        => 'password',
                'id'          => 'password',
                'type'        => 'password',
                'class'       => 'form-control',
                'placeholder' => 'Kata sandi',
                'value'       => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name'        => 'password_confirm',
                'id'          => 'password_confirm',
                'type'        => 'password',
                'class'       => 'form-control',
                'placeholder' => 'Konfirmasi kata sandi',
                'value'       => $this->form_validation->set_value('password_confirm'),
            );

            $this->template->load('template_Super_Admin','super_admin/akun/create_akun_mhs_form', $this->data);
        }
    }
    //END craete akun mhs
    
    //List Akun Ion auth
    function data_akun_list(){
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

	//list the users
        $this->data['users'] = $this->ion_auth->users()->result();
	foreach ($this->data['users'] as $k => $user)
	{
            $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
	}
        //$this->_render_page('super_admin/akun/data_akun_list', $this->data);
	$this->template->load('template_Super_Admin','super_admin/akun/data_akun_list', $this->data);
    }
    //END list akun ion auth
    
    //delete akun
    public function delete_akun($id) 
    {
        $row = $this->Super_admin_model->get_by_id($id);

        if ($row) {
            $this->Super_admin_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('super_admin/data_akun_list'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('super_admin/data_akun_list'));
        }
    }
    //END delete akun
    
    // deactivate the user
	public function deactivate($id = NULL)
	{
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

	//list the users
        $this->data['users'] = $this->ion_auth->users()->result();
	foreach ($this->data['users'] as $k => $user)
	{
            $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
	}
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			//$this->_render_page('super_admin/akun/deactivate_akun', $this->data);
                        $this->template->load('template_Super_Admin','super_admin/akun/deactivate_akun', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				/*if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}*/

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			// redirect them back to the auth page
			redirect('super_admin/data_akun_list', 'refresh');
		}
	}
        //END deactivate
    // activate the user
	public function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("super_admin/data_akun_list", 'refresh');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}
        //END activate
    // edit a group
	public function edit_grup($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('super_admin/data_akun_list', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("super_admin/data_akun_list", 'refresh');
			}
		}

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['group'] = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

		$this->data['group_name'] = array(
			'name'        => 'group_name',
			'id'          => 'group_name',
                        'placeholder' => 'Nama grup',
                        'class'       => 'form-control',
			'type'        => 'text',
			'value'       => $this->form_validation->set_value('group_name', $group->name),
			$readonly     => $readonly,
		);
		$this->data['group_description'] = array(
			'name'        => 'group_description',
			'id'          => 'group_description',
                        'placeholder' => 'Deskripsi grup',
                        'class'       => 'form-control',
			'type'        => 'text',
			'value'       => $this->form_validation->set_value('group_description', $group->description),
		);

		$this->_render_page('super_admin/akun/edit_grup', $this->data);
	}
    //END edit grup
    
    
    // edit a user
	public function edit_akun($id)
	{
		$this->data['title'] = $this->lang->line('edit_user_heading');

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
                $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'trim|required|min_length[3]|max_length[30]',
                        array('required'   => 'Kolom %s harus di isi!',
                              'min_length' => 'Min. 3 karakter..',
                              'max_length' => 'Max. 30 karakter..')
                );
		/*$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'trim|required|min_length[3]|max_length[30]',
                        array('required'   => 'Kolom %s harus di isi!',
                              'min_length' => 'Min. 3 karakter..',
                              'max_length' => 'Max. 30 karakter..')
                              );*/
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'trim|required|min_length[3]|max_length[30]',
                        array('required'   => 'Kolom %s harus di isi!',
                              'min_length' => 'Min. 3 karakter..',
                              'max_length' => 'Max. 30 karakter..')
                              );
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'trim|required|is_natural|min_length[11]|max_length[12]',
                array('required'   => 'Kolom %s harus di isi!',
                      'is_natural' => 'Isi hanya angka!',
                      'min_length' => 'Min. 11 karakter..',
                      'max_length' => 'Max. 12 karakter..')
                );
		//$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			/*if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}*/

			// update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'company'    => $this->input->post('company'),
					'phone'      => $this->input->post('phone'),
				);

				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}



				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
					//Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData)) {

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}

					}
				}

			// check to see if we are updating the user
			   if($this->ion_auth->update($user->id, $data))
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->messages() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('super_admin/data_akun_list', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}

			    }
			    else
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->errors() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('super_admin/data_akun_list', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}

			    }

			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
                    'name'        => 'first_name',
                    'id'          => 'first_name',
                    'class'       => 'form-control',
                    'placeholder' => 'Nama depan',
                    'type'        => 'text',
                    'value'       => $this->form_validation->set_value('first_name', $user->first_name),
		);
		$this->data['last_name'] = array(
                    'name'        => 'last_name',
                    'id'          => 'last_name',
                    'type'        => 'text',
                    'class'       => 'form-control',
                    'placeholder' => 'Nama belakang',
                    'value'       => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$this->data['company'] = array(
                    'name'        => 'company',
                    'id'          => 'company',
                    'type'        => 'text',
                    'class'       => 'form-control',
                    'placeholder' => 'Perusahaan',
                    'value'       => $this->form_validation->set_value('company', $user->company),
		);
		$this->data['phone'] = array(
                    'name'        => 'phone',
                    'id'          => 'phone',
                    'type'        => 'text',
                    'class'       => 'form-control',
                    'placeholder' => 'Phone',
                    'value'       => $this->form_validation->set_value('phone', $user->phone),
		);
		$this->data['password'] = array(
                    'name'        => 'password',
                    'id'          => 'password',
                    'class'       => 'form-control',
                    'placeholder' => 'Password => Jika ingin di ganti',
                    'type'        => 'password'
		);
		$this->data['password_confirm'] = array(
                    'name'        => 'password_confirm',
                    'id'          => 'password_confirm',
                    'class'       => 'form-control',
                    'placeholder' => 'Password confirm => Jika ingin di ganti',
                    'type'        => 'password'
		);
                $this->_render_page('super_admin/akun/edit_akun', $this->data);
		//$this->template->load('template_Super_Admin','super_admin/akun/edit_akun', $this->data);
	}
    //END edit_akun
        
        public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}
    public function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
    
    public function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}

    public function list_kamar_ikhwan()
    {
        $kamar_ikhwan = $this->Kamar_ikhwan_model->get_all();

        $data = array(
            'kamar_ikhwan_data' => $kamar_ikhwan
        );

        $this->template->load('template_Super_Admin','super_admin/kamar_ikhwan/kamar_ikhwan_list', $data);
    }

    public function create_kamar_ikhwan() 
    {
        $data = array(
            'button'         => 'Create',
            'action'         => site_url('super_admin/create_action_kamar_ikhwan'),
            'id'             => set_value('id'),
            'kamar'          => set_value('kamar')
        );
        $this->template->load('template_Super_Admin','super_admin/kamar_ikhwan/kamar_ikhwan_form', $data);
    }
    
    public function create_action_kamar_ikhwan() 
    {
        $this->rules_kamar_ikhwan1();

        if ($this->form_validation->run() == FALSE) {
            $this->create_kamar_ikhwan();
        } else {
            $data = array(
                'kamar' => $this->input->post('kamar',TRUE)
            );

            $this->Kamar_ikhwan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('super_admin/list_kamar_ikhwan'));
        }
    }
    
    public function update_kamar_ikhwan($id) 
    {
        $row = $this->Kamar_ikhwan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'       => 'Update',
                'action'       => site_url('super_admin/update_action_kamar_ikhwan'),
                'id'           => set_value('id', $row->id),
                'kamar'        => set_value('kamar', $row->kamar),
                'isi_max'      => set_value('isi_max', $row->isi_max),
                'status'       => set_value('status', $row->status),
                'kondisi'      => set_value('kondisi', $row->kondisi),
                'perlengkapan' => set_value('perlengkapan', $row->perlengkapan),
                'h2'           => 'Update Data kamar ikhwan'
            );
            $this->template->load('template_Super_Admin','super_admin/kamar_ikhwan/kamar_ikhwan_form_update', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('super_admin/list_kamar_ikhwan'));
        }
    }

    public function update_kamar_ikhwan1($id) 
    {
        $row = $this->Kamar_ikhwan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'       => 'Update',
                'action'       => site_url('super_admin/update_action_kamar_ikhwan'),
                'id'           => set_value('id', $row->id),
                'kamar'        => set_value('kamar', $row->kamar),
                'isi_max'      => set_value('isi_max', $row->isi_max),
                'status'       => set_value('status', $row->status),
                'kondisi'      => set_value('kondisi', $row->kondisi),
                'perlengkapan' => set_value('perlengkapan', $row->perlengkapan),
                'h2'           => 'Update Data kamar ikhwan'
            );
            $this->template->load('template_Super_Admin','super_admin/kamar_ikhwan/kamar_ikhwan_form_update1', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('super_admin/list_kamar_ikhwan'));
        }
    }
    
    public function update_action_kamar_ikhwan() 
    {
        $this->_rules_kamar_ikhwan();

        if ($this->form_validation->run() == FALSE) {
            $this->update_kamar_ikhwan1($this->input->post('id', TRUE));
        }else {
            $data = array(
                'kamar'        => $this->input->post('kamar',TRUE),
                'isi_max'      => $this->input->post('isi_max',TRUE),
                'status'       => $this->input->post('status',TRUE),
                'kondisi'      => implode(', ',$this->input->post('kondisi',TRUE)), //$this->input->post('kondisi',TRUE), //
                'perlengkapan' => implode(', ',$this->input->post('perlengkapan',TRUE)), //$this->input->post('perlengkapan',TRUE)
            );

            $this->Kamar_ikhwan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('super_admin/list_kamar_ikhwan'));
        }
    }
    
    public function delete_kamar_ikhwan($id) 
    {
        $row = $this->Kamar_ikhwan_model->get_by_id($id);

        if ($row) {
            $this->Kamar_ikhwan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('super_admin/list_kamar_ikhwan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('super_admin/list_kamar_ikhwan'));
        }
    }

    public function _rules_kamar_ikhwan() 
    {
        $this->form_validation->set_rules('kamar', 'kamar', 'trim|required',
            array('required'   => 'Kamar harus di isi!'));
        $this->form_validation->set_rules('isi_max', 'isi max', 'trim|required|is_natural|min_length[1]|max_length[10]',
            array('required'   => 'Isi max. harus di isi!',
                  'is_natural' => 'Hanya angka!',
                  'min_length' => 'Min. 1 digit angka!',
                  'max_length' => 'Max. 10 digit angka!'
                 )
        );
        $this->form_validation->set_rules('status', 'status', 'trim|required',array('required'   => 'Status harus di isi!'));
        $this->form_validation->set_rules('kondisi[]', 'kondisi', 'trim|required',array('required'   => 'Kondisi harus di isi!'));
        $this->form_validation->set_rules('perlengkapan[]', 'Perlengkapan', 'trim|required',array('required'   => '%s harus di isi!'));

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function rules_kamar_ikhwan1() 
    {
        $this->form_validation->set_rules('kamar', 'Kamar', 'trim|required|is_unique[kamar_ikhwan.kamar]|min_length[1]|max_length[5]',
            array('required'   => 'Kamar harus di isi!',
                   'is_unique' => "Kamar ini sudah ada!",
                   'min_length'=> '%s min. 1 karakter!',
                   'max_length'=> '%s max. 5 karakter!'));
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel_kamar_ikhwan()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kamar_ikhwan.xls";
        $judul = "kamar_ikhwan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Kamar");
        xlsWriteLabel($tablehead, $kolomhead++, "Isi Max");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");
        xlsWriteLabel($tablehead, $kolomhead++, "Kondisi");

        foreach ($this->Kamar_ikhwan_model->get_all() as $data) {
                $kolombody = 0;

                //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->kamar);
            xlsWriteNumber($tablebody, $kolombody++, $data->isi_max);
            xlsWriteLabel($tablebody, $kolombody++, $data->status);
            xlsWriteLabel($tablebody, $kolombody++, $data->kondisi);

            $tablebody++;
                $nourut++;
            }

            xlsEOF();
            exit();
    }

    public function word_kamar_ikhwan()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=kamar_ikhwan.doc");

        $data = array(
            'kamar_ikhwan_data' => $this->Kamar_ikhwan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('super_admin/kamar_ikhwan/kamar_ikhwan_doc',$data);
    }

    //kamar akhwat
    public function list_kamar_akhwat()
    {
        $kamar_akhwat = $this->Kamar_akhwat_model->get_all();

        $data = array(
            'kamar_akhwat_data' => $kamar_akhwat
        );

        $this->template->load('template_Super_Admin','super_admin/kamar_akhwat/kamar_akhwat_list', $data);
    }

    public function create_kamar_akhwat() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('super_admin/create_action_kamar_akhwat'),
            'id'     => set_value('id'),
            'kamar'  => set_value('kamar')
        );
        $this->template->load('template_Super_Admin','super_admin/kamar_akhwat/kamar_akhwat_form', $data);
    }
    
    public function create_action_kamar_akhwat() 
    {
        $this->_rules_kamar_akhwat1();

        if ($this->form_validation->run() == FALSE) {
            $this->create_kamar_akhwat();
        } else {
            $data = array(
                'kamar' => $this->input->post('kamar',TRUE)
            );

            $this->Kamar_akhwat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('super_admin/list_kamar_akhwat'));
        }
    }
    
    public function update_kamar_akhwat($id) 
    {
        $row = $this->Kamar_akhwat_model->get_by_id($id);

        if ($row) {
            $data = array(
                    'button'       => 'Update',
                    'action'       => site_url('super_admin/update_action_kamar_akhwat'),
                    'id'           => set_value('id', $row->id),
                    'kamar'        => set_value('kamar', $row->kamar),
                    'isi_max'      => set_value('isi_max', $row->isi_max),
                    'status'       => set_value('status', $row->status),
                    'kondisi'      => set_value('kondisi', $row->kondisi),
                    'perlengkapan' => set_value('perlengkapan', $row->perlengkapan),
                    'h2'           => 'Update Data Kamar akhwat'
                );
            $this->template->load('template_Super_Admin','super_admin/kamar_akhwat/kamar_akhwat_form_update', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('super_admin/list_kamar_akhwat'));
        }
    }

    public function update_kamar_akhwat1($id) 
    {
        $row = $this->Kamar_akhwat_model->get_by_id($id);

        if ($row) {
            $data = array(
                    'button'       => 'Update',
                    'action'       => site_url('super_admin/update_action_kamar_akhwat'),
                    'id'           => set_value('id', $row->id),
                    'kamar'        => set_value('kamar', $row->kamar),
                    'isi_max'      => set_value('isi_max', $row->isi_max),
                    'status'       => set_value('status', $row->status),
                    'kondisi'      => set_value('kondisi', $row->kondisi),
                    'perlengkapan' => set_value('perlengkapan', $row->perlengkapan),
                    'h2'           => 'Update Data Kamar akhwat'
                );
            $this->template->load('template_Super_Admin','super_admin/kamar_akhwat/kamar_akhwat_form_update1', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('super_admin/list_kamar_akhwat'));
        }
    }
    
    public function update_action_kamar_akhwat() 
    {
        $this->_rules_kamar_akhwat();

        if ($this->form_validation->run() == FALSE) {
            $this->update_kamar_akhwat1($this->input->post('id', TRUE));
        } else {
            $data = array(
                'kamar'        => $this->input->post('kamar',TRUE),
                'isi_max'      => $this->input->post('isi_max',TRUE),
                'status'       => $this->input->post('status',TRUE),
                'kondisi'      => implode(', ', $this->input->post('kondisi',TRUE)),
                'perlengkapan' => implode(', ', $this->input->post('perlengkapan',TRUE))
            );

            $this->Kamar_akhwat_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('super_admin/list_kamar_akhwat'));
        }
    }
    
    public function delete_kamar_akhwat($id) 
    {
        $row = $this->Kamar_akhwat_model->get_by_id($id);

        if ($row) {
            $this->Kamar_akhwat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('super_admin/list_kamar_akhwat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('super_admin/list_kamar_akhwat'));
        }
    }

    public function _rules_kamar_akhwat() 
    {
        $this->form_validation->set_rules('isi_max', 'isi max', 'trim|required|is_natural|min_length[1]|max_length[10]',
            array('required'   => 'Isi max. harus di isi!',
                  'is_natural' => 'Hanya angka!',
                  'min_length' => 'Min. 1 digit angka!',
                  'max_length' => 'Max. 10 digit angka!'
                 )
        );
        $this->form_validation->set_rules('status', 'status', 'trim|required',array('required'   => 'Status harus di isi!'));
        $this->form_validation->set_rules('kondisi[]', 'kondisi', 'trim|required',array('required'   => 'Kondisi harus di isi!'));
        $this->form_validation->set_rules('perlengkapan[]', 'Perlengkapan', 'trim|required',array('required'   => '%s harus di isi!'));
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_kamar_akhwat1() 
    {
        $this->form_validation->set_rules('kamar', 'kamar', 'trim|required|is_unique[kamar_akhwat.kamar]|min_length[1]|max_length[5]',
            array('required'   => 'Kamar harus di isi!',
                   'is_unique' => "Kamar ini sudah ada!",
                   'min_length'=> '%s min. 1 karakter!',
                   'max_length'=> '%s max. 5 karakter!'));
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel_kamar_akhwat(){
        $this->load->helper('exportexcel');
        $namaFile = "kamar_akhwat.xls";
        $judul = "kamar_akhwat";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Kamar");
        xlsWriteLabel($tablehead, $kolomhead++, "Isi Max");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");
        xlsWriteLabel($tablehead, $kolomhead++, "Kondisi");

        foreach ($this->Kamar_akhwat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->kamar);
            xlsWriteNumber($tablebody, $kolombody++, $data->isi_max);
            xlsWriteLabel($tablebody, $kolombody++, $data->status);
            xlsWriteLabel($tablebody, $kolombody++, $data->kondisi);

            $tablebody++;
                $nourut++;
            }

            xlsEOF();
            exit();
    }

    public function word_kamar_akhwat()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=kamar_akhwat.doc");

        $data = array(
            'kamar_akhwat_data' => $this->Kamar_akhwat_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('super_admin/kamar_akhwat/kamar_akhwat_doc',$data);
    }

    //pembayaran_mhs
    public function list_pembayaran()
    {
        $pembayaran = $this->Pembayaran_model->get_all();        
        $data = array(
            'pembayaran_data' => $pembayaran,
            'h2'              => 'List Pembayaran Mahasiswa',
            'url_create'      => site_url('super_admin/create_pembayaran')
        );

        $this->template->load('template_Super_Admin','super_admin/pembayaran/pembayaran_list', $data);
    }

    public function list_pembayaran_2018()
    {
        $pembayaran = $this->Pembayaran_model->get_all();
        $data = array(
            'pembayaran_data' => $pembayaran,
            'h2'              => 'List Pembayaran Mahasiswa',
            'url_create'      => site_url('super_admin/create_pembayaran')
        );

        $this->template->load('template_Super_Admin','super_admin/pembayaran/pembayaran_list_2018', $data);
    }

    public function create_pembayaran() 
    {
        $data = array(
            'button'            => 'Create',
            'action'            => site_url('super_admin/create_action_pembayaran'),
            'id'                => set_value('id'),
            'jumlah_pembayaran' => set_value('jumlah_pembayaran'),
            'operator'          => set_value('operator'),
            'tgl_hari_ini'      => set_value('tgl_hari_ini'),
            'tgl_pembayaran'    => set_value('tgl_pembayaran'),
            'id_mhs'            => set_value('id_mhs'),
            'npm'               => set_value('npm'),
            'cancel'            => site_url('super_admin/list_pembayaran'),
            'h2'                => 'Form Pembayaran Mahasiswa'

        );
        $this->template->load('template_Super_Admin','super_admin/pembayaran/pembayaran_form', $data);
    }
    
    public function create_action_pembayaran() 
    {
        $this->_rules_pembayaran();

        if ($this->form_validation->run() == FALSE) {
            $this->create_pembayaran();
        } else {
            if(empty($this->input->post('tgl_pembayaran',TRUE)))
                $tgl="";
            else
                $tgl=date('Y-m-d', strtotime($this->input->post('tgl_pembayaran',TRUE)));

            $user=$this->ion_auth->user()->row();
            $id_mhs=$this->Daftar_mhs_model->get_id_by_npm($this->input->post('npm',TRUE));
            $data = array(
                'jumlah_pembayaran' => $this->session->flashdata('pembayaran') ,
                'operator'          => $user->first_name.' '.$user->last_name,
                'tgl_hari_ini'      => date('Y-m-d'),
                'tgl_pembayaran'    => $tgl,
                'id_mhs'            => $id_mhs->id
            );

            $this->Pembayaran_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('super_admin/list_pembayaran'));
        }
    }

    public function update_pembayaran($id) 
    {
        $row = $this->Pembayaran_model->get_by_id($id);
        $mhs = $this->Pembayaran_model->get_data_mhs_by_id($row->id_mhs);
        if ($row) {
            $data = array(
                'button'            => 'Update',
                'action'            => site_url('super_admin/update_action_pembayaran'),
                'id'                => set_value('id', $row->id),
                'jumlah_pembayaran' => set_value('jumlah_pembayaran', $row->jumlah_pembayaran),
                //'operator'          => //set_value('operator', $row->operator),
                'tgl_hari_ini'      => set_value('tgl_hari_ini', tgl_indo($row->tgl_hari_ini)),
                'tgl_pembayaran'    => set_value('tgl_pembayaran', tgl_indo($row->tgl_pembayaran)),
                'h2'                => 'Update pembayaran mahasiswa',
                'npm'               => $mhs->npm,
                'cancel'            => site_url('super_admin/list_pembayaran'),
        );
            $this->template->load('template_Super_Admin','super_admin/pembayaran/pembayaran_form_update', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('super_admin/list_pembayaran'));
        }
    }
    
    public function update_action_pembayaran() 
    {
        $this->_rules_pembayaran();

       if ($this->form_validation->run() == FALSE) {
            $this->update_pembayaran($this->input->post('id',TRUE));
        } else {
            if(empty($this->input->post('tgl_pembayaran',TRUE)))
                $tgl="";
            else
                $tgl=date('Y-m-d', strtotime($this->input->post('tgl_pembayaran',TRUE)));

            $user=$this->ion_auth->user()->row();
            $id_mhs=$this->Daftar_mhs_model->get_id_by_npm($this->input->post('npm',TRUE));
            $data = array(
                'jumlah_pembayaran' => $this->session->flashdata('pembayaran') ,
                'operator'          => $user->first_name.' '.$user->last_name,
                'tgl_hari_ini'      => date('Y-m-d'),
                'tgl_pembayaran'    => $tgl,
                'id_mhs'            => $id_mhs->id
            );

            $this->Pembayaran_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('super_admin/list_pembayaran'));
        }
    }
    
    public function delete_pembayaran($id) 
    {
        $row = $this->Pembayaran_model->get_by_id($id);

        if ($row) {
            $this->Pembayaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('super_admin/list_pembayaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('super_admin/list_pembayaran'));
        }
    }
    function cek_npm($str)
        {
            $npm = $this->Pembayaran_model->get_npm($str);
            if ($npm <0)
            {
                $this->form_validation->set_message('cek_npm', '{field} tidak ada!');
                return FALSE;
            }else{
                return TRUE;
            }
        }
    public function _rules_pembayaran() 
    {
        $this->form_validation->set_rules('npm', 'NPM', 'trim|required|is_natural|min_length[9]|max_length[9]|callback_cek_npm',
                        array('required'   => 'Kolom %s harus di isi!',
                              'is_natural' => 'Isi hanya angka!',
                              'min_length' => 'Min. 9 karakter..',
                              'max_length' => 'Max. 9 karakter..')
                );
        $this->form_validation->set_rules('tgl_pembayaran', 'Tanggal pembayaran', 'trim|required',
                        array('required'   => 'Kolom %s harus di isi!'));

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    
}


