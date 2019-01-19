<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/student.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare student object
$student = new Student($db);
 
// get id of student to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of student to be edited
$student->id = $data->id;
 
// set student property values
$student->name = $data->name;
$student->topic = $data->topic;
$student->status = $data->status;
$student->advisor_id = $data->advisor_id;
$email = $data->email;
 
// update the student
if($student->update()){
    $to_email = $email;
    $subject = "Thesis topic result";
    $message = "Your thesis topic is accepted.";

    // set response code - 200 ok
    http_response_code(200);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://localhost/api/email/send.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,array(
        'to_email' => $to_email, 
        'subject' => $subject,
        'message' => $message
    ));

    // Receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    curl_close($ch);
 
    // tell the user
    echo json_encode(array("message" => "Student was updated."));
}
 
// if unable to update the student, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update student."));
}
?>