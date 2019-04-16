<?php
function My_Connect_DB()//created this function so we can call it everytime
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "eventtracker"; //these 4 variabales always needed to connect to db

	$conn = mysqli_connect($servername,$username,$password,$dbname); //first step is always connect to db.
	if(!$conn)
	die("Connection to DB failed: ".mysqli_connect_error()."<br/>");

	return $conn;
}

function My_SQL_EXE($conn, $sql)
{
	if($result = mysqli_query($conn, $sql))
	echo "";
else
	echo "Error in running sql: ". $sql ."with erro: ".mysqli_error($conn)."<br/>";
    return $result;
   
}

function My_Show_Table($result)
{
	echo "<table class='table table-hover' border = 1; table style='background-color:#D5DBDB;margin:auto'>";
    echo "<tr  style='background-color:lightblue;'>";
    	while($fieldinfo = mysqli_fetch_field($result))
        {
        	echo "<td>";
            	echo $fieldinfo-> name;
            echo "</td>";
        }
    echo "</tr>";
    while($row =mysqli_fetch_assoc($result))
    {
    	echo "<tr>";
        	foreach($row as $key=> $value)
            {
            	echo "<td>";
                	echo $value;
                echo "</td>";
            }
        echo "</tr>";
    }

	echo "</table>";
    echo "<p align='center'>Total rows: ".mysqli_num_rows($result)."</p><br/>";

}
function Run_SQL_Show_Table($conn, $sql, $table)
{
	My_SQL_EXE($conn, $sql);
    $sql = "SELECT * FROM ". $table. ";";
    $result = My_SQL_EXE($conn, $sql);
    My_Show_Table($result);
    
}


function showJson($conn, $sql){
	My_SQL_EXE($conn, $sql);
    $sql = "SELECT * FROM events FOR JASON;";
    $result = My_SQL_EXE($conn, $sql);


}

?>