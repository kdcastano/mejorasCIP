<?php
session_start();
unset($_SESSION['CP_Usuario']);
session_destroy();
?>
<script>window.location.assign("../index.php");</script>