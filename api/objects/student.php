<?php
class Student
{
    // database connection and table name
    private $conn;
    private $table_name = "students";

    // object properties
    public $id;
    public $name;
    public $topic;
    public $status;
    public $advisor_id;
    public $advisor_name;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read students
    public function index()
    {
        // select all query
        $query = "SELECT
                     s.id, s.name, s.email, s.topic, s.status, a.name as advisor_name
                FROM
                    " . $this->table_name . " s
                LEFT JOIN
                    advisors a
                ON s.advisor_id = a.id
                ORDER BY
                    s.id ASC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create student
    public function store()
    {
        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                id=:id, name=:name, email=:email, topic=:topic, status=0, advisor_id=:advisor_id";

        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->topic = htmlspecialchars(strip_tags($this->topic));
        $this->advisor_id = htmlspecialchars(strip_tags($this->advisor_id));
        // bind values
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":topic", $this->topic);
        $stmt->bindParam(":advisor_id", $this->advisor_id);
        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // used when filling up the update student form
    public function show()
    {
        // query to read single record
        $query = "SELECT
               s.id, s.name, s.email, s.topic, s.status, s.advisor_id, a.name as advisor_name
            FROM
               " . $this->table_name . " s
            LEFT JOIN
               advisors a
            ON s.advisor_id = a.id
            WHERE
               s.id = ?
            LIMIT
               0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // bind id of student to be updated
        $stmt->bindParam(1, $this->id);
        // execute query
        $stmt->execute();
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // set values to object properties
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->topic = $row['topic'];
        $this->status = $row['status'];
        $this->advisor_id = $row['advisor_id'];
        $this->advisor_name = $row['advisor_name'];
    }

    // update the student
    public function update()
    {
        // update query
        $query = "UPDATE
                   " . $this->table_name . "
                SET
                   name=:name, topic=:topic, status=:status, advisor_id=:advisor_id
                WHERE
                   id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->topic = htmlspecialchars(strip_tags($this->topic));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->advisor_id = htmlspecialchars(strip_tags($this->advisor_id));
        $this->id = htmlspecialchars(strip_tags($this->id));
        // bind new values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":topic", $this->topic);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":advisor_id", $this->advisor_id);
        $stmt->bindParam(':id', $this->id);
        // execute the query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // delete the student
    public function destroy()
    {
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    
    // search student
    public function search($keywords)
    {
        // select all query
        $query = "SELECT
               s.id, s.name, s.topic, s.status, a.name as advisor_name
            FROM
               " . $this->table_name . " s
            LEFT JOIN
               advisors a
            ON s.advisor_id = a.id
           WHERE
               s.name LIKE ? OR a.name LIKE ?
           ORDER BY
               s.id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // sanitize
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // read students with pagination
    public function readPaging($from_record_num, $records_per_page)
    {
        // select query
        $query = "SELECT
                  s.id, s.name, s.topic, s.status, a.name as advisor_name
            FROM
                " . $this->table_name . " s
            LEFT JOIN
                advisors a
            ON s.advisor_id = a.id
            ORDER BY
                s.id
            LIMIT ?, ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
        // execute query
        $stmt->execute();
        // return values from database
        return $stmt;
    }

    // used for paging products
    public function count()
    {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_rows'];
    }
}
