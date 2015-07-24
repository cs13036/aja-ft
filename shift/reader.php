<?php

    $data=Array();
        $table = $_POST['table'];
        $number = $_POST['number'];
        $dsn = "mysql:host=localhost;dbname=shift;charset=utf8";

        try{
            $pdo = new PDO($dsn,"root","");
            $pdo ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            //print"接続しました";

        } catch (Exception $ex) {
            die($ex->getMessage());
        }

         try {
                $db=$pdo->prepare("SELECT * FROM ".$table." WHERE member_number = ".$number);
                $db->execute();
            } catch (Exception $Exception) {
                echo "Error:".$Exception->getMessage();
            }
            
            while($row=$db->fetch(PDO::FETCH_ASSOC)){
                $data[]=$row;
                
            }

        
        header('Content-Type: application/json; charsete=utf-8');
        //echo json_encode($data,JSON_UNESCAPED_UNICODE);
        echo json_encode($data);

?>