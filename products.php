<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root"; // Change if needed
$password = "";
$dbname = "HBS";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$search = isset($_GET['search']) ? $_GET['search'] : "";

$sql = "SELECT id, name, description, price, category FROM products WHERE name LIKE '%$search%' OR category LIKE '%$search%'";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

echo json_encode($products);
$conn->close();
?>
