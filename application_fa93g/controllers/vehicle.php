<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Vehicle extends CI_Controller {		
		
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
				if (! file_exists('application_fa93g/views/vehicle/' . $page . '.php'))
				{
					// Whoops, we don't have a page for that!
					show_404();
				}
				
				// Populate data
				$data['title'] = 'Add Vehicle'; 
				
				// Load libraries and helpers
				$this->load->library('form_validation');
				$this->load->helper('form');
				$this->load->helper('url');
				
				// Load views
				$this->load->view('templates/header', $data);
				$this->load->view('vehicle/menu' , $data);
				$this->load->view('vehicle/' . $page, $data);
				$this->load->view('templates/footer', $data);
		}
		
		public function validate($data)
		{
					// Set validation rules
					$rules = array(
										'name'				=> 'required|alpha_numeric|max_len,100|min_len,2',
										'vehicle_number'	=> 'required|alpha_numeric|max_len,100|min_len,2',
										'fuel_capacity'		=> 'required|numeric|max_len,3|min_len,1'
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
				
				$vehicles = $this->input->post('name');

				$i = 0;
				$data = array();
				foreach($vehicles as $vehicle)
				{
						$number = $this->input->post('vehicle_number');
						$capacity = $this->input->post('fuel_capacity');
						$temp = array('name' => $vehicle, 'vehicle_number' => $number[$i], 'fuel_capacity' => $capacity[$i]);
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
							$there = $this->sharedDB_model->get('vehicles', array('id'), array('name' => $datum['name'], 'vehicle_number' => $datum['vehicle_number']));
							
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
												'vehicle_number'	=> 'trim|sanitize_string',
												'fuel_capacity'		=> 'trim|sanitize_numbers'
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
							
								if($this->sharedDB_model->insert('vehicles', $sanitizedDatum) == 1)
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
								echo "All vehicles successfully inserted into the database!";
								echo "!</div>\n";
						}
						
				}
		}
		
		public function mileage($page='mileage')
		{
				$data = $this->data;
				if (! file_exists('application_fa93g/views/vehicle/' . $page . '.php'))
				{
					// Whoops, we don't have a page for that!
					show_404();
				}
				
				// Populate data
				$data['title'] = 'Add Fuel Data'; 
				$data['vehicles'] = $this->sharedDB_model->get('vehicles', array('id', 'name'), NULL, 'name ASC');
				
				// Load libraries and helpers
				$this->load->library('form_validation');
				$this->load->helper('form');
				$this->load->helper('url');
				
				// Load views
				$this->load->view('templates/header', $data);
				$this->load->view('vehicle/menu' , $data);
				$this->load->view('vehicle/' . $page, $data);
				$this->load->view('templates/footer', $data);
		}
		
		public function validate_mileage($data)
		{
			// Set validation rules
			$rules = array(
								'vehicle'				=> 'required|numeric|max_len,11|min_len,1',
								'odometer_reading'		=> 'required|numeric|max_len,8|min_len,1',
								'fuel_amount'			=> 'required|numeric|max_len,6|min_len,1',
								'date'					=> 'required|max_len,10|min_len,1',
								'do_not_use'			=> 'required|max_len,1|min_len,1'
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
		
		public function add_mileage()
		{
			// USE HTML PURIFIER
			
			
			// Libraries
			$this->load->library('dateconverter');
			
			// Build a nice little associative array for the data
			// Loop for each name to make sure multiple entries are dealt with.
			
			$odometerReadings = $this->input->post('odometer_reading');
			
			$i = 0;
			$data = array();
			foreach($odometerReadings as $odometerReading)
			{
				$date = $this->input->post('date');
				$date = $date[$i];
				$date = explode('-', $date);
				$date = $this->dateconverter->nep_to_eng($date[0], $date[1], $date[2]);
				$date = strtotime($date['year'] . '-' . $date['month'] . '-' . $date['date']);
				
				
				
				$vehicle = $this->input->post('vehicle');
				$amount = $this->input->post('fuel_amount');
				$do_not_use = $this->input->post('do_not_use');
				$temp = array('odometer_reading' => $odometerReading, 'vehicle' => $vehicle[$i], 'fuel_amount' => $amount[$i], 'date' => $date, 'do_not_use' => $do_not_use[$i]);
				$data[] = $temp;
				$i++;
			}
			
			// Validation
			
			$everythingGood = 1;	// We believe in the good!
			foreach($data as $datum)
			{
				$errors = $this->validate_mileage($datum);
				
				if($errors === true)
				{
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
										'vehicle'				=> 'trim|sanitize_numbers',
										'odometer_reading'		=> 'trim',
										'fuel_amount'			=> 'trim',
										'date'					=> 'trim',
										'do_not_use'			=> 'trim|sanitize_numbers',
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
					if($this->sharedDB_model->insert('mileage', $sanitizedDatum) == 1)
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
					echo "All mileage successfully inserted into the database!";
					echo "!</div>\n";
				}
				
			}
		}
		
	}