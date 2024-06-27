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
	<!-- Google Icons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
	<!-- Coca-Cola Font -->
	<link href="https://fonts.cdnfonts.com/css/coca-cola-ii" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" href="homeStyle.css">
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
				<a href="index.php">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bx-current-location' ></i>
					<span class="text">Location</span>
				</a>
			</li>
			<li>
				<a href="order.php">
					<i class='bx bx-package'></i>	
					<span class="text">Order</span>
				</a>
			</li>
			<li>
				<a href="salesUnit.php">
					<i class='bx bx-coin-stack'></i>
					<span class="text">Unit</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<!-- <li>
				<a href="#">
					<i class='bx bx-user-circle' ></i>
					<span class="text">Profile</span>
				</a>
			</li> -->
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bx-log-out'></i>
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
			<i class='bx bx-menu' ></i>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>

			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
		</nav>
		<!-- END OF NAVBAR -->

		<!-- MAIN -->
		<main>
			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>1020</h3>
						<p>New Order</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-coin-stack' ></i>
					<span class="text">
						<h3>2834</h3>
						<p>Total Units</p>
					</span>
				</li>
				<li>
					<i class='bx bx-money'></i>
					<span class="text">
						<h3>₱2543</h3>
						<p>Total Sales</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent Orders</h3>
					</div>
					<table>
						<thead>
							<tr>
								<th>Buyer</th>
								<th>Date Order</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<img src="KFC.jpg">
									<p>John Bert</p>
								</td>
								<td>30-04-2024</td>
								<td><span class="status completed">Completed</span></td>
							</tr>
							<tr>
								<td>
									<img src="KFC.jpg">
									<p>Son Chaeyoung</p>
								</td>
								<td>22-06-2024</td>
								<td><span class="status pending">Pending</span></td>
							</tr>
							<tr>
								<td>
									<img src="KFC.jpg">
									<p>Robbie Emman</p>
								</td>
								<td>25-06-2024</td>
								<td><span class="status process">Process</span></td>
							</tr>
							<tr>
								<td>
									<img src="KFC.jpg">
									<p>Micheal Dhan</p>
								</td>
								<td>20-06-2024</td>
								<td><span class="status pending">Pending</span></td>
							</tr>
							<tr>
								<td>
									<img src="KFC.jpg">
									<p>John Angelo</p>
								</td>
								<td>10-05-2024</td>
								<td><span class="status completed">Completed</span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="charts">
				<div class="charts-card">
					<p class="chart-title">Top 5 Products</p>
					<div id="bar-chart"></div>
				</div>

				<div class="charts-card">
					<p class="chart-title">Purchase and Sales Orders</p>
					<div id="area-chart"></div>
				</div>
			</div>
		</main>
		<!-- END OF MAIN -->
	</section>
	<!-- END OF CONTENT -->
	<!-- apexchart -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
	<!-- script -->
	<script src="home.js"></script>
</body>
</html>
