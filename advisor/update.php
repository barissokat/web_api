<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/advisor.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare advisor object
$advisor = new Advisor($db);
 
// get id of advisor to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of advisor to be edited
$advisor->id = $data->id;
 
// set advisor property values
$advisor->name = $data->name;
$advisor->area = $data->area;
$advisor->title_id = $data->title_id;
 
// update the advisor
if($advisor->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Advisor was updated."));
}
 
// if unable to update the advisor, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update advisor."));
}
?>