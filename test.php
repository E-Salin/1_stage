<?php
session_abort();

$email = "gmailgmail.com";
if(filter_var($email, FILTER_VALIDATE_EMAIL))
{
    echo "ok";
}
else
{
    echo "ne ok";
}