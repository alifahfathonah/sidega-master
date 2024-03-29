<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lembaga_master extends Admin_Controller {

	private $_set_page;
	private $_list_session;

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['lembaga_master_model']);
		$this->modul_ini = 200;
		$this->sub_modul_ini = 35;
		$this->_set_page = ['20', '50', '100'];
		$this->_list_session = ['cari', 'filter'];
	}

	public function clear()
	{
		$this->session->unset_userdata($this->_list_session);
		$this->session->per_page = $this->_set_page[0];
		redirect('lembaga_master');
	}

	public function index($p = 1, $o = 0)
	{
		$data['p'] = $p;
		$data['o'] = $o;

		foreach ($this->_list_session as $list)
		{
			$data[$list] = $this->session->$list ?: '';
		}

		$per_page = $this->input->post('per_page');
		if (isset($per_page))
			$this->session->per_page = $per_page;

		$data['func'] = 'index';
		$data['set_page'] = $this->_set_page;
		$data['paging'] = $this->lembaga_master_model->paging($p, $o);
		$data['main'] = $this->lembaga_master_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['keyword'] = $this->lembaga_master_model->autocomplete();

		$this->set_minsidebar(1);
		$this->render('lembaga_master/table', $data);
	}

	public function form($id = '')
	{
		if ($id)
		{
			$data['lembaga_master'] = $this->lembaga_master_model->get_lembaga_master($id);
			$data['form_action'] = site_url("lembaga_master/update/$id");
		}
		else
		{
			$data['lembaga_master'] = NULL;
			$data['form_action'] = site_url("lembaga_master/insert");
		}

		$this->set_minsidebar(1);
		$this->render('lembaga_master/form', $data);
	}

	public function filter($filter)
	{
		$value = $this->input->post($filter);
		if ($value != "")
			$this->session->$filter = $value;
		else $this->session->unset_userdata($filter);
		redirect('lembaga_master');
	}

	public function insert()
	{
		$this->lembaga_master_model->insert();
		redirect('lembaga_master');
	}

	public function update($id = '')
	{
		$this->lembaga_master_model->update($id);
		redirect('lembaga_master');
	}

	public function delete($id = '')
	{
		$this->redirect_hak_akses('h');
		$this->lembaga_master_model->delete($id);
		redirect('lembaga_master');
	}

	public function delete_all()
	{
		$this->redirect_hak_akses('h');
		$this->lembaga_master_model->delete_all();
		redirect('lembaga_master');
	}

}
