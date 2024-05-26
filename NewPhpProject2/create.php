<?php
include('config.php');

if ( !mysqli_query($dbConn,"CREATE Database IF NOT EXISTS University")) {
    die("Не може да се създаде база данни");
}

if (!mysqli_select_db($dbConn,'University')) {
    die("Не може да избере базата данни!");
}




if (!mysqli_query($dbConn,"CREATE TABLE IF NOT EXISTS Student ("
        . "ST_Name VARCHAR (32) DEFAULT NULL,"
        . "Facility_num BIGINT NOT NULL,"
        . "SP_FK_Id INT DEFAULT NULL,"
        . "Course INT DEFAULT NULL,"
        . "ST_Email VARCHAR(32) DEFAULT NULL,"
        . "PRIMARY KEY(Facility_num)"
        . ")ENGINE=INNODB DEFAULT CHARSET=utf8")) {
    
    die("Не може да се създаде таблица Студент !");
}


if (!mysqli_query($dbConn,"CREATE TABLE IF NOT EXISTS Specialty ("
        . "SP_Id INT NOT NULL AUTO_INCREMENT,"
        . "SP_Name VARCHAR(40) DEFAULT NULL,"
        . "PRIMARY KEY(SP_Id)"
        . ")ENGINE=INNODB DEFAULT CHARSET=utf8")) {
    
    die("Не може да се създаде таблица Специалност !");
}

if (!mysqli_query($dbConn,"CREATE TABLE IF NOT EXISTS Teacher ("
        . "TCH_Id INT NOT NULL AUTO_INCREMENT,"
        . "TCH_Name VARCHAR(50) DEFAULT NULL,"
        . "TL_FK_Id INT DEFAULT NULL,"
        . "Phone VARCHAR(32) DEFAULT NULL,"
        . "TCH_Email VARCHAR(32) DEFAULT NULL,"
        . "PRIMARY KEY(TCH_Id)"
        . ")ENGINE=INNODB DEFAULT CHARSET=utf8")) {
    
    die("Не може да се създаде таблица Преподавател !");
}

if (!mysqli_query($dbConn,"CREATE TABLE IF NOT EXISTS Title ("
        ."TL_Id INT NOT NULL AUTO_INCREMENT,"
        . "TL_Name VARCHAR(32) DEFAULT NULL,"
        . "PRIMARY KEY(TL_Id)"
        .")ENGINE=INNODB DEFAULT CHARSET=utf8")) {
    
    die("Не може да се създаде таблица Титла !");
}

if (!mysqli_query($dbConn,"CREATE TABLE IF NOT EXISTS Discipline ("
        ."DS_Id INT NOT NULL AUTO_INCREMENT,"
        . "DS_Name VARCHAR(32) DEFAULT NULL,"
        . "Semester INT DEFAULT NULL,"
        . "PRIMARY KEY(DS_Id)"
        .")ENGINE=INNODB DEFAULT CHARSET=utf8")) {
    
    die("Не може да се създаде таблица Дисциплина !");
}

if (!mysqli_query($dbConn,"CREATE TABLE IF NOT EXISTS Disicpline_Teacher_MM ("
        ."DS_FK_MM INT NOT NULL,"
        . "TCH_FK_MM INT NOT NULL"
        .")ENGINE=INNODB DEFAULT CHARSET=utf8")) {
    
    die("Не може да се създаде таблица Дисциплина и преподавател M / M !");
}

if (!mysqli_query($dbConn,"CREATE TABLE IF NOT EXISTS Rating ("
        ."Grade DOUBLE NOT NULL,"
        . " Dates DATE DEFAULT NULL,"
        . "ST_FK_R INT NOT NULL,"
        . "TCH_FK_R INT NOT NULL,"
        . "DS_FK_R INT NOT NULL"
        .")ENGINE=INNODB DEFAULT CHARSET=utf8")) {
    
    die("Не може да се създаде таблица  Оценки ! ");
}

