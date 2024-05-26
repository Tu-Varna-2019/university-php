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
            <h2 align="center"> Въведете наименованието на дисциплината,на която искате да промените:</h2>
            </div>
            <br>
            <br>
            Наименование:<input type="text" name="Name">
            <br>
            <br>
            <input type="submit" name="submit" value="Потвърди !">
        
         </form>
       
       <br>
       <br>
<?php
if (isset($_POST['submit'])) {
    session_start();
    
    $_SESSION['Discipline']=null;
   
    $flag=false;
    
    $resDS= mysqli_query($dbConn,"SELECT * FROM Discipline");
    while($row = mysqli_fetch_assoc($resDS)) {
       
       if ($_POST['Name'] == $row['DS_Name']) { $flag=true; $_SESSION['Discipline']=$row['DS_Id']; }
    }
    
    if (!$flag) {
        die("<ul><li>Дисциплина с такова име не съществува</li><li><a href='index.php'>Начало</a></li></ul> !");
    }
    else  {
        
        header('Location: http://localhost/NewPhpProject2/update2_discipline.php');
    }
    }
        ?>
    
        

    </body>
</html>