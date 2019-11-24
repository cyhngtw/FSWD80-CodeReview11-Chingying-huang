<?php
$connect = mysqli_connect("localhost", "root", "", "cr11_ching_travelmatic");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM location 
	WHERE type LIKE '%".$search."%'
	OR address LIKE '%".$search."%' 
	OR name LIKE '%".$search."%' 
	OR city LIKE '%".$search."%' 
	OR zip LIKE '%".$search."%' 
	OR style LIKE '%".$search."%'
	";
}
else
{
	$query = "
	SELECT * FROM location ORDER BY id";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
						    <th>Name</th>
							<th>Type</th>
							<th>Address</th>
							<th>City</th>
							<th>Postal Code</th>
							<th>style</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
				<td>'.$row["name"].'</td>
				<td>'.$row["type"].'</td>
				<td>'.$row["address"].'</td>
				<td>'.$row["city"].'</td>
				<td>'.$row["zip"].'</td>
				<td>'.$row["style"].'</td>
			</tr>
		';
	}
	echo $output;
}
else
{
	echo 'Data Not Found';
}
?>