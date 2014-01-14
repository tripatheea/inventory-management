				<section class="col-md-9">
					<div class="page-header">
						<h3><?php echo $title; ?></h3>
					</div>
					
						<div id="ajax_response"></div>
						
						<form action="#" class="form-horizontal" id="inventory">	
							<div class="content">
								<div class="input-row">
									<div class="row-fluid">
											<div class="col-mod-12">
												<!--<div class="control-group">
													<label class="control-label">Item-Code:</label>
													<div class="controls" style="margin-top: 6px;">
														 IN-2013-12512C
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="name[]">Name:</label>
													<div class="controls">
														<input type="text" name="name[]" id="name[]" placeholder="Name" required="">
													</div>
												</div><!--/.control-group -->
												
											</div><!--/.col-mod-12 -->
									</div><!--/.row -->
									
								</div>	<!--/.input-row -->
								

								
							</div><!--/.content -->
							
							<div style="margin: 5px 5px 5px 180px;">
									<a href="#" id="Add">Add More</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</div>
							
							<input type="submit" value="Add Inventory" style="margin: 20px 20px 20px 180px;">
							
						</form>
						
				</section>	<!--/.col-mod-9 -->
								

				<script>
					$(document).ready(function()
					{		
							$("#Add").click(function()
							{
									var obj =  $("div.input-row").eq( 0 ).clone(); //this will clone the html elements
									
									// Set empty values for all cloned fields. Cloned as in triggered by the 'Add More' link.
									
									var inputs = obj.find("input");
									inputs.each(function()
									{
											var input = $(this);
											
											/*
											 * Check the name of the input.
											 * If the input name is 'stock[]', set the value as 0.
											 * No need to do anything for select elements. For some reason, it just works. :D
											 */
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
							$("#inventory").submit(function (e)
							{
									e.preventDefault(); // Prevent default form submit
									var url = '<?php echo base_url(); ?>index.php/inventory/add_data';
									var data = Object();
									var name = Object();
									var i = 0;
									// Put CSFR token
									data['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
									$('input[id$="name[]"]').each(function()
									{
											temp =  $(this);
											name[i] = temp[0]['value'];	// The index 0 here is INTENTIONAL
											i++;
									});
									data.name = name;
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
