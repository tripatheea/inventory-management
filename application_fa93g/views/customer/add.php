				<section class="col-md-9">
					<div class="page-header">
						<h3><?php echo $title; ?></h3>
					</div>
						
						<div id="ajax_response"></div>
						
						<form action="#" class="form-horizontal" id="customer">
							
							<div class="content">
								<div class="input-row">
									<div class="row">
											<div class="span6">
												
												<!--<div class="control-group">
													<label class="control-label">Customer-Code:</label>
													<div class="code controls" style="margin-top: 6px;"></div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="name[]">Name:</label>
													<div class="controls">
														<input type="text" name="name[]" id="name[]" placeholder="Name" required>
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="reg_number[]">Registration No.:</label>
													<div class="controls">
														<input type="text" name="reg_number[]" id="reg_number[]" placeholder="Registration No.">
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="alternate_id[]">Alternate ID:</label>
													<div class="controls">
														<input type="text" name="alternate_id[]" id="alternate_id[]" placeholder="Alternate ID">
													</div>
												</div><!--/.control-group -->
												
											</div><!--/.span6 -->
											
											<div class="span6">
												
												<div class="control-group">
													<label class="control-label" for="type[]">Customer Type:</label>
													<div class="controls">
														<select name="type[]" id="type[]">
															<option value="0">-- Select --</option>
															<?php
																if(isset($customerType)){
																		if(count($customerType)>0){
																				foreach($customerType as $type){
																				?>
																						<option value='<?php echo $type['id']; ?>'><?php echo $type['name']; ?></option>
																				<?php
																				}
																		}
																}
															?>
														</select>
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group grade-level" style="margin-top: 50px;">
													<label class="control-label" for="grade_level[]">Grade Level:</label>
													<div class="controls">
														<select name="grade_level[]" id="grade_level[]">
															<option value="0">-- Select --</option>
															<?php
																if(isset($gradeLevels)){
																	if(count($gradeLevels)>0){
																		foreach($gradeLevels as $gradeLevel){
																		?>
																		<option value='<?php echo $gradeLevel['id']; ?>'><?php echo $gradeLevel['name']; ?></option>
																		<?php
																		}
																	}
																}
															?>
														</select>
													</div>
												</div><!--/.control-group -->
											</div><!--/.span6 -->
									</div><!--/.row -->
								</div>	<!--/.input-row -->
							</div><!--/.content -->
							<div style="margin: 5px 5px 5px 180px;">
									<a href="#" id="Add">Add More</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</div>
							<input type="submit" value="Add Customer" style="margin: 20px 20px 20px 180px;">
						</form>
				</section>	<!--/.span9 -->
				
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
							$("#customer").submit(function (e)
							{
									e.preventDefault(); // Prevent default form submit
									var url = '<?php echo base_url(); ?>index.php/customer/add_data';
									var data = Object();
									var name = Object(); var reg_number = Object(); var alternate_id = Object(); var type = Object(); var grade_level = Object();
									var i = 0;
									// Put CSFR token
									data['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
									$('input[id$="name[]"]').each(function() {
										temp =  $(this);
										name[i] = temp[0]['value'];	// The index 0 here is INTENTIONAL
										temp = $( 'input[id$="reg_number[]"]' );
										reg_number[i] = temp[i].value;
										temp = $( 'input[id$="alternate_id[]"]' );
										alternate_id[i] = temp[i].value;
										i++;
									});
									
									var ty = $( "[name=type\\[\\]]" );
									var gr = $( "[name=grade_level\\[\\]]" );
									i = 0;
									$(ty).each(function() {
										a = $(ty[i]); type[i] = a.val();
										b = $(gr[i]); grade_level[i] = b.val();
										i++;
									});
									
									data.name = name; data.reg_number = reg_number; data.alternate_id = alternate_id; data.type = type; data.grade_level = grade_level;
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
					
					$(document).ready(function()
					{
							//$('.grade-level').hide();
							/*
							$('input[name=type\\[\\]]').change(function()
							{
									alert('yada');
							});
							*/
					});
				</script>