<?php

$result = mysqli_query($connection, "SELECT * FROM userbase");

while($query_data = mysqli_fetch_row($result)) {
  echo "<br>";
  echo "<tr>";
  echo "<td>",$query_data[0], "</td>",
       "<td>",$query_data[1], "</td>",
       "<td>",$query_data[2], "</td>",
       "<td>",$query_data[3], "</td>";
  echo "</tr>";
}
?>