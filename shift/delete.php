<?php
    
    $dsn = "mysql:host=localhost;dbname=shift;charset=utf8";
    
    try{
        $pdo = new PDO($dsn, "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        echo "access OK";
    } catch (Exception $ex) {
        die('error:'.$ex->getMessage());
        header("HTTP/1.0 400 Bad Request");
        header("Content-Type: text/plain; charset=UTF-8");
        print 'エラー:'.$ex->getMessage();
        exit;
    }
    
    try{
        $pdo->beginTransaction();
        $sql ="DELETE FROM shift_plan WHERE member_number = :number AND date = :date";
        $stmh=$pdo->prepare($sql);
        $stmh->bindValue(':number',$_POST['number'],PDO::PARAM_INT);
        $stmh->bindValue(':date',$_POST['date'],PDO::PARAM_STR);
        $stmh->execute();
        $pdo->commit();
    } catch (Exception $ex) {
        $pdo->rollBack();
        echo"error:".$ex->getMessage();
        header("HTTP/1.0 400 Bad Request");
        header("Content-Type: text/plain; charset=UTF-8");  
        print "エラー:".$ex->getMessage();;
        exit;
    }
    
        header("Content-Type: text/plain; charset=UTF-8");
        print "成功しますた";
        exit;

?>