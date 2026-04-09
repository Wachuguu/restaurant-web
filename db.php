<?php
$conn = new mysqli(
    'sql109.infinityfree.com',      
    'if0_41624021',         // e.g. if0_41624021
    'Wachugu38',
    'if0_41624021_restaurant'     // e.g. if0_41624021_restaurant
);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>