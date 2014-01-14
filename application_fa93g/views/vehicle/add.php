				<section class="col-md-9">
					<div class="page-header">
						<h3><?php echo $title; ?></h3>
					</div>
						
						<div id="ajax_response"></div>
						
						<form action="#" class="form-horizontal" id="vehicle">
							
							<div class="content">
								<div class="input-row">
									<div class="row">
											<div class="col-md-9">
												
												<!--<div class="control-group">
													<label class="control-label">Vehicle-Code:</label>
													<div class="controls" style="margin-top: 6px;">
														 VH-2013-12512C
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="name[]">Name:</label>
													<div class="controls">
														<input type="text" name="name[]" id="name[]" placeholder="Name" required>
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="vehicle_number[]">Vehicle Number:</label>
													<div class="controls">
														<input type="text" name="vehicle_number[]" id="vehicle_number[]" placeholder="Vehicle Number">
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="fuel_capacity[]">Fuel Capacity:</label>
													<div class="controls">
														<input type="text" name="fuel_capacity[]" id="fuel_capacity[]" placeholder="Fuel Capacity">
													</div>
												</div><!--/.control-group -->
												
											</div><!--/.col-md-9 -->
											
									</div><!--/.row -->
								</div>	<!--/.input-row -->
							</div><!--/.content -->
							<div style="margin: 5px 5px 5px 180px;">
									<a href="#" id="Add">Add More</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</div>
							<input type="submit" value="Add Vehicles" style="margin: 20px 20px 20px 180px;">
						</form>
				</section>	<!--/.col-md-9 -->
				
				<script>
					$(document).ready(function()
					{		
							$("#Add").click(function(){
									var obj =  $("div.input-row").eq( 0 ).clone(); //this will clone the html elements
									// Set empty values for all cloned fields. Cloned as in triggered by the 'Add More' link.
									var inputs = obj.find("input");
									inputs.each(function()
									{
										var input = $(this);
										input[0].value = '';
									});
									obj.prepend( '<hr>' );
									obj.append( '<div style="margin: 5px 20px 5px 5px; float: right;"><a href="#" onclick="removeDOM(this)">Remove</a></div>' );
									$("div.content").append(obj); //this will append to the existing elements
							});
					});

					function removeDOM(thisObj)
					{
							$(thisObj).parent().parent().remove();
					}
					
					$(document).ready(function ()
					{
							$("#vehicle").submit(function (e)
							{
									e.preventDefault(); // Prevent default form submit
									var url = '<?php echo base_url(); ?>index.php/vehicle/add_data';
									var data = Object();
									var name = Object(); var vehicle_number = Object(); var fuel_capacity = Object();
									var i = 0;
									// Put CSFR token
									data['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
									$('input[id$="name[]"]').each(function() {
										temp =  $(this);
										name[i] = temp[0]['value'];	// The index 0 here is INTENTIONAL
										temp = $( 'input[id$="vehicle_number[]"]' );
										vehicle_number[i] = temp[i].value;
										temp = $( 'input[id$="fuel_capacity[]"]' );
										fuel_capacity[i] = temp[i].value;
										i++;
									});
									
									data.name = name; data.vehicle_number = vehicle_number; data.fuel_capacity = fuel_capacity;
									$.ajax({
										   type: "POST",
										   url: url,
										   data: data,
										   success: function(response){
											   // Show response from the php script.
											   $('div#ajax_response').html(response);
										   }
									});
									return false; // Avoid to execute the actual submit of the form.
							});
					});
				</script>