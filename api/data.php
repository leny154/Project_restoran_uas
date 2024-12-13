<?php

try {

    if (!file_exists('../backends/connection-pdo.php'))
        throw new Exception();
    else
        require_once('../backends/connection-pdo.php');
		
} catch (Exception $e) {

    $arr = array ('code'=>"0",'msg'=>"There were some problem in the Server! Try after some time!");

    echo json_encode($arr);

    exit();
	
}

// Link ngrok untuk digunakan di dalam respons atau keperluan internal
$ngrok_url = 'https://a127-139-195-129-141.ngrok-free.app';

if (!isset($_REQUEST['key'])) {
    $arr = array (
        'msg' => "User Data API",
        'dev' => "Sanjukta Mishti Chakroborty",
        'https://a127-139-195-129-141.ngrok-free.app' => $ngrok_url // Tambahkan link ngrok sebagai informasi
    );

    echo json_encode($arr);

    exit();

} else {

    if (strcmp('mishtikhabo', $_REQUEST['key']) == 0) {

        $sql = "SELECT * FROM users;";
        $query  = $pdoconn->prepare($sql);
        $query->execute();
        $arr = $query->fetchAll(PDO::FETCH_ASSOC);

        // Tambahkan link ngrok sebagai base URL untuk setiap data user
        foreach ($arr as &$user) {
            $user['profile_url'] = $ngrok_url . '/profile/' . $user['id'];
        }

        echo json_encode($arr);

    } else {

        $arr = array ('code'=>"0",'msg'=>"Invalid API Key!");

        echo json_encode($arr);
    }

    exit();
}
