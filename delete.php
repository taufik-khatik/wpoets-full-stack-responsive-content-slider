<?php
include "db.php";

$id = $_GET['id'];

$conn->query("DELETE FROM slides WHERE id=$id");

header("Location: index.php");
?>