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
	<link rel="stylesheet" href="prodstyle.css">
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
			<li>
				<a href="prodHome.php">
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
			<li class="active">
				<a href="prodSched.php">
					<i class='bx bxs-calendar'></i>
					<span class="text">Production Schedule</span>
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
				<a href="#" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->

    <!-- Main wrapper for the calendar application -->
    <div class="wrapper">
        <div class="container-calendar">
            <div id="left">
                <h1>Coca-Cola</h1>
                <div id="event-section">
                    <h3>Add Event</h3>
                    <input type="date" id="eventDate">
                    <input type="text"
                        id="eventTitle"
                        placeholder="Event Title">
                    <input type="text"
                        id="eventDescription"
                        placeholder="Event Description">
                    <button id="addEvent" onclick="addEvent()">
                        Add
                    </button>
                </div>
                <div id="reminder-section">
                    <h3>Reminders</h3>
                    <!-- List to display reminders -->
                    <ul id="reminderList">
                        <li data-event-id="1">
                            <strong>Event Title</strong>
                            - Event Description on Event Date
                            <button class="delete-event"
                                onclick="deleteEvent(1)">
                                Delete
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="right">
                <h3 id="monthAndYear"></h3>
                <div class="button-container-calendar">
                    <button id="previous"
                            onclick="previous()">
                        ‹
                    </button>
                    <button id="next"
                            onclick="next()">
                        ›
                    </button>
                </div>
                <table class="table-calendar"
                    id="calendar"
                    data-lang="en">
                    <thead id="thead-month"></thead>
                    <!-- Table body for displaying the calendar -->
                    <tbody id="calendar-body"></tbody>
                </table>
                <div class="footer-container-calendar">
                    <label for="month">Jump To: </label>
                    <!-- Dropdowns to select a specific month and year -->
                    <select id="month" onchange="jump()">
                        <option value=0>Jan</option>
                        <option value=1>Feb</option>
                        <option value=2>Mar</option>
                        <option value=3>Apr</option>
                        <option value=4>May</option>
                        <option value=5>Jun</option>
                        <option value=6>Jul</option>
                        <option value=7>Aug</option>
                        <option value=8>Sep</option>
                        <option value=9>Oct</option>
                        <option value=10>Nov</option>
                        <option value=11>Dec</option>
                    </select>
                    <!-- Dropdown to select a specific year -->
                    <select id="year" onchange="jump()"></select>
                </div>
            </div>
        </div>
    </div>
    <!-- Include the JavaScript file for the calendar functionality -->
    <script src="schedule.js"></script>
</body>
</html>