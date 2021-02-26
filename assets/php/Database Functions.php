<?php
/**
 * Connection to the MySQL database.
 * @return false|mysqli - Returns the connection if it's made otherwise dies.
 */
function DatabaseConnection()
{
    $url = parse_url(getenv("DB_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $conn = mysqli_connect($server, $username, $password, $db) or die("Cant connect to database.");
    return $conn;
}

/**
 * Performs a query on the database using the provided SQL.
 * @param $query - The SQL statement to be queried.
 * @return bool|mysqli_result - Returns the result of the query.
 */
function QueryTable($query)
{
    $conn = DatabaseConnection();
    $result = $conn->query($query);

    return $result;
}

/**
 * Select items from a specific table by querying it.
 * @param $table - The table to be queried.
 * @param $selections - The items to be selected from the table.
 * @param $where_clause - Query filter.
 * @return bool|mysqli_result - Returns the result of the query.
 */
function SelectFromTable($table, $selections, $where_clause)
{
    $sql = "SELECT {$selections} FROM {$table} WHERE {$where_clause}";
    return QueryTable($sql);
}

function InsertUser($username, $password)
{
    $username = SanitizeString($username);
    $password = hash("sha256", SanitizeString($password));
    $sql = "INSERT INTO heroku_7e12094ae71a8cd.users (username, password, permission) VALUES ('{$username}', '{$password}', 'User')";
    return QueryTable($sql);
}

/**
 * Update the metrics table to increment the value of a A/B test metric by 1.
 * @param $type - The metric type to be incremented.
 */
function UpdateMetric($type)
{
    $sql = "UPDATE heroku_7e12094ae71a8cd.metrics SET metric_value = metric_value + 1 WHERE metric_type = '{$type}'";
    QueryTable($sql);
}

/**
 * Takes a row outputted by mysqli_fetch_object and sanitizes each item with
 * htmlspecialchars to convert special characters to HTML entities to prevent XSS.
 * If any item in the row is blank or empty it will be set to Unspecified.
 * @param $row - The mysqli_fetch_object row to be sanitized.
 * @return mixed - A sanitized row object.
 */
function SanitizeRowObject($row)
{
    foreach($row as $key => $value)
    {
        if(is_null($value) || empty($value)) $value = "Unspecified";
        else $row->$key = htmlspecialchars($value);
    }

    return $row;
}

/**
 * Create a legal SQL string that can be used in a SQL statement. The string
 * will be encoded to an escaped SQL string.
 * @param $word - The string to be sanitized and escaped.
 * @return mixed - An escaped string.
 */

function SanitizeString($word)
{
    $conn = DatabaseConnection();
    return $conn->real_escape_string($word);
}

/**
 * Check how many rows are returned in a database query.
 * @param $result - The result returned from querying the database.
 * @return mixed - Returns the number of rows.
 */
function NumRows($result)
{
    return $result->num_rows;
}
?>