<?php
  include '../db.php';
?>
<html>
  <head>
    <title>Administrative Actions</title>

    <script type="text/javascript">
    // <![CDATA[
    function show(id) {
      document.getElementById(id).style.display = 'block';
    }
    function hide(id) {
      document.getElementById(id).style.display = 'none';
    }
    // ]]>
    </script>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
  <body>
    <p dir='rtl'>
    <img src='http://www.sf-f.org.il/static/top_title_right.jpg'>
    </p>

    <?php
      $table = $_GET["table"];
      echo "Please choose an action to perform on the $table table:";
      echo '<form action="process.php?table=' . $table . '" method="post">';
    ?>
      <p>
        <input type="radio" name="action" value="add" onclick="show('new_name'); hide('items');" />
          Add an item (type a name) <br>
        <input type="radio" name="action" value="delete" onclick="hide('new_name'); show('items');" />
          Delete an item (choose one) <br>
        <input type="radio" name="action" value="rename" onclick="show('new_name'); show('items');" />
          Rename an item (choose one and type a new name) <br>
      </p>
      <table border="0" style="text-align: left;">
        <tr>
        <td id="items" style="display: none;">
          Available items:
          <select name="id" size="4">  
          <?php
            function subtree_options($root_id, $root_name, $tabchar, $depth)
            {
              echo '<option value="' . $root_id . '" > ' . str_repeat($tabchar, $depth) . $root_name;
              $data = mysql_query("SELECT id, name FROM $table WHERE field_id = \"$root_id\"", $con);
              while ($row = mysql_fetch_array($data))
              {
                subtree_options($row["id"], $row["name"], $tabchar, $depth+1);
              }
            }

            if ($table == "skills")
            {
              $data = mysql_query("SELECT id, name FROM $table WHERE field_id IS NULL", $con) or die ("Error: " . mysql_error());
              while ($row = mysql_fetch_array($data))
              {
                subtree_options($row["id"], $row["name"], "&mdash;es", 0);
              }
            } else {
              $data = mysql_query("SELECT id, name FROM $table", $con) or die ("Error: " . mysql_error());
              while ($row = mysql_fetch_array($data))
              {
                echo '<option value="' . $row["id"] . '" > ' . $row["name"];
              }
            }
            mysql_close($con);
          ?>
          </select>
        </td>
        </tr>

        <tr>
        <td id="new_name" style="display: none;">
          New item name: <input type="text" name="new_name" />
        </td>
        </tr>
      </table>
      <input type="submit" value="Perform action" />
    </form>
    <form action="index.html" method="post">
      <input type="submit" value="Back to administration menu" />
    </form>
  </body>
</html>
