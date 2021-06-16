<?php
require 'includes/common.php';

$_SESSION['is_welcomed'] = true;
header('location: index.php');
