<?php
  include 'db.php';
?>
<html>
  <head>
    <title>New Activist Form</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript">
function validate_required(field, alerttxt)
{
  if (field.value==null||field.value=="")
  {
    alert(alerttxt);return false;
  }
  else
  {
    return true;
  }
}

function validate_form(thisform)
{
  with (thisform)
  {
<?php
  foreach ($fields as $field)
  {
    if (!$field["mandatory"]) continue;
    echo 'if (validate_required(' . $field["name"]
      . ', "The ' . $field["title"] . ' field cannot be left blank!") == false)';
    echo '{' . $field["name"] . '.focus(); return false;}';
  }
?>
  }
}
    </script>
  </head>
  <body>
    <p dir='rtl'>
    <img src='http://www.sf-f.org.il/static/top_title_right.jpg'>
    </p>

    Please fill in your details:<br>
    (mandatory fields are marked with a <span style="color:red">*</span>)<br>
    <form action="process.php" onsubmit="return validate_form(this)" method="post">
      <table border="0" style="text-align: left;">
<?php
foreach ($fields as $field)
{
  switch ($field["type"])
  {
    case "simple":
      echo '<tr>';
      echo '<td>' . $field["title"] . '</td>';
      echo '<td><input type="text" name="' . $field["name"] . '" />'
        . ($field["mandatory"] ? '<span style="color:red">*</span>' : '')
        . '</td>';
      echo '</tr>';
      break;

    case "multiple":
      echo '<tr>';
      echo '<td>' . $field["title"]
        . '<p style="font-size:60%">(hold down the Ctrl key for<br>selecting more than one)</p>'
        . '</td>';
      echo '<td>';
      echo '<select multiple name=' . $field . '[] size="4">';
      $data = mysql_query('SELECT id, name FROM ' . $field["name"], $con) or die ("Error: " . mysql_error());
      while ($row = mysql_fetch_array($data))
      {
        echo '<option value="' . $row["id"] . '" > ' . $row["name"];
      }
      echo '</select>';
      echo '</td>';
      echo '</tr>';

      echo '<tr>';
      echo '<td>Other:</td>';
      echo '<td><input type="text" name="other" /></td>';
      echo '</tr>';

      break;

    default:
      echo 'ERROR: field "' . $field["name"] . '" has an invalid type, "' . $field["type"] . '".';
      break;
  }
}
mysql_close($con);
?>
      </table>
      <input type="submit" value="Add to database" />
    </form>
  </body>
</html>
