<?php
session_start();
if (!isset($_SESSION["users"])) {
   header("Location: logreg.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- Remix Icons -->
	<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
	<!-- Material Icons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
	<!-- Coca-Cola Font -->
	<link href="https://fonts.cdnfonts.com/css/coca-cola-ii" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" href="prodHomestyle.css">
	<title>Coca-Cola</title>
</head>
<body>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class="ri-drinks-2-line"></i>
			<span class="text">Coca-Cola</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="prodHome.php">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bx-current-location'></i>
					<span class="text">Location</span>
				</a>
			</li>
			<li>
				<a href="prodUnit.php">
					<i class='bx bx-coin-stack'></i>
					<span class="text">Unit</span>
				</a>
			</li>
			<li>
				<a href="qualityCont.php">
					<i class='bx bx-slider-alt'></i>
					<span class="text">Quality Control</span>
				</a>
			</li>
			<li>
				<a href="prodSched.php">
					<i class='bx bxs-calendar'></i>
					<span class="text">Production Schedule</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<!-- <li>
				<a href="#">
					<i class='bx bx-user-circle'></i>
					<span class="text">Profile</span>
				</a>
			</li> -->
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bxs-log-out-circle'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu'></i>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>

			<a href="#" class="notification">
				<i class='bx bxs-bell'></i>
				<span class="num">8</span>
			</a>
		</nav>
		<!-- END OF NAVBAR -->

		<!-- MAIN -->
		<main class="main-container">
			<div class="main-title">
				<p class="font-weight-bold">DASHBOARD</p>
			</div>

			<div class="main-cards">
				<div class="card">
					<div class="card-inner">
						<p class="text-primary">Production Performance</p>
						<span class="material-icons-outlined text-blue">inventory</span>
					</div>
					<span class="text-primary font-weight-bold">75%</span>
				</div>

				<div class="card">
					<div class="card-inner">
						<p class="text-primary">Quality Control</p>
						<span class="material-icons-outlined text-orange">production_quantity_limits</span>
					</div>
					<span class="text-primary font-weight-bold">83</span>
				</div>

				<div class="card">
					<div class="card-inner">
						<p class="text-primary">Units Produced</p>
						<span class="material-icons-outlined text-green">shopping_cart_checkout</span>
					</div>
					<span class="text-primary font-weight-bold">79</span>
				</div>

				<div class="card">
					<div class="card-inner">
						<p class="text-primary">Production Output</p>
						<span class="material-icons-outlined text-red">output</span>
					</div>
					<span class="text-primary font-weight-bold">5,000 units/day</span>
				</div>
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Available Units</h3>
					</div>
					<table>
						<thead>
							<tr>
								<th>Coca-cola Products</th>
								<th>Quantity</th>
								<th>Manufacturing Date</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><p>Coke</p></td>
								<td>10,000</td>
								<td>2023-11-15</td>
							</tr>
							<tr>
								<td><p>Royal</p></td>
								<td>8,000</td>
								<td>2024-01-10</td>
							</tr>
							<tr>
								<td><p>Sprite</p></td>
								<td>15,000</td>
								<td>2024-02-20</td>
							</tr>
							<tr>
								<td><p>Minute Maid</p></td>
								<td>20,000</td>
								<td>2023-10-01</td>
							</tr>
							<tr>
								<td><p>A&W Root Beer</p></td>
								<td>5,000</td>
								<td>2023-12-20</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="charts">
				<div class="charts-card">
					<p class="chart-title">Defect Breakdown</p>
					<div id="bar-chart"></div>
				</div>

				<div class="charts-card">
					<p class="chart-title">Inventory Levels over Time</p>
					<div id="area-chart"></div>
				</div>
			</div>
		</main>
		<!-- End Main -->
	</section>
	<!-- END OF CONTENT -->

    <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <!-- Custom JS -->
	<script src="prodHome.js"></script>
</body>
</html>
