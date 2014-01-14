				<section class="col-md-9">
					<div class="page-header">
						<h3><?php echo $title; ?></h3>
					</div>
						
						<div id="ajax_response"></div>
						
						<form action="#" class="form-horizontal" id="mileage">
							
							<div class="content">
								<div class="input-row">
									<div class="row-fluid">
											<div class="col-md-9">
												
												<div class="control-group">
													<label class="control-label" for="vehicle[]">Vehicle:</label>
													<div class="controls">
														<select name="vehicle[]" id="vehicle[]">
															<option value="0">-- Select --</option>
															<?php
																if(isset($vehicles)){
																	if(count($vehicles)>0){
																		foreach($vehicles as $vehicle){
																		?>
																		<option value='<?php echo $vehicle['id']; ?>'><?php echo $vehicle['name']; ?></option>
																		<?php
																		}
																	}
																}
															?>
														</select>
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="odometer_reading[]">Odometer Reading:</label>
													<div class="controls">
														<input type="text" name="odometer_reading[]" id="odometer_reading[]" placeholder="Odometer Reading">
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="fuel_amount[]">Fuel Amount:</label>
													<div class="controls">
														<input type="text" name="fuel_amount[]" id="fuel_amount[]" placeholder="Fuel Amount">
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="date[]">Date:</label>
													<div class="controls">
														<input type="text" class="date nepali-calendar" name="date[]" id="date" placeholder="Date">
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="do_not_use[]">Do not use in mileage calculation?</label>
													<div class="controls">
														<input type="checkbox" name="do_not_use[]" id="do_not_use[]">
													</div>
												</div><!--/.control-group -->
												
											</div><!--/.col-md-9 -->
											
									</div><!--/.row -->
								</div>	<!--/.input-row -->
							</div><!--/.content -->
							<div style="margin: 5px 5px 5px 180px;">
									<a href="#" id="Add">Add More</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</div>
							<input type="submit" value="Add Mileage" style="margin: 20px 20px 20px 180px;">
						</form>
				</section>	<!--/.col-md-9 -->
				
				<script type="text/javascript">
					$(document).ready(function()
					{
						$('.nepali-calendar').nepaliDatePicker();
					});
					
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
							$("#mileage").submit(function (e)
							{
									e.preventDefault(); // Prevent default form submit
									var url = '<?php echo base_url(); ?>index.php/vehicle/add_mileage';
									var data = Object();
									var vehicle = Object(); var odometer_reading = Object(); var fuel_amount = Object();  var date = Object(); var do_not_use = Object();
									var i = 0;
									// Put CSFR token
									data['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
									$('input[id$="odometer_reading[]"]').each(function() {
										temp =  $(this);
										odometer_reading[i] = temp[0]['value'];	// The index 0 here is INTENTIONAL
										temp = $( 'input[id$="fuel_amount[]"]' );
										fuel_amount[i] = temp[i].value;
										temp = $( 'input[name$="date[]"]' );
										date[i] = temp[i].value;
										temp = $( 'input[id$="do_not_use[]"]' );
										temp.is(':checked') ? do_not_use[i] = 1 : do_not_use[i] = 0;
										i++;
									});
									
									
									// Select fields
									var veh = $( "[name=vehicle\\[\\]]" );
									i = 0;
									$(veh).each(function()
									{
										a = $(veh[i]); vehicle[i] = a.val();
										i++;
									});
									
									data.vehicle = vehicle; data.odometer_reading = odometer_reading; data.fuel_amount = fuel_amount; data.date = date; data.do_not_use = do_not_use;
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