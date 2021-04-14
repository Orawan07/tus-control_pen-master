<?php
header('Content-Type: application/json');

$conn = mysqli_connect('localhost', 'root', '', 'tus-control_pen');

$sqlQuery = "SELECT gender FROM employee ORDER BY emp_id";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>