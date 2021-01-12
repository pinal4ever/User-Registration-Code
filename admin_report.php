<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'registration';
// Try and connect using the info above.

$db = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

$result = mysqli_query($db,"SELECT * FROM users order by `date` desc");

echo "<table border='1'>
<tr>
<th>FirstName</th>
<th>LastName</th>
<th>Address1</th>
<th>Address2</th>
<th>City</th>
<th>State</th>
<th>Zip</th>
<th>Country</th>
<th>Date</th>
</tr>";

while($row = mysqli_fetch_assoc($result))
{
echo "<tr>";
echo "<td>" . $row['first_name'] . "</td>";
echo "<td>" . $row['last_name'] . "</td>";
echo "<td>" . $row['address_1'] . "</td>";
echo "<td>" . $row['address_2'] . "</td>";
echo "<td>" . $row['city'] . "</td>";
echo "<td>" . $row['state'] . "</td>";
echo "<td>" . $row['zip'] . "</td>";
echo "<td>" . $row['country'] . "</td>";
echo "<td>" . $row['date'] . "</td>";
echo "</tr>";
}
echo "</table>";

$db->close();
?>