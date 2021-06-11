<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/////////////////////////////////////////////



if (isset($_REQUEST['check']) ){






$CONFIG['gnupg_home'] = '/tmp';
$CONFIG['gnupg_fingerprint'] = '9D6DB8675C4513BAE8DD3ACCDB885277D18D0797';

//encrypt

$gpg = new gnupg();

putenv("GNUPGHOME={$CONFIG['gnupg_home']}");

$gpg->seterrormode(GNUPG_ERROR_SILENT);

$gpg->addencryptkey($CONFIG['gnupg_fingerprint']);




$uploaddir = '/home/pixihuge/public_html/projects-m/upload/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

//Get the file that need to be encrypted
    $uploadFileContent = file_get_contents($_FILES['userfile']['tmp_name']);
	
	//encrypt file
	$enc = $gpg->encrypt($uploadFileContent);
	
	//Save encrypted file
	$filename = $_FILES['userfile']['name']. '.gpg';
    file_put_contents($filename, $enc);


print '<h2>Fisierul a fost criptat si se poate descarca apasand <a href="./'.$filename.'">Aici</a> </h2><hr> </br></br>';

}

?>


<form enctype="multipart/form-data" action="" method="POST">  
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />  
    Encrypt this file: <input name="userfile" type="file" />
	 <input type="hidden" id="check" name="check" value="1">
    <input type="submit" value="Send File" />
</form>



<a href="./criptare-text"> << Spre criptare text >> </a>