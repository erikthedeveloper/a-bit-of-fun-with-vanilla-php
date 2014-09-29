<?php
session_start();
$current_user = \MyClasses\Auth\AuthMaster::getCurrentUser();