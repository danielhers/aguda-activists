<?php
  $db["url"] = "localhost";
  $db["username"] = "root";
  $db["password"] = "root";
  $db["name"] = "aguda";

  $con = mysql_connect($db["url"],$db["username"],$db["password"])
    or die ("Could not connect: " . mysql_error());
  mysql_select_db($db["name"], $con)
    or die ("Could not select database: " . mysql_error());

  $fields = array("first_name"  => array("name" => "first_name",
                                         "title" => "First Name",
                                         "mandatory" => true,
                                         "type" => "simple"
                                        ),
                  "last_name"   => array("name" => "last_name",
                                         "title" => "Last Name",
                                         "mandatory" => true,
                                         "type" => "simple"
                                        ),
                  "age"         => array("name" => "age",
                                         "title" => "Age",
                                         "mandatory" => false,
                                         "type" => "simple"
                                        ),
                  "cell_number" => array("name" => "cell_number",
                                         "title" => "Cell. number",
                                         "mandatory" => false,
                                         "type" => "simple"
                                        ),
                  "email"       => array("name" => "email",
                                         "title" => "Email address",
                                         "mandatory" => true,
                                         "type" => "simple"
                                        ),
                  "interests"   => array("name" => "interests",
                                         "title" => "Interests",
                                         "mandatory" => false,
                                         "type" => "multiple"
                                        )

      );
?>
