<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
		
		$this->load->library('grocery_CRUD');	
	}
	
	function _example_output($output = null)
	{
		$this->load->view('example.php',$output);	
	}
	
	function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}	
	
	function offices()

    {
        $output = $this->grocery_crud->render();
 
        $this->_example_output($output);

    }
	
	function jobs()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('tblkerja');
			$crud->set_subject('Tabel Kerja');
			$crud->set_rules('tempat_kerja', 'Tempat kerja', 'required|xss_clean');
			$crud->columns('tempat_kerja','tgl_kerja','durasi_kerja');
			
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	function alumni()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('tbluser');
			$crud->set_subject('Alumni');
			$crud->required_fields('name');
			$crud->set_rules('nama', 'Nama', 'required|xss_clean');
					
			$crud->set_field_upload('foto','assets/uploads/images');
		
			$output = $crud->render();

			$this->_example_output($output);
	}
	
	function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}
	
}