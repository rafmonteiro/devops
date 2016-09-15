<?php
 
// database credentials (defined in group_vars/all)
$dbname = "dockerapp";
$dbuser = "admin";
$dbpass = "password";
$dbhost = "mysql";
 
// query templates
$create_table = "CREATE TABLE IF NOT EXISTS `wall` (
   `id` int(11) unsigned NOT NULL auto_increment,
   `title` varchar(255) NOT NULL default '',
   `content` text NOT NULL default '',
   PRIMARY KEY  (`id`)
   ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
$select_wall = 'SELECT * FROM wall';
 
// Connect to and select database
$link = mysql_connect($dbhost, $dbuser, $dbpass)
    or die('Could not connect: ' . mysql_error());
mysql_select_db($dbname) or die('Could not select database');
 
// create table
$result = mysql_query($create_table) or die('Create Table failed: ' . mysql_error());
 
// handle new wall posts
if (isset($_POST["title"])) {
    $result = mysql_query("insert into wall (title, content) values ('".$_POST["title"]."', '".$_POST["content"]."')") or die('Create Table failed: ' . mysql_error());
}
 
// Performing SQL query
$result = mysql_query($select_wall) or die('Query failed: ' . mysql_error());
 
// Printing results in HTML
echo "<table>\n";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";
 
// Free resultset
mysql_free_result($result);
 
// Closing connection
mysql_close($link);
?>
<!DOCTYPE html>
<html>
<style>
input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>
<body>

<h3>Very simple App</h3>

<div>
  <form method="post">
    <label for="title">Title</label>
    <input type="text" id="title" name="title">

    <label for="msg">Message</label>
    <input type="text" id="msg" name="content">

   
    <input type="submit" value="Send message">
  </form>
</div>

</body>
</html>
