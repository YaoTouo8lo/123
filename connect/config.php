<?php
ini_set('display_errors', 1);
error_reporting(~0);

if (!function_exists('conn')) {
    function conn($db){
        $serverName = "IP SERVER";
        $userName = "sa";
        $userPassword = "Password";
        
        $connectionInfo = array("Database"=>$db, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true);
        $conn = sqlsrv_connect($serverName, $connectionInfo);

        if (!$conn) {
            die(print_r(sqlsrv_errors(), true));
        }

        return $conn;
    }
}

// Usage example
$conn = conn('GlobalAccount');
if ($conn) {

} else {
    echo "無法建立連線。";
}
?>
