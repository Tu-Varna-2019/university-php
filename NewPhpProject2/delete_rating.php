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
        <form action="#" method="POST">
            <br>
            <div class="header">
            <h2 align="center"> Въведете фак. номер на студента и наименованието на дисциплината, на които искате да изтриете оценката:</h2>
            </div>
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
       
       <br>
       <br>
<?php
if (isset($_POST['submit'])) {
 
   
    $flagST=null;
    $flagDS=null;
    $flagSTDS=true;
    $resST= mysqli_query($dbConn,"SELECT * FROM Student");
    while($row = mysqli_fetch_assoc($resST)) {
       
       if ($_POST['Fac_num'] == $row['Facility_num']) { $flagST=$_POST['Fac_num']; }
    }
    
    if (!$flagST) {
        die("<ul><li>Студент с такъв факултетен номер не съществува</li><li><a href='index.php'>Начало</a></li></ul> !");
    }
    
    
    $resDS= mysqli_query($dbConn,"SELECT * FROM Discipline");
    while($row = mysqli_fetch_assoc($resDS)) {
       
       if ($_POST['DS_Name'] == $row['DS_Name']) { $flagDS=$row['DS_Id']; }
    }
    
    if (!$flagDS) {
        die("<ul><li>Дисциплина с такова име не съществува</li><li><a href='index.php'>Начало</a></li></ul> !");
    }
    
    $res= mysqli_query($dbConn,"SELECT * FROM Rating JOIN Student ON ( Facility_num = ST_FK_R) JOIN Discipline ON ( DS_ID = DS_FK_R) ");
          
          while ($row= mysqli_fetch_assoc($res)) {
              if ($_POST['Fac_num'] == $row['ST_FK_R'] && $flagDS != $row['DS_FK_R']) $flagSTDS=false;
              else if ($_POST['Fac_num'] == $row['ST_FK_R'] && $flagDS == $row['DS_FK_R'])  {$flagSTDS=true;break;}
              }
    
          if (!$flagSTDS) {die("<ul><li>Не съществува оценка в дисциплина на този студент ! </li><li><a href='index.php'>Начало</a></li></ul> !");}
          
          
   else if ($flagST && $flagDS && $flagSTDS)
   {
       if(!mysqli_query($dbConn,"DELETE FROM Rating WHERE ST_FK_R = $flagST AND DS_FK_R= $flagDS ")) {
           die("<ul><li>Не могат да се изтрият данните ! </li><li><a href='index.php'>Начало</a></li></ul>");
       }
           else echo"<ul><li>Изтриването бе успешно !</li><li><a href='index.php'>Начало</a></li></ul>";
       }
    }
    
    
    
        ?>
    
        

    </body>
</html>