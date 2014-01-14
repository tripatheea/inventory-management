<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Transaction extends CI_Controller {
			
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
					
					$this->load->model('transaction_model');
			}
			
			public function add( $page = 'add' )
			{
					$data = $this->data;
					if ( ! file_exists( 'application_fa93g/views/transaction/'.$page.'.php' ) ){
							// Whoops, we don't have a page for that!
							show_404();
					}
					$data['title'] = 'Add Transaction'; 
					// Load libraries and helpers
					$this->load->helper('form');
					$this->load->helper('url');
					$this->load->library('form_validation');
					// Load views
					$this->load->view('templates/header', $data);
					$this->load->view('transaction/' . $page, $data);
					$this->load->view('templates/footer', $data);
			}

			public function autocomplete_customer()
			{
					$searchTerm = $this->input->get('term');
					$findings = $this->transaction_model->autocomplete_customer($searchTerm);
					$allFindings = array();
					//foreach ($findings as $finding) $allFindings[] = $finding['name'] . ' (' . $finding['reg_number'] . ', ' . $finding['alternate_id'] . ', ' . $finding['type'] . ' )';
					foreach ($findings as $finding) $allFindings[] = $finding['name'];
					echo json_encode($allFindings);
			}
		
			public function autocomplete_inventory()
			{
					$searchTerm = $this->input->get('term');
					$findings = $this->transaction_model->autocomplete_inventory($searchTerm);
					$allFindings = array();
					//foreach ($findings as $finding) $allFindings[] = $finding['name'] . ' ( ' . $finding['code'] . ' )';
					foreach ($findings as $finding)
					{
							if($finding['quantity'] > 0)
							{
									$allFindings[] = $finding['name'];
							}
					}
					$allFindings = array_unique($allFindings);
					echo json_encode($allFindings);
			}
			
			public function autocomplete_inventory_for_reports()
			{
					// The only difference to the method above is that for this one, the quantity isn't taken into consideration. I mean, even the inventory which has 0 stock is shown here.
					$searchTerm = $this->input->get('term');
					$findings = $this->transaction_model->autocomplete_inventory($searchTerm);
					$allFindings = array();
					//foreach ($findings as $finding) $allFindings[] = $finding['name'] . ' ( ' . $finding['code'] . ' )';
					foreach ($findings as $finding)
					{
							$allFindings[] = $finding['name'];
					}
					$allFindings = array_unique($allFindings);
					echo json_encode($allFindings);
			}
			
			public function get_inventory()
			{
					$name = $this->input->post('name');
					$customer = $this->input->post('customer');
					
					// SANITIZE
					
					$this->load->model('inventory_model');
					
					$details = $this->inventory_model->get_inventory(array('inventory.id', 'inventory.name'), array('inventory.name' => $name), NULL, NULL, 'inventory.added_on desc');
					$details = $details[0];
					$customerType = $this->sharedDB_model->get('customers', array('type'), array('name' => $customer));
					$customerType = $customerType[0]['type'];
					
					/*
					 * So, we've got the inventory here. All we have here is actually the inventory name.
					 * Now we need to get a stock.
					 * In fact, it's where FIFO and LIFO comes in place.
					 * 
					 */
					
					/* 
					 * Now, let's get all stocks of current inventory.
					 * This is the actual place where we determine FIFO / FILO.
					 * It's actually determined by whether we arrange the table entries below in asscending or descending order of the dates they were added on.
					 * asc => FIFO
					 * desc => LIFO
					 */
					
					$allStocks = $this->sharedDB_model->get('stock', array('id', 'cp', 'sp', 'quantity'), array('inventory_id' => $details['id'], 'quantity >' => 0 ), 'added_on asc');
					
					/* 
					 * We select the first stock now. 
					 * Why? You ask. Well irrespective of whether it's FIFO or LIFO we want, the arrangement done in the SQL query above has already put the required stock on the top.
					 * The following line could have been omitted but is here for clarity.
					 * 
					 */
					
					if(count($allStocks) >= 1)
					{
							$latestStock = $allStocks[0]; // The key '0' here is intentional. Don't mess it here!
					}
					else
					{
							$latestStock = NULL;
					}
					
					// Bind the selling price of the latest stock we've got to the inventory array we've got above.
					$details['quantity'] = $latestStock['quantity'];
					
					/*
					 * If customer type is Department, sell at the cost price.
					 * Else, sell at the selling price.
					 * 
					 * First, find the customer ID of the type 'Department'.
					 * 
					 * Then, compare the current customer ID with this ID.
					 * 
					 */
					
					$departmentCustomerID = $this->sharedDB_model->get('customer_type', array('id'), array('name' => 'Department' ));
					$departmentCustomerID = $departmentCustomerID[0]['id'];
					
					if($customerType == $departmentCustomerID)
					{
							// Current customer type is department.
							$details['sp'] = $latestStock['cp'];
					}
					else
					{
							// Current customer type is NOT department.
							$details['sp'] = $latestStock['sp'];
					}
					$details['id'] = $latestStock['id'];
					
					echo json_encode($details);
			}
			
			public function get_customer()
			{
					$name = $this->input->post('name');
					
					// SANITIZE
					
					$details = $this->sharedDB_model->get('customers', array('id', 'name', 'code', 'reg_number', 'alternate_id', 'type'), array('name' => $name));
					$details = $details[0];
					echo json_encode($details);
			}
			
			public function number_to_words()
			{
					$this->load->library('NumberToWords');
					$number = $this->input->post('number');
					
					// SANITIZE
					
					echo $this->numbertowords->convert($number);
			}
			
			public function add_transaction()
			{
					$data = $this->input->post('invoice');
					$customerID = $data['customer'];
					$stock = $data['inventory'];
					
					$invoice = array();
					
					// GET PAYMENT TYPE AS WELL
					
					// VALIDATE. AND SANITIZE
					// VALIDATE. AND SANITIZE
					
					$customerDetails = $this->sharedDB_model->get('customers', array('id', 'code', 'reg_number', 'alternate_id', 'name', 'type'), array('id' => $customerID));
					$customerDetails = $customerDetails[0];
					
					$invoice['customer'] = $customerDetails;
					$invoice['customer']['type'] = $this->sharedDB_model->get('customer_type', array('name'), array('id' => $invoice['customer']['type']));
					$invoice['customer']['type'] = $invoice['customer']['type'][0]['name'];
					
					$invoice['inventory'] = array();
					$i = 0;
					foreach($stock as $sto)
					{
							/* 
							 * So we have an array called $sto which contains two things:
							 * 1) Stock ID. 
							 * 2) Quantity
							 * 
							 * Let me be clear. It's stock ID and not inventory ID.
							 * 
							 * First we need to find stock code, CP, SP, quantity, warehouse and supplier.
							 * Then, the corresponding inventory ID, code and name.
							 * 
							 */
							
							$invoice['inventory'][$i] = $this->sharedDB_model->get('stock', array('id', 'code', 'inventory_id', 'cp', 'sp', 'warehouse', 'supplier'), array('id' => $sto['id']));
							$invoice['inventory'][$i] = $invoice['inventory'][$i][0];
							
							$dummy = $this->sharedDB_model->get('inventory', array('code', 'name'), array('id' => $invoice['inventory'][$i]['inventory_id']));
							$dummy = $dummy[0];
							
							$invoice['inventory'][$i]['quantity'] = $sto['quantity'];
							
							$invoice['inventory'][$i]['name'] = $dummy['name'];
							$invoice['inventory'][$i]['inventory_code'] = $dummy['code'];
							
							// Warehouse
							$invoice['inventory'][$i]['warehouse'] = $this->sharedDB_model->get('warehouse', array('id', 'code', 'name', 'location1', 'location2'), array('id' => $invoice['inventory'][$i]['warehouse']));
							$invoice['inventory'][$i]['warehouse'] = $invoice['inventory'][$i]['warehouse'][0];
							
							// Supplier
							$invoice['inventory'][$i]['supplier'] = $this->sharedDB_model->get('suppliers', array('id', 'code', 'name', 'address1', 'address2', 'phone1', 'phone2', 'phone3', 'email', 'website'), array('id' => $invoice['inventory'][$i]['supplier']));
							$invoice['inventory'][$i]['supplier'] = $invoice['inventory'][$i]['supplier'][0];
							$i++;
					}
					$sanitizedDatum = array();
					$sanitizedDatum['invoice'] = json_encode($invoice);
					$sanitizedDatum['customer'] = $invoice['customer']['id'];
					
					// Generate Code.
					$this->load->helper('generate_code');
					$sanitizedDatum['code'] = generate_code($this->router->class);
					
					if($this->sharedDB_model->insert('invoices', $sanitizedDatum) == 1)
					{
							// Also decrease the stock quantity by the quantity set to the corresponding inventory.
							// Not done above to make sure data has actually been inserted into the database.
							
							foreach($invoice['inventory'] as $invent)
							{
									// Correct this
									$currentStock = $this->sharedDB_model->get('stock', array('quantity'), array('id' => $invent['id']));
									$currentStock = $currentStock[0]['quantity'];
									$newStock = $currentStock - $invent['quantity'];
									$this->sharedDB_model->update('stock', array('quantity' => $newStock), array('id' => $invent['id']));
							}
							
							echo '1';	// Confirmition message sent to the view so that it can clear all fields on screen.
					}
					
					
			}
			
			public function show_invoice()
			{
					echo 'bazinga';
					echo '<script>';
						echo "alert('bazinga');";
					echo '</script>';
			}
	}