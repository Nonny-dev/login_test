<?php
session_start();
session_unset();
session_start();
header('location: ../login.php');
exit(0);

?>