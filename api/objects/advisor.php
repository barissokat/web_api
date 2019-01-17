<?php
class Advisor
{
    // database connection and table name
    private $conn;
    private $table_name = "advisors";

    // object properties
    public $id;
    public $name;
    public $area;
    public $title_id;
    public $title;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read advisors
    public function index()
    {
        // select all query
        $query = "SELECT
                    a.id, a.name, a.area, t.name as title
                FROM
                    " . $this->table_name . " a
                LEFT JOIN
                    titles t
                ON a.title_id = t.id
                ORDER BY
                    a.id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create advisor
    public function store()
    {
        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, area=:area, title_id=:title_id";

        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->area = htmlspecialchars(strip_tags($this->area));
        $this->title_id = htmlspecialchars(strip_tags($this->title_id));
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":area", $this->area);
        $stmt->bindParam(":title_id", $this->title_id);
        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // used when filling up the update advisor form
    public function show()
    {
        // query to read single record
        $query = "SELECT
                    a.id, a.name, a.area, t.name as title
                FROM
                    " . $this->table_name . " a
                LEFT JOIN
                    titles t
                ON a.title_id = t.id
                WHERE
                    a.id = ?
                LIMIT
                    0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // bind id of advisor to be updated
        $stmt->bindParam(1, $this->id);
        // execute query
        $stmt->execute();
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // set values to object properties
        $this->name = $row['name'];
        $this->area = $row['area'];
        $this->title = $row['title'];
    }

    // update the advisor
    public function update()
    {
        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :name, area = :area, title_id = :title_id
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->area = htmlspecialchars(strip_tags($this->area));
        $this->title_id = htmlspecialchars(strip_tags($this->title_id));
        $this->id = htmlspecialchars(strip_tags($this->id));
        // bind new values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':area', $this->area);
        $stmt->bindParam(':title_id', $this->title_id);
        $stmt->bindParam(':id', $this->id);
        // execute the query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // delete the advisor
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


    // search advisor
    public function search($keywords)
    {
        // select all query
        $query = "SELECT
                   a.id, a.name, a.area, t.name as title
                FROM
                    " . $this->table_name . " a
                LEFT JOIN
                    titles t
                ON a.title_id = t.id
                WHERE
                    a.name LIKE ? OR a.area LIKE ?
                ORDER BY
                    a.name";

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

    // read advisors with pagination
    public function readPaging($from_record_num, $records_per_page)
    {
        // select query
        $query = "SELECT
                   a.id, a.name, a.area, t.name as title
                FROM
                    " . $this->table_name . " a
                LEFT JOIN
                    titles t
                ON a.title_id = t.id
                ORDER BY
                    a.name
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
