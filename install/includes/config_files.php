<?php
/***************************************************************************
* Config files for V1.0.0.369
****************************************************************************/

	//Main config files - /data/config/config.php
	$mainconfigstring = "<?php \n";
	$mainconfigstring .= "    function db() {\n";
	$mainconfigstring .= '        $link = ';
	$mainconfigstring .= "mysqli_connect('" . $servername . "', '" . $dbuser . "', '" . $dbpass1 . "');\n";
	$mainconfigstring .= "        mysqli_select_db(\$link,'" . $databasename . "');\n";
	$mainconfigstring .= "        return \$link;\n";
	$mainconfigstring .= "	}\n";
	$mainconfigstring .= '    $rpintsversion="1.0.0.369";' . "\n";
	$mainconfigstring .= "?>";

	//Admin config file - /data/config/conn.php
	$adminconfig1 = "<?php \n";
	$adminconfig1 .= '   $host="' . "{$servername}" . '"; // Host name' . "\n";
	$adminconfig1 .= '   $username="' . "{$dbuser}" . '"; // Mysql username' . "\n";
	$adminconfig1 .= '   $password="' . "${dbpass1}" . '"; // Mysql password' . "\n";
	$adminconfig1 .= '   $db_name="' . "${databasename}" . '"; // Database name' . "\n";
	$adminconfig1 .= '   $tbl_name="users";' . "\n";
	$adminconfig1 .= '   //Connect to server and select databse.' . "\n";
	$adminconfig1 .= '   $con=mysqli_connect("$host", "$username", "$password")or die("cannot connect to server");' . "\n";
	$adminconfig1 .= '   mysqli_select_db($con,"$db_name")or die("cannot select DB");' . "\n\n";
	$adminconfig1 .= "   function mysqli_result(\$res, \$row, \$field=0) {\n";
	$adminconfig1 .= "			\$res->data_seek(\$row);\n";
	$adminconfig1 .= "			\$datarow = \$res->fetch_array();\n";
	$adminconfig1 .= "			return \$datarow[\$field];\n";
	$adminconfig1 .= "	  }\n";
	$adminconfig1 .= '?>';

	//Admin config file - /data/config/configp.php
	$adminconfig2 = "<?php\n";
	$adminconfig2 .= '  $dbhost="' . "{$servername}" . '";' . "\n";
	$adminconfig2 .= '	$dbname="' . "${databasename}" . '";' . "\n";
	$adminconfig2 .= '  $dbuser="' . "{$dbuser}" . '";' . "\n";
	$adminconfig2 .= '  $dbpass="' . "${dbpass1}" . '";' . "\n";
	$adminconfig2 .= '	$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);' . "\n";
	$adminconfig2 .= '	$stmt = $conn->prepare(' . "'SELECT * FROM config WHERE showOnPanel = 1')" . ";\n";
	$adminconfig2 .= '	$stmt->execute();' . "\n";
	$adminconfig2 .= '	$result = $stmt->fetchAll();' . "\n";
	$adminconfig2 .= '?>';
?>
