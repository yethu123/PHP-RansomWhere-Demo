<?php
$target_path="Encrypt/";

$target_path = $target_path.basename($_FILES['uploadedfile']['name']);
//echo $target_path."</br>";
//echo basename($_FILES['uploadedfile']['tmp_name'])."</br>";
// here wll move the desired file from the tmp directory to the target path
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$target_path)){
echo "the file " . basename($_FILES['uploadedfile']['name']) . " has been uploaded! ";
}else {
echo "there was an error uploading the file ,please try again!";
}
?>