<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/student.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare student object
$student = new Student($db);

// set ID property of record to read
$student->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of student to be edited
$student->show();

if ($student->name != null) {
    // create array
    $student_arr = array(
        "id" => $student->id,
        "name" => $student->name,
        "topic" => html_entity_decode($student->topic),
        "status" => $student->status,
        "advisor_id" => $student->advisor_id,
        "advisor_name" => $student->advisor_name,
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($student_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user student does not exist
    echo json_encode(array("message" => "Student does not exist."));
}
