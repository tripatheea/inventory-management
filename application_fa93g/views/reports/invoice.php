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
										
									</div><!--/.input-row -->
									
									<div class="input-row">
										<div class="row-fluid">
											<div class="span12">
												
												<div class="control-group">
													<label class="control-label" for="gradeLevel">Customer Type:</label>
													<div class="controls">
														<select name="customerType" id="customerType">
																<option value='0'> -- Select -- </option>
																<option value='-1'>All</option>
																<?php
																		foreach($allCustomerTypes as $customerType)
																		{
																		?>
																				<option value='<?php echo $customerType['id']; ?>'><?php echo $customerType['name']; ?></option>
																		<?php
																		}
																?>
														</select>
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="gradeLevel">Grade Level:</label>
													<div class="controls">
														<select name="gradeLevel" id="gradeLevel">
																<option value='0'> -- Select -- </option>
																<?php
																		foreach($allGradeLevels as $gradeLevel)
																		{
																		?>
																				<option value='<?php echo $gradeLevel['id']; ?>'><?php echo $gradeLevel['name']; ?></option>
																		<?php
																		}
																?>
														</select>
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="show">Show:</label>
													<div class="controls">
														<select name="show" id="show">
															<option value='invoices'>Invoices</option>
															<option value='expenses'>Expenses Only</option>
														</select>
													</div>
												</div><!--/.control-group -->
												
											</div><!--/.span12 -->
										</div><!--/.row-fluid -->
									</div><!--/.input-row -->
									
								</form>
							</div><!--/.content -->
							
							<div class="content results">
							
							</div><!--/.content results -->
							
					</section>	<!--/.span12 -->
					
					<script type="text/javascript">
							$(document).ready(function()
							{
								$('.nepali-calendar').nepaliDatePicker();
							});
							
							$(document).ready(function()
							{
									$('#customerType').change(function()
									{
										refresh_data();
									});
									$('#gradeLevel').change(function()
									{
											refresh_data();
									});
									
									$('#show').change(function()
									{
											refresh_data();
									});
							});
							
							function refresh_data()
							{
									if($('#show').val() == 'expenses')
									{
											var url = "<?php echo base_url(); ?>index.php/reports/invoice_expenses/";
									}
									else if($('#show').val() == 'invoices')
									{
											var url = "<?php echo base_url(); ?>index.php/reports/invoice_invoices/";
									}
									
									var data = Object();
									
									// Put CSFR token
									data['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
									
									if($('#from').val() == '') {data['from'] = '2007-11-07';} else{data['from'] = $('#from').val();}
									if($('#to').val() == '') {data['to'] = '2089-11-07';} else{data['to'] = $('#to').val();}
									
									data['customerType'] = $('#customerType').val();
									data['gradeLevel'] = $('#gradeLevel').val();
									$.ajax({
										type: 'POST',
										url: url,
										data: data,
										success: function(response){
											console.log(response);
											$('.results').html(response);
										}
									});
							}
					</script>