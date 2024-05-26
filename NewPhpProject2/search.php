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

        
        
        <fieldset>
        <form action="#" method="POST">
            
            <h2 align="center"> Въведете фак. номер на студента и наименованието на дисциплината:</h2>
            <br>
            <br>
            Фак. номер:<input type="text" name="Fac_num">
             <br>
            <br>
            Наименование:<input type="text" name="DS_Name">
            <br>
            <br>
            <input type="submit" name="submit" value="Потвърди !">
            
         </form>
            </fieldset>
            
       <br>
       <br>
<?php
if (isset($_POST['submit'])) {
 
   $Fac_n=$_POST['Fac_num'];
   $Discipline=$_POST['DS_Name'];
    $flagST=false;
    $flagDS=false;
    $flagFOUND=false;
    $DS_Id=null;
    $resST= mysqli_query($dbConn,"SELECT * FROM Student");
    while($row = mysqli_fetch_assoc($resST)) {
       
       if ($_POST['Fac_num'] == $row['Facility_num']) { $flagST=true;  }
    }
    
    if (!$flagST) {
        die("<ul><li>Студент с такъв факултетен номер не съществува</li><li><a href='index.php'>Начало</a></li></ul> !");
    }
    
    
    $resDS= mysqli_query($dbConn,"SELECT * FROM Discipline");
    while($row = mysqli_fetch_assoc($resDS)) {
       
       if ($_POST['DS_Name'] == $row['DS_Name']) {$DS_Id=$row['DS_Id']; $flagDS=true; }
    }
    
     $resR= mysqli_query($dbConn,"SELECT * FROM RATING JOIN STUDENT ON ( Facility_num = ST_FK_R) WHERE Facility_num= $Fac_n ");
    while($row = mysqli_fetch_assoc($resR)) {
       
       if ($row['DS_FK_R'] == $DS_Id) { $flagFOUND=true; }
    }
    
    if (!$flagDS) {
        die("<ul><li>Дисциплина с такова име не съществува !</li><li><a href='index.php'>Начало</a></li></ul>");
    }
    
    if (!$flagFOUND) {
        
        die("<ul><li>Студент няма оценка в такава дисциплина !</li><li><a href='index.php'>Начало</a></li></ul>");
    }
   else if ($flagST && $flagDS && $flagFOUND )
   {
        echo"<script>document.body.innerHTML='';</script>";
        echo"<div class='header'><h2 align='center'> Резултат</h2></div>";
        echo"<ul><li>";
        echo"<table border='1' size=25%><tr><th>Студент</th><th>Дисциплина</th><th>Оценка</th></tr>";
        
        $res= mysqli_query($dbConn,"SELECT * FROM Rating JOIN Student "
                . "ON ( Facility_num = ST_FK_R) JOIN Discipline ON ( DS_Id = DS_FK_R ) WHERE Facility_num = $Fac_n AND DS_Name='$Discipline' ");
    while($row = mysqli_fetch_assoc($res)) {
        
    echo"<tr><td>".$row['ST_Name']."</td><td>".$row['DS_Name']."</td><td>".$row['Grade']."</td></tr>";
        
    }
        echo"</li> <li><a href='index.php'>Начало</a></li> </ul>";
        
        echo"</table>";
      
    }
    
    
    }
        ?>
    
        

    </body>
</html>

