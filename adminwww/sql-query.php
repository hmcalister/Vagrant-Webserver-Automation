<?php
function sql_query($query){
    include 'database-login.php';

    $result = mysqli_query($con, $query);
    if (gettype($result) === "boolean") {
        if ($result) {
            echo ("<h1>Query Successful!</h1>");
        } else {
            echo ("<h1>Query Failed!</h1>");
            echo ("<h1>Error:".mysqli_error($con)."</h1>");
        }
    } else {
        $finfo = $result->fetch_fields();

        echo "<table style='width:100%;'>"; // start a table tag in the HTML

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