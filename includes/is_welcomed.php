<?php

if (!isset($_SESSION['is_welcomed'])) {
    header('location: index.php');
}