<?php
$salt= openssl_random_pseudo_bytes(12);
echo base64_encode($salt);
?>