				<section class="span12">
					<div class="page-header">
						<h3><?php echo $title; ?></h3>
					</div>
					
						<div class="content">
							<form action="#" class="form-horizontal" id="transaction-report">
								<div class="input-row">
									<div class="row-fluid">
											<div class="span12">
												<div class="control-group">
													<label class="control-label" for="from">From:</label>
													<div class="controls">
														<input type="text" name="from" id="from" class="nepali-calendar" placeholder="From" style="width: 190px;">
													</div>
												</div><!--/.control-group -->
											</div><!--/.span12 -->
									</div><!--/.row-fluid -->
									
									<div class="row-fluid">
											<div class="span12">
												<div class="control-group">
													<label class="control-label" for="to">To:</label>
													<div class="controls">
														<input type="text" name="to" id="to" class="nepali-calendar" placeholder="To" style="width: 190px;">
													</div>
												</div><!--/.control-group -->
											</div><!--/.span12 -->
									</div><!--/.row-fluid -->
									
									<hr>
									
									<div class="row-fluid">
											<div class="span6">
												<div class="control-group">
													<label class="control-label" for="customer">Search By Customer:</label>
													<div class="controls">
														<input type="text" name="customer" id="customer" placeholder="Customer Name / Regd No. / Alternate ID" style="width: 300px;">
													</div>
												</div><!--/.control-group -->
												
											</div><!--/.span6 -->
											
											<div class="span6">
											
												<div class="control-group">
													<label class="control-label" for="inventory">Search By Inventory:</label>
													<div class="controls">
														<input type="text" name="inventory" id="inventory" placeholder="Inventory Name / Code" style="width: 300px;">
													</div>
												</div><!--/.control-group -->
												
											</div><!--/.span6 -->
									</div><!--/.row -->
								</div>	<!--/.input-row -->
							</form>
						</div><!--/.content -->
						
						<hr>
						
						<div class="content">
							<div class="row-fluid">
								<div class="span12 search-results">
										
								</div><!--/.span12 search-results -->
							</div><!--/.row -->
						</div><!--/.content -->
				</section>	<!--/.span12 -->
				
				<script type="text/javascript">
						$(document).ready(function()
						{
								$('.nepali-calendar').nepaliDatePicker();
						});
						
						// Autocomplete by inventory begins here.
						
						$(function(){
								// Autocomplete for inventory.
								$("#inventory").autocomplete({
										source: "<?php echo base_url(); ?>index.php/transaction/autocomplete_inventory_for_reports/",
										minLength: 1,
										select: function(event, ui){
												$('#customer').val('');
												from_inventory();
										}
								});
						});
						
						function from_inventory()
						{
								var url = "<?php echo base_url(); ?>index.php/reports/transaction_by_inventory/";
								data = Object();
								data['inventory'] = $('#inventory').val();
								
								if($('#from').val() == '') {data['from'] = '2007-11-07';} else{data['from'] = $('#from').val();}
								if($('#to').val() == '') {data['to'] = '2089-11-07';} else{data['to'] = $('#to').val();}
								
								// Put CSFR token.
								data['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
								$.ajax({
									type: 'POST',
									url: url,
									data: data,
									success: function(response){
										$('.search-results').html(response);
									}
								});
						}
						
						
						// Autocomplete by customer begins here.
						
						$(function(){
								// Autocomplete trigger when the user types in the customer details.
								$("#customer").autocomplete({
										source: "<?php echo base_url(); ?>index.php/transaction/autocomplete_customer/",
										minLength: 1,
										select: function(event, ui){
												$('#inventory').val('');
												from_customer();
										}
								});
						});
						
						function from_customer()
						{
							var url = "<?php echo base_url(); ?>index.php/reports/transaction_by_customer/";
							data = Object();
							data['customer'] = $('#customer').val();
							
							if($('#from').val().length != 10) {data['from'] = '2007-11-07';} else{data['from'] = $('#from').val();}
							if($('#to').val().length != 10) {data['to'] = '2089-11-07';} else{data['to'] = $('#to').val();}
							
							// Put CSFR token
							data['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
							$.ajax({
								type: 'POST',
								url: url,
								data: data,
								success: function(response){
									$('.search-results').html(response);
								}
							});
						}
						
						function refresh_data()
						{
								if($('#customer').val().length > 0)
								{
										from_customer();
								}
								else if($('#inventory').val().length > 0)
								{
										from_inventory();
								}
						}
				</script>