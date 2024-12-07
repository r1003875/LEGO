<?php
    include_once(__DIR__.'/../classes/Db.php');
    if(!empty($_POST)){
        try{
            $email = $_POST['email'];
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT email FROM user WHERE email = :email");
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result){
                $response = [
                    'status' => 'success',
                    'body' => 'false',
                    'message' => 'Email already exists'
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            }
            else{
                $response = [
                    'status' => 'success',
                    'body' => 'true',
                    'message' => 'Email is available'
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        }
        catch(Exception $e) {
            $error = $e->getMessage();
            echo $error;
        }
    }