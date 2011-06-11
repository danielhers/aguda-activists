<?php
  include '../db.php';
?>
<html>
  <head>
    <title>Processing...</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
  <body>
    <?php
    $table = $_GET["table"];

    $action = $_POST["action"];
    $id = $_POST["id"];
    $new_name = $_POST["new_name"];

    switch ($action)  {
    case "add":
      if ($new_name == '') die ("Error: new name empty");
      $sql = "INSERT INTO `$table` ( `name` ) VALUES ( '$new_name' );";
      $message = "Successfully added '$new_name' to the $table table.";
      break;
    case "delete":
      if ($id == '') die ("Error: id empty");
      $data = mysql_query("SELECT name FROM $table WHERE id=$id", $con) or die ("Error: " . mysql_error());
      list($name) = mysql_fetch_row($data);
      $sql = "DELETE FROM `$table` WHERE id='$id' ;";
      $message = "Successfully deleted '$name' from the $table table.";
      break;
    case "rename":
      if ($id == '') die ("Error: id empty");
      if ($new_name == '') die ("Error: new name empty");
      $data = mysql_query("SELECT name FROM $table WHERE id=$id", $con) or die ("Error: " . mysql_error());
      list($name) = mysql_fetch_row($data);
      $sql = "UPDATE `$table` SET name='$new_name' WHERE id='$id' ;";
      $message = "Successfully renamed '$name' to '$new_name' in the $table table.";
      break;
    default:
      die ("Error: unknown action $action");
    }

    mysql_query($sql, $con)
      or die ("Error: " . mysql_error());
    echo "<p>$message</p>";

    echo "<p>Data currently in the $table table:</p>";
    $data = mysql_query("SELECT * FROM $table", $con) or die ("Error: " . mysql_error());
    ?>
    <p>
    <table border="1">
      <tr>
        <th>Name</th>
        <th>ID</th>
      </tr>

    <?php
      while ($row = mysql_fetch_array($data))
      {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["id"] . "</td>";
        echo "</tr>";
      }
      mysql_close($con);
    ?>
    </table>
    </p>
    <form action="index.html" method="post">
      <input type="submit" value="Back to administration menu" />
    </form>
  </body>
</html>
