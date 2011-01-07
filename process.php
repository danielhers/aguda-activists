<pre> POST: <?php print_r($_POST) ?> </pre>
<?php
  include 'db.php';

  function age_to_year_of_birth($age)
  {
    $birth_date = new DateTime();
    $birth_date->sub(DateInterval::createFromDateString("$age years"));
    return $birth_date->format("Y");
  }

  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];
  $age = $_POST["age"];
  $year_of_birth = age_to_year_of_birth($age);
  $cell_number = $_POST["cell_number"];
  $email = $_POST["email"];
  $other_interest = $_POST["other_interest"];

  $sql = "INSERT INTO `volunteers` (
    `id` ,
    `first_name` ,
    `last_name` ,
    `year_of_birth` ,
    `city_id` ,
    `phone_number` ,
    `cell_number` ,
    `email` ,
    `mail_address` ,
    `comment`
  )
  VALUES (
    NULL ,
    '$first_name',
    '$last_name',
    '$year_of_birth',
    NULL ,
    NULL ,
    '$cell_number',
    '$email',
    NULL ,
    NULL
  );";

  mysql_query($sql, $con)
    or die ("Error: " . mysql_error());

  $sql = "INSERT INTO `interests` ( `name` ) VALUES ( '$other_interest' );";

  mysql_query($sql, $con)
    or die ("Error: " . mysql_error());
?>
<html>
  <head>
    <title>Processing...</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
  <body>
    <p>
      <table border="0">
      <tr>
        <td><b>Interests:</b></td>
        <td><?php echo implode($_POST["interests"],", ") . $_POST["other_interest"]; ?></td>
      </table>
    </p>

    <p>Successfully added '<?php echo "$first_name $last_name" ?>' to the database.</p>
    <p>Data currently in the database:</p>
    <?php $data = mysql_query("SELECT * FROM volunteers", $con) or die ("Error: " . mysql_error()); ?>
    <p>
    <table border="1">
      <tr>
        <th>Name</th>
        <th>Age</th>
      </tr>

    <?php
      while ($row = mysql_fetch_array($data))
      {
        echo "<tr>";
        echo "<td>" . $row["first_name"] . "</td>";
        echo "<td>" . $row["last_name"] . "</td>";
        echo "<td>" . $row["year_of_birth"] . "</td>";
        echo "</tr>";
      }
      mysql_close($con);
    ?>
    </table>
    </p>
    <form action="index.php" method="post">
      <input type="submit" value="Back to form" />
    </form>
  </body>
</html>
