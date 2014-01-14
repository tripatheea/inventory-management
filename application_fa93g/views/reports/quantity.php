					<section class="span12">
							<div class="content">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>S.No.</th>
											<th>Code</th>
											<th>Name</th>
											<th>Gross Quantity</th>
											<th>Stock Balance</th>
											<th>Inventory Added Date</th>
										</tr>
									</thead>
								<?php
									$i = 1;
									foreach($inventory as $invent)
									{
								?>
										<tr>
												<td style="text-align: center;"><?php echo $i; ?></td>
												<td><?php echo $invent['code']; ?></td>
												<td><?php echo $invent['name']; ?></td>
												<td style="text-align: right;"><?php echo $invent['initial_quantity']; ?></td>
												<td style="text-align: right;"><?php echo $invent['quantity']; ?></td>
												<td style="text-align: center;"><?php echo $invent['added_on_nepali']['date'] . ' ' . $invent['added_on_nepali']['nmonth'] . ', ' . $invent['added_on_nepali']['year'] . '<br> ' . $invent['added_on']; ?></td>
										</tr>
								<?php
										$i++;
									}
								?>
								</table>
								
							</div><!--/.content -->					
				</section>	<!--/.span12 -->
								
