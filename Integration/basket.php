<?php
include 'classes/pageBuilder.php';

$html_code  = "<html>
<title>Web-Application-Security</title>"
.pageBuilder::printHead().

    
	
  " <table border=\"1\">
<tbody>
  <tr>
    <th>Number</th>
    <th>Article</th> 
    <th>Price</th>
	<th>Count</th>
	<th>Add or Remove</th>
  </tr>
  <tr>
    <td>1</td>
    <td>The Web Application Hacker's Handbook</td> 
    <td>34,99 €</td>
	<td>1</td>
	<td><a href = \"home.asp\">Add</a> / <a href = \"home.asp\">Remove</a></td>
  </tr>
  <tr>
    <td>2</td>
    <td>The Tangled Web: A Guide to Securing Modern Web Applications</td> 
    <td>40,00 €</td>
	<td>2</td>
	<td><a href = \"home.asp\">Add</a> / <a href = \"home.asp\">Remove</a></td>
  </tr>
  <tr>
    <td></td>
	<td>Total</td>
    <td>117,99 €</td>
	<td>3</td>
	<td><a href = \"home.asp\">Order</a> / <a href = \"home.asp\">Cancel</a></td>
  </tr>
</tbody>
</table>    

</body>
</html>";

echo $html_code;
?>



