<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employees</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #2c3e50;
            color: #ecf0f1;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: 20px;
            padding: 20px;
            background-color: #34495e;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        h2 {
            text-align: center;
            color: #e74c3c;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #7f8c8d;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #e74c3c;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #3b5998;
        }

        tr:hover {
            background-color: #2980b9;
        }

        .back-button, .delete-button, .create-employee-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            margin-right: 10px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover, .create-employee-button:hover {
            background-color: #c0392b;
        }

        .delete-button {
            background-color: #e74c3c;
        }

        .delete-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Start session
        session_start();

        // Database connection parameters
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

        // Check if a deletion request is made
        if (isset($_GET['delete_id'])) {
            $delete_id = $_GET['delete_id'];
            // Delete the employee with the given ID
            $sql = "DELETE FROM employee WHERE employee_id = $delete_id";
            if ($conn->query($sql) === TRUE) {
                echo "Employee deleted successfully.";
            } else {
                echo "Error deleting employee: " . $conn->error;
            }
        }

        // Query to retrieve all employees
        $query = "SELECT * FROM employee";

        // Execute query
        $result = $conn->query($query);

        // Check if any employees found
        if ($result->num_rows > 0) {
            // Output employee details
            echo "<h2>All Employees</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone Number</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["employee_id"] . "</td>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["phone_number"] . "</td>";
                echo "<td><a href='?delete_id=" . $row["employee_id"] . "' class='delete-button'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No employees found.";
        }

        // Close database connection
        $conn->close();
        ?>
        <br>
        <a href="../admin/admin_dashboard.php" class="back-button">Return Home</a>
        <a href="../owner/createemployee.php" class="create-employee-button">Create Employee</a>
    </div>
</body>
</html>