<?php
session_start();
if (!isset($_SESSION["users"])) {
   header("Location: logreg.php");
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addUnit'])) {
        $product_name = $_POST['product_name'];
        $description = $_POST['description'];
        $size = $_POST['size'];
        $price = $_POST['price'];
        $lead_time = $_POST['lead_time'];
        
        $sql = "INSERT INTO production_units (product_name, description, size, price, lead_time) VALUES ('$product_name', '$description', '$size', '$price', '$lead_time')";
        
        if (mysqli_query($conn, $sql)) {
            echo "New unit created successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['updateUnit'])) {
        $id = $_POST['id'];
        $product_name = $_POST['product_name'];
        $description = $_POST['description'];
        $size = $_POST['size'];
        $price = $_POST['price'];
        $lead_time = $_POST['lead_time'];
        
        $sql = "UPDATE production_units SET product_name='$product_name', description='$description', size='$size', price='$price', lead_time='$lead_time' WHERE id='$id'";
        
        if (mysqli_query($conn, $sql)) {
            echo "Unit updated successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['deleteUnit'])) {
        $id = $_POST['id'];
        
        $sql = "DELETE FROM production_units WHERE id='$id'";
        
        if (mysqli_query($conn, $sql)) {
            echo "Unit deleted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

$production_units = mysqli_query($conn, "SELECT * FROM production_units");

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
    <link rel="stylesheet" type="text/css" href="prodUnitstyle.css">
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
            <li class="active">
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
                    <i class='bx bx-user-circle' ></i>
                    <span class="text">Profile</span>
                </a>
            </li> -->
            <li>
                <a href="logout.php" class="logout">
                    <i class='bx bxs-log-out-circle' ></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- UNIT PAGE -->
    <div class = "table">
        <div class = "table_header">
            <p><strong>Unit Details</strong></p>
            <div>
                <input placeholder="product"/>
                <button class = "add_new" onclick="showAddUnitForm()">+ Add New</button>
            </div>
        </div>
        <div class = "table_section">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Lead Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($production_units)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['product_name'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= $row['size'] ?></td>
                        <td><?= $row['price'] ?></td>
                        <td><strong><?= $row['lead_time'] ?></strong></td>
                        <td>
                            <button onclick="editUnit(<?= $row['id'] ?>, '<?= $row['product_name'] ?>', '<?= $row['description'] ?>', '<?= $row['size'] ?>', '<?= $row['price'] ?>', '<?= $row['lead_time'] ?>')"><i class='bx bxs-edit'></i></button>
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
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" id="product_name" required>
            
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" required>
            
            <label for="size">Size:</label>
            <input type="text" name="size" id="size" required>
            
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" required>
            
            <label for="lead_time">Lead Time:</label>
            <input type="text" name="lead_time" id="lead_time" required>
            
            <button type="submit" name="addUnit" id="addUnitBtn">Add Unit</button>
            <button type="submit" name="updateUnit" id="updateUnitBtn" style="display: none;">Update Unit</button>
            <button type="button" onclick="hideUnitForm()">Cancel</button>
        </form>
    </div>

    <script src="prodUnit.js"></script>
</body>

</html>
