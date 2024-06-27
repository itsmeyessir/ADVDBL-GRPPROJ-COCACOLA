<?php
session_start();
if (!isset($_SESSION["users"])) {
   header("Location: logreg.php");
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addOrder'])) {
        $sales_order_id = $_POST['sales_order_id'];
        $buyer_id = $_POST['buyer_id'];
        $items_ordered = $_POST['items_ordered'];
        $total_price = $_POST['total_price'];
        $order_date = $_POST['order_date'];
        $delivery_date = $_POST['delivery_date'];
        $status = $_POST['status'];
        
        $sql = "INSERT INTO orders (sales_order_id, buyer_id, items_ordered, total_price, order_date, delivery_date, status) VALUES ('$sales_order_id', '$buyer_id', '$items_ordered', '$total_price', '$order_date', '$delivery_date', '$status')";
        
        if (mysqli_query($conn, $sql)) {
            echo "New order created successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['updateOrder'])) {
        $id = $_POST['id'];
        $sales_order_id = $_POST['sales_order_id'];
        $buyer_id = $_POST['buyer_id'];
        $items_ordered = $_POST['items_ordered'];
        $total_price = $_POST['total_price'];
        $order_date = $_POST['order_date'];
        $delivery_date = $_POST['delivery_date'];
        $status = $_POST['status'];
        
        $sql = "UPDATE orders SET sales_order_id='$sales_order_id', buyer_id='$buyer_id', items_ordered='$items_ordered', total_price='$total_price', order_date='$order_date', delivery_date='$delivery_date', status='$status' WHERE id='$id'";
        
        if (mysqli_query($conn, $sql)) {
            echo "Order updated successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['deleteOrder'])) {
        $id = $_POST['id'];
        
        $sql = "DELETE FROM orders WHERE id='$id'";
        
        if (mysqli_query($conn, $sql)) {
            echo "Order deleted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

$orders = mysqli_query($conn, "SELECT * FROM orders");

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
    <link rel="stylesheet" type="text/css" href="orderStyle.css">
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
			<li class="active">
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

<!-- ORDER PAGE -->
<div class="table">
    <div class="table_header">
        <p><strong>Order Details</strong></p>
        <div>
            <input placeholder="Search" id="productSearch"/>
            <button class="add_new" onclick="showAddOrderForm()">+ Add New</button>
        </div>
    </div>
    <div class="table_section">
        <table>
            <thead>
                <tr>
                    <th>Sales Order ID</th>
                    <th>Buyer's ID</th>
                    <th>Items Ordered</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($orders)): ?>
                <tr>
                    <td><?= $row['sales_order_id'] ?></td>
                    <td><?= $row['buyer_id'] ?></td>
                    <td><?= $row['items_ordered'] ?></td>
                    <td><?= $row['total_price'] ?></td>
                    <td><?= $row['order_date'] ?></td>
                    <td><?= $row['delivery_date'] ?></td>
                    <td><strong><?= $row['status'] ?></strong></td>
                    <td>
                        <button onclick="editOrder(<?= $row['id'] ?>, '<?= $row['sales_order_id'] ?>', '<?= $row['buyer_id'] ?>', '<?= $row['items_ordered'] ?>', '<?= $row['total_price'] ?>', '<?= $row['order_date'] ?>', '<?= $row['delivery_date'] ?>', '<?= $row['status'] ?>')"><i class='bx bxs-edit'></i></button>
                        <form method="post" style="display:inline-block;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" name="deleteOrder"><i class='bx bxs-trash-alt'></i></button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Order Form Modal -->
<div id="orderFormModal" class="modal">
    <form method="post" id="orderForm" class="form-modal">
        <input type="hidden" name="id" id="orderId">
        <label for="sales_order_id">Sales Order ID:</label>
        <input type="text" name="sales_order_id" id="sales_order_id" required>
        
        <label for="buyer_id">Buyer ID:</label>
        <input type="text" name="buyer_id" id="buyer_id" required>
        
        <label for="items_ordered">Items Ordered:</label>
        <input type="text" name="items_ordered" id="items_ordered" required>
        
        <label for="total_price">Total Price:</label>
        <input type="text" name="total_price" id="total_price" required>
        
        <label for="order_date">Order Date:</label>
        <input type="date" name="order_date" id="order_date" required>
        
        <label for="delivery_date">Delivery Date:</label>
        <input type="date" name="delivery_date" id="delivery_date" required>
        
        <label for="status">Status:</label>
        <input type="text" name="status" id="status" required>
        
        <button type="submit" name="addOrder" id="addOrderBtn">Add Order</button>
        <button type="submit" name="updateOrder" id="updateOrderBtn" style="display: none;">Update Order</button>
        <button type="button" onclick="hideOrderForm()">Cancel</button>
    </form>
</div>

<script src="order.js"></script>
</body>

</html>
