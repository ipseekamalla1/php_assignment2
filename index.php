<?php

$conn = new mysqli('localhost', 'root', '', 'hoodieHub');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Create Operation: Add a new hoodie to the database
if (isset($_POST['create'])) {
    $hoodieName = $_POST['hoodieName'];
    $hoodieDescription = $_POST['hoodieDescription'];
    $quantityAvailable = $_POST['quantityAvailable'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $productAddedBy = "Ipseeka Malla"; // Hardcoded or fetched from session/user input

    // Insert hoodie into the database with ProductAddedBy
    $sql = "INSERT INTO hoodies (HoodieName, HoodieDescription, QuantityAvailable, Price, Size, ProductAddedBy) 
            VALUES ('$hoodieName', '$hoodieDescription', $quantityAvailable, $price, '$size', '$productAddedBy')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "New hoodie added successfully by $productAddedBy!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Update Operation: Update hoodie details in the database
if (isset($_POST['update'])) {
    $hoodieID = $_POST['hoodieID'];
    $hoodieName = $_POST['hoodieName'];
    $hoodieDescription = $_POST['hoodieDescription'];
    $quantityAvailable = $_POST['quantityAvailable'];
    $price = $_POST['price'];
    $size = $_POST['size'];

    // Update hoodie in the database
    $sql = "UPDATE hoodies SET HoodieName='$hoodieName', HoodieDescription='$hoodieDescription', 
            QuantityAvailable=$quantityAvailable, Price=$price, Size='$size' WHERE HoodieID=$hoodieID";

    if ($conn->query($sql) === TRUE) {
        $message = "Hoodie updated successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Delete Operation: Delete a hoodie from the database
if (isset($_POST['delete'])) {
    $hoodieID = $_POST['hoodieID'];

    // Delete hoodie from the database
    $sql = "DELETE FROM hoodies WHERE HoodieID=$hoodieID";

    if ($conn->query($sql) === TRUE) {
        $message = "Hoodie deleted successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Read Operation: Fetch all hoodies from the database
$sql = "SELECT * FROM hoodies";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HoodieHub - Ecommerce Site</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">HoodieHub</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#availableHoodies">Available Hoodies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#addHoodie">Add Hoodie</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="hero">
        <h1>Welcome to Your Hoodie Hub</h1>
    </div>

    <div class="container mt-5">
        <h3>Hello Admin,</h3>
       
        <p class="text-success text-center"><?php echo $message; ?></p>

        <!-- READ AND DELETE SECTION (Available Hoodies) -->
        <h2 id="availableHoodies" class="text-center my-4">Discover Our Available Hoodies</h2>
        <div class="list-group">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="list-group-item">';
                    echo '<h5 class="mb-1">' . $row["HoodieName"] . '</h5>';
                    echo '<p class="mb-1">' . $row["HoodieDescription"] . '</p>';
                    echo '<p><strong>Quantity:</strong> ' . $row["QuantityAvailable"] . '</p>';
                    echo '<p><strong>Price:</strong> $' . $row["Price"] . '</p>';
                    echo '<p><strong>Size:</strong> ' . $row["Size"] . '</p>';
                    echo '<p><strong>Added By:</strong> ' . $row["ProductAddedBy"] . '</p>';  // Display who added the hoodie
                    echo '<div class="d-flex justify-content-between align-items-center">';
                    echo '<button class="btn btn-success btn-sm edit" onclick="populateForm(' . $row["HoodieID"] . ', \'' . addslashes($row["HoodieName"]) . '\', \'' . addslashes($row["HoodieDescription"]) . '\', ' . $row["QuantityAvailable"] . ', ' . $row["Price"] . ', \'' . addslashes($row["Size"]) . '\')"><a href="#addHoodie">Edit</a></button>';
                    echo '<form method="post" action="" style="display:inline;">
                            <input type="hidden" name="hoodieID" value="' . $row["HoodieID"] . '">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                          </form>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<div class='list-group-item'>No hoodies found</div>";
            }
            ?>
        </div>

        <hr>

        <div class="hoodie">
            <h2 id="addHoodie" class="text-center my-4">Add Hoodie</h2>
            <form method="post" action="">
                <input type="hidden" name="hoodieID" id="hoodieID">

                <div class="form-group">
                    <label for="hoodieName">Hoodie Name:</label>
                    <input type="text" name="hoodieName" id="hoodieName" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="hoodieDescription">Hoodie Description:</label>
                    <textarea name="hoodieDescription" id="hoodieDescription" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="quantityAvailable">Quantity Available:</label>
                    <input type="number" name="quantityAvailable" id="quantityAvailable" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" name="price" id="price" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="size">Size:</label>
                    <input type="text" name="size" id="size" class="form-control" required>
                </div>

                <button type="submit" name="create" class="btn btn-primary btn-block">Add Hoodie</button>
                <button type="submit" name="update" class="btn btn-warning btn-block">Update Hoodie</button>
            </form>
        </div>
    </div>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2024 HoodieHub. All Rights Reserved.</p>
            <p>Contact: <a href="mailto:info@hoodiehub.com">info@hoodiehub.com</a></p>
            <p>Follow us on 
                <a href="#" target="_blank">Facebook</a>, 
                <a href="#" target="_blank">Twitter</a>, 
                <a href="#" target="_blank">Instagram</a>
            </p>
        </div>
    </footer>

    <script>
        // Function to populate the form for editing
        function populateForm(hoodieID, hoodieName, hoodieDescription, quantityAvailable, price, size) {
            document.getElementById('hoodieID').value = hoodieID;
            document.getElementById('hoodieName').value = hoodieName;
            document.getElementById('hoodieDescription').value = hoodieDescription;
            document.getElementById('quantityAvailable').value = quantityAvailable;
            document.getElementById('price').value = price;
            document.getElementById('size').value = size;
        }
    </script>

</body>
</html>
