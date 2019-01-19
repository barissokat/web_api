<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../config/database.php';
include_once '../objects/student.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare student object
$student = new Student($db);

// get student id
$data = json_decode(file_get_contents("php://input"));

// set student id to be deleted
$student->id = $data->id;
$to_email = $data->email;



// delete the student
if ($student->destroy()) {
    $to_email = $data->email;
    $subject = "Thesis topic result";
    $message = "thesis topic is refused please find a new one";

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
    echo json_encode(array("message" => "Student was deleted."));
}
?>