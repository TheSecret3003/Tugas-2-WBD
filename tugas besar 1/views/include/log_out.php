<?php
setcookie("ID", "", time() - (60 * 10), "/");
setcookie("access_token", "", time() - (60 * 10), "/");
unset($_COOKIE["ID"]);
unset($_COOKIE["access_token"]);
header("Location: ../login.php?logout=success");
exit();
?>