if (!'FK_ST_PK_SP') {
if (!mysqli_query($dbConn,"ALTER TABLE  Student ADD CONSTRAINT  FK_ST_PK_SP FOREIGN KEY(SP_FK_Id)  REFERENCES Specialty(SP_Id)")) {
    die("Не може да се осъществи връзка между таблица студент и специалност !");
}
}

if (!'FK_TCH_PK_TL') {
if (!mysqli_query($dbConn,"ALTER TABLE Teacher ADD CONSTRAINT FK_TCH_PK_TL FOREIGN KEY(TL_FK_Id) REFERENCES Title (TL_Id)")) {
    die("Не може да се осъществи връзка между таблица преподавател и титла !");
}
}



if (!'FK_DSTCHMM_PK_TCH') {
if (!mysqli_query($dbConn,"ALTER TABLE Discipline_Teacher_MM ADD CONSTRAINT FK_DSTCHMM_PK_TCH FOREIGN KEY(TCH_FK_MM) REFERENCES Teacher (TCH_Id)")) {
    die("Не може да се осъществи връзка между таблица преподавател - дисциплина М/ М и преподавател !");
}
}


if (!'FK_DSTCHMM_PK_DS') {
if (!mysqli_query($dbConn,"ALTER TABLE Discipline_Teacher_MM ADD CONSTRAINT FK_DSTCHMM_PK_DS FOREIGN KEY(DS_FK_MM) REFERENCES Discipline (DS_Id)")) {
    die("Не може да се осъществи връзка между таблица преподавател - дисциплина М/ М и дисциплина !");
}
}


if (!'FK_R_PK_ST') {
if (!mysqli_query($dbConn,"ALTER TABLE Rating ADD CONSTRAINT FK_R_PK_ST FOREIGN KEY(ST_FK_R) REFERENCES Student (Facility_num)")) {
    die("Не може да се осъществи връзка между таблица оценка и студент !");
}
}


if (!'FK_R_PK_DS') {
if (!mysqli_query($dbConn,"ALTER TABLE Rating ADD CONSTRAINT FK_R_PK_DS FOREIGN KEY(DS_FK_R) REFERENCES Discipline (DS_Id)")) {
    die("Не може да се осъществи връзка между таблица оценка и дисциплина !");
}
}


if (!'FK_R_PK_TCH') {
if (!mysqli_query($dbConn,"ALTER TABLE Rating ADD CONSTRAINT FK_R_PK_TCH FOREIGN KEY(TCH_FK_R) REFERENCES Teacher (TCH_Id)")) {
    die("Не може да се осъществи връзка между таблица оценка и преподавател !");
}
}


$OUTFILE_ST="D:/XAMPP/Setup/tmp/Student.sql";
$OUTFILE_SP="D:/XAMPP/Setup/tmp/Specialty.sql";
$OUTFILE_TCH="D:/XAMPP/Setup/tmp/Teacher.sql";
$OUTFILE_TL="D:/XAMPP/Setup/tmp/Title.sql";
$OUTFILE_DS="D:/XAMPP/Setup/tmp/Discipline.sql";
$OUTFILE_DS_TCH_MM="D:/XAMPP/Setup/tmp/DS_TCH_MM.sql";
$OUTFILE_R="D:/XAMPP/Setup/tmp/Rating.sql";

mysqli_query($dbConn,"SELECT * FROM Student INTO OUTFILE '$OUTFILE_ST'");
mysqli_query($dbConn,"SELECT * FROM Specialty INTO OUTFILE '$OUTFILE_SP'");
mysqli_query($dbConn,"SELECT * FROM Teacher INTO OUTFILE '$OUTFILE_TCH'");
mysqli_query($dbConn,"SELECT * FROM Title INTO OUTFILE '$OUTFILE_TL'");
mysqli_query($dbConn,"SELECT * FROM Discipline INTO OUTFILE '$OUTFILE_DS'");
mysqli_query($dbConn,"SELECT * FROM Discipline_Teacher_MM INTO OUTFILE '$OUTFILE_DS_TCH_MM'");
mysqli_query($dbConn,"SELECT * FROM Rating INTO OUTFILE '$OUTFILE_R'");


        

?>

