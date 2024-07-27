<?php
include '../../config/functions.php';

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: No ID provided.");
}

$id = intval($_GET['id']);

// Process deletion
$resultMessage = deleteSponsor($id);
echo $resultMessage;

// Redirect to sponsor list page or another relevant page
header("Location: sponsor.php");
exit();
