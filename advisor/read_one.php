<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/advisor.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare advisor object
$advisor = new Advisor($db);
 
// set ID property of record to read
$advisor->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of advisor to be edited
$advisor->readOne();
 
if($advisor->name!=null){
    // create array
    $advisor_arr = array(
        "id" =>  $advisor->id,
        "name" => $advisor->name,
        "area" => $advisor->area,
        "title" => $advisor->title
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($advisor_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user advisor does not exist
    echo json_encode(array("message" => "Advisor does not exist."));
}
?>