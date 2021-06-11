<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/////////////////////////////////////////////


if(!isset($_REQUEST['mesaj']) )
{ 
	print "<h2>Criptare text folosind gnupg</h2> <br><br><br>";
	
}else {

$data =  $_REQUEST['mesaj'];








$CONFIG['gnupg_home'] = '/tmp';
$CONFIG['gnupg_fingerprint'] = '9D6DB8675C4513BAE8DD3ACCDB885277D18D0797';

//encrypt

$gpg = new gnupg();

putenv("GNUPGHOME={$CONFIG['gnupg_home']}");

$gpg->seterrormode(GNUPG_ERROR_SILENT);

$gpg->addencryptkey($CONFIG['gnupg_fingerprint']);

$encrypted =  $gpg->encrypt($data);

echo "Mesaj criptat: \n<pre>$encrypted</pre>\n";





//decrypt 
$passphrase = $_REQUEST['Passphrase'];

$gpg->adddecryptkey($CONFIG['gnupg_fingerprint'], $passphrase);

$decrypted = $gpg->decrypt($encrypted);


echo "Mesaj decriptat: ";
echo $decrypted;
echo "<hr>";

}
?>

<form action="" method="post">
Mesaj : <input type="text" name="mesaj"><br><br>
Passphrase: <input type="text" name="Passphrase" placeholder="optional pentru decriptare"><br>
<input type="submit">
</form>
<a href="./criptare-fisier"> << Spre criptare fisier >> </a>