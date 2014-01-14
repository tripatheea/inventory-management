				<section class="col-md-9">
					<div class="page-header">
						<h3><?php echo $title; ?></h3>
					</div>
					
						<div id="ajax_response"></div>
						
						<form action="#" class="form-horizontal" id="warehouse">
							
							<div class="content">
								<div class="input-row">
									<div class="row">
											<div class="span6">
												
												<!--<div class="control-group">
													<label class="control-label">Warehouse-Code:</label>
													<div class="controls" style="margin-top: 6px;">
														 WH-1307-34561
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="name[]">Name:</label>
													<div class="controls">
														<input type="text" name="name[]" id="name[]" placeholder="Name" required>
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="location1[]">Location 1:</label>
													<div class="controls">
														<input type="text" name="location1[]" id="location1[]" placeholder="Location">
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="location2[]">Location 2:</label>
													<div class="controls">
														<input type="text" name="location2[]" id="location2[]" placeholder="Location">
													</div>
												</div><!--/.control-group -->
												
											</div><!--/.span6 -->
											
											
									</div><!--/.row -->
									
								</div>	<!--/.input-row -->
								

								
							</div><!--/.content -->
							
							<div style="margin: 5px 5px 5px 180px;">
									<a href="#" id="Add">Add More</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</div>
							
							<input type="submit" value="Add Warehouse" style="margin: 20px 20px 20px 180px;">
							
						</form>
						
				</section>	<!--/.col-md-9 -->
								

				<script>
					$(document).ready(function(){
							
							$("#Add").click(function(){
									var obj =  $("div.input-row").eq( 0 ).clone(); //this will clone the html elements
									obj.prepend( '<hr>' );
									obj.append( '<div style="margin: 5px 20px 5px 5px; float: right;"><a href="#" onclick="removeDOM(this)">Remove</a></div>' );
									$("div.content").append(obj); //this will append to the existing elements
							});
					});

					function removeDOM(thisObj){
							$(thisObj).parent().parent().remove();
					}
					
					$(document).ready(function () {
						$("#warehouse").submit(function (e) {
							e.preventDefault(); // Prevent default form submit
							var url = '<?php echo base_url(); ?>index.php/warehouse/add_data';
							
							var data = Object();
							var name = Object(); var location1 = Object(); var location2 = Object();
							var i = 0;
							// Put CSFR token
							data['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
							$('input[id$="name[]"]').each(function() {
								
								temp =  $(this);
								name[i] = temp[0]['value'];	// The index 0 here is INTENTIONAL
								temp = $( 'input[id$="location1[]"]' );
								location1[i] = temp[i].value;
								temp = $( 'input[id$="location2[]"]' );
								location2[i] = temp[i].value;
								
								i++;
							});
							
							data.name = name; data.location1 = location1; data.location2 = location2;
							
							$.ajax({
								   type: "POST",
								   url: url,
								   data: data,
								   success: function(response){
									   // Show response from the php script.
									   $('div#ajax_response').html(response);
								   }
							});

							return false; // Avoid to execute the actual submit of the form
						});
					});
					

		
				</script>

