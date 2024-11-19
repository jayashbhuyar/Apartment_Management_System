<?php
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

// Fetch enquiries from the database
$enquiry_query = "SELECT * FROM enquiries";
$enquiry_result = $conn->query($enquiry_query);

// Function to sanitize data for CSV
function sanitizeForCSV($value) {
    // Escape special characters
    $value = htmlspecialchars_decode($value, ENT_QUOTES);
    // Enclose in double quotes and escape double quotes if necessary
    $value = '"' . str_replace('"', '""', $value) . '"';
    return $value;
}

// Function to generate CSV file
function generateCSV($data) {
    $file = fopen('enquiries.csv', 'w');
    // Add headers
    fputcsv($file, array('Name', 'Email', 'Contact'));
    // Add data
    foreach ($data as $row) {
        fputcsv($file, array($row['name'], $row['email'], $row['contact']));
    }
    fclose($file);
}

// Function to generate Excel file
function generateExcel($data) {
    // Load PHPExcel library
    require_once 'PHPExcel/Classes/PHPExcel.php';

    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();

    // Set document properties
    $objPHPExcel->getProperties()->setCreator("Apartment Management")
                                 ->setLastModifiedBy("Apartment Management")
                                 ->setTitle("Enquiries")
                                 ->setSubject("Enquiries")
                                 ->setDescription("Enquiries Data")
                                 ->setKeywords("enquiries")
                                 ->setCategory("Enquiries");

    // Add headers
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Name')
                ->setCellValue('B1', 'Email')
                ->setCellValue('C1', 'Contact');

    // Add data
    $rowIndex = 2;
    foreach ($data as $row) {
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $rowIndex, $row['name'])
                    ->setCellValue('B' . $rowIndex, $row['email'])
                    ->setCellValue('C' . $rowIndex, $row['contact']);
        $rowIndex++;
    }

    // Set active sheet index to the first sheet
    $objPHPExcel->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Excel5)
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="enquiries.xls"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Enquiries</title>
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

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .export-button, .return-button {
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

        .export-button:hover, .return-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Enquiries</h2>

        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
            </tr>
            <?php
            if ($enquiry_result->num_rows > 0) {
                while ($row = $enquiry_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["contact"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No enquiries found</td></tr>";
            }
            ?>
        </table>
        <div class="button-container">
            <button onclick="location.href='exportenq.php'" class="export-button">Export Data</button>
            <button onclick="location.href='admin_dashboard.php'" class="return-button">Return to Home</button>
        </div>
    </div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>