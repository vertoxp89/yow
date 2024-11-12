<?php
// Database connection
$servername = "localhost"; // Replace with your server
$username = "shairo";        // Replace with your DB username
$password = "Iamshairojames29";            // Replace with your DB password
$dbname = "mydb"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $course_and_sec = $_POST['cas'];

    // Insert data into the database
    $sql = "INSERT INTO d_form (fname, mname, lname, age, address, cas) 
            VALUES ('$fname', '$mname', '$lname', '$age', '$address', '$cas')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Entry Result</title>
</head>
<body>
    <h2>Form Submission Successful</h2>
    <p><a href="form.php">Go back to the form</a></p>
</body>
</html>
