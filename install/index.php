<?php
session_start();
error_reporting(E_ERROR);
require_once("../application/config/config.php");
include "db.php";

echo "config.php file loaded";

if(	$config['hostname'] != '' &&
		$config['db_username'] != '' && 
		$config['db'] != '')
	{
$link = @osc_db_connect(trim($config['hostname']), trim($config['db_username']), trim($config['db_password']));

if (!$link) 
{
   $error = 'Could not connect to the host specified. Error: ' . mysql_error();
}
else
{
	//Connected successfully
	$db_selected = @osc_db_select_db(trim($config['db']));
	
	if (!$db_selected) 
	{
	   $error	= $error . '<BR>Can\'t use the database specified. Error: ' . mysql_error();
	}
	
	//mysql_close($link);
}
//echo $error;exit;
$sql = " SHOW TABLES FROM ".trim($config['db']);

$result = osc_db_query($sql);

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

$numtable = osc_db_num_rows($result);

mysql_free_result($result);

if($numtable > 0){
	header("Location: ../");
}

}
$compat_register_globals = true;

if (function_exists('ini_get') && (PHP_VERSION < 4.3) && ((int)ini_get('register_globals') == 0)) {
	$compat_register_globals = false;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/common.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<title>SEPT 0.1 Step-1</title>
</head>
<body>
<div id="header">
  <!--RC for Logo-->
  <!--RC-->
  <div id="header_inner">
    <div class="clsclearfix">
      <div id="selLeftHeader">
        <h1><a href="http://products.cogzidel.com/groupon-clone/">groupon</a></h1>
        <p><a href="#">Best Groupon Software</a></p>
      </div>
      <div id="selRightHeader">
        <ul>
          <li><a href="http://products.cogzidel.com/groupon-clone/" target="_blank"><span>SEPT</span></a></li>
          <li><a href="http://cogzidel.com" target="_blank"><span>Cogzidel</span></a></li>
          <li class="clsNoBg"><a href="http://cogzideltemplates.com" target="_blank"><span>Cogzidel Templates</span></a></li>
        </ul>
      </div>
    </div>
  </div>
  <!--RC-->
</div>
<div id="container">
  <!--end of RC-->
  <!--Rc -->
  <div id="banner">
    <!--RC-->
    <div id="selBanner">
      <h2>SEPT 0.1 Installation Steps</h2>
      <img src="images/step1.png" alt="Step-1" /> </div>
    <!--RC-->
  </div>
  <!--End Rc -->
  <!--RC-->
  <div id="main">
    <div class="clsSin_Top">
      <div class="clsSin_Bttm">
        <div class="clsSin_Mid">
          <!--RC-->
          <div id="selMain">
            <h2>New Installation</h2>
            <div class="clsMain_Content">
              <?php
				  if (function_exists('ini_get')) {
				  
				  $config_file_permission=substr(decoct( fileperms("../application/config/config.php") ), 3);
				  
				  $install_config_file_permission=substr(decoct( fileperms("config.php") ), 3);
				  
				  if($_SERVER['HTTP_HOST']=="localhost")
				  {
				  	$config_file_permission=777;
					$install_config_file_permission=777;
				  }
				  if($config_file_permission!=777)
				  {
				  	echo '<div id="File_alerts">
							<ul class="alerts info">
							  <li class="info">
								<div>
									<span style="font-size:13px;">
										Please Change The file Permission <strong style="color:#000">777</strong> for following file /application/config/config.php to countinue the Installation
									</span> 
								</div>
							  </li>
							</ul>
						</div>';
				}
				if($install_config_file_permission!=777)
				{
					echo '<div id="File_alerts">
							<ul class="alerts info">
							  <li class="info">
								<div>
									<span style="font-size:13px;">
										Please Change The file Permission <strong style="color:#000">777</strong> for following file /install/config.php to countinue the Installation
									</span> 
								</div>
							  </li>
							</ul>
						</div>';
				}
			?>
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
                  <td><b>PHP Settings</b></td>
                  <td align="right"></td>
                  <td align="right" width="25"></td>
                </tr>
                <tr>
                  <td><li>register_globals</li></td>
                  <td align="right"><?php echo (((int)ini_get('register_globals') == 0) ? 'Off' : 'On'); ?></td>
                  <td align="right"><img src="images/<?php echo (((int)ini_get('register_globals') == 0) ? 'cross.gif' : 'tick.gif'); ?>" border="0" width="16" height="16"></td>
                </tr>
                <tr>
                  <td><li>magic_quotes</li></td>
                  <td align="right"><?php echo (((int)ini_get('magic_quotes') == 0) ? 'Off' : 'On'); ?></td>
                  <td align="right"><img src="images/<?php echo (((int)ini_get('magic_quotes') == 0) ? 'cross.gif' : 'tick.gif'); ?>" border="0" width="16" height="16"></td>
                </tr>
                <tr>
                  <td><li>file_uploads</li></td>
                  <td align="right"><?php echo (((int)ini_get('file_uploads') == 0) ? 'Off' : 'On'); ?></td>
                  <td align="right"><img src="images/<?php echo (((int)ini_get('file_uploads') == 0) ? 'cross.gif' : 'tick.gif'); ?>" border="0" width="16" height="16"></td>
                </tr>
                <tr>
                  <td><li>session.auto_start</li></td>
                  <td align="right"><?php echo (((int)ini_get('session.auto_start') == 0) ? 'Off' : 'On'); ?></td>
                  <td align="right"><img src="images/<?php echo (((int)ini_get('session.auto_start') == 0) ? 'cross.gif' : 'tick.gif'); ?>" border="0" width="16" height="16"></td>
                </tr>
                <tr>
                  <td><li>session.use_trans_sid</li></td>
                  <td align="right"><?php echo (((int)ini_get('session.use_trans_sid') == 0) ? 'Off' : 'On'); ?></td>
                  <td align="right"><img src="images/<?php echo (((int)ini_get('session.use_trans_sid') == 0) ? 'cross.gif' : 'tick.gif'); ?>" border="0" width="16" height="16"></td>
                </tr>
              </table>
              <br />
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
                  <td><b>PHP Extensions</b></td>
                  <td align="right" width="25"></td>
                </tr>
                <tr>
                  <td><li>MySQL</li></td>
                  <td align="right"><img src="images/<?php echo (extension_loaded('mysql') ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
                </tr>
                <tr>
                  <td><li>GD</li></td>
                  <td align="right"><img src="images/<?php echo (extension_loaded('gd') ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
                </tr>
              </table>
              <?php
  }
?>
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
                  <td><b>System Requirements - Check the following requirements before installation:</b></td>
                  <td align="right"></td>
                  <td align="right" width="25"></td>
                </tr>
                <tr>
                  <td><li>Linux Server</li></td>
                  <td align="right"></td>
                  <td align="right"></td>
                </tr>
                <tr>
                  <td><li>Apache version</li></td>
                  <td align="right"></td>
                  <td align="right">2.2.4</td>
                </tr>
                <tr>
                  <td><li>PHP version</li></td>
                  <td align="right"></td>
                  <td align="right">5.2.1</td>
                </tr>
                <tr>
                  <td><li>MySQL version</li></td>
                  <td align="right"></td>
                  <td align="right">5.0.33</td>
                </tr>
              </table>
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
                  <td><b>Information you will need for installation:</b></td>
                  <td align="right"></td>
                  <td align="right" width="25"></td>
                </tr>
                <tr>
                  <td><li>MySQL Host Name (usually 'localhost')</li></td>
                  <td align="right"></td>
                  <td align="right"></td>
                </tr>
                <tr>
                  <td><li>MySQL Username</li></td>
                  <td align="right"></td>
                  <td align="right"></td>
                </tr>
                <tr>
                  <td><li>MySQL Password</li></td>
                  <td align="right"></td>
                  <td align="right"></td>
                </tr>
                <tr>
                  <td><li>MySQL Database Name</li></td>
                  <td align="right"></td>
                  <td align="right"></td>
                </tr>
              </table>
              <p class="clsAlign">
              	<?php
                	if($config_file_permission==777 && $install_config_file_permission==777)
						echo '<input type="button" name="" class="clsbtn" value="Continue" onClick="window.location=\'install.php\'" />';
				?>
              </p>
            </div>
          </div>
          <!--RC-->
        </div>
      </div>
    </div>
  </div>
  <!--end of RC-->
  <div id="footer">
    <p>Copyright &copy; 2008 - <?php echo date("Y");?> SEPT 0.1 (Copyright Policy, Trademark Policy) </p>
  </div>
</div>
</body>
</html>
