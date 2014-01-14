<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<title><?php echo $title ?> - Inventory Management</title>
		
		<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/more.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/nepali.datepicker.css" rel="stylesheet">
		
		<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>-->
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/nepali.datepicker.js"></script>
		
	</head>
<body>
		<div class="container center pad">
			<div class="row">
				<div class="span12 header">
					<div class="row">
						<div class="col-md-2">
							<img src='../../../img/logo-resized.png' alt='Logo' title=''>
						</div>
						<div class="col-md-8 text-left">
							<h2>Store Management System</h2>
							<h4>ABC School</h4>
							<h6>Somewhere, Earth</h6>
						</div>
					</div>
				</div><!--/.span12 -->
			</div><!--/.row -->
		</div><!--/.container -->
		
		<div class="container">
			<div class="navbar navbar-default">
						
					<div class="navbar-collapse collapse">
					    <ul class="nav navbar-nav">
							<li>
								<a href="<?php echo base_url(); ?>" id="drop1" title="Home">Home</a>
							</li>
						
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="drop1" title="Customers">Customers<strong class="caret"></strong></a>
								<ul class="dropdown-menu">
									<li>
										<a href="<?php echo base_url(); ?>index.php/customer/add" title="Add Customers">Add Customers</a>
									</li>
								</ul>
							</li>
						
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="drop1" title="Inventory">Inventory <strong class="caret"></strong></a>
								<ul class="dropdown-menu">
									<li>
										<a href="<?php echo base_url(); ?>index.php/inventory/add" title="Add Inventory">Add Inventory</a>
									</li>
								</ul>
							</li>
						
						
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="drop1" title="Reports">Reports <strong class="caret"></strong></a>
								<ul class="dropdown-menu">
									<li>
										<a href="<?php echo base_url(); ?>reports/fuel" title="Fuel Reports">Fuel Report</a>
									</li>
									
									<li>
										<a href="<?php echo base_url(); ?>reports/invoice" title="Invoice Reports">Invoice Report</a>
									</li>
									
									<li>
										<a href="<?php echo base_url(); ?>reports/quantity" title="Stock Balance Report">Stock Balance Report</a>
									</li>
									
									<li>
										<a href="<?php echo base_url(); ?>reports/stock" title="Stock Report">Stock Report</a>
									</li>
									
									<li>
										<a href="<?php echo base_url(); ?>reports/transaction" title="Transaction Report">Transaction Report</a>
									</li>
								</ul>
							</li>
						
						
						
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="drop1" title="Stock">Stock <strong class="caret"></strong></a>
								
								<ul class="dropdown-menu">
									<li>
										<a href="<?php echo base_url(); ?>index.php/stock/add" title="Add Stock">Add Stock</a>
									</li>
								</ul>
							</li>
						
						
						
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="drop1" title="Transaction">Transaction <strong class="caret"></strong></a>
								
								<ul class="dropdown-menu">
									<li>
										<a href="<?php echo base_url(); ?>index.php/transaction/add" title="Add Transaction">Add Transaction</a>
									</li>
								</ul>
							</li>
							
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="drop1" title="Vehicles">Vehicles <strong class="caret"></strong></a>
								
								<ul class="dropdown-menu">
									<li>
										<a href="<?php echo base_url(); ?>index.php/vehicle/add" title="Add Vehicles">Add Vehicles</a>
									</li>
									<li>
										<a href="<?php echo base_url(); ?>index.php/vehicle/mileage" title="Add Refueling Details">Add Refueling Details</a>
									</li>
								</ul>
							</li>
							
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="drop1" title="Warehouse">Warehouse <strong class="caret"></strong></a>
								
								<ul class="dropdown-menu">
									<li>
										<a href="<?php echo base_url(); ?>index.php/warehouse/add" title="Add Warehouse">Add Warehouse</a>
									</li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="<?php echo base_url(); ?>index.php/auth/change_password" title="Change Password">Change Password</a>
							</li>
						</ul>
						
						<ul class="nav navbar-nav navbar-right">
							<div style="margin-top: 15px;">
							Logged in as <a href="#" class="navbar-link"><?php echo $username; ?></a>
							 | <?php echo anchor('/auth/logout/', 'Logout'); ?>
							 </div>
						</ul>
					</div>
				</div>
			</div>
		
<div class="container center pad">
			<div class="row">
