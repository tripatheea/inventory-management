				<section class="col-mod-12">
					<div class="page-header">
						<h3><?php echo $title; ?></h3>
					</div>
					
						<div id="ajax_response"></div>
						
						<form action="#" class="form-horizontal" id="stock">	
							<div class="content">
								<div class="input-row">
									<div class="row">
											<div class="col-mod-6">
												
												<!--<div class="control-group">
													<label class="control-label">Stock-Code:</label>
													<div class="controls" style="margin-top: 6px;">
														 IN-2013-12512C
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="name[]">Inventory:</label>
													<div class="controls">
														<select name="inventory[]" id="inventory[]">
															<option value="0">-- Select --</option>
															<?php
																if(isset($inventory)){
																	if(count($inventory) > 0){
																		foreach($inventory as $invent){
																		?>
																		<option value='<?php echo $invent['id']; ?>'><?php echo $invent['name']; ?></option>
																		<?php
																		}
																	}
																}
															?>
														</select>
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="cp[]">Cost Price:</label>
													<div class="controls">
														<input type="text" name="cp[]" id="cp[]" placeholder="Cost Price" required="">
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="sp[]">Selling Price:</label>
													<div class="controls">
														<input type="text" name="sp[]" id="sp[]" placeholder="Selling Price" required="">
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="quantity[]">Quantity:</label>
													<div class="controls">
														<input type="number" min="0" value="0" name="quantity[]" id="quantity[]" required="">
													</div>
												</div><!--/.control-group -->
												
											</div><!--/.span6 -->
											
											<div class="span6">
												
												<div class="control-group" style="margin-top: 50px;">
													<label class="control-label" for="warehouse[]">Warehouse:</label>
													<div class="controls">
														<select name="warehouse[]" id="warehouse[]">
															<option value="0">-- Select --</option>
															<?php
																if(isset($warehouse)){
																		if(count($warehouse)>0){
																				foreach($warehouse as $ware){
																						?>
																							<option value='<?php echo $ware['id']; ?>'><?php echo $ware['name']; ?></option>
																						<?php
																				}
																		}
																}
															?>
														</select>
													</div>
												</div><!--/.control-group -->
												
												<div class="control-group">
													<label class="control-label" for="supplier[]">Supplier:</label>
													<div class="controls">
														<select name="supplier[]" id="supplier[]">
															<option value="0">-- Select --</option>
															<?php
																if(isset($suppliers)){
																	if(count($suppliers)>0){
																		foreach($suppliers as $supplier){
																		?>
																		<option value='<?php echo $supplier['id']; ?>'><?php echo $supplier['name']; ?></option>
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
							
							<input type="submit" value="Add Stock" style="margin: 20px 20px 20px 180px;">
							
						</form>
						
				</section>	<!--/.span9 -->
								

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
											 * If the input name is 'quantity[]', set the value as 0.
											 * No need to do anything for select elements. For some reason, it just works. :D
											 */
											
											if(input[0]['name'] == 'quantity[]')
											{
													input[0].value = '0';
											}
											else
											{
													input[0].value = '';
											}
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
							$("#stock").submit(function (e)
							{
									e.preventDefault(); // Prevent default form submit
									
									var url = '<?php echo base_url(); ?>index.php/stock/add_data';
									
									var data = Object();
									var inventory = Object(); var cp = Object(); var sp = Object(); var quantity = Object(); var warehouse = Object(); var supplier = Object();
									
									// Put CSFR token
									data['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
									
									var i = 0;
									$('input[id$="cp[]"]').each(function()
									{
											temp = $('input[id$="cp[]"]');
											cp[i] = temp[i].value;			// The index 0 here is INTENTIONAL
											temp = $('input[id$="sp[]"]');
											sp[i] = temp[i].value;
											temp = $('input[id$="quantity[]"]');
											quantity[i] = temp[i].value;
											i++;
									});
									
									var invent = $( "[name=inventory\\[\\]]" );
									var ware = $( "[name=warehouse\\[\\]]" );
									var supp = $( "[name=supplier\\[\\]]" );
									i = 0;
									$(invent).each(function()
									{
											a = $(invent[i]); inventory[i] = a.val();
											b = $(ware[i]);	warehouse[i] = b.val();
											c = $(supp[i]); supplier[i] = c.val();
											i++;
									});
									data.inventory = inventory; data.cp = cp; data.sp = sp; data.quantity = quantity; data.warehouse = warehouse; data.supplier = supplier;
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