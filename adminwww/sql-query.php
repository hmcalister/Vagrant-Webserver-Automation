<?php
function sql_query($query){
    $DATABASE_HOST = '192.168.2.12:3306';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = 'root';
    $DATABASE_NAME = 'webdatabase';

    // Try and connect using the info above.
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno()) {
        // If there is an error with the connection, stop the script and display the error.
        echo ('Failed to connect to MySQL: ' . mysqli_connect_error());
        return;
    }

    $result = mysqli_query($con, $query);
    if (gettype($result) === "boolean") {
        if ($result) {
            echo ("<h1>Query Successful!</h1>");
        } else {
            echo ("<h1>Query Failed!</h1>");
        }
    } else {
        $finfo = $result->fetch_fields();

        echo "<table>"; // start a table tag in the HTML

        //create the table headers as column names
        echo ('<tr>');
        foreach ($finfo as $header) {
            printf("<th>%s</th>", $header->name);
        }
        echo ('</tr>');
        //echo each row as next data
        while ($row = mysqli_fetch_array($result)) {   //Creates a loop to loop through results
            echo "<tr>";
            for ($i = 0; $i < count($row); $i++) {
                printf("<td>%s</td>", $row[$i]);
            }
            echo "</tr>";
        }

        echo "</table>"; //Close the table in HTML
    }
    $con->close();
}
?>