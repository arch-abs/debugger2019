<?php
require_once ("includes/global.php");
header ( 'Content-type: text/html; charset=utf-8' );
echo <<<CONTENT
<!DOCTYPE html>
<html>
  <head>
    <title>Debugger - Add a question</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
CONTENT;
if (! isset ( $_SESSION ['admin'] ))
	header ( 'Location: login.php' ) && die ();
?>
</head>
<body>

  <!--Still missing the feature of having anything inside <> appear in the table-->
  <header style="height: 50px; background-color: rgba(32, 169, 112, 0.14); text-align: center;">
    <div class="left" id="teamheader" style="float:left; margin-left: 20px; margin-top: 15px; "><a href="index.php">Hi Admin</a></div>
    <div class="right" id="logoutheader" style="float: right; float: right;margin-right: 20px;margin-top: 15px;"><a href="logout.php">LogOut</a></div>
  </header>
  
<h2 align="center"> View all questions</h2>
<a href="addq.php"><button>
    <h3 style="color: black">Add new question</h3>
  </button></a>
<br>
<br>
  <?php
  include 'includes/connection.php';
  $query1="SELECT stageid FROM stages";
  if (! $result1 = $mysqli->query ( $query1 )) {
    die ( "Error" . $mysqli->error );
  }
  if ($result1->num_rows == 0){
    echo "no data here";
    die();
  }
  while ($row1 = $result1->fetch_assoc()){
    $stageid = $row1['stageid'];
    echo 'stageid = ';
    echo $stageid;
    echo '<br>';
    $query="SELECT * from questions WHERE stageid='{$stageid}'";
    $result=$mysqli->query($query);
    if ($result->num_rows > 0){?>
      <!--Creating a table-->
    <table style="margin: 10px 10px 10px 10px;"border="1" >
    		  	<tr>
    				<th>Stage id</th>
    				<th>Question id</th>
    				<th>Question</th>
            <th>Code</th>
    			</tr>
          <?php
          while($row = $result->fetch_assoc()){
            echo '
            <tr>
              <td>'.$row["stageid"].'</td>
              <td>'.$row["questionid"].'</td>
              <td><pre style="white-space: pre-line;text-align : left;">'.htmlspecialchars($row['question']).'</pre></td>
              <td><pre style="white-space: pre-line;text-align : left;">'.htmlspecialchars($row['code']).'</pre></td>
            </tr>';
        	} ?>
      </table>
      <br>
    <?php
    }
  }
?>
</body>
</html>
