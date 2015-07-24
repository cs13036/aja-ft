
        <?php

        $data=Array();
        $table = $_POST['table'];
        $dsn = "mysql:host=localhost;dbname=shift;charset=utf8";

        try{
        	//ここを自分の権限があるユーザーに変更
            $pdo = new PDO($dsn,"root","");
            $pdo ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            //print"接続しました";

        } catch (Exception $ex) {
            die($ex->getMessage());
        }

         try {
                $db=$pdo->prepare("SELECT * FROM ".$table);
                $db->execute();
            } catch (Exception $Exception) {
                echo "Error:".$Exception->getMessage();
            }
            
            while($row=$db->fetch(PDO::FETCH_ASSOC)){
                $data[]=$row;
                
            }

        
       

        header('Content-Type: application/json; charsete=utf-8');
        echo json_encode($data);

        ?>