<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
include('database/dbconfig.php');

if($conn)
{
    // echo "Database Connected";
}
else
{
    header("Location: database/dbconfig.php");
}
?>