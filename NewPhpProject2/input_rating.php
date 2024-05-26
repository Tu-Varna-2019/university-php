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
        
         <div class="header"> <h1 align="center">Моля въведете данните  с<font color="red">  * </font> ! </h1></div>
        
        
        <form action="#" method="POST">
            <br>
            Оценка:    <input type="text" name="Grade"><font color="red">*</font>
            <br>
            <br>
            Дата: <input type="date" name="Date"><font color="red">*</font>
            <br>
             <br>
             Факултетен номер на студент: <input type="text" name="Fac_num"><font color="red">*</font>
             <br>
             <br>
             
            <label for="Discipline">Дисциплина:</label>
            <select name="Discipline" id="Discipline">
                <?php
                 $res= mysqli_query($dbConn,"SELECT * FROM Discipline");
    while($row = mysqli_fetch_assoc($res)) {
        $valName=$row['DS_Name'];
       $valId=$row['DS_Id'];
    echo"<option value=$valId>$valName</option>";
    }
    ?>
                            </select>
           
            <font color="red">*</font>

            <br>
             <br>
         
             
            Преподавател: <input type="text" name="Teacher"><font color="red">*</font>
           
            <br>
            <br>
            <input type="submit" name="submit" value="Въведи">
            <br>

            <br>
            
        </form>

<?php
if (isset($_POST['submit'])) {
    


    if (!empty($_POST['Grade']) && !empty($_POST['Date']) && !empty($_POST['Fac_num']) && !empty($_POST['Discipline'] && !empty($_POST['Teacher']))) {
        
        $rawdate = htmlentities($_POST['Date']);
        

        
        
    
        $flagST=false;
        $flagTCH=false;
        $flagSTDS=false;
        $Grade=$_POST['Grade'];
        $Date= date('Y-m-d', strtotime($rawdate));
        $Fac_n=$_POST['Fac_num'];
        $Discipline=$_POST['Discipline'];
        $Teacher=$_POST['Teacher'];
        
         $resTCH= mysqli_query($dbConn,"SELECT * FROM Teacher");
    while($row = mysqli_fetch_assoc($resTCH)) {
        $valName=$row['TCH_Name'];
       $valId=$row['TCH_Id'];
       if ($valName == $Teacher) { $Teacher=$valId;$flagTCH=true; }
    }
    
        $resST= mysqli_query($dbConn,"SELECT * FROM Student");
    while($row = mysqli_fetch_assoc($resST)) {
        
       $valId=$row['Facility_num'];
       if ($valId == $Fac_n) { $flagST=true; }
    }
    
        
      
        
      
      if (!$flagTCH || !$flagST ) { die("<ul><li>Преподавател / студент  с такова име / фак.номер не съществува </li><li><a href='index.php'>Начало</a></li></ul>!"); }
     
      else {
          
          $res= mysqli_query($dbConn,"SELECT * FROM Rating JOIN Student ON ( Facility_num = ST_FK_R) JOIN Discipline ON ( DS_ID = DS_FK_R) ");
          
          while ($row= mysqli_fetch_assoc($res)) { if ($Fac_n == $row['ST_FK_R'] && $Discipline == $row['DS_FK_R']) $flagSTDS=true; }
          
          
          if ($flagSTDS) {die("<ul><li>Студент вече има оценка в дадената дисциплина !</li><li><a href='index.php'>Начало</a></li></ul>");}
          else {
         if (!mysqli_query($dbConn,"INSERT INTO Rating (Grade,Dates,ST_FK_R,TCH_FK_R,DS_FK_R) "
                . "Values($Grade,'$Date',$Fac_n,$Teacher,$Discipline)")) { die("<ul><li>Не могат да се добавят данните !</li><li><a href='index.php'>Начало</a></li></ul>"); 
                
                }else {        echo"<table border='1' size=25%><tr><th>Оценка</th><th>Дата</th><th>Студент</th><th>Преподавател</th><th>Дисциплина</th></tr>";
        $res= mysqli_query($dbConn,"SELECT * FROM Rating JOIN Student ON (Facility_num = ST_FK_R)  JOIN Teacher ON (TCH_Id = TCH_FK_R) JOIN Discipline ON (DS_Id = DS_FK_R) "
                . "ORDER BY ST_FK_R");
    while($row = mysqli_fetch_assoc($res)) {
        
    echo"<tr><td>".$row['Grade']."</td><td>".$row['Dates']."</td><td>".$row['ST_Name']."</td><td>".$row['TCH_Name']."</td><td>".$row['DS_Name']."</td></tr>";
        
    }
                echo"</table><ul><li><a href='index.php'>Начало</a></li></ul>";}
        }
      }
    }else die("<ul><li>Moля въведете необходимата информация !</li><li><a href='index.php'>Начало</a></li></ul>");
    
}
?>

    </body>
</html>