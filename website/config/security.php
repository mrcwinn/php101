<?php defined('BASEPATH') || exit('No direct script access allowed');

function setCSRFToken()
{
    $_SESSION['csrfToken'] = md5(uniqid(mt_rand(), true));
}

function CSRFToken()
{
    return $_SESSION['csrfToken'];
}

function inputCSRF()
{
    setCSRFToken();
    return '<input type="hidden" name="csrfToken" value="' . CSRFToken() . '" />';
}

function hashPassword($password)
{
    $salt = substr(base64_encode(microtime()), 0, 28);
    return $salt . getPasswordHash($password);
}

function getPasswordHash($password)
{
    return md5($password);
}