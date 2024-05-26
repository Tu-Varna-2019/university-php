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
            <h2 align="center"> Намерена е въведената оценка !</h2>
            <h2 align="center">Въведете новите данни </h2>
            </div>

 <form action="#" method="POST">
     <br>
            Оценка:<input type="text" name="Grade">
           <br>
           <br>
            Дата: <input type="date" name="Date"><font color="red">*</font>
         
            <br>
           <br>
           Преподавател: <input type="text" name="Teacher"><font color="red">*</font>
            <br>
            <br>
            <input type="submit" name="submit2" value="Въведи">
            <br>
            <br>
       
       </form>
      

        <?php
   
       
           if (isset($_POST['submit2'])) {
               session_start();
    
    if (!empty($_POST['Grade'])  && !empty($_POST['Date']) &&  !empty($_POST['Teacher'])) {
        
        

        $Grade=$_POST['Grade'];
         $rawdate = htmlentities($_POST['Date']);
        $Date= date('Y-m-d', strtotime($rawdate));
       $Fac_num=$_SESSION['Fac_num'];
       
       
        $Discipline=$_SESSION['Discipline'];
        
        $Teacher;
        $TeacherN=$_POST['Teacher'];
        
        $flagTCH=false;
          $resTCH= mysqli_query($dbConn,"SELECT * FROM Teacher");
    while($row = mysqli_fetch_assoc($resTCH)) {
        $valName=$row['TCH_Name'];
       $valId=$row['TCH_Id'];
       if ($valName == $TeacherN) { $Teacher=$valId;$flagTCH=true; }
    }
        
      if (!$flagTCH) { die("<ul><li>Преподавател с такова име не съществува</li><li><a href='index.php'>Начало</a></li></ul> !"); }
      
      else {
          
         
        
    

        if (!mysqli_query($dbConn,"UPDATE Rating "
                . "SET Grade =$Grade,"
                . "Dates ='$Date',"
                . "TCH_FK_R=$Teacher "
                . "WHERE ST_FK_R=$Fac_num AND DS_FK_R= $Discipline ")) { die("<ul><li>Не могат да се редактират данните</li><li><a href='index.php'>Начало</a></li></ul> !");
                
                
                
                
                }else {   echo"<ul><li>Редактирането бе успешно!</li><li><a href='index.php'>Начало</a></li></ul> "; }
      }
    }else die("<ul><li>Moля въведете необходимата информация !</li><li><a href='index.php'>Начало</a></li></ul>");
    
    unset($_SESSION['Fac_num']);
    unset($_SESSION['Discipline']);
    session_destroy();
}
           
       
        
       
    
    




?>
        
        
    </body>
</html>