<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Warehouse extends CI_Controller 
	{
		
		private $data;
		
		public function __construct()
		{
				parent::__construct();
				
				// Libraries and helpers and models.
				$this->load->helper('url');
				$this->load->helper('permission_manager');
				$this->load->library('validation');
				$this->load->model('sharedDB_model');
				$this->data = permission_manager();
		}
		
		public function add($page = 'add')
		{
				$data = $this->data;
				if (! file_exists('application_fa93g/views/warehouse/' . $page . '.php'))
				{
					// Whoops, we don't have a page for that!
					show_404();
				}
				
				// Populate data
				$data['title'] = 'Add Warehouse'; 
				
				// Load libraries and helpers
				$this->load->library('form_validation');
				$this->load->helper('form');
				$this->load->helper('url');
				
				// Load views
				$this->load->view('templates/header', $data);
				$this->load->view('warehouse/menu' , $data);
				$this->load->view('warehouse/' . $page, $data);
				$this->load->view('templates/footer', $data);
		}
		
		public function get_warehouse($condition = array())
		{
			// Load libraries and helpers
			$this->load->library('form_validation');
			
			// Validation
			
			// Load model
			$this->load->model('Shared_DB','',TRUE);
			$this->load->model('Warehouse','',TRUE);
			
			// Get data
			return $this->warehouse_model->get_warehouse( $condition );
		}
		
		public function validate($data)
		{
			// Set validation rules
			$rules = array(
			'name'				=> 'required|alpha_numeric|max_len,100|min_len,2',
			'location1'			=> 'required|alpha_numeric|max_len,100|min_len,2',
			'location2'			=> 'required|alpha_numeric|max_len,100|min_len,2'
			);			
			$this->validation->validation_rules($rules);
			$validatedData = $this->validation->run($data);
			if($validatedData === false)
			{
				// Validation failed meaning invalid entries found
				return $this->validation->get_readable_errors(false);
			} 
			else 
			{
				// Validation successful
				return true;
			}
		}
		
		public function add_data()
		{
			// USE HTML PURIFIER
			
			// Build a nice little associative array for the data
			// Loop for each name to make sure multiple entries are dealt with.
			
			$warehouses = $this->input->post('name');
			
			$i = 0;
			$data = array();
			foreach($warehouses as $warehouse)
			{
			
				$location2 = $this->input->post('location2');
				$location1 = $this->input->post('location1');
				$temp = array('name' => $warehouse, 'location1' => $location1[$i], 'location2' => $location2[$i]);
				$data[] = $temp;
				$i++;
			}
			
			// Validation
			
			$everythingGood = 1;	// We believe in the good!
			foreach($data as $datum)
			{
				$errors = $this->validate($datum);
				
				if($errors === true)
				{	
					// Check for redundancy.
					$there = $this->sharedDB_model->get('warehouse', array('id'), array('name' => $datum['name']));
					
					if(count($there) > 0)
					{
						echo "<div class='alert alert-error fade in'>";
						echo "<button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Oh Snap! </strong>";
						echo "The data you tried to enter already exist in the database.";
						echo "!</div>\n";
						die();
					}
					
					// Everything is good!
				}
				else
				{
					// There are errors. Set the error flag
					$everythingGood = $everythingGood * 0;
					
					// Show error message/s
					foreach( $errors as $error )
					{
						echo "<div class='alert alert-error fade in'>";
						echo "<button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Oh Snap! </strong>";
						echo $error;
						echo "!</div>\n";
					}
					// Stop operation.
					break;								
				}
			}
			
			// Check if everything is good and if it is, sanitize and filter everything.
			
			if($everythingGood == 1)
			{
				// Filter rules
				$filterRules = array(
				'name'				=> 'trim|sanitize_string',
				'location1'			=> 'trim|sanitize_string',
				'location2'			=> 'trim|sanitize_string'
				);
				
				// Sanitize and filter data.
				$sanitizedData = array();
				foreach($data as $datum)
				{
					$datum = $this->validation->sanitize($datum);
					$sanitizedData[] = $this->validation->filter($datum, $filterRules);
				}
				
				// Sanitization and all complete. Insert data into the database now.
				$dbGood = 1;
				foreach($sanitizedData as $sanitizedDatum)
				{
					// Generate Code.
					$this->load->helper('generate_code');
					$sanitizedDatum['code'] = generate_code($this->router->class);
					
					if($this->sharedDB_model->insert('warehouse', $sanitizedDatum) == 1)
					{
						$dbGood = $dbGood * 1;
					}
					else
					{
						$dbGood = $dbGood * 0;
					}
				}
				
				// Check if all data has been inserted into the database and show success message!
				if($dbGood == 1)
				{
					echo "<div class='alert alert-success fade in'>";
					echo "<button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Well Done! </strong>";
					echo "All warehouse successfully inserted into the database!";
					echo "!</div>\n";
				}
				
			}
		}

	}