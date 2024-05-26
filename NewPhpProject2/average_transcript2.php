<?php include('config.php');if (!mysqli_select_db($dbConn,'University')) {
    die("Не може да избере базата данни!");
} ?>





<html>
               <head>
      <style>
body {
    background-color:#C5E2F6;



margin: 0;
}
ul {
list-style-type: none;
margin: 0;
padding: 0;
text-align: center;
 border: 3px solid #BCC1E9;
width: 100%;
background-color: #C5E2F6;


position: fixed;
height: 100%;
overflow: auto;
}
li a {
display: block;
color: #000;
padding: 8px 16px;
text-decoration: none;
}
li a.active {
background-color: #4CAF50;
color: white;
}
li a:hover:not(.active) {
background-color: #555;
color: white;
}

.header {

background-color:#0D6DB0
;
color:white;
padding: 20px;
text-align: left;

}



</style>
    </head>
  
    <body>
          <div class="header">
        <h2 align="center">Среден успех за дисциплини</h2>
          </div>
        <br>
        <?php
        
        $res= mysqli_query($dbConn,"SELECT DS_Name , ROUND(AVG(Grade)) AS avrg FROM Rating "
                . "JOIN Discipline ON ( DS_Id = DS_FK_R ) GROUP BY DS_Name "
                . "ORDER BY DS_Name ");
        
         echo"<table border='1' size=25%><tr><th>Дисциплина</th><th>Среден успех</th></tr>";
        while($row = mysqli_fetch_assoc($res)) {
           echo"<tr><td>".$row['DS_Name']."</td><td>".$row['avrg']."</td></tr>";
        }
        echo"</table>";
        ?>
        <br>
        <ul><li>
         <a href="index.php">Назад</a>
            </li></ul>
    </body>
</html>
