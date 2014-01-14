					<section class="span12">
							<div class="content">

								<?php
									$i = 1;
									
									foreach($inventory as $invent)
									{
								?>
											<div><b>S.No.:</b> <?php echo $i; ?></div>
											<div><b>Item Code:</b> <?php echo $invent['code']; ?></div>
											<div><b>Name:</b> <?php echo $invent['name']; ?></div>
											<div><b>Added On:</b> <?php echo $invent['added_on_nepali']['date'] . ' ' . $invent['added_on_nepali']['nmonth'] . ', ' . $invent['added_on_nepali']['year'] . '; ' . $invent['added_on'] ; ?></div>
											<div><b>Stocks:</b> 
													<?php
														if(count($invent['stocks']) != 0)
														{
													?>
													</div>
													<table class="table table-bordered table-striped">
																<thead>
																		<tr>
																				<th>S.No.</th>
																				<th>Code</th>
																				<th>Quantity</th>
																				<th>CP</th>
																				<th>SP</th>
																				<th>Warhouse</th>
																				<th>Supplier</th>
																				<th>Date</th>
																		</tr>
																</thead>
																<?php
																		$j = 1;
																		$total = array('quantity' => 0, 'cp' => 0, 'sp' => 0);
																		foreach($invent['stocks'] as $stock)
																		{
																		?>
																				<tr>
																						<td style="text-align: center;"><?php echo $j; ?></td>
																						<td><?php echo $stock['code']; ?></td>
																						<td style="text-align: right;"><?php echo $stock['quantity']; ?></td>
																						<td style="text-align: right;">रू <?php echo $stock['cp']; ?></td>
																						<td style="text-align: right;">रू <?php echo $stock['sp']; ?></td>
																						<td><?php echo $stock['warehouse']['name'] . ' ( ' . $stock['warehouse']['code'] . ' )'; ?></td>
																						<td><?php echo $stock['supplier']['name'] . ' ( ' . $stock['supplier']['code'] . ' )'; ?></td>
																						<td style="text-align: center;"><?php echo $stock['added_on_nepali']['date'] . ' ' . $stock['added_on_nepali']['nmonth'] . ', ' . $stock['added_on_nepali']['year'] . '<br> ' . $stock['added_on']; ?></td>
																				</tr>
																		<?php
																				$total['quantity'] += $stock['quantity'];
																				$total['cp'] += $stock['cp'];
																				$total['sp'] += $stock['sp'];
																			$j++;
																		}
																?>
																				<tr>
																						<td style="background: #eaeaea;">&nbsp;</td>
																						<td style="background: #eaeaea;">Total: </td>
																						<td style="background: #eaeaea;"><?php echo $total['quantity']; ?></td>
																						<td style="background: #eaeaea;">रू <?php echo $total['cp']; ?></td>
																						<td style="background: #eaeaea;">रू <?php echo $total['sp']; ?></td>
																						<td style="background: #eaeaea;">&nbsp;</td>
																						<td style="background: #eaeaea;">&nbsp;</td>
																						<td style="background: #eaeaea;">&nbsp;</td>
																				</tr>
													</table>
													<?php
														}
														else
														{
																echo "None</div>";
														}
													?>
											<hr>
								<?php
										$i++;
									}
								?>

							</div><!--/.content -->					
				</section>	<!--/.span12 -->
								
