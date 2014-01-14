				<!--<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css">-->

					<section class="col-md-12" style="width: 98% !important;">
							<div class="content">
								<div class="input-row">
									<!--<div class="row transaction-top-bar">
													<strong>Transaction ID:</strong> TXN-1307-27392
									</div><!--/.row -->
									
									<div class="row transaction-main-bar">
											<div class="col-md-4" style="border-right: 1px solid #eeeeee; padding-right: 10px;">
													<input class="transaction-customer-input" name="customer-search" id="customer-search" type="text" placeholder="Customer Name / Regd No. / Alternate ID" autofocus="autofocus" autocomplete="off">
													
													<hr>
													
													<div class="row">
															<div class="col-md-4 text-right">
																<div>Name:</div>
																<div>Customer Code:</div>
																<div>Regd No.:</div>
																<div>Alternate ID:</div>
																<div>Type:</div>
															</div>
															
															<div class="col-md-8">
																<div class="customer-name"></div>
																<div class="customer-code"></div>
																<div class="customer-reg-number"></div>
																<div class="customer-alternate-id"></div>
																<div class="customer-type"></div>
															</div>
													</div><!--/.row -->
													
													<hr>
													
													<form class="row form-horizontal">
															<!--<div class="control-group" style="margin-left: -75px !important;">
																<label class="control-label" for="invoice">Show Invoice</label>
																<div class="controls">
																	<input type="checkbox">
																</div>
															</div>-->
															<input type="button" value="Proceed" class="invoice-proceed">
													</form>
													
													
											</div><!--/.col-md-4 -->
											
											<div class="col-md-8">
													<div class="row">
														<form action="#" class="form-horizontal" id="transaction-inventory-form">
															<div class="col-md-8">
																<input class="transaction-inventory-input" name="transaction-inventory-input" type="text" placeholder="Inventory Name / Code" autocomplete="off">
															</div>
															
															<div class="col-md-4" style="text-align: right">
																Quantity: <input name="transaction-inventory-number-input" type="number" min="0" value="1">&nbsp;&nbsp;&nbsp;
																<input type="submit" value="Add">
															</div>
														</form>
													</div><!--/.row -->
													
													<hr>
													
													<div class="row">
															<table style="width: 100%;" class="table-striped inventory-table">
																<thead>
																	<tr>
																		<th style="width: 8%;">S.No.</th>
																		<th style="width: 55%; text-align: left;">Particulars</th>
																		<th style="width: 10%; text-align: center;">Quantity</th>
																		<th style="width: 12%; text-align: center;">Unit Price</th>
																		<th style="width: 15%; text-align: center;">Total</th>
																	</tr>
																</thead>
																
																<tbody>

																</tbody>
															</table>
													</div><!--/.row -->
													
													<div class="row">
														<div style="float: right; margin-top: 20px; width: 200px;">
															<div class="col-md-6 transaction-invoice-title text-right">
																	Total:<br>
																	Discount:<br>
																	Grand Total:<br>
																</div>
																
																<div class="col-md-6 transaction-invoice-value text-left">
																	<div class="invoice-total">रू 0</div>
																	<div class="invoice-discount">रू 0</div>
																	<div class="invoice-grand-total">रू 0</div>
																</div>
														</div>
													</div><!--/.row -->
													
													<div class="row">
														<hr><div class="number-in-words"></div><hr>
													</div>
													
													<div class="row" style="float: right; width: 300px;">
															<div class="col-md-6 text-right">
																	<div class='transaction-total-title'>Grand Total: </div>
																	<div class='transaction-tender-title'>Tender: </div>
																	<div class='transaction-change-title'>Change: </div>
															</div>
																								
															<div class="col-md-6 text-right">
																	<div class='transaction-grand-total'>रू 0.00</div>
																	<div class='transaction-tender'>रू 0.00</div>
																	<div class='transaction-change'>रू 0.00</div>
															</div>	
													</div><!--/.row -->
											</div><!--/.col-md-8 -->
									</div><!--/.row -->
								</div>	<!--/.input-row -->
							</div><!--/.content -->					
				</section>	<!--/.col-md-9 -->
								

				<!--<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>-->
				
				<script type="text/javascript">
						$(function(){
								// Autocomplete for customers
								$(".transaction-customer-input").autocomplete({
												source: "<?php echo base_url(); ?>index.php/transaction/autocomplete_customer",
												minLength: 1,
												select: function(event, ui){
																var customer = $('.transaction-customer-input').val();
																
																get_customer(customer).success(function (response)
																{
																		$('.customer-name').html(response['name']);
																		$('.customer-code').html(response['code']);
																		$('.customer-reg-number').html(response['reg_number']);
																		$('.customer-alternate-id').html(response['alternate_id']);
																		$('.customer-type').html(response['type']);
																		$('.transaction-inventory-input').focus();
																		get_invoice_customer(response['id']);
																});
														}
								});
						});
						
						$(function(){
							// Autocomplete for inventory
							$(".transaction-inventory-input").autocomplete({
												source: "<?php echo base_url(); ?>index.php/transaction/autocomplete_inventory",
												minLength: 1,
												select: function(event, ui){
																$('input[name$=transaction-inventory-number-input]').focus()	
														}
							});
						});
						
						function get_customer(name)
						{
								data = Object();
								data['name'] = name;
								// Put CSFR token
								data['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
								var url = '<?php echo base_url(); ?>index.php/transaction/get_customer';
								return $.ajax({
										dataType: 'json',
										type: 'POST',
										url: url,
										data: data
								});
						}
						
						function check_for_inventory(id)
						{
								allInventory = invoice['inventory'];
								for(var prop in allInventory)
								{
										inventory = allInventory[prop]['id'];
										if(id == inventory)
										{
												return true;
										}
								}
								return false;
						}
						
						
						invoice = Object();
						invoice['inventory'] = Object();
						//invoice['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
						inventoryCount = 0;
						function get_invoice_inventory(stockID, quantity, customer)
						{
								invoice['inventory'][inventoryCount] = Object();
								invoice['inventory'][inventoryCount]['id'] = stockID;
								invoice['inventory'][inventoryCount]['quantity'] = quantity;
								inventoryCount++;
						}
						
						function get_invoice_customer(customer)
						{
								invoice['customer'] = customer;
						}
						
						function number_to_words(number)
						{
							data = Object();
							data['number'] = number;
							// Put CSFR token
							data['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
							var url = '<?php echo base_url(); ?>index.php/transaction/number_to_words';
							$.ajax({
								type: 'POST',
								url: url,
								data: data,
								success: function(response){
									// Show response from the php script.
									$('.number-in-words').text('Rupees ' + response + ' Only');
								}
							});
						}						
						
						function get_inventory(name, customer)
						{
								data = Object();
								data['name'] = name;
								data['customer'] = customer;
								// Put CSFR token
								data['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
								var url = '<?php echo base_url(); ?>index.php/transaction/get_inventory';
								return $.ajax({
										dataType: 'json',
										type: 'POST',
										url: url,
										data: data
								});
						}
						
						function get_total()
						{
								var total = 0;
								var indTotal = $('[name=invoice-total\\[\\]]');
								indTotal.each(function()
								{
										total += parseFloat($(this)[0]['innerHTML']);
								});
								return total;
						}
						
						$(document).ready(function()
						{		
								var originalContent = $('.transaction-main-bar').html();
								$(".invoice-proceed").click(function(){
									
										// Check if the user wants to print invoice or not.
										// Generate an invoice. Create a link to that and just open that in the popup. That's it! :)
										
										// For now, don't print invoice. Just add data to the database.
										
										data = Object();
										data['invoice'] = invoice;
										
										// GET PAYMENT TYPE AS WELL
										
										data['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
										
										var url = "<?php echo base_url(); ?>index.php/transaction/add_transaction/";
										
										
										$.ajax({
												type: 'POST',
												url: url,
												data: data,
												success: function(response){
														if(response == '1')
														{
																// Empty all fields
																//document.href('http://127.0.0.1/inventory/transaction/add');
																$('.transaction-main-bar').html(originalContent);
														}
												}
										});
										
										/*
										var url = "<?php echo base_url(); ?>index.php/transaction/show_invoice";
										var abc = 'hello';
										
										var params = [
										'height=' + screen.height,
										'width=' + screen.width,
										'fullscreen = yes' // Only works in IE, but here for completeness
										].join(',');
										
										var popup = window.open(url, 'popup_window', params); 
										popup.moveTo(0,0);
										
										// Open Popup to print invoice
										
										*/
										
										return false;
								});
						});
						
						$(document).ready(function()
						{
								var count = 1;
								$('#transaction-inventory-form').submit(function (e)
								{
										e.preventDefault(); // Prevent default form submit
										
										var customer = $('.transaction-customer-input').val();
										
										// User added an inventory. Add it to the inventory table.
										var inventory = $('input[name$=transaction-inventory-input]')[0]['value'];
										var enterredQuantity = $('input[name$=transaction-inventory-number-input]')[0]['value'];
										get_inventory(inventory, customer).success(function (response)
										{
												inventoryDetails = response;
												// Before doing anything else, check if the inventory has already been added.
												// If it has, then do not add the inventory.
												var inventoryAlreadyListed = check_for_inventory(inventoryDetails['id']);
												
												if(!inventoryAlreadyListed)
												{
													// Now check if the enterred quantity is smaller than stock quantity or not.
													// If it's not, change enterred quantity to the stock quantity.
													if(parseInt(enterredQuantity) > parseInt(inventoryDetails['quantity']))
													{
														console.log('yes');
														enterredQuantity = inventoryDetails['quantity'];
													}
													var tableEntry = '<tr>';
																tableEntry += '<td class="text-center">' + count + '</td>';
																tableEntry += '<td><span name="invoice-particular[]">' + inventoryDetails['name'] + '</span><span style="display: none; height: 0; width: 0;" class="stock_id">' + inventoryDetails['id'] + '</span></td>';			// Use a hidden input or an invisible element or something to store the stock id as well. That way it won't be ambigious. :)
																tableEntry += '<td class="text-center"><span name="invoice-quantity[]">' + enterredQuantity + '</span></td>';
																tableEntry += '<td class="text-center">रू <span name="invoice-sp[]">' + parseFloat(inventoryDetails['sp']).toFixed(2) + '</span></td>';
																tableEntry += '<td class="text-center">रू <span name="invoice-total[]">' + parseFloat((enterredQuantity * inventoryDetails['sp'])).toFixed(2) + '</span></td>';
													tableEntry += '</tr>';
													
													$('.inventory-table').append(tableEntry);
													count++;
													
													get_invoice_inventory(inventoryDetails['id'], enterredQuantity);
													
													// Calculations- small and indeterminable ones.
													$('.invoice-total').html('रू ' + parseFloat(get_total()).toFixed(2));	// Calculate and show Total
													$('.invoice-grand-total').html('रू ' + parseFloat(get_total()).toFixed(2));	// Calculate and show Grand Total
													
													// Calculations- big and bright and nice and clear and...
													// Here, we simply copy the field values from the invoice part.
													$('.transaction-grand-total').html($('.invoice-grand-total').html());
													
													// Give the total in words as well
													number_to_words(get_total());
												}
												
												$('input[name$=transaction-inventory-input]').val('');	// Empty the inventory field.
												$('input[name$=transaction-inventory-number-input]').val('1');	// Empty the quantity field.
												$('input[name$=transaction-inventory-input]').focus();	// Foucs the inventoy field so that next inventory can be added.

												return 0;
												
												
										});
								});
						});
						
				</script>