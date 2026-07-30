<!-- Task 1 -->
 <?php

    if(isset($_REQUEST["submit"]))
    {
        $name = $_REQUEST["name"];
        $email = $_REQUEST["email"];
        $message = $_REQUEST["message"];

        echo "Name: $name <br>";
        echo "Email: $email <br>";
        echo "Message: $message";
    }

?>

<!DOCTYPE html>
<html>

<body>

<form method="POST">

Name:
<input type="text" name="name">

<br><br>

Email:
<input type="email" name="email">

<br><br>

Message:
<textarea name="message"></textarea>

<br><br>

<input type="submit" name="submit">

</form>

</body>
</html>

<!-- Task 2 -->
 <?php

    echo "Host Name: " . $_SERVER["SERVER_NAME"] . "<br>";

    echo "PHP Version: " . phpversion() . "<br>";

    echo "Request Method: " . $_SERVER["REQUEST_METHOD"];

?>

<!-- Task 3 -->
 /*
 CREATE DATABASE website;
 USE website;

 CREATE TABLE users
(
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100),
email VARCHAR(100)
);
*/
<?php

    $conn = mysqli_connect("localhost","root","password1223","website");

    if(!$conn)
    {
        die("Connection Failed");
    }

    echo "Connected Successfully";

?>

<!-- Task 4 -->
 <?php
    $sql = "INSERT INTO users(name,email)
    VALUES('John','john@gmail.com')";

    mysqli_query($conn,$sql);

    $sql = "SELECT * FROM users";

    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result))
    {
        echo $row["id"] . "<br>";
        echo $row["name"] . "<br>";
        echo $row["email"] . "<br>";
    }
    $sql = "UPDATE users
    SET email='newemail@gmail.com'
    WHERE id=1";

    mysqli_query($conn,$sql);
    $sql = "DELETE FROM users
    WHERE id=1";

    mysqli_query($conn,$sql);
?>

<!-- Task 5 -->
 /* CREATE DATABASE website;

USE website;

CREATE TABLE users
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    message TEXT
); 
*/

<?php

// Database Connection
$conn = mysqli_connect("localhost", "root", "", "website");

// Check connection
if (!$conn)
{
    die("Connection Failed: " . mysqli_connect_error());
}

// Save data into database
if (isset($_POST["save"]))
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $sql = "INSERT INTO users (name, email, message)
            VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $sql))
    {
        echo "<p style='color:green;'>Record saved successfully!</p>";
    }
    else
    {
        echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Final PHP Project</title>
</head>
<body>

<h2>User Information Form</h2>

<form method="POST">

    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Message:</label><br>
    <textarea name="message" rows="4" cols="40" required></textarea><br><br>

    <input type="submit" name="save" value="Save">

</form>

<hr>

<h2>All Records</h2>

<table border="1" cellpadding="8">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Message</th>
    <th>Actions</th>
</tr>

<?php

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result))
{
    echo "<tr>";

    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["name"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["message"] . "</td>";

    echo "<td>";
    echo "<a href='edit.php?id=" . $row["id"] . "'>Edit</a> | ";
    echo "<a href='delete.php?id=" . $row["id"] . "'>Delete</a>";
    echo "</td>";

    echo "</tr>";
}

?>

</table>

</body>
</html>
