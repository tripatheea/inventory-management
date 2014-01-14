					<section class="span12">
						<div class="page-header">
							<h3><?php echo $title; ?></h3>
						</div>

							<div class="content">
									<?php
										$i = 0;
										$dataForGraph = array();
										foreach($allVehicleData as $vehicle)
										{
									?>
											<strong><?php echo $vehicle[0]['vehicle']['name']; ?></strong>
											<div><?php echo $vehicle[0]['vehicle']['vehicle_number']; ?></div>
											<div><?php echo $vehicle[0]['vehicle']['fuel_capacity']; ?> litres</div>
											<br>
											
											<table class="table table-bordered table-striped">
												<thead>
													<tr>
														<th style='width: 20px;'>S.No.</th>
														<th style='width: 50px;'>Odometer</th>
														<th style='width: 50px;'>Distance</th>
														<th style='width: 80px;'>Fuel Consumption</th>
														<th style='width: 80px;'>Average Mileage</th>
														<th style='width: 100px;'>Refueled Date</th>
														<th style='width: 110px;'>Refueled Date (Nepali)</th>
														<th style='width: 130px;'>Date Added (Gregorian)</th>
														<th style='width: 110px;'>Date Added (Nepali)</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$j = 0;
														foreach($vehicle as $data)
														{
															// For descending order of date:
															//$distance = ($j == count($vehicle) - 1) ? $vehicle[$j]['odometer_reading'] . ' <em>km</em><div style="font-size: 10px;">(Initial Reading)</div>' : $vehicle[$j]['odometer_reading'] - $vehicle[$j + 1]['odometer_reading'] . ' <em>km</em>';
															
															// For ascending order of date:
															$distance = ($j == 0) ? 0 : $vehicle[$j]['odometer_reading'] - $vehicle[$j - 1]['odometer_reading'];
															
															
															// For ascending order of date:
															$data['fuel_amount'] = ($j == 0) ? 0 : $data['fuel_amount'];
															$mileage = ($j == 0) ? 0 : $distance / $vehicle[$j]['fuel_amount'];
															
															// For descending order of date:
															//$data['fuel_amount'] = ($j == count($vehicle) - 1) ? 0 : $data['fuel_amount'];
															//$mileage = ($j == count($vehicle) - 1) ? 0 : $mileage;
															
															$mileage = round($mileage, 2);
														?>
														<tr>
															<td style='text-align: center;'><?php echo $j + 1; ?></td>
															<td style='text-align: right;'><?php echo $data['odometer_reading']; ?> <em>km</em></td>
															<td style='text-align: right;'><?php echo $distance; ?> <em>km</em></td>
															<td style='text-align: right;'><?php echo ($data['do_not_use'] == 1) ? $data['fuel_amount'] . "<div style='font-size: 12px;'>(Refueled Amount)</div>" : $data['fuel_amount'] . ' <em>l</em>'; ?></td>
															<td style='text-align: right;'><?php echo ($data['do_not_use'] == 1) ? 'N/A' : $mileage . ' <em>km/l</em>'; ?></td>
															<td style='text-align: right;'><?php echo $data['date']; ?></td>
															<td style='text-align: right;'><?php echo $data['date_nepali']['date'] . ' ' . $data['date_nepali']['nmonth'] . ', ' . $data['date_nepali']['year']; ?></td>
															<td style='text-align: center;'><?php echo $data['added_on']; ?></td>
															<td style='text-align: right;'><?php echo $data['added_on_nepali']['date'] . ' ' . $data['added_on_nepali']['nmonth'] . ', ' . $data['added_on_nepali']['year']; ?></td>
														</tr>
														<?php
															$j++;
															$dataForGraph[] = array(
																						'vehicle' 			=> $vehicle[0]['vehicle']['vehicle_number'],
																						'mileage' 			=> $mileage,
																						'distance' 			=> $distance,
																						'fuel_amount' 		=> $data['fuel_amount'],
																						'date_exact'		=> $data['date_exact'],
																						'date_nepali' 		=> $data['date_nepali'],
																						'do_not_use' 		=> $data['do_not_use'],
																					);
														}
														?>
												</tbody>
											</table>
											<hr>
									<?php
											// We've added some data to the array $vehicle. So add it back to the parent array $allVehicledData.
											$i++;
										}
									?>
									
							</div><!--/.content -->					
							<?php
									$chart = array();
									foreach($dataForGraph as $refueling)
									{
											$nepaliDate = $refueling['date_nepali']['date'] . '/' . $refueling['date_nepali']['nmonth'] . '/' . $refueling['date_nepali']['year'];
											$key = $refueling['date_exact'];
											if($refueling['do_not_use'] != 1)
												$chart[$key][$nepaliDate][$refueling['vehicle']] = $refueling;
									}
									// Sort in ascending order of date.s
									ksort($chart);
							?>
							<div class="content">
								<script type="text/javascript" src="https://www.google.com/jsapi"></script>
								<script type="text/javascript">
									google.load("visualization", "1", {packages:["corechart"]});
									google.setOnLoadCallback(drawChart);
									function drawChart() {
										var dataMileage = google.visualization.arrayToDataTable([
										<?php
										
											echo "\n['Refueling',";
												$i = 0;
												foreach($vehicles as $vehicle)
												{
													echo ($i == count($vehicles) - 1) ? "'" . $vehicle['vehicle_number'] . "'\t" : "'" . $vehicle['vehicle_number'] . "',";
													$i++;
												}
											echo "],\n";
											
											foreach($chart as $key => $value)
											{
													$nepaliMonth = key($value);
													$refuelings = $value[$nepaliMonth];
													echo "['" . $nepaliMonth . "',\t";
													$j = 0;
													foreach($vehicles as $vehicle)
													{
														if(isset($refuelings[$vehicle['vehicle_number']]))
														{
																if($refuelings[$vehicle['vehicle_number']]['mileage'] == '0')		$refuelings[$vehicle['vehicle_number']]['mileage'] = 'null';
																echo ($j == count($vehicles) - 1) ? $refuelings[$vehicle['vehicle_number']]['mileage'] : $refuelings[$vehicle['vehicle_number']]['mileage'] . ",\t";

														}
														else
														{
															echo ($j == count($vehicles) - 1) ? "null" : "null" . ",";
														}
														$j++;
													}
													echo "],\n";
											}
										
										?>
										]);
										
										var dataDistance = google.visualization.arrayToDataTable([
										<?php
											
											echo "\n['Refueling',";
											$i = 0;
											foreach($vehicles as $vehicle)
											{
												echo ($i == count($vehicles) - 1) ? "'" . $vehicle['vehicle_number'] . "'\t" : "'" . $vehicle['vehicle_number'] . "',";
												$i++;
											}
											echo "],\n";
											
											foreach($chart as $key => $value)
											{
												$nepaliMonth = key($value);
												$refuelings = $value[$nepaliMonth];
												echo "['" . $nepaliMonth . "',\t";
												$j = 0;
												foreach($vehicles as $vehicle)
												{
													if(isset($refuelings[$vehicle['vehicle_number']]))
													{
														if($refuelings[$vehicle['vehicle_number']]['distance'] == '0')		$refuelings[$vehicle['vehicle_number']]['distance'] = 'null';
														echo ($j == count($vehicles) - 1) ? $refuelings[$vehicle['vehicle_number']]['distance'] : $refuelings[$vehicle['vehicle_number']]['distance'] . ",\t";
														
													}
													else
													{
														echo ($j == count($vehicles) - 1) ? "null" : "null" . ",";
													}
													$j++;
												}
												echo "],\n";
											}
											
										?>
										]);
										
										var dataFuel = google.visualization.arrayToDataTable([
										<?php
											
											echo "\n['Refueling',";
											$i = 0;
											foreach($vehicles as $vehicle)
											{
												echo ($i == count($vehicles) - 1) ? "'" . $vehicle['vehicle_number'] . "'\t" : "'" . $vehicle['vehicle_number'] . "',";
												$i++;
											}
											echo "],\n";
											
											foreach($chart as $key => $value)
											{
												$nepaliMonth = key($value);
												$refuelings = $value[$nepaliMonth];
												echo "['" . $nepaliMonth . "',\t";
												$j = 0;
												foreach($vehicles as $vehicle)
												{
													if(isset($refuelings[$vehicle['vehicle_number']]))
													{
														if($refuelings[$vehicle['vehicle_number']]['fuel_amount'] == '0')		$refuelings[$vehicle['vehicle_number']]['fuel_amount'] = 'null';
														echo ($j == count($vehicles) - 1) ? $refuelings[$vehicle['vehicle_number']]['fuel_amount'] : $refuelings[$vehicle['vehicle_number']]['fuel_amount'] . ",\t";
														
													}
													else
													{
														echo ($j == count($vehicles) - 1) ? "null" : "null" . ",";
													}
													$j++;
												}
												echo "],\n";
											}
											
										?>
										]);
										
										var optionsMileage = {
											title: 'Mileage',
											min: 0,
											interpolateNulls: true
										};
										
										var optionsDistance = {
											title: 'Distance Covered',
											min: 0,
											interpolateNulls: true
										};
										
										var optionsFuel = {
											title: 'Fuel Consumption',
											min: 0,
											interpolateNulls: true
										};
										
										var chartMileage = new google.visualization.LineChart(document.getElementById('chart_mileage'));
										var chartDistance = new google.visualization.LineChart(document.getElementById('chart_distance'));
										var chartFuel = new google.visualization.LineChart(document.getElementById('chart_fuel'));
										
										chartMileage.draw(dataMileage, optionsMileage);
										chartDistance.draw(dataDistance, optionsDistance);
										chartFuel.draw(dataFuel, optionsFuel);
									}
								</script>
								
								<div id="chart_fuel" style="width: 900px; height: 500px;"></div>
								<div id="chart_distance" style="width: 900px; height: 500px;"></div>
								<div id="chart_mileage" style="width: 900px; height: 500px;"></div>
								
								
							</div><!--/.content -->
				</section>	<!--/.span12 -->
								
