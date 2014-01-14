<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Reports extends CI_Controller 
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
			
			public function stock()
			{
					$data = $this->data;
					if (! file_exists('application_fa93g/views/reports/stock.php'))
					{
						// Whoops, we don't have a page for that!
						show_404();
					}
					
					// Libraries
					$this->load->library('dateconverter');
					
					// Load models
					$this->load->model('sharedDB_model');
					
					// Populate data
					$data['title'] = 'Stocks Report'; 
					$allInventory = $this->sharedDB_model->get('inventory', array('id', 'code', 'name', 'added_on'), NULL, 'name ASC'); 
					
					$inventories = array();
					foreach($allInventory as $inventory)
					{
							// Manipulate dates.
							$inventory['added_on_nepali'] = $this->dateconverter->eng_to_nep(date('Y', $inventory['added_on']), date('m', $inventory['added_on']), date('j', $inventory['added_on']));
							$inventory['added_on'] = date('G:i:s (D, j M, Y)', $inventory['added_on']);
							
							// Get all stocks of current inventory.
							$allStocks = $this->sharedDB_model->get('stock', array('code', 'cp', 'sp', 'quantity', 'warehouse', 'supplier', 'added_on'), array('inventory_id' => $inventory['id']), 'added_on asc'); 
							$stocks = array();
							foreach($allStocks as $stock)
							{
							
									$stock['warehouse'] = $this->sharedDB_model->get('warehouse', array('code', 'name'), array('id' => $stock['warehouse']));
									$stock['warehouse'] = $stock['warehousse'][0];
									$stock['supplier'] = $this->sharedDB_model->get('suppliers', array('code', 'name'), array('id' => $stock['supplier']));
									$stock['supplier'] = $stock['supplier'][0];
									$stock['added_on_nepali'] = $this->dateconverter->eng_to_nep(date('Y', $stock['added_on']), date('m', $stock['added_on']), date('j', $stock['added_on']));
									$stock['added_on'] = date('G:i:s <b\\r> (D, j M, Y)', $stock['added_on']);
									$stocks[] = $stock;
							}
							
							$inventory['stocks'] = $stocks;
							$inventories[] = $inventory;
					}
					
					$data['inventory'] = $inventories;
					
					// Load views
					$this->load->view('templates/header', $data);
					$this->load->view('reports/stock.php', $data);
					$this->load->view('templates/footer', $data);
			}
			
			public function quantity()
			{
					$data = $this->data;
					if (! file_exists('application_fa93g/views/reports/stock.php'))
					{
						// Whoops, we don't have a page for that!
						show_404();
					}
					
					// Libraries
					$this->load->library('dateconverter');
					
					// Load models
					$this->load->model('sharedDB_model');
					
					// Populate data
					$data['title'] = 'Stocks Report'; 
					$allInventory = $this->sharedDB_model->get('inventory', array('id', 'code', 'name', 'added_on'), NULL, 'name ASC'); 
					
					$inventories = array();
					foreach($allInventory as $inventory)
					{
						
						
						// Manipulate dates.
						$inventory['added_on_nepali'] = $this->dateconverter->eng_to_nep(date('Y', $inventory['added_on']), date('m', $inventory['added_on']), date('j', $inventory['added_on']));
						$inventory['added_on'] = date('G:i:s (D, j M, Y)', $inventory['added_on']);
						
						// Get all stocks of current inventory.
						$allStocks = $this->sharedDB_model->get('stock', array('code', 'cp', 'sp', 'quantity', 'initial_quantity', 'warehouse', 'supplier', 'added_on'), array('inventory_id' => $inventory['id']), 'added_on asc'); 
						
						$inventory['quantity'] = 0;
						$inventory['initial_quantity'] = 0;
						foreach($allStocks as $stock)
						{
							$inventory['quantity'] += $stock['quantity'];
							$inventory['initial_quantity'] += $stock['initial_quantity'];
						}
						
						$inventories[] = $inventory;
					}
					
					$data['inventory'] = $inventories;
					
					// Load views
					$this->load->view('templates/header', $data);
					$this->load->view('reports/quantity.php', $data);
					$this->load->view('templates/footer', $data);
			}
			
			public function transaction()
			{
				$data = $this->data;
				if (! file_exists('application_fa93g/views/reports/transaction.php'))
				{
					// Whoops, we don't have a page for that!
					show_404();
				}
				
				// Libraries
				$this->load->helper('url');
				
				
				// Populate data
				$data['title'] = 'Transaction Report';
				
				// Load views
				$this->load->view('templates/header', $data);
				$this->load->view('reports/transaction.php', $data);
				$this->load->view('templates/footer', $data);
			}
			
			public function transaction_by_inventory()
			{
					$inventoryName = $this->input->post('inventory');
					
					$from = $this->input->post('from');
					$to = $this->input->post('to');
					
					// VALIDATE. AND SANITIZE.
					// VALIDATE. AND SANITIZE.
					
					// Libraries
					$this->load->library('dateconverter');
					
					$from = $this->input->post('from');
					$to = $this->input->post('to');
					
					// VALIDATE. AND SANITIZE.
					// VALIDATE. AND SANITIZE.
					
					$from = explode('-', $from);
					$to = explode('-', $to);
					
					$from = $this->dateconverter->nep_to_eng($from[0], $from[1], $from[2]);
					$from = $from['year'] . '-' . $from['month'] . '-' . $from['date'];
					$from = strtotime($from);
					
					$to = $this->dateconverter->nep_to_eng($to[0], $to[1], $to[2]);
					$to = $to['year'] . '-' . $to['month'] . '-' . $to['date'];
					$to = strtotime($to);
										
					// Get all inventory details (row) from the above data.
					$inventoryDetails = $this->sharedDB_model->get('inventory', array('id', 'code', 'name'), array('name' => $inventoryName));
					$inventoryDetails = $inventoryDetails[0];
					$inventoryID = $inventoryDetails['id'];
					
					// Get all invoices now.
					$allInvoices =  $this->sharedDB_model->get('invoices', array('id', 'code', 'customer', 'invoice', 'added_on'), array('added_on >' => $from, 'added_on <' => $to), 'added_on desc');
					
					$allInventory = array();
					foreach($allInvoices as $invoice)
					{
							$invoiceDetails = json_decode($invoice['invoice']);
							$allInvents = $invoiceDetails->inventory;
							foreach($allInvents as $invent)
							{
									if($invent->inventory_id === $inventoryID)
									{
											$allInventory[] = array(
																		'code' 					=> $invoice['code'],
																		'customer' 				=> get_object_vars($invoiceDetails->customer),
																		'cp'	 				=> $invent->cp,
																		'sp'	 				=> $invent->sp,
																		'stock' 				=> $invent->id,
																		'quantity' 				=> $invent->quantity,
																		'nepali_date' 			=> $this->dateconverter->eng_to_nep(date('Y', $invoice['added_on']), date('m', $invoice['added_on']), date('j', $invoice['added_on'])),
																		'added_on' 				=> date('G:i:s <b\\r> D, j M, Y', $invoice['added_on'])											
																	);
									}
							}
					}
					
					?>
					<div class="container">
						<div style="width: 7%; float: left; text-align: right; margin-right: 5px;">
							<div class="title">Name:</div>
							<div class="title">Code:</div>
						</div>
						
						<div style="width: 91%; float: left;">
							<div class="value">&nbsp;<?php echo $inventoryDetails['name'] ?></div>
							<div class="value">&nbsp;<?php echo $inventoryDetails['code'] ?></div>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<hr>
					
					<div class="container">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th style='width: 20px;'>S.No.</th>
									<th style='width: 100px;'>Invoice Code</th>
									<th style='width: 320px;'>Customer</th>
									<th style='width: 60px;'>Rate</th>
									<th style='width: 80px;'>Quantity</th>
									<th style='width: 80px;'>Total</th>
									<th style='width: 100px;'>Date (Gregorian)</th>
									<th style='width: 100px;'>Date (Nepali)</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$i = 1;
								foreach($allInventory as $inventory)
								{
								?>
											<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $inventory['code']; ?></td>
													<td><?php echo "<u>" . $inventory['customer']['name'] . "</u><br>Code: " . $inventory['customer']['code']  . "<br>Reg No.: " . $inventory['customer']['reg_number'] . "<br>Alternate ID: " . $inventory['customer']['alternate_id'] . "<br>Type: " . $inventory['customer']['type']; ?></td>
													<td style='text-align: right;'>रू <?php echo $inventory['sp']; ?></td>
													<td style='text-align: right;'><?php echo $inventory['quantity']; ?></td>
													<td style='text-align: right;'>रू <?php echo $inventory['sp'] * $inventory['quantity']; ?></td>
													<td style='text-align: center;'><?php echo $inventory['added_on']; ?></td>
													<td style='text-align: center;'><?php echo $inventory['nepali_date']['date'] . ' ' . $inventory['nepali_date']['nmonth'] . ', ' . $inventory['nepali_date']['year']; ?></td>
											</tr>
								<?php
									$i++;
								}
								?>
							</tbody>
						</table>
					</div><!--/.container -->
					
					<?php
			}
			
			public function transaction_by_customer()
			{
				$customerName = $this->input->post('customer');
				
				// VALIDATE. AND SANITIZE.
				
				// Libraries
				$this->load->library('dateconverter');
				
				$from = $this->input->post('from');
				$to = $this->input->post('to');
				
				// VALIDATE. AND SANITIZE.
				// VALIDATE. AND SANITIZE.
				
				$from = explode('-', $from);
				$to = explode('-', $to);
				
				$from = $this->dateconverter->nep_to_eng($from[0], $from[1], $from[2]);
				$from = $from['year'] . '-' . $from['month'] . '-' . $from['date'];
				$from = strtotime($from);
				
				$to = $this->dateconverter->nep_to_eng($to[0], $to[1], $to[2]);
				$to = $to['year'] . '-' . $to['month'] . '-' . $to['date'];
				$to = strtotime($to);
				
				// Get Customer Details
				$customerDetails = $this->sharedDB_model->get('customers', array('id', 'code', 'reg_number', 'alternate_id', 'name', 'type'), array('name' => $customerName));
				$customerDetails = $customerDetails[0];
				$customerDetails['type'] = $this->sharedDB_model->get('customer_type', array('code', 'name'), array('id' => $customerDetails['type']));
				$customerDetails['type'] = $customerDetails['type'][0];
				
				// Get all transactions of current customer.
				$allTransactions = $this->sharedDB_model->get('invoices', array('code', 'invoice', 'added_by', 'added_on'), array('customer' => $customerDetails['id'], 'added_on >' => $from, 'added_on <' => $to));
				
				?>
					<div class="container">
						<div style="width: 7%; float: left; text-align: right; margin-right: 5px;">
								<div class="title">Name:</div>
								<div class="title">Code:</div>
								<div class="title">Reg No.:</div>
								<div class="title">Alternate ID:</div>
								<div class="title">Type:</div>
						</div>
						
						<div style="width: 91%; float: left;">
								<div class="value">&nbsp;<?php echo $customerDetails['name']; ?></div>
								<div class="value">&nbsp;<?php echo $customerDetails['code']; ?></div>
								<div class="value">&nbsp;<?php echo $customerDetails['reg_number']; ?></div>
								<div class="value">&nbsp;<?php echo $customerDetails['alternate_id']; ?></div>
								<div class="value">&nbsp;<?php echo $customerDetails['type']['name']; ?></div>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<hr>
					
					<div class="container">
							<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th style='width: 20px;'>S.No.</th>
											<th style='width: 100px;'>TXN Code</th>
											<th style='width: 320px;'>Particulars</th>
											<th style='width: 60px;'>Quantity</th>
											<th style='width: 80px;'>Rate</th>
											<th style='width: 80px;'>Total</th>
											<th style='width: 100px;'>Date (Gregorian)</th>
											<th style='width: 100px;'>Date (Nepali)</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$i = 1;
										foreach($allTransactions as $transaction)
										{
											$invoice = json_decode($transaction['invoice']);
											$inventory = $invoice->inventory;
											$inventoryNumber = count($inventory);
											$nepaliDate = $this->dateconverter->eng_to_nep(date('Y', $transaction['added_on']), date('m', $transaction['added_on']), date('j', $transaction['added_on']));
										?>
											<tr>
													<td rowspan="<?php echo $inventoryNumber; ?>"><?php echo $i; ?></td>
													<td rowspan="<?php echo $inventoryNumber; ?>"><?php echo $transaction['code']; ?></td>
													<td><?php echo $inventory[0]->name; ?></td>
													<td style='text-align: right;'><?php echo $inventory[0]->quantity; ?></td>
													<td style='text-align: right;'>रू <?php echo $inventory[0]->sp; ?></td>
													<td style='text-align: right;'>रू <?php echo ($inventory[0]->sp * $inventory[0]->quantity); ?></td>
													<td style='text-align: center;' rowspan="<?php echo $inventoryNumber; ?>"><?php echo date('G:i:s <b\\r> D, j M, Y', $transaction['added_on']); ?></td>
													<td style='text-align: center;' rowspan="<?php echo $inventoryNumber; ?>"><?php echo $nepaliDate['date'] . ' ' . $nepaliDate['nmonth'] . ', ' . $nepaliDate['year']; ?></td>
											</tr>
												<?php
													for($j = 1; $j < $inventoryNumber; $j++)
													{
													?>
														<tr>
																<td><?php echo $inventory[$j]->name; ?></td>
																<td style='text-align: right;'><?php echo $inventory[$j]->quantity; ?></td>
																<td style='text-align: right;'>रू <?php echo $inventory[$j]->sp; ?></td>
																<td style='text-align: right;'>रू <?php echo ($inventory[$j]->sp * $inventory[$j]->quantity); ?></td>
														</tr>
													<?php
													}
													?>

										<?php
										$i++;
										}
									?>
									</tbody>
							</table>
								
					</div><!--/.container -->
				
				<?php
			}
			
			public function fuel()
			{
					$data = $this->data;
					if (! file_exists('application_fa93g/views/reports/fuel.php'))
					{
						// Whoops, we don't have a page for that!
						show_404();
					}
					
					// Libraries
					$this->load->library('dateconverter');
					
					// Load models
					$this->load->model('sharedDB_model');
					
					// Populate data
					$data['title'] = 'Fuel Report';
					
					$data['vehicles'] = $this->sharedDB_model->get('vehicles', array('name', 'vehicle_number', 'fuel_capacity'), array());
					
					// DO NOT CHANGE THE ORDER BELOW FROM ASC TO DESC.
					// IT WILL SCREW UP THE DISTANCE CALCULATIONS
					$allRefuelingsDummy = $this->sharedDB_model->get('mileage', array('vehicle', 'fuel_amount', 'odometer_reading', 'date', 'do_not_use', 'added_on'), array(), 'date asc');
					
					$allRefuelings = array();
					foreach($allRefuelingsDummy as $refueling)
					{
							$refueling['vehicle'] = $this->sharedDB_model->get('vehicles', array('id', 'name', 'vehicle_number', 'fuel_capacity'), array('id' => $refueling['vehicle']));
							$refueling['vehicle'] = $refueling['vehicle'][0];
							$refuelingDate = explode('-', $refueling['date']);
							$refueling['date_exact'] = $refueling['date'];
							$refueling['date'] = date('D, j M, Y', $refueling['date']);
							$refueling['date_nepali'] = $this->dateconverter->eng_to_nep(date('Y', $refueling['date_exact']), date('m', $refueling['date_exact']), date('j', $refueling['date_exact']));
							$refueling['added_on_nepali'] = $this->dateconverter->eng_to_nep(date('Y', $refueling['added_on']), date('m', $refueling['added_on']), date('j', $refueling['added_on']));
							$refueling['added_on'] = date('G:i:s <b\\r> D, j M, Y', $refueling['added_on']);
							$allRefuelings[] = $refueling;
					}
					
					$allVehicleData = array();
					foreach($allRefuelings as $refueling)
					{
							$allVehicleData[$refueling['vehicle']['id']][] = $refueling;
					}
					
					$data['allVehicleData'] = $allVehicleData;
					
					// Load views
					$this->load->view('templates/header', $data);
					$this->load->view('reports/fuel.php', $data);
					$this->load->view('templates/footer', $data);
			}
			
			function invoice()
			{
					$data = $this->data;
					if (! file_exists('application_fa93g/views/reports/invoice.php'))
					{
						// Whoops, we don't have a page for that!
						show_404();
					}
					
					// Libraries
					$this->load->helper('url');	
					
					// Load models
					$this->load->model('sharedDB_model');
					
					// Populate data
					$data['title'] = 'Customers Transaction Report';
					
					$allCustomerTypes = $this->sharedDB_model->get('customer_type', array('id', 'name'), NULL);
					$allGradeLevels = $this->sharedDB_model->get('grade_levels', array('id', 'name'), NULL, 'added_on asc');
				
					$data['allCustomerTypes'] = $allCustomerTypes;
					$data['allGradeLevels'] = $allGradeLevels;
					
					// DO NOT CHANGE THE ORDER BELOW FROM ASC TO DESC.
					// IT WILL SCREW UP THE DISTANCE CALCULATIONS
					
					
					// Load views
					$this->load->view('templates/header', $data);
					$this->load->view('reports/invoice.php', $data);
					$this->load->view('templates/footer', $data);
			}
			
			function invoice_expenses()
			{
					// Libraries
					$this->load->library('dateconverter');
					// Load models
					$this->load->model('sharedDB_model');
					
					$from = $this->input->post('from');
					$to = $this->input->post('to');
					$customerType = $this->input->post('customerType');
					
					// Get ID of customer type = student.
					$studentCustomer = $this->sharedDB_model->get('customer_type', array('id'), array('name' => 'Student'));
					$studentCustomer = $studentCustomer[0]['id'];
					
					/*
					 * Check the current customer type.
					 * If it's student, it's fine.
					 * Else, assign gradeLevel as 0.
					 * 
					 */
					
					$gradeLevel = ($customerType == $studentCustomer) ? $gradeLevel = $this->input->post('gradeLevel') : $gradeLevel = 0;
					
					// VALIDATE. AND SANITIZE.
					// VALIDATE. AND SANITIZE.
					
					$from = explode('-', $from);
					$to = explode('-', $to);
					
					$from = $this->dateconverter->nep_to_eng($from[0], $from[1], $from[2]);
					$from = $from['year'] . '-' . $from['month'] . '-' . $from['date'];
					$from = strtotime($from);
					
					$to = $this->dateconverter->nep_to_eng($to[0], $to[1], $to[2]);
					$to = $to['year'] . '-' . $to['month'] . '-' . $to['date'];
					$to = strtotime($to);
					
					/*
					 * Check the customer type.
					 * If it's all, have a NULL condition for the SQL query.
					 * 
					 */
					$allCstmrs = ($customerType == -1) ? $this->sharedDB_model->get('customers', array('id', 'code', 'reg_number', 'alternate_id', 'name', 'grade_level'), NULL, 'grade_level asc, name asc') : $this->sharedDB_model->get('customers', array('id', 'code', 'reg_number', 'alternate_id', 'name', 'grade_level'), array('type' => $customerType, 'grade_level' => $gradeLevel), 'grade_level asc, name asc');
										
					$allCustomers = array();
					foreach($allCstmrs as $currentCustomer)
					{
						$currentCustomerTotal = 0;
						$invoices = $this->sharedDB_model->get('invoices', array('code', 'invoice', 'added_on'), array('customer' => $currentCustomer['id'], 'added_on >' => $from, 'added_on <' => $to));
						foreach($invoices as $invoice)
						{
								$invoice = json_decode($invoice['invoice']);
								$stuff = $invoice->inventory;
								foreach($stuff as $currentStuff)
								{
										$currentCustomerTotal += $currentStuff->sp * $currentStuff->quantity;
								}
								
						}
						$currentCustomer['total'] = $currentCustomerTotal;
						$allCustomers[] = $currentCustomer;
					}
					?>					
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th style='width: 20px;'>S.No.</th>
									<th style='width: 100px;'>Code</th>
									<th style='width: 320px;'>Name</th>
									<th style='width: 60px;'>Reg. No.</th>
									<th style='width: 80px;'>Alternate ID</th>
									<th style='width: 80px;'>Total</th>
								</tr>
							</thead>
							<tbody>
							
							<?php
								$i = 1;
								foreach($allCustomers as $customer)
								{
									?>
										<tr>
												<td style='text-align: center;'><?php echo $i; ?></td>
												<td style='text-align: left;'><?php echo $customer['code']; ?></td>
												<td style='text-align: left;'><?php echo $customer['name']; ?></td>
												<td style='text-align: left;'><?php echo $customer['reg_number']; ?></td>
												<td style='text-align: left;'><?php echo $customer['alternate_id']; ?></td>
												<td style='text-align: right;'>रू <?php echo $customer['total']; ?></td>
										</tr>
							<?php
									$i++;
								}
							?>
							</tbody>
						</table>
						<?php
			}

			
			function invoice_invoices()
			{
				// Libraries
				$this->load->library('dateconverter');
				// Load models
				$this->load->model('sharedDB_model');
				
				$from = $this->input->post('from');
				$to = $this->input->post('to');
				$gradeLevel = $this->input->post('gradeLevel');
				$customerType = $this->input->post('customerType');
				
				/*
				 * Check the current customer type.
				 * If it's student, it's fine.
				 * Else, assign gradeLevel as 0.
				 * 
				 */
				
				// Get ID of customer type = student.
				$studentCustomer = $this->sharedDB_model->get('customer_type', array('id'), array('name' => 'Student'));				
				$studentCustomer = $studentCustomer[0]['id'];
				$gradeLevel = ($customerType == $studentCustomer) ? $gradeLevel = $this->input->post('gradeLevel') : $gradeLevel = 0;
				
				// VALIDATE. AND SANITIZE.
				// VALIDATE. AND SANITIZE.
				
				$from = explode('-', $from);
				$to = explode('-', $to);
				
				$from = $this->dateconverter->nep_to_eng($from[0], $from[1], $from[2]);
				$from = $from['year'] . '-' . $from['month'] . '-' . $from['date'];
				$from = strtotime($from);
				
				$to = $this->dateconverter->nep_to_eng($to[0], $to[1], $to[2]);
				$to = $to['year'] . '-' . $to['month'] . '-' . $to['date'];
				$to = strtotime($to);
				
				/*
				 * Check the customer type.
				 * If it's all, have a NULL condition for the SQL query.
				 * 
				 */
				$allCstmrs = ($customerType == -1) ? $this->sharedDB_model->get('customers', array('id', 'code', 'reg_number', 'alternate_id', 'name', 'grade_level'), NULL, 'grade_level asc, name asc') : $this->sharedDB_model->get('customers', array('id', 'code', 'reg_number', 'alternate_id', 'name', 'grade_level'), array('type' => $customerType, 'grade_level' => $gradeLevel), 'grade_level asc, name asc');
				
				$allCustomers = array();
				foreach($allCstmrs as $currentCustomer)
				{
					$currentCustomer['invoices'] = $this->sharedDB_model->get('invoices', array('code', 'invoice', 'added_on'), array('customer' => $currentCustomer['id'], 'added_on >' => $from, 'added_on <' => $to));
					$allCustomers[] = $currentCustomer;
				}
				
				foreach($allCustomers as $customer)
				{
					if(count($customer['invoices']) != 0)
					{
					?>
						<hr>
						
						<div style="width: 7%; float: left; text-align: right; margin-right: 5px;">
							<div class="title">Name:</div>
							<div class="title">Code:</div>
							<div class="title">Reg No.:</div>
							<div class="title">Alternate ID:</div>
						</div>
						
						<div style="width: 91%; float: left;">
							<div class="value">&nbsp;<?php echo $customer['name']; ?></div>
							<div class="value">&nbsp;<?php echo $customer['code']; ?></div>
							<div class="value">&nbsp;<?php echo $customer['reg_number']; ?></div>
							<div class="value">&nbsp;<?php echo $customer['alternate_id']; ?></div>
						</div>
						
						<div class="clearfix"></div>
						
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style='width: 20px;'>S.No.</th>
										<th style='width: 100px;'>TXN Code</th>
										<th style='width: 320px;'>Particulars</th>
										<th style='width: 60px;'>Quantity</th>
										<th style='width: 80px;'>Rate</th>
										<th style='width: 80px;'>Total</th>
										<th style='width: 100px;'>Date (Gregorian)</th>
										<th style='width: 100px;'>Date (Nepali)</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$i = 1;
										foreach($customer['invoices'] as $transaction)
										{
											$invoice = json_decode($transaction['invoice']);
											$inventory = $invoice->inventory;
											$inventoryNumber = count($inventory);
											$nepaliDate = $this->dateconverter->eng_to_nep(date('Y', $transaction['added_on']), date('m', $transaction['added_on']), date('j', $transaction['added_on']));
										?>
										<tr>
											<td rowspan="<?php echo $inventoryNumber; ?>"><?php echo $i; ?></td>
											<td rowspan="<?php echo $inventoryNumber; ?>"><?php echo $transaction['code']; ?></td>
											<td><?php echo $inventory[0]->name; ?></td>
											<td style='text-align: right;'><?php echo $inventory[0]->quantity; ?></td>
											<td style='text-align: right;'>रू  <?php echo $inventory[0]->sp; ?></td>
											<td style='text-align: right;'>रू  <?php echo ($inventory[0]->sp * $inventory[0]->quantity); ?></td>
											<td style='text-align: center;' rowspan="<?php echo $inventoryNumber; ?>"><?php echo date('G:i:s <b\\r> D, j M, Y', $transaction['added_on']); ?></td>
											<td style='text-align: center;' rowspan="<?php echo $inventoryNumber; ?>"><?php echo $nepaliDate['date'] . ' ' . $nepaliDate['nmonth'] . ', ' . $nepaliDate['year']; ?></td>
										</tr>
										<?php
											for($j = 1; $j < $inventoryNumber; $j++)
											{
											?>
											<tr>
												<td><?php echo $inventory[$j]->name; ?></td>
												<td style='text-align: right;'><?php echo $inventory[$j]->quantity; ?></td>
												<td style='text-align: right;'>रू  <?php echo $inventory[$j]->sp; ?></td>
												<td style='text-align: right;'>रू  <?php echo ($inventory[$j]->sp * $inventory[$j]->quantity); ?></td>
											</tr>
											<?php
											}
										?>
										
										<?php
											$i++;
										}
									?>
								</tbody>
							</table>
							<?php
							}
				}
			}
	}