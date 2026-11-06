<?php
    $target_dir = "uploads/";
    var_dump($_FILES);
    $target_file = $target_dir . basename($_FILES['file']['name']);
?>