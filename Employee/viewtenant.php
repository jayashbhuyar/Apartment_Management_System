<?php
// Start the session
session_start();

$servername = "localhost";
$username = "root";
$password = "Jayash@123";
$database = "apartment_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Variable to store tenant_id
$tenant_id = "";

// Check if form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and store tenant_id
    $tenant_id = sanitize_input($_POST["tenant_id"]);
}

// SQL query to select all tenants
$tenant_query = "SELECT * FROM tenant";

// Execute tenant query
$tenant_result = $conn->query($tenant_query);

// Check if tenant_id is set in GET request
if(isset($_GET['tenant_id'])) {
    $tenant_id = $_GET['tenant_id'];
    
    // Fetch tenant details
    $sql = "SELECT * FROM tenant WHERE tenant_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $tenant_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $tenant = $result->fetch_assoc();
    
    // Delete the tenant
    $sql = "DELETE FROM tenant WHERE tenant_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $tenant_id);
    
    if($stmt->execute()) {
        echo "<script>alert('Tenant deleted successfully!'); window.location.href='viewtenant.php';</script>";
    } else {
        echo "<script>alert('Error deleting tenant!'); window.location.href='viewtenant.php';</script>";
    }
    
    $stmt->close();
}

// Handle form submission
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $tenant_id = $_POST['tenant_id'];
    
    $update_sql = "UPDATE tenant SET first_name=?, last_name=?, email=?, phone_number=?, age=?, dob=? WHERE tenant_id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssssi", $first_name, $last_name, $email, $phone_number, $age, $dob, $tenant_id);
    
    if($update_stmt->execute()) {
        echo "<script>alert('Tenant updated successfully!'); window.location.href='viewtenant.php';</script>";
    } else {
        echo "<script>alert('Error updating tenant!'); window.location.href='viewtenant.php';</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #289898;
            --secondary-color: #4CAF50;
            --danger-color: #f44336;
            --text-color: #333;
            --light-text: #fff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 40px;
            background-image: url('https://www.luxuryresidences.in/seo-assest/images/ambience-tiverton.webp');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            color: var(--light-text);
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
    text-align: center;
    font-size: 2.5em;
    margin-bottom: 30px;
    color: #000000; /* Changed to black */
    text-shadow: 2px 2px 4px rgba(255,255,255,0.3); /* Updated shadow for better visibility against dark background */
    font-weight: 600; /* Added for better visibility */
}

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
            margin: 20px 0;
        }

        th {
            background-color: rgba(76, 175, 80, 0.3);
            color: var(--light-text);
            padding: 15px;
            text-align: left;
            font-weight: 500;
            font-size: 1.1em;
        }

        td {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 15px;
            transition: all 0.3s ease;
        }

        tr:hover td {
            background-color: rgba(255, 255, 255, 0.2);
            transform: scale(1.01);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .delete-button, .edit-button {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.9em;
        }

        .delete-button {
            background-color: var(--danger-color);
            color: white;
        }

        .edit-button {
            background-color: var(--primary-color);
            color: white;
        }

        .delete-button:hover, .edit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .back-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: var(--secondary-color);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 20px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .back-button:hover {
            background-color: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        @media (max-width: 768px) {
            body {
                padding: 20px;
            }

            table {
                display: block;
                overflow-x: auto;
            }

            td, th {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tenant Details</h2>
        <table>
            <tr>
                <th>Tenant ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Age</th>
                <th>Date of Birth</th>
                <th>Action</th>
            </tr>
            <?php
            if ($tenant_result->num_rows > 0) {
                while ($row = $tenant_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["tenant_id"] . "</td>";
                    echo "<td>" . $row["first_name"] . "</td>";
                    echo "<td>" . $row["last_name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["phone_number"] . "</td>";
                    echo "<td>" . $row["age"] . "</td>";
                    echo "<td>" . $row["dob"] . "</td>";
                    echo "<td class='action-buttons'>";
                    echo "<button class='delete-button' onclick='deleteTenant(" . $row["tenant_id"] . ")'><i class='fa fa-trash'></i> Delete</button>";
                    echo "<button class='edit-button' onclick='editTenant(" . $row["tenant_id"] . ")'><i class='fa fa-edit'></i> Edit</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No tenants found</td></tr>";
            }
            ?>
        </table>
        <a href="empdashboard.php" class="back-button">Return Home</a>
    </div>

    <!-- Add this after the table but before closing body tag -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
        // Function to delete tenant
        function deleteTenant(tenant_id) {
            if(confirm('Are you sure you want to delete this tenant?')) {
                window.location.href = 'delete_tenant.php?tenant_id=' + tenant_id;
            }
        }

        // Function to edit tenant
        function editTenant(tenant_id) {
            window.location.href = 'edit_tenant.php?tenant_id=' + tenant_id;
        }
    </script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Tenant</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Use same styling as viewtenant.php */
        /* Add form specific styles */
        .edit-form {
            max-width: 500px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: black;
        }
        .form-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .submit-btn {
            background-color: var(--secondary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Tenant</h2>
        <form class="edit-form" method="POST">
            <input type="hidden" name="tenant_id" value="<?php echo $tenant['tenant_id']; ?>">
            
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" value="<?php echo $tenant['first_name']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" value="<?php echo $tenant['last_name']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $tenant['email']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone_number" value="<?php echo $tenant['phone_number']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" value="<?php echo $tenant['age']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="dob" value="<?php echo $tenant['dob']; ?>" required>
            </div>
            
            <button type="submit" class="submit-btn">Update Tenant</button>
            <a href="viewtenant.php" class="back-button">Cancel</a>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?> -->
