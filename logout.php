<?php
session_start();     // start session
session_unset();     // remove all session variables
session_destroy();
session_abort();   // destroy session

header("Location: index.php");
exit();
?>