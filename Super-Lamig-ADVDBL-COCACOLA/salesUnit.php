<?php
session_start();
if (!isset($_SESSION["users"])) {
   header("Location: logreg.php");
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addUnit'])) {
        $product_id = $_POST['product_id'];
        $inventory_id = $_POST['inventory_id'];
        $batch_id = $_POST['batch_id'];
        $quantity = $_POST['quantity'];
        $manufacturing_date = $_POST['manufacturing_date'];
        $location = $_POST['location'];
        
        $sql = "INSERT INTO sales_units (product_id, inventory_id, batch_id, quantity, manufacturing_date, location) VALUES ('$product_id', '$inventory_id', '$batch_id', '$quantity', '$manufacturing_date', '$location')";
        
        if (mysqli_query($conn, $sql)) {
            echo "New unit created successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['updateUnit'])) {
        $id = $_POST['id'];
        $product_id = $_POST['product_id'];
        $inventory_id = $_POST['inventory_id'];
        $batch_id = $_POST['batch_id'];
        $quantity = $_POST['quantity'];
        $manufacturing_date = $_POST['manufacturing_date'];
        $location = $_POST['location'];
        
        $sql = "UPDATE sales_units SET product_id='$product_id', inventory_id='$inventory_id', batch_id='$batch_id', quantity='$quantity', manufacturing_date='$manufacturing_date', location='$location' WHERE id='$id'";
        
        if (mysqli_query($conn, $sql)) {
            echo "Unit updated successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['deleteUnit'])) {
        $id = $_POST['id'];
        
        $sql = "DELETE FROM sales_units WHERE id='$id'";
        
        if (mysqli_query($conn, $sql)) {
            echo "Unit deleted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

$sales_units = mysqli_query($conn, "SELECT * FROM sales_units");

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
    <link rel="stylesheet" type="text/css" href="salesUnitstyle.css">
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
			<li class="active">
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

<!-- SALES PAGE -->
<div class="table">
    <div class="table_header">
        <p><strong>Unit Details</strong></p>
        <div>
            <input placeholder="Search" id="productSearch"/>
            <button class="add_new" onclick="showAddUnitForm()">+ Add New</button>
        </div>
    </div>
    <div class="table_section">
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Inventory ID</th>
                    <th>Batch ID</th>
                    <th>Quantity</th>
                    <th>Manufacturing Date</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($sales_units)): ?>
                <tr>
                    <td><?= $row['product_id'] ?></td>
                    <td><?= $row['inventory_id'] ?></td>
                    <td><?= $row['batch_id'] ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td><?= $row['manufacturing_date'] ?></td>
                    <td><strong><?= $row['location'] ?></strong></td>
                    <td>
                        <button onclick="editUnit(<?= $row['id'] ?>, '<?= $row['product_id'] ?>', '<?= $row['inventory_id'] ?>', '<?= $row['batch_id'] ?>', '<?= $row['quantity'] ?>', '<?= $row['manufacturing_date'] ?>', '<?= $row['location'] ?>')"><i class='bx bxs-edit'></i></button>
                        <form method="post" style="display:inline-block;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" name="deleteUnit"><i class='bx bxs-trash-alt'></i></button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Unit Form Modal -->
<div id="unitFormModal" class="modal">
    <form method="post" id="unitForm" class="form-modal">
        <input type="hidden" name="id" id="unitId">
        <label for="product_id">Product ID:</label>
        <input type="text" name="product_id" id="product_id" required>
        
        <label for="inventory_id">Inventory ID:</label>
        <input type="text" name="inventory_id" id="inventory_id" required>
        
        <label for="batch_id">Batch ID:</label>
        <input type="text" name="batch_id" id="batch_id" required>
        
        <label for="quantity">Quantity:</label>
        <input type="text" name="quantity" id="quantity" required>
        
        <label for="manufacturing_date">Manufacturing Date:</label>
        <input type="date" name="manufacturing_date" id="manufacturing_date" required>
        
        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required>
        
        <button type="submit" name="addUnit" id="addUnitBtn">Add Unit</button>
        <button type="submit" name="updateUnit" id="updateUnitBtn" style="display: none;">Update Unit</button>
        <button type="button" onclick="hideUnitForm()">Cancel</button>
    </form>
</div>

<script src="unit.js"></script>
</body>

</html>
