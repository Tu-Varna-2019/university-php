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
        <ul>
        <fieldset>
            <li>
         <h2 align="left">Студенти</h2>
         <?php
         echo"<table border='1' size=25% align='left'><tr><th>Студент</th><th>Факултетен номер</th><th>Специалност</th><th>Курс</th><th>Еmail</th></tr>";
        $res= mysqli_query($dbConn,"SELECT * FROM Student JOIN Specialty ON (SP_Id = SP_FK_Id)");
    while($row = mysqli_fetch_assoc($res)) {
        
    echo"<tr><td>".$row['ST_Name']."</td><td>".$row['Facility_num']."</td><td>".$row['SP_Name']."</td><td>".$row['Course']."</td><td>".$row['ST_Email']."</td></tr>";
        
    }
    echo"</table>";
    
    
    ?>
            </li>
            <li>
         
          <h2 align="center">Специалности</h2>
         <?php
         
           echo"<table border='1' size=25% align='center'><tr><th>Номер</th><th>Дисциплина</th></tr>";
        $res= mysqli_query($dbConn,"SELECT * FROM Specialty");
    while($row = mysqli_fetch_assoc($res)) {
        
    echo"<tr><td>".$row['SP_Id']."</td><td>".$row['SP_Name']."</td></tr>";
        
    }
    echo"</table>";
    
    ?>
            </li>
            <li>
        </fieldset>
          <br>
          <br>
          <fieldset>
         <h2 align="left">Преподаватели</h2>
         <?php
         echo"<table border='1' size=25% align='left'><tr><th>Номер</th><th>Преподавател</th><th>Титла</th><th>Тел. номер</th><th>Еmail</th></tr>";
        $res= mysqli_query($dbConn,"SELECT * FROM Teacher JOIN Title ON (TL_Id = TL_FK_Id)");
    while($row = mysqli_fetch_assoc($res)) {
        
    echo"<tr><td>".$row['TCH_Id']."</td><td>".$row['TCH_Name']."</td><td>".$row['TL_Name']."</td><td>".$row['Phone']."</td><td>".$row['TCH_Email']."</td></tr>";
        
    }
    echo"</table>";
        ?>
          </li>
          <li>
         
          <h2 align="center">Титли</h2>
         <?php
         echo"<table border='1' size=25% align='center'><tr><th>Номер</th><th>Титла</th></tr>";
        $res= mysqli_query($dbConn,"SELECT * FROM Title");
    while($row = mysqli_fetch_assoc($res)) {
        
    echo"<tr><td>".$row['TL_Id']."</td><td>".$row['TL_Name']."</td></tr>";
        
    }
    echo"</table>";
         ?>
          </li>
          <li>
          </fieldset>
         <br>
        
         <br>
         <fieldset>
          <h2 align="left">Дисциплини</h2>
         <?php
           echo"<table border='1' size=25% align='left'><tr><th>Номер</th><th>Дисциплина</th><th>Семестър</th></tr>";
        $res= mysqli_query($dbConn,"SELECT * FROM Discipline");
    while($row = mysqli_fetch_assoc($res)) {
        
    echo"<tr><td>".$row['DS_Id']."</td><td>".$row['DS_Name']."</td><td>".$row['Semester']."</td></tr>";
        
    }
    echo"</table>";
    ?>
         </li>
         <li>
        
         <h2 align="center">Оценки</h2>
        
         <?php
          echo"<table border='1' size=25% align='center'><tr><th>Оценка</th><th>Дата</th><th>Студент</th><th>Преподавател</th><th>Дисциплина</th></tr>";
        $res= mysqli_query($dbConn,"SELECT * FROM Rating JOIN Student ON (Facility_num = ST_FK_R)  JOIN Teacher ON (TCH_Id = TCH_FK_R) JOIN Discipline ON (DS_Id = DS_FK_R) "
                . "ORDER BY ST_FK_R ");
    while($row = mysqli_fetch_assoc($res)) {
        
    echo"<tr><td>".$row['Grade']."</td><td>".$row['Dates']."</td><td>".$row['ST_Name']."</td><td>".$row['TCH_Name']."</td><td>".$row['DS_Name']."</td></tr>";
        
    }
                echo"</table>";
                echo"";
                
                ?>
         </li>
         <li><a href='index.php'>Начало</a></li>
        </ul>
         </fieldset>
           
         <br>
         <br>
        
       
    </body>
</html>
