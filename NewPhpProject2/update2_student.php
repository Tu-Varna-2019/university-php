

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
            <h2 align="center"> Намерен е въведения студент !</h2>
            <h2 align="center">Въведете новите данни </h2>
            </div>

 <form action="#" method="POST">
     <br>
            Име:<input type="text" name="Name">
           <br>
           <br>
            <label for="Specialty">Специалност:</label>
            <select name="Specialty" id="Specialty">
                <?php
                 $res= mysqli_query($dbConn,"SELECT * FROM Specialty");
    while($row = mysqli_fetch_assoc($res)) {
        $valName=$row['SP_Name'];
       $valId=$row['SP_Id'];
    echo"<option value=$valId>$valName</option>";
    }
    ?>
                            </select>
            <br>
           <br>
           Курс: <input type="text" name="Course">
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
   
       
           if (isset($_POST['submit2'])) {
               
               session_start();
           $Email="Няма";
    
    if (!empty($_POST['Name'])  && !empty($_POST['Specialty']) && !empty($_POST['Course'])) {
        
        $Name=$_POST['Name'];
       
        $Specialty=$_POST['Specialty'];
        $Course=$_POST['Course'];
        $FN=$_SESSION['Facility_num'];
        if (!empty($_POST['Email'])) { $Email=$_POST['Email'];}
        
        if (!mysqli_query($dbConn,"UPDATE Student "
                . "SET ST_Name ='$Name' , "
                . "SP_FK_Id =$Specialty , "
                . "Course=$Course , "
                . "ST_Email='$Email' "
                . "WHERE Facility_num= $FN ")) {  die("<ul><li>Не могат да се редактират данните</li><li><a href='index.php'>Начало</a></li></ul> !");
                
                
                
                
                }else { echo"<script>document.body.innerHTML='';</script>";  echo"<ul><li>Редактирането бе успешно!</li><li><a href='index.php'>Начало</a></li></ul>"; }
        
    }else die("<ul><li>Moля въведете необходимата информация !</li><li><a href='index.php'>Начало</a></li></ul>");
    unset($_SESSION['Facility_num']);
session_destroy();
}
           
       
        
       
    
    




?>
        
        
    </body>
</html>