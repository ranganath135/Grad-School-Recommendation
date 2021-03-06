<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['admin_username']) && isset($_POST['password'])) {
 
    // receiving the post params
    $adminUsername = $_POST['admin_username'];
    $password = $_POST['password'];
 
    // get the user by username and password
    $user = $db->getAdminByUsernameAndPassword($adminUsername, $password);
 
    if ($user != false) {
        // user is found
        $response["error"] = FALSE;
        $response["user"]["admin_name"] = $user["admin_name"];
        $response["user"]["admin_username"] = $user["admin_username"];
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters username or password is missing!";
    echo json_encode($response);
}
?>