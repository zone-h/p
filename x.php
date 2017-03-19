<html>
    <head>
        <title>Shell Detektor</title>
        <link href="http://3.bp.blogspot.com/-dCijSi1fl4s/Vc6jF5hFEOI/AAAAAAAABGE/4Q4tDf4ZgUE/s1600/Garuda%2BPancasila.png" rel="shortcut icon" type="image/x-icon" />

<?php
/*
 * @autor           Kriz
 * @email           kristisonzakaria@gmail.com
 * @version         ....
 * @name            Shell Detektor
 * @project	    Skripsi S1 Pendidikan Teknik Informatika dan Komputer STKIP Surya
 * @motto	    "Orang tidak peduli seberapa banyak ilmu yang kau miliki, Mereka peduli pada seberapa banyak yang kau lakukan dengan ilmu yang dimiliki"
*/
#-----------------------------------------------
# Awalan code untuk melarang masuk dengan http
if ( isset($_SERVER['HTTPS']) ) {
#------------------------------------------------
error_reporting(0);
function logout() {
    $_SESSION = array('authenticated' => false);
    if (isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-44000, '/');
    session_destroy();
}
if (get_magic_quotes_gpc())
    $_POST = stripslashes_deep($_POST);
// Initialize variables
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

//---------------------------------------------------------------|
$passx="toor"; //ini bagian password                             |
                                                            //   |
$ini['users'] = array('root' => $passx);//ini bagian username    |
//---------------------------------------------------------------|
// Default settings
$default_settings = array('home-directory'   => '.');
// Merge settings
$ini['settings'] = array_merge($default_settings, $ini['users']);
session_start();
if (isset($_POST['logout']))
    logout();
// Authentication
if (isset($ini['users'][$username])) {
    if (strchr($ini['users'][$username], ':') === false) {
        // No seperator = clear text password
        $_SESSION['authenticated'] = ($ini['users'][$username] == $password);
    } else {
        list($fkt, $hash) = explode(':', $ini['users'][$username]);
        $_SESSION['authenticated'] = ($fkt($password) == $hash);
    }
}
?>
<!------------------------------------------------------------------------------------------>
<?php
            if (isset($_GET['file'])) {
                if (isset($_GET['save'])) {
                    if (get_magic_quotes_gpc()) {
                        $file_cont = stripslashes($_POST['text']);
                    } else
                        $file_cont = $_POST['text'];
                    file_put_contents($_GET['file'], $file_cont);
                    echo '<h1>Disimpan</h1>';
                }
                $text = htmlspecialchars(file_get_contents($_GET['file']));
        ?>

            <form method="POST" name="form_f" action="<?=$_SERVER['PHP_SELF']?>?file=<?=$_GET['file']?>">
                <textarea style="width: 98%; height: 500px;" name="text"><?=$text?></textarea>
                <br>
                <input onclick="document.form_f.action = document.form_f.action + '&save=1';document.form_f.submit();" value="Simpan" type="button" />
                <input type="button" value="Keluar" onClick="window.close()" />
            </form>

        <?php
            } else {
        ?>
<!---------------------------------------------------------------------------------------------->


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head></head>
<body>

<form name="shell" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

<?php
if (!$_SESSION['authenticated']) {
?>
<!-------------------------form login------------------------------>
<center>
    <fieldset>
        <legend><h4>Authentication</h4></legend>

    <?php
    if (!empty($username))
       echo '  <p class="error">Login failed, please try again:</p>' . "\n";
    ?>
<!---------------------------------------------------------------------------------->
<table>
    <tr>
        <td>
            <img src="https://ipghost7.files.wordpress.com/2017/01/stkip_logo.png" heigth="300px" width="100px"/></a>
        </td>
        <th style='background-color:#201d1d; color:white;font-size:14px'>
     
        <center>
            <font size="5" color="white"><blink>SHELL DETEKTOR</blink></font>
 <!--           <font size="5" color="white"><blink>MENGGUNAKAN PHP</blink></font><br>
            <font size="5" color="white"><blink>UNTUK MENDETEKSI</blink></font>
            <font size="5" color="white"><blink>BERBAGAI JENIS <i>BACKDOOR</i></blink></font>
            <font size="5" color="white"><blink>DI SERVER</blink></font>
-->
        </center>
        <br>
        <center>
          <b style='color:white;font-size:12px'>Program Skripsi</b> 
        </center>

        </th>
        <td>
            <img src="https://ipghost7.files.wordpress.com/2017/01/robot_securityyy.png" heigth="300px" width="100px"/></a>
        </td>
    </tr>
</table>
 <br>
 <table>
<!------------------------------------------------------------------------------------>
    <a href="javascript:window.open('http://bit.ly/2klGGN4');void(0)" style='background-color:#201d1d; color:white;font-size:17px'>Tutorial Penggunaan</a>
    <p>Username: <input name="username" type="text" value="<?php echo $username ?>"></p>

    <p>Password: <input name="password" type="password"></p>

    <p><input type="submit" value="Login"></p>

    </fieldset>
</center>
<!------------------------end-------------------------------->
<?php } else { /* Auth'd */ ?>
<!--start--isi-------------------------------------------------------------------------------->
<fieldset>
  <legend><h4>Server Details | <p>
    <input type="submit" name="logout" value="Logout">
</p></h4></legend>
<?php
 // set the default timezone to use.
date_default_timezone_set('Asia/Jakarta');
header('Content-Type: text/html; charset=UTF-8');
$path = dirname(__FILE__);
$allowed_ext_st = array('htaccess', 'txt', 'php', 'php3', 'php4', 'phtml', 'shtml', 'php5','html', 'htm', 'xml', 'xhtml', 'js', 'css', 'py', 'pl','sh','cin','izo','root','cfm','c','tpl','rtf','xlsx','doc','docx','pptx','ndsxf','asp','aspx','bash','zsh','csh','tsch','pdf','jfif','jpe','bmp','ico','tif','tiff','png','jpeg', 'jpg', 'gif','avi','mpg','mpeg','mp4','mp3');

if (isset($_POST['run'])) {
    set_time_limit(0);
    $html = '';
    $allowed_ext = $_POST['ext'];

    //fungsi mencurigakan yang akan di pindai
    $shells = array(
    '@error_reporting(0)' => '@error_reporting\(0\)',
    '@set_time_limit(0)' => '@set_time_limit\(0\)',
    '_shell_atildi_' => '_shell_atildi_',
    '~ Shell I' => '~ Shell I',
    '0xdd82' => '0xdd82',
    'Antichat shell' => 'Antichat shell',
    'ALEMiN KRALi' => 'ALEMiN KRALi',
    'ASPX Shell by LT' => 'ASPX Shell by LT',
    '$auth_pass' => '\$auth_pass',
    'auth_pass'=>'auth_pass',
    'aZRaiLPhP' => 'aZRaiLPhP',
    'backdor1' => 'Coded By Charlichaplin',
    'base64' => 'base64',
    'Bl0od3r' => 'Bl0od3r',
    'boff' => 'boff',
    'BY iSKORPiTX' => 'BY iSKORPiTX',
    'devilzShell' => 'devilzShell',
    'c100' => 'c100',
    'c100.php' => 'Written by Captain Crunch Team',
    'c2007.php' => 'c2007\.php',
    'c99' => 'c99',
    'C99 Modified By Psych0' => 'C99 Modified By Psych0',
    'c99 mod Captain Crunch' => '\$c99sh_updatefurl',
    'C99 Shell' => 'C99 Shell',
    'c99shell' => 'c99shell',
    'Chartreuse' => 'Chartreuse',
    'CGI shell' => 'CGI shell',
    'CIH' => 'CIH',
    'confirm(' => 'confirm\(',
    'cookiename = "wieeeee"' => 'cookiename = \"wieeeee\"',
    'Crystal' => ' Coded by : Super-Crystal and Mohajer22',
    'CrystalShell' => 'CrystalShell',
    'ctt_sh.php' => 'TEAM SCRIPTING - RODNOC',
    'Cyber Shell' => 'Cyber Shell',
    'd0mains' => 'd0mains',
    '$daemon =' => '\$daemon =',
    '$domains' => '\$domains',
    'DarkDevilz.iN' => 'DarkDevilz\.iN',
    'dC3 Security Crew Shell PRiV' => 'Shell written by Bl0od3r',
    'Dive Shell 1.0 - Emperor Hacking Team' => 'Dive Shell - Emperor Hacking Team',
    'Devr-i Mefsedet' => 'Devr-i Mefsedet',
    'document.write(' => 'document\.write\(',
    'DTool Pro' => 'Comandos Exclusivos do DTool Pro',
    'DxShell' => 'DxShell',
    'Emperor Hacking TEAM' => 'Emperor Hacking TEAM',
    'error_reporting(0)' => 'error_reporting\(0\)',
    'eval(' => 'eval\(',
    'eval(gzinflate(base64_decode(' => 'eval\(gzinflate\(base64_decode\(',
    'eval(gzinflate(base64_decode($code)))' => 'eval\(gzinflate\(base64_decode\(\$code',
    'FilesMan' => 'FilesMan',
    'Fixed by Art Of Hack' => 'Fixed by Art Of Hack',
    'FaTaLisTiCz_Fx Fx29Sh' => 'FaTaLisTiCz_Fx Fx29Sh',
    'Fatalshell' => 'Lutfen Dosyayi Adlandiriniz',
    'fuckphpshell' => 'this is a priv3 server',
    'g00n' => 'g00n',
    'getcwd()' => 'getcwd\(\)',
    'GFS web-shell' => 'GFS Web-Shell',
    'GHC Manager' => 'GHC Manager',
    'GIF89a1' => 'GIF89a1',
    'Goog1e_analist' => 'Goog1e_analist',
    'Grinay Go0o$E' => 'Grinay Go0o\$E',
    'gzinflate(' => 'gzinflate\(',
    'h4ntu' => 'h4ntu',
    'h4ntu shell [powered by tsoi]' => 'h4ntu shell \[powered by tsoi\]',
    'Hacked BY' => 'Hacked BY',
    'Hacked By Devr-i Mefsedet' => 'Hacked By Devr-i Mefsedet',
    'HACKED BY REALWAR' => 'HACKED BY REALWAR',
    'Hackerler Vurur Lamerler Surunur' => 'Hackerler Vurur Lamerler Surunur',
    'IFRAME' => 'IFRAME',
    'iMHaBiRLiGi' => 'iMHaBiRLiGi',
    'iMHaPFtp.php' => 'iMHaBiRLiGi Php Ftp Editoru',
    'ironshell' => 'You can put a md5 string here too, for plaintext passwords',
    'JTerm' => 'JTerm',
    'KA_uShell' => 'KA_uShell',
    'Liz0ziM' => 'Liz0ziM',
    'Liz0ziM Private Safe Mode Command Execuriton Bypass Exploit' => 'Liz0ziM Private Safe Mode Command Execuriton Bypass Exploit',
    'locus7' => 'locus7',
    'Locus7Shell' => 'Locus7Shell',
    'mailer3.php' => 'Moroccan Spamers Ma-EditioN By GhOsT',
    'matamu' => 'Matamu Mat',
    'Moroccan Spamers Ma-EditioN By GhOsT' => 'Open the file attachment if any, and base64_encode',
    'm0rtix' => 'm0rtix',
    'm0hze' => 'm0hze',
    'Matamu Mat' => 'Matamu Mat',
    'Moroccan Spamers' => 'Moroccan Spamers',
    'myshell' => '\$MyShellVersion',
    'MyShell' => 'MyShell',
    'MySQL RST' => 'MySQL RST',
    'MySQL Web Interface' => 'MySQL Web Interface',
    'MySQL Web Interface Version' => 'MySQL Web Interface Version',
    'MySQL Webshell' => 'MySQL Webshell',
    'N3tshell' => 'N3tshell',
    'NCC' => 'NCC',
    'NCC-Shell' => 'Hacked by Silver',
    'NeoHack' => 'NeoHack',
    'NetworkFileManagerPHP' => 'NetworkFileManagerPHP',
    'NIX REMOTE WEB-SHELL' => 'NIX REMOTE WEB-SHELL',
    'O BiR KRAL TAKLiT EDilEMEZ' => 'O BiR KRAL TAKLiT EDilEMEZ',
    'Onet7' => 'Onet7',
    'oRb' => 'oRb',
    'PHANTASMA' => 'PHANTASMA- NeW CmD',
    'phpinfo()' => 'phpinfo\(\)',
    '$_POST' => '\$_POST',
    '$pass_up' => '\$pass_up',
    'PIRATES CREW WAS HERE' => 'PIRATES CREW WAS HERE',
    'php-backdoor' => 'a simple php backdoor',
    'php-include-w-shell' => 'LOTFREE PHP Backdoor',
    'pHpINJ' => 'News Remote PHP Shell Injection',
    'phpjackal' => 'PHPJackal',
    'PHP HVA Shell Script' => 'PHP HVA Shell Script',
    'PHPRemoteView' => 'phpRemoteView',
    'phpshell' => 'phpshell',
    'phpshell17' => 'PHP Shell is aninteractive PHP-page',
    'phvayv.php' => 'PHVayv',
    'PPS 1.0 perl-cgi web shell' => 'PPS 1.0 perl-cgi web shell',
    'preg_match(' => 'preg_match\(',
    'preg_replace' => 'preg_replace',
    'Press OK to enter site' => 'Press OK to enter site',
    'private Shell by m4rco' => 'private Shell by m4rco',
    'r0nin' => 'r0nin',
    'R57Sql' => 'R57Sql',
    'r57shell.php' => 'r57shell\.php',
    'RDot' => 'RDot',
    'rgod`s webshell' => 'rgod`s webshell',
    'realauth=SvBD85dINu3' => 'realauth=SvBD85dINu3',
    'RootShell' => 'RootShell',
    'Ru24PostWebShell' => 'Ru24PostWebShell',
    'Russian.php' => 'KAdot Universal Shell',
    's72 Shell' => 'Cr@zy_King',
    'Safe0ver Shell - Safe Mod Bypass By Evilc0der' => 'Safe_Mode Bypass PHP',
    'SarasaOn Services' => 'SarasaOn Services',
    'set_time_limit(0)' => 'set_time_limit\(0\)',
    'SimAttacker - Vrsion' => 'Simple PHP backdoor by DK',
    'simple-backdoor' => 'G-Security Webshell',
    'simple_cmd' => 'Simorgh Security Magazine',
    'Shell by Mawar_Hitam' => 'Shell by Mawar_Hitam',
    'SSI web-shell' => 'SSI web-shell',
    'storm7' => 'storm7',
    'Storm7Shell' => 'Storm7Shell',
    'stripslashes' => 'stripslashes',
    'The_BeKiR' => 'The_BeKiR',
    'tmp_name' => 'tmp_name',
    'w3d.php' => 'W3D Shell',
    'w4ck1ng shell' => 'w4ck1ng shell',
    'WebControls' => 'WebControls',
    'webshell.txt' => 'This PHP Web Shell was developed by Digital Outcast',
    'Worse Linux Shell' => 'Watch Your system Shany was here',
    'Web-shell' => 'Web-shell',
    'WebShell' => 'WebShell',
    'WEB SHELL' => 'WEB SHELL',
    'Web Shell by oRb' => 'Web Shell by oRb',
    'Web Shell by boff' => 'Web Shell by boff',
    'wieeeee' => 'wieeeee',
    'WSO2 Webshell' => 'WSO2 Webshell',
    'xCedz' => 'xCedz',
    'xinfo.php' => 'NetworkFileManagerPHP for channel',
    'zacosmall' => 'Small PHP Web Shell by ZaCo',
    'zerofill' => 'zerofill',
    'unescape' => 'unescape',
    'urldecode' => 'urldecode',
    'str_rot13' => 'str_rot13',
    'str_replace'=> 'str_replace',
    'fread' => 'fread',
    'fclose'=> 'fclose',
    'fopen' => 'fopen',
    'strtr '=> 'strtr ',
    'safe_mode'=> 'safe_mode',
    'upload' => 'upload',
    'uploads' => 'uploads',
    'uploaded' => 'uploaded',
    'uploader' => 'uploader',
    'b374k' => 'b374k',
    'mkdir' => 'mkdir',
    'filesize'=>'filesize',
    'fileperms'=>'fileperms',
    'disk_free_space'=>'disk_free_space',
    'disk_total_space'=>'disk_total_space',
    "x'1n73ct"=>"1n73tion",
    "X'1N73CT"=> "x'1n73ct",
    'Backdoor'=>'backdoor',
    'chmod'=>'chmod',
    'GaLer xh3LL Backd00r'=>'GaLer xh3LL Backd00r',
    'Dhanush'=>'Dhanush',
    'Indian Hacker'=>'Indian Hacker',
    'Hacker'=>'hacker',
    'Hacked'=>'hacked',
    'Ani Shell'=>'Ani Shell',
    'c0d3d by lionaneesh'=>'c0d3d by lionaneesh',
    'lionaneesh'=>'lionaneesh',
    'c0d3d by'=>'c0d3d by',
    'safe_mode'=>'safe_mode',
    'FilesMan'=>'FilesMan',
    'Shell rabbitsec'=>'rabbitsec',
    'perms'=>'perms',
    'passthru'=>'passthru',
    'Greetz to:'=>'Greetz to:',
    'iskorpitx'=>'iskorpitx',
    'Symlink'=>'Symlink',
    'Bypass'=>'Bypass',
    '/etc/' => '/etc/',
    '/etc/passwd/' => '/etc/passwd',
    '/etc/named.conf'=>'/etc/named.conf',
    '/etc/valiases/'=>'/etc/valiases',
    '/sym/'=>'/sym/',
    'jumping'=>'jumping',
    'idx_config'=>'idx_config',
    'IndoXploit'=>'IndoXploit',
    'Cpanel'=>'Cpanel',
    'AddHandler cgi-script .izo'=>'AddHandler cgi-script .izo',
    'CGI-Telnet'=>'CGI-Telnet',
    'AddHandler cgi-script .cin'=>'AddHandler cgi-script .cin',
    'Fake_root!'=>'fake_root',
    'adminer'=>'adminer',
    'IndiShell'=>'IndiShell',
    'AddHandler cgi-script .root'=>'AddHandler cgi-script .root',
    'Options FollowSymLinks MultiViews Indexes ExecCGI'=>'Options FollowSymLinks MultiViews Indexes ExecCGI',
    'Mohajer22'=>'Mohajer22',
    'Hiddenymouz'=>'Hiddenymouz',
    'Mr-GanDrunX'=>'Mr-GanDrunX',
    'GandrunXs'=>'Gandrunxs',
    'Yukinoshita47'=>'Yukinoshita47',
    'Mr.BaHoNKx404'=>'Mr.BaHoNKx404',
    '_MisterNotFound_'=>'_MisterNotFound_',
    'Mr.H4lluSN0G3N!'=>'Mr.H4lluSN0G3N!',
    'Mr.XM404RS!'=>'Mr.XM404RS!',
    'Dot ID'=> 'Dot ID',
    './R15_UTD'=> './R15_UTD',
    'anonymous'=>'Anonymous',
    'Cicurug Indonesia Cyber Team'=> 'Cicurug Indonesia Cyber Team',
    'Garooda security squad'=>'Garooda security squad',
    'Garuda security hacker'=>'Garuda security hacker',
    'Tersakiti Team'=>'tersakiti team',
    'IDCA'=>'idca',
    'Indonesian Cyber Army' =>'indonesian cyber army',
    'Garuda Cyber Army'=>'garuda cyber army',
    'ase64_encod'=>'ase64_encod',
    'phpshadow_exec'=>'phpshadow_exec',
    'eval("?>".base64_decode'=>'eval("?>".base64_decode',
    'indonesian freedom security'=>'indonesian freedom security',
    'K4MVR3T717'=>' K4MVR3T717',
    'IndoXploit Coders Team'=>'IndoXploit Coders Team',
    'Fr13nds Team'=>'Fr13nds Team',
    'A_Ghacker'=>'A_Ghacker',
    'zone-deface.com'=>'zone-deface.com',
    'www.zone-h.com'=>'www.zone-h.com',
    'www.zone-h.org'=>'www.zone-h.org',
    'defacer.id'=>'defacer.id',
    'Tu5b0l3d'=>'Tu5b0l3d',
    'Guard Hacking Team'=>'Guard Hacking Team',
    'Khanh Cloud'=>'Khanh Cloud',
    'www.r00t.info'=>'www.r00t.info',
    'Trenggalek Cyber Army'=>'Trenggalek Cyber Army',
    'm3r1c4'=>'m3r1c4',
    'Exploit'=>'Exploit',
    ' file_get_contents'=>'file_get_contents',
    'AddType application/x-httpd-php .htacces' => 'AddType application/x-httpd-php .htacces',
    'AddType application/x-httpd-php .jpg' => 'AddType application/x-httpd-php .jpg',
    'AddType application/x-httpd-php .png' => 'AddType application/x-httpd-php .png'
    );
    function get_perms($file_now) {
    if ($mode = @fileperms($file_now)) {
        $perms = '';
        $perms.= ($mode & 00400) ? 'r' : '-';
        $perms.= ($mode & 00200) ? 'w' : '-';
        $perms.= ($mode & 00100) ? 'x' : '-';
        $perms.= ($mode & 00040) ? 'r' : '-';
        $perms.= ($mode & 00020) ? 'w' : '-';
        $perms.= ($mode & 00010) ? 'x' : '-';
        $perms.= ($mode & 00004) ? 'r' : '-';
        $perms.= ($mode & 00002) ? 'w' : '-';
        $perms.= ($mode & 00001) ? 'x' : '-';
        return $perms;
        } else return "??????????";
    }
    function ukuran($file_now) {
        if ($size = @filesize($file_now)) {
            if ($size < 1024) return "$size b";
            else {
                if ($size <= 1024 * 1024) {
                    $size = @round($size / 1024, 2);
                    return "$size kb";
                } else {
                    $size = @round($size / 1024 / 1024, 2);
                    return "$size mb";
                }
            }
        } else return "???";
    }

    function findshells($start) {
        global $allowed_ext, $shells, $path, $html;
        $files = array();
        $handle = opendir($start);

        while(($file = readdir($handle)) !== false) {
            if ($file != '.' && $file != '..') {
                $startfile = $start.'/'.$file;
                if (is_dir($startfile)) {
                    findshells($startfile);
                } else {
                    if (in_array(substr(strrchr($startfile, '.'), 1), $allowed_ext) and basename($startfile) != basename(__file__)) {
                        $file_source = file_get_contents($startfile);
                        foreach ($shells as $name => $signature) {
                            if (preg_match('#'.$signature.'#', $file_source)) {
                                $file_now = substr(str_replace('./', '', $startfile), 1);
                                $html .=
                                '<tr>';
                                /*Nama File*/
                                $html .=
                                '<td width="25%" >'.$file_now.'</td>';
                                /*/Nama File*/

                                /*Shell'a signature /suspicious functions used:*/
                                $html .=
                                '<td width="15%" >'.$name.'</td>';
                                /*/Shell'a signature /suspicious functions used:*/

                                /*File size:*/
                                $html .=
                                '<td width="5%" >'.ukuran($file_now).'</td>';
                                /*/File size:*/

                                /*permisison file*/
                                $html .=
                                '<td width="8%" >'.get_perms($file_now).'</td>';
                                /*/permision file*/

                                /*Create time:*/
                                $html .=
                                '<td width="10%" >'.date("d-M-Y H:i", filectime($file_now)).'</td>';
                                /*/Create time:*/

                                /*Last accessed:*/
                                $html .=
                                '<td width="10%" >'.date('d F Y H:i:s', fileatime($file_now)).'</td>';
                                /*/Last accessed:*/

                                /*Last modified:*/
                                $html .=
                                '<td width="10%" >'.date('d F Y H:i:s', filemtime($file_now)).'</td>';
                                /*/Last modified:*/

                                /*Operasi*/
                                $html .=
                                '<td width="20%">

                                <center>
                                    <a href="?dir=/'.$file_now.'" onclick="return confirmDelete();">Hapus file</a> |
                                    <a href="'.$file_now.'" target="_blank">Open file</a> |
                                    <a href="javascript:edit(\''.$file_now.'\');void(0)">Edit file</a>
                                </center>

                                </td>
                                </tr>';
                            }
                        }
                    }
                }
            }
        }

        closedir($handle);
    }
    findshells('./');
}
if (isset($_GET['dir'])) {
    unlink($path.$_GET['dir']);
    header('Location: '.$_SERVER['SCRIPT_NAME']);
}
?>
<center>
<table>
    <tr>
        <td>
            <img src="https://ipghost7.files.wordpress.com/2017/01/stkip_logo.png" heigth="300px" width="100px"/></a>
        </td>
        <th>
        <center>
            <font size="5" color="white"><blink>SHELL DETEKTOR</blink></font>
<!--            <font size="5" color="white"><blink>MENGGUNAKAN PHP</blink></font><br>
            <font size="5" color="white"><blink>UNTUK MENDETEKSI</blink></font>
            <font size="5" color="white"><blink>BERBAGAI JENIS <i>BACKDOOR</i></blink></font>
            <font size="5" color="white"><blink>DI SERVER</blink></font>
-->
        </center>
        <br>
        <center>
          <b style='color:white;font-size:12px'>Program Skripsi</b> 
        </center>
        </th>
        <td>
            <img src="https://ipghost7.files.wordpress.com/2017/01/robot_securityyy.png" heigth="300px" width="100px"/></a>
        </td>
<!--        <td>
            <img src="http://3.bp.blogspot.com/-dCijSi1fl4s/Vc6jF5hFEOI/AAAAAAAABGE/4Q4tDf4ZgUE/s1600/Garuda%2BPancasila.png" heigth="300px" width="100px"/></a>
        </td>
-->
    </tr>
</table>
<!-------------------------------------------------------------------->
<!--Owner ,User Info, PHP Version, Lokasi Folder-->
<?php
  closelog( );
  $user = get_current_user( );
  $login = posix_getuid( );
  $euid = posix_geteuid( );
  $ver = phpversion( );
  $gid = posix_getgid( );
  if ($chdir == "") $chdir = getcwd( );
  if(!$whoami)$whoami=exec("whoami");
?>
<?php
  $uname = posix_uname( );
  while (list($info, $value) = each ($uname)) {
?>
<?php
  }
?>
<!-------------------------------------------------------------------->

<!--start-->
        <center><table><tr>
            <center>
              
                <!--Melihat IP Address server-->
                <?php
                    $ip=$_SERVER['HTTP_HOST'];
                    echo "<tr style='background-color:#201d1d; color:white;font-size:14px'><th>IP server</th><td>:</td>
                              <td>$ip</td>
                          </tr>";
                ?>
           
                <?php
                // your ip ;-)
                    $my_ip = $_SERVER['REMOTE_ADDR'];
                    echo "<tr style='background-color:#201d1d; color:white;font-size:14px'><th>Your ip </th><td>:</td>
                              <td>$my_ip</td>
                          </tr>";
                ?>
                
                <!--Owner-->
                <?php
                    echo "<tr style='background-color:#201d1d; color:white;font-size:14px'><th>Owner</th><td>:</td>
                              <td>$user</td>
                          </tr>";
                ?>
                
                <!--User Info-->
                <?php
                    echo "<tr style='background-color:#201d1d; color:white;font-size:14px'><th>User Info</th><td>:</td>
                              <td>Uid= $login [$whoami] | Euid= $euid [$whoami] | Gui= $gid [$whoami]</td>
                          </tr>";
                ?>
             
                <!--PHP Version-->
                <?php
                    echo "<tr style='background-color:#201d1d; color:white;font-size:14px'><th>PHP Version</th><td>:</td>
                              <td>$ver</td>
                          </tr>";
                ?>
          
                <!--Os Software-->
                <?php
                    $os_software = $_SERVER['SERVER_SOFTWARE'];
                    echo "<tr style='background-color:#201d1d; color:white;font-size:14px'><th>OS software</th><td>:</td>
                              <td>$os_software</td>
                          </tr>";
                ?>
            
                <?php
                //document_root
                    $document_root=$_SERVER['DOCUMENT_ROOT'];
                    echo "<tr style='background-color:#201d1d; color:white;font-size:14px'><th>DOCUMENT_ROOT</th><td>:</td>
                              <td>$document_root</td>
                          </tr>";
                ?>
          
                <!--Lokasi Folder-->
                <?php
                    echo "<tr style='background-color:#201d1d; color:white;font-size:14px'><th>Lokasi Folder</th><td>:</td>
                              <td>$chdir</td>
                          </tr>";
                ?>
                <?php
                //lokasi_detektor_shell
                    $lokasi_detektor_shell = $_SERVER['SCRIPT_FILENAME'];
                    echo "<tr style='background-color:#201d1d; color:white;font-size:14px'><th>Lokasi Script Detector Shell</th><td>:</td>
                              <td>$lokasi_detektor_shell</td>
                          </tr>";
                ?>
              
                <?php
                //"d-M-Y" = day-mont-year
                //"H" = Hour
                    $tanggal= mktime(date("m"),date("d"),date("Y"));
                    echo "<tr style='background-color:#201d1d; color:white;font-size:14px'><th>Tanggal</th><td>:</td>
                              <td><b>".date("d-M-Y", $tanggal)."</b></td> ";
                    date_default_timezone_set('Asia/Jakarta');
                    $a = date ("H");
                    if (($a>=6) && ($a<=10)){
                        echo "<tr style='background-color:#201d1d; color:white;font-size:14px'><td></td><td></td><td> Selamat Pagi !!<td></tr>";
                    }
                    else if(($a>10) && ($a<15))
                    {
                        echo "<tr style='background-color:#201d1d; color:white;font-size:14px'><td></td><td></td><td> Selamat siang !!</td></tr>";}
                    else if (($a>=15) && ($a<=18))
                    {
                        echo "<tr style='background-color:#201d1d; color:white;font-size:14px'><td></td><td></td><td> Selamat Sore jangan lupa ambil makan ya !!</td></tr>";}
                    else if (($a>18) && ($a<23) && ($a<=00))
                    {
                        echo "<tr style='background-color:#201d1d; color:white;font-size:14px'><td></td><td></td><td> Sudah tengah malam !!</td></tr>";}

                    else if (($a>=1) && ($a<=3))
                    {
                        echo "<tr style='background-color:#201d1d; color:white;font-size:14px'><td></td><td></td><td> Masih malam nih..!!</td></tr>";}
                    else
                    {
                        echo "<tr style='background-color:#201d1d; color:white;font-size:14px'><td></td><td></td><td> Selamat malam..!!</td></tr>";
                    }
                ?>

                <!--Menampilkan output dr script javascript id jam digital di atas-->
                <tr style='background-color:#201d1d; color:white;font-size:14px'><th>Pukul</th><td>:</td><td><b><div id="output"></div></b></tr>
                <!--mulai hitung jumlah file dalam server-->

</center>
<!--Gambar kiri dan kanan---------------------------------------------------->
<!DOCTYPE html>
<html>
<body>
<img src="https://ipghost7.files.wordpress.com/2017/01/ica-kanan1.png" alt="ica" style="width:210px;height:230px;float:right;margin-right:90px;">
<img src="https://ipghost7.files.wordpress.com/2017/01/ica-kiri1.png" alt="ica" style="width:210px;height:230px;float:left;margin-left:90px;">
</body>
</html>
<!--and---------------------------------------------------->
        <!--CSS Body-->
        <style>
            th{background-color:#201d1d}
            tr:hover{background-color:#ffd900}
            .logo a:hover{text-decoration:none}
            .logo span, .logo img{vertical-align:middle}
    body {background-color:#ffffff; color:#030303; margin:0; font:normal 75% Arial, Helvetica, sans-serif; } canvas{ display: block; vertical-align: bottom;}
    #particles-js{width: 100%; height: 100px; background-color: #060a10; background-image: url(''); background-repeat: no-repeat; background-size: cover; background-position: 50% 50%;}
    body,td,th  {font:10pt tahoma,arial,verdana,sans-serif,Lucida Sans;margin:0;vertical-align:top;}
    table.info  {color:#C3C3C3;}
    table#toolsTbl {background-color: #060A10;}
    span,h1,a   {color:#201d1d !important;} /*warne pada link download tutorial, hapus, open, edit*/
    span        {font-weight:bolder;}
    h1          {border-left:5px solid #201d1d;padding:2px 5px;font:14pt Verdana;background-color:#10151c;margin:0px;}
    div.content {padding:5px;margin-left:5px;background-color:#060a10;}
    a           {text-decoration:none;}
    a:hover     {text-decoration:underline;}
    .tooltip::after {background:#0663D5;color:#FFF;content: attr(data-tooltip);margin-top:-50px;display:block;padding:6px 10px;position:absolute;visibility:hidden;}
    .tooltip:hover::after {opacity:1;visibility:visible;}
    .ml1        {border:1px solid #202832;padding:5px;margin:0;overflow:auto;}
    .bigarea    {min-width:100%;max-width:100%;height:400px;}
    input, textarea, select {margin:20px 10px 20px 10px;color:#fff;background-color:#202832;border:none;
        font:12pt tahoma,arial,verdana,sans-serif,Lucida Sans;utline:none;}

    form        {margin:0px;}
    #toolsTbl   {text-align:center;}
    #fak        {background:none;}
    #fak td     {padding:5px 0 0 0;}
    iframe      {border:1px solid #060a10;}
    .toolsInp   {width:300px}
    .main th    {text-align:left;background-color:#060a10;}
    .main tr:hover{background-color:#354252;}
    .main td, th{vertical-align:middle;}
    input[type='submit']{background-color:#201d1d;} 
    input[type='button']{background-color:#201d1d;}
    input[type='submit']:hover{background-color:#56AD15;} /*hijau muda*/
    input[type='button']:hover{background-color:#56AD15;}
    .l1         {background-color:#202832;}
    pre         {font:9pt Courier New;}

/*    #FFDB5F warna kuning*/
</style>
        <!--confirmDelete-->
        <script type="text/javascript">
        function confirmDelete() {
            if (confirm("Anda setuju untuk menghapus file ?")) {
                return true;
            }else
                return false;
        }
        </script>
        <!--/confirmDelete-->

        <!--Javascript jam digital-->
        <script type="text/javascript">
         // 1 detik = 1000
             window.setTimeout("waktu()",1000);
         function waktu() {
            var tanggal = new Date();
               setTimeout("waktu()",1000);
               document.getElementById("output").innerHTML = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();
         }
        </script>
        <!--/Javascript jam digital-->
    </head>
<?php

  function DirLineCounter( $dir , $result = array('lines_html' => false, 'files_count' => false, 'lines_count' => false ), $complete_table = true )
  {
//array hitung file otomatis
      $file_read = array('htaccess', 'txt', 'php', 'php3', 'php4', 'phtml', 'shtml', 'php5','html', 'htm', 'xml', 'xhtml', 'js', 'css', 'py', 'pl','sh','cin','izo','root','cfm','c','tpl','rtf','xlsx','doc','docx','pptx','ndsxf','asp','aspx','bash','zsh','csh','tsch','pdf','jfif','jpe','bmp','ico','tif','tiff','png','jpeg', 'jpg', 'gif','avi','mpg','mpeg','mp4','mp3');
      $dir_ignore = array();

      $scan_result = scandir( $dir );

      foreach ( $scan_result as $key => $value ) {

          if ( !in_array( $value, array( '.', '..' ) ) ) {

              if ( is_dir( $dir . DIRECTORY_SEPARATOR . $value ) ) {

                  if ( in_array( $value, $dir_ignore ) ) {
                    continue;
                  }

                  $result = DirLineCounter( $dir . DIRECTORY_SEPARATOR . $value, $result, false );

              }
              else {

              $type = explode( '.', $value );
              $type = array_reverse( $type );
              if( !in_array( $type[0], $file_read ) ) {
                continue;
              }

              $lines = 0;
              $handle = fopen( $dir . DIRECTORY_SEPARATOR . $value, 'r' );

              while ( !feof( $handle ) ) {

                  if ( is_bool( $handle ) ) {
                      break;
                  }

                  $line = fgets( $handle );
                  $lines++;
              }

              fclose( $handle );
              $result['files_count'] = $result['files_count'] + 1;
              $result['lines_count'] = $result['lines_count'] + $lines;
              }
          }
      }
      if ( $complete_table ) {

        $lines_html = implode('', $result['lines_html']) .
        '<tr><td style="border: 1px solid #222"><center>[ '.$result['files_count'].' ]<center></td></tr>';

        return  '<table><tr><td style="width: 20%;"><center>Jumlah file yang akan discan dalam server<center></td></tr>'
                             . $lines_html .
                '</table>';

      }
      else {
        return $result;
      }

  }

  echo DirLineCounter( '.' );

?>
<!--and hitung file dalam server-->

            </center>
                </tr></table>
        </center>
           <!--end-->

        <div style="margin:5px 0 0">
        <form method="POST" action="">

            <!--kotak pengaturan pilihan yang akan di pindai-->

            <fieldset>

            <center>
            <table width="100%" cellpadding="5" align="center" >
            <tr style='background-color:#201d1d; color:white;font-size:14px'><th><center>Pengaturan pemilihan ekstensi file</center></th></tr>
            </table>
            </center>
            <center>

                Rescan:&nbsp;
            <?php
                for ($i = 0; $i < count($allowed_ext_st); $i++) {
                    if (isset($_POST['ext'])) {
                    $ch = '';
                    if (in_array($allowed_ext_st[$i], $_POST['ext']))
                        $ch = ' checked="checked"';
                    echo '<input'.$ch.' type="checkbox" name="ext[]" value="'.$allowed_ext_st[$i].'" id="ext_'.$i.'" /><label for="ext_'.$i.'">'.$allowed_ext_st[$i].'</label>';
                    } else
                    echo '<input'.$ch.' type="checkbox" name="ext[]" value="'.$allowed_ext_st[$i].'" id="ext_'.$i.'" /><label for="ext_'.$i.'">'.$allowed_ext_st[$i].'</label>';
                }
            ?>
            </center>
</table>
            </fieldset>

            <!--tombol mulai memindai-->
            <div style="text-align:center; margin:10px 0 5px 0">
               <input name="run" type="submit" value="Mulai memindai" />
            </div>

        </form>
        </div>
        <?php } ?>

        <?php if ($_POST['run']) { ?>
        <script type="text/javascript">
            function edit(name) {
                window.open(document.location.href + '?file=' + name, 'editwindow', 'width=1000,height=600,toolbar=0,location=0,menubar=0,scrollbars=0,status=0');
            }
        </script>

        <table width="100%" cellpadding="5" align="center">
            <tbody>
                <tr style='background-color:#201d1d; color:white;font-size:14px'>
                    <th>Nama File:</th>
                    <th>Fungsi mencurigakan digunakan:</th>
                    <th>File size:</th>
                    <th>Perms:</th>
                    <th>Create time:</th>
                    <th>Last accessed:</th>
                    <th>Last modified:</th>
                    <th>Operasi:</th>
                </tr>
                <!--Jalan ke shell-->
                <tr style='background-color:#201d1d; color:white;font-size:14px'>
        <!--banyaknya kolom pada kata "Memindai Selesai - kami sarankan Anda memeriksa daftar file" dan "Memindai lengkap - tidak ada kecurigaan"-->
                    <td colspan="8">
        <!--/banyaknya kolom pada kata "Memindai Selesai - kami sarankan Anda memeriksa daftar file"-->
                        <?php
                            if ($html != null) {
                                echo "<center><b>Memindai Selesai - harap Anda memeriksa daftar file</b></center>\n";
                            } else {
                                echo "<center><b>Memindai lengkap - tidak ada kecurigaan</b></center>\n";
                            }
                        ?>
                    </td>
                </tr>
                <?php echo $html; ?>
                <?php if ($html != null) { ?>
                <tr style='background-color:#201d1d; color:white;font-size:14px'>
                    <td colspan="8">
                        <?php
                            if ($html != null) {
                                echo "<center><b>Memindai Selesai - harap Anda memeriksa daftar file</b></center>\n";
                            } else {
                                echo "<center><b>Memindai lengkap - tidak ada kecurigaan</b></center>\n";

                            }
                            ?>
                        ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>
 <!--footer-->
<br>
<table width="100%" cellpadding="8" align="center">
            <tbody>
                <tr>
                    <tr style='background-color:#201d1d; color:white;font-size:14px'>
                    <th><center>Detector Shell Developer By Kristison Zakaria</center><br>
                    </th>
                    </tr>
                </tr>
             </tbody>
</table>
    </body>
</html>
</fieldset>
<!-----------------------end---------------------------------------->
<?php } ?>
</form>
</body>
</html>

<?php
#--------------------------------------------------
# Akhiran code untuk melarang masuk dengan http
} else {
	echo "Anda harus masuk dengan https supaya aman, Contoh hhtps://contoh.com/shelldetektor.php";
}
?>
