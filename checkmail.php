<?php

    require("DBconnect.php");

    $eNo = "SELECT COUNT(*)+1 FROM mail";
    $email = $_POST["email"];
    
    $SQL = "SELECT * FROM mail WHERE email = '$email'";
    $result = mysqli_query($link,$SQL);
    
    $updateSQL = "INSERT INTO mail(eNo,email) VALUES ('$eNo','$email')";

    while($row = mysqli_fetch_assoc($result)){
        $dbmail=$row['email'];
    }
    if($dbmail == $email){
        echo "<script type='text/javascript'>";
        echo "alert('您已訂閱過!');";
        echo "</script>";
        echo "<meta http-equiv='Refresh' content='0; url = form.php'>"; 
    }
    else{
        if(mysqli_query($link,$updateSQL)){
            echo "<script type='text/javascript'>";
            echo "alert('成功加入訂閱!');";
            echo "</script>";
            echo "<meta http-equiv='Refresh' content='0; url = form.php'>";
        }else{
            echo "<script type='text/javascript'>";
            echo "alert('加入訂閱失敗');";
            echo "</script>";
            echo "<meta http-equiv='Refresh' content='0; url = form.php'>";
        }
         
    }
?>