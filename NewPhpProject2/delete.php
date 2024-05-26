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
text-align: center;

}



</style>
    </head>
    <body>
        <title>Изтриване</title>
        
         <div class="header">
        <h1 align="center">Редактиране</h1>
         </div>
        <br><br>
         <div class="header">
        <p align="center">В каква секция искате да изтриете данни?</p>
         </div>
        <ul>
            <li>
         <a href="delete_student.php" align="justify">Студент</a>
         
            </li>
             <li>
         <a href="delete_specialty.php" align="justify">Специалност</a>
            </li>
            <li>
      
        <a href="delete_teacher.php" align="justify">Преподавател</a>
            </li>
            
            <li>
         
        <a href="delete_title.php" align="justify">Титла</a>
            </li>
            <li>
                
         
    
          <a href="delete_discipline.php" align="justify">Дисциплина</a>
            </li>
            <li>
           <a href="delete_rating.php" align="justify">Оценка</a>
            </li>
        </ul>
    </body>
</html>