<?php
session_start();
if (!isset($_SESSION["users"])) {
   header("Location: logreg.php");
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addQualityControl'])) {
        $product_id = $_POST['product_id'];
        $batch_number = $_POST['batch_number'];
        $description = $_POST['description'];
        $inspection_date = $_POST['inspection_date'];
        $test_performed = $_POST['test_performed'];
        $status = $_POST['status'];
        $defect_description = $_POST['defect_description'];
        
        $sql = "INSERT INTO quality_control (product_id, batch_number, description, inspection_date, test_performed, status, defect_description) VALUES ('$product_id', '$batch_number', '$description', '$inspection_date', '$test_performed', '$status', '$defect_description')";
        
        if (mysqli_query($conn, $sql)) {
            echo "New quality control record created successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['updateQualityControl'])) {
        $id = $_POST['id'];
        $product_id = $_POST['product_id'];
        $batch_number = $_POST['batch_number'];
        $description = $_POST['description'];
        $inspection_date = $_POST['inspection_date'];
        $test_performed = $_POST['test_performed'];
        $status = $_POST['status'];
        $defect_description = $_POST['defect_description'];
        
        $sql = "UPDATE quality_control SET product_id='$product_id', batch_number='$batch_number', description='$description', inspection_date='$inspection_date', test_performed='$test_performed', status='$status', defect_description='$defect_description' WHERE id='$id'";
        
        if (mysqli_query($conn, $sql)) {
            echo "Quality control record updated successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['deleteQualityControl'])) {
        $id = $_POST['id'];
        
        $sql = "DELETE FROM quality_control WHERE id='$id'";
        
        if (mysqli_query($conn, $sql)) {
            echo "Quality control record deleted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

$quality_control = mysqli_query($conn, "SELECT * FROM quality_control");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- Remix Icons -->
	<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
	<!-- Google Icons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
	<!-- Coca-Cola Font -->
	<link href="https://fonts.cdnfonts.com/css/coca-cola-ii" rel="stylesheet">
    <!-- CSS  -->
    <link rel="stylesheet" type="text/css" href="qualiStyle.css">
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
			<li class="active">
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

    <!-- QUALITY CONTROL PAGE -->
    <div class="table">
        <div class="table_header">
            <p><strong>Quality Control</strong></p>
            <div>
                <input placeholder="Search" id="productSearch"/>
                <button class="add_new" onclick="showAddQualityControlForm()">+ Add New</button>
            </div>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Batch Number</th>
                        <th>Description</th>
                        <th>Inspection Date</th>
						<th>Test Performed</th>
                        <th>Status</th>
                        <th>Defect Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($quality_control)): ?>
                    <tr>
                        <td><?= $row['product_id'] ?></td>
                        <td><?= $row['batch_number'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= $row['inspection_date'] ?></td>
						<td><?= $row['test_performed'] ?></td>
                        <td><strong><?= $row['status'] ?></strong></td>
                        <td><?= $row['defect_description'] ?></td>
                        <td>
                            <button onclick="editQualityControl(<?= $row['id'] ?>, '<?= $row['product_id'] ?>', '<?= $row['batch_number'] ?>', '<?= $row['description'] ?>', '<?= $row['inspection_date'] ?>', '<?= $row['test_performed'] ?>', '<?= $row['status'] ?>', '<?= $row['defect_description'] ?>')"><i class='bx bxs-edit'></i></button>
                            <form method="post" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" name="deleteQualityControl"><i class='bx bxs-trash-alt'></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quality Control Form Modal -->
    <div id="qualityControlFormModal" class="modal">
        <form method="post" id="qualityControlForm" class="form-modal">
            <input type="hidden" name="id" id="qualityControlId">
            <label for="product_id">Product ID:</label>
            <input type="text" name="product_id" id="product_id" required>
            
            <label for="batch_number">Batch Number:</label>
            <input type="text" name="batch_number" id="batch_number" required>
            
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" required>
            
            <label for="inspection_date">Inspection Date:</label>
            <input type="date" name="inspection_date" id="inspection_date" required>
            
            <label for="test_performed">Test Performed:</label>
            <input type="text" name="test_performed" id="test_performed" required>
            
            <label for="status">Status:</label>
            <input type="text" name="status" id="status" required>
            
            <label for="defect_description">Defect Description:</label>
            <input type="text" name="defect_description" id="defect_description">
            
            <button type="submit" name="addQualityControl" id="addQualityControlBtn">Add Quality Control</button>
            <button type="submit" name="updateQualityControl" id="updateQualityControlBtn" style="display: none;">Update Quality Control</button>
            <button type="button" onclick="hideQualityControlForm()">Cancel</button>
        </form>
    </div>

    <script src="function.js"></script>
</body>

</html>

