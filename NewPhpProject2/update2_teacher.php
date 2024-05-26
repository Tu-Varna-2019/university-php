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
            <h2 align="center"> Намерен е въведения преподавател !</h2>
            <h2 align="center">Въведете новите данни </h2>
            </div>


 <form action="#" method="POST">
     <br>
           Име:<input type="text" name="Name">
           <br>
           <br>
            <label for="Title">Титла:</label>
            <select name="Title" id="Title">
                <?php
                 $res= mysqli_query($dbConn,"SELECT * FROM Title");
    while($row = mysqli_fetch_assoc($res)) {
        $valName=$row['TL_Name'];
       $valId=$row['TL_Id'];
    echo"<option value=$valId>$valName</option>";
    }
    ?>
                            </select>
            <br>
           <br>
           Тел. номер: <input type="text" name="Phone">
            <br>
             <br>
            Е-mail: <input type="email" name="Email">
            <br>
            <br>
            <input type="submit" name="submit2" value="Въведи">
            <br>
            <br>
       
       </form>
     
     

        <?php
    session_start();
       
           if (isset($_POST['submit2'])) {
           $Email="Няма";
    $Phone="Няма";
    if (!empty($_POST['Name'])  && !empty($_POST['Title']) ) {
        
        $Name=$_POST['Name'];
       
        $Title=$_POST['Title'];
       
        $Id=$_SESSION['Teacher'];
        if (!empty($_POST['Email'])) { $Email=$_POST['Email'];}
         if (!empty($_POST['Phone'])) { $Phone=$_POST['Phone'];}
         
        if (!mysqli_query($dbConn,"UPDATE Teacher "
                . "SET TCH_Name ='$Name',"
                . "TL_FK_Id =$Title,"
                . "Phone='$Phone',"
                . "TCH_Email='$Email'"
                . "WHERE TCH_Id=$Id ")) { die("<ul><li>Не могат да се редактират данните</li><li><a href='index.php'>Начало</a></li></ul> !");
                
                
                
                
                }else { echo"<script>document.body.innerHTML='';</script>";  echo"<ul><li>Редактирането бе успешно!</li><li><a href='index.php'>Начало</a></li></ul> "; }
        
    }else die("<ul><li>Moля въведете необходимата информация !</li><li><a href='index.php'>Начало</a></li></ul>");
    
    unset($_SESSION['Teacher']);
    session_destroy();
    
}
           
       
        
       
    
    




?>
        
        
    </body>
</html>