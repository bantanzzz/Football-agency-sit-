<?php
include 'includes/session.php';
include 'includes/auth.php';

logout_user();
header('Location: index.php');
exit();
?>