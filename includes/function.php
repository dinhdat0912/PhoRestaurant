<?php
    require_once("Includes/DB.php");
    function Redirect_To($new_Location){
        header("Location:".$new_Location);
        exit;
    }
        function checkUsernameExistOrNot($adminUsername){
            global $ConnectingDB;
            $sql = "SELECT adminname FROM admin WHERE adminusername=:adminusernamE";
            $stmt=$ConnectingDB->prepare($sql);
            $stmt->bindValue(":adminusernamE",$adminUsername);
            $stmt->execute();
            $result=$stmt->rowcount();
            if($result==1){
                return true;
            }else{
                return false;
            }
        }
        function logInAttempt($adminUsername,$password){
            // $_SESSION["successMessage"]="Log In Successfully";
            // Redirect_to("login.php");
            global $ConnectingDB;
            $sql = "SELECT * FROM admin WHERE adminusername=:adminusernamE AND password=:passworD LIMIT 1";
            $stmt=$ConnectingDB->prepare($sql);
            $stmt->bindValue(":adminusernamE",$adminUsername);
            $stmt->bindValue(":passworD",$password);
            $stmt->execute();
            $result=$stmt->rowcount();
            if($result==1){
                return $foundAccount = $stmt->fetch();
            }else{
                return null;
            }
        }
        function confirmLogin(){
            if(isset($_SESSION["userId"])){
                return true;
            }else{
                $_SESSION["errorMessage"]="Log In Required";
                Redirect_to("login.php");
            }
        }
?> 