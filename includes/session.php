<?php
session_start();
$display_user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Anonymous';