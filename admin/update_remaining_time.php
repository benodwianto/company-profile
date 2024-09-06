<?php
session_start();

if (isset($_POST['remaining_time'])) {
    $_SESSION['remaining_time'] = (int)$_POST['remaining_time'];
}
?>