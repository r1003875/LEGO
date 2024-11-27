<?php
    include_once(__DIR__.'/../classes/Review.php');
    if(!empty($_POST)){
        try{
            $c = new Review();
            $c->setProduct_id($_POST['product_id']);
            $c->setUser_id($_POST['user_id']);
            $c->setComment($_POST['comment']);
            $c->setRating($_POST['rating']);
            $c->setDate();
            $c->save();
            $username = $c->getUserById($_POST['user_id']);
            $response = [
                'status' => 'success',
                'body' => htmlspecialchars($c->getComment()),
                'rating' => $c->getRating(),
                'date' => $c->getDate(),
                'user_id' => $c->getUser_id(),
                'username' => $username,
                'message' => 'Comment was saved'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        catch(Exception $e) {
            $error = $e->getMessage();
            echo $error;
        }
    }