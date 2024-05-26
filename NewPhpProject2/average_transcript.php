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
        <h2 align="center">Среден успех за студенти за специалност / курс , подредени в намаляващ ред</h2>
         </div>
        <br>
        <?php
        
        $res= mysqli_query($dbConn,"SELECT SP_Name,Course,ROUND(AVG(GRADE),2) AS avrg
 FROM Rating JOIN Student
            ON ( Facility_num = ST_FK_R) JOIN Specialty ON ( SP_Id = SP_FK_Id ) GROUP BY Course,SP_Name 
            ORDER BY Course DESC , SP_Id DESC ");
        
         echo"<table border='1' size=25%><tr><th>Специалност</th><th>Курс</th><th>Среден успех</th></tr>";
        while($row = mysqli_fetch_assoc($res)) {
           echo"<tr><td>".$row['SP_Name']."</td><td>".$row['Course']."</td><td>".$row['avrg']."</td></tr>";
        }
        echo"</table>";
        ?>
        <br>
        <ul><li>
         <a href="index.php">Назад</a>
            </li></ul>
    </body>
</html>
