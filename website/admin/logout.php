<?php
require_once '../config/access.php';
require_once '../config/security.php';
require_once '../config/helper-functions.php';
require_once '../config/sessions.php';

if (!isset($_POST['csrfToken']) && strcmp($_POST['csrfToken'], CSRFToken()) !== 0) {
    setSessionVars($_POST);
    redirect($_SERVER['HTTP_REFERER']);
} else {
    endSession();
    redirect($_SERVER['HTTP_REFERER']);
}