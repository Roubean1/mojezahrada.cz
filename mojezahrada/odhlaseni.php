<?php
session_start();
session_unset();
session_destroy();
echo "Uživatel odhlášen";
header("Location: index.php");
