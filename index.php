<?php
// Database connection
$servername = "localhost"; // Replace with your server
$username = "shairo";        // Replace with your DB username
$password = "Iamshairojames29"; // Replace with your DB password
$dbname = "mydb"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Variable to store error messages
$error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
    $mname = isset($_POST['mname']) ? $_POST['mname'] : '';
    $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $course_and_sec = isset($_POST['course_and_sec']) ? $_POST['course_and_sec'] : '';

    // Basic validation for required fields
    if (empty($fname) || empty($lname) || empty($age) || empty($address) || empty($course_and_sec)) {
        $error_message = "All fields are required. Please fill in all the information.";
    } else {
        // Sanitize data (Optional but recommended to prevent SQL Injection)
        $fname = $conn->real_escape_string($fname);
        $mname = $conn->real_escape_string($mname);
        $lname = $conn->real_escape_string($lname);
        $age = $conn->real_escape_string($age);
        $address = $conn->real_escape_string($address);
        $course_and_sec = $conn->real_escape_string($course_and_sec);

        // Insert data into the database
        $sql = "INSERT INTO d_form (fname, mname, lname, age, address, cas) 
                VALUES ('$fname', '$mname', '$lname', '$age', '$address', '$course_and_sec')";

        if ($conn->query($sql) === TRUE) {
            $success_message = "New record created successfully.";
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
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
    <title>Data Entry Form</title>
</head>
<body>
    <h2>Enter Your Information</h2>
    
    <?php if (!empty($error_message)): ?>
        <div style="color: red;">
            <?php echo $error_message; ?>
        </div>
    <?php elseif (isset($success_message)): ?>
        <div style="color: green;">
            <?php echo $success_message; ?>
        </div>
        <p><a href="index.php">Go back to the form</a></p>
    <?php else: ?>
        <!-- Display the form if no error or success message -->
        <form action="index.php" method="POST">
            <label for="fname">First Name:</label><br>
            <input type="text" id="fname" name="fname" required><br><br>

            <label for="mname">Middle Name:</label><br>
            <input type="text" id="mname" name="mname"><br><br>

            <label for="lname">Last Name:</label><br>
            <input type="text" id="lname" name="lname" required><br><br>

            <label for="age">Age:</label><br>
            <input type="number" id="age" name="age" required><br><br>

            <label for="address">Address:</label><br>
            <textarea id="address" name="address" required></textarea><br><br>

            <label for="course_and_sec">Course and Section:</label><br>
            <input type="text" id="cas" name="course_and_sec" required><br><br>

            <input type="submit" value="Submit">
        </form>
    <?php endif; ?>
</body>
</html>