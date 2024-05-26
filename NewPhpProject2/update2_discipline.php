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
            <h2 align="center"> Намерена е въведената дисциплина !</h2>
            <h2 align="center">Въведете новото наименование </h2>
            </div>
 <form action="#" method="POST">
     <br>
           Наименование:<input type="text" name="Name">
           <br>
           <br>
           Семестър: <input type="text" name="Semester">
            <br>
             <br>
         
            <input type="submit" name="submit2" value="Въведи">
            <br>
            <br>
       
       </form>
      


        <?php
   
       
           if (isset($_POST['submit2'])) {
               session_start();
     
    if (!empty($_POST['Name'])  && !empty($_POST['Semester']) ) {
        
        $Name=$_POST['Name'];
       
        $Semester=$_POST['Semester'];
       
        $Id=$_SESSION['Discipline'];
      
         
        if (!mysqli_query($dbConn,"UPDATE Discipline "
                . "SET DS_Name ='$Name'," 
                . "Semester=$Semester "
                . "WHERE DS_Id =$Id ")) { die("<ul><li>Не могат да се редактират данните</li><li><a href='index.php'>Начало</a></li></ul> !");
                
                
                
                
                }else { echo"<script>document.body.innerHTML='';</script>";  echo"<ul><li>Редактирането бе успешно!</li><li><a href='index.php'>Начало</a></li></ul>"; }
        
    }else die("<ul><li>Moля въведете необходимата информация !</li><li><a href='index.php'>Начало</a></li></ul>");
    
    unset($_SESSION['Discipline']);
    session_destroy();
    
}
           
       
        
       
    
    




?>
        
        
    </body>
</html>
