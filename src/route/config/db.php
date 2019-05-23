<?php


class db
{
 function connection(){
     $dbConnection = new PDO('mysql:host=127.0.0.1;dbname=slimapp', 'root', '');
//       $dbConnection=new PDO("mysql:host=$this->dbHost;dbname=$this->dbname",$this->dbUser,$this->passwrd);
     $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     return $dbConnection;
 }
}