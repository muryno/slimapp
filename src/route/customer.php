<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app = new Slim\App;

//getAllCustomer
$app->get("/api/customer",function (Request $request,Response $response){
    $getData="SELECT * FROM  customer";
    try{
        $con=new db();
        $db=$con->connection();

       $row= $db->query($getData);
      $customer=$row->fetchAll(PDO::FETCH_OBJ);

      $con=null;
        return $response->withStatus(200) ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($customer));

    }catch (PDOException $ex){

        echo '{"error": {"text" : '.$ex->getMessage().'} ';
    }
});

//getSingleCustomer
$app->get("/api/customer/{id}",function (Request $request,Response $response){
    $id=$request->getAttribute('id');
    $getData="SELECT * FROM  customer WHERE id=$id";
    try{
        $con=new db();
        $db=$con->connection();

        $row= $db->query($getData);
        $customer=$row->fetchAll(PDO::FETCH_OBJ);

        $con=null;
        return $response->withStatus(200) ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($customer));

    }catch (PDOException $ex){

        echo '{"error": {"text" : '.$ex->getMessage().'} ';
    }
});

//add customer
$app->post("/api/customer/add",function (Request $request,Response $response){
    $fname=$request->getParam('fname');
    $lname=$request->getParam('lname');
    $phone=$request->getParam('phone');
    $address=$request->getParam('address');

    $getData="INSERT INTO  customer (fname,lname,phone,address) VALUE (:fname,:lname,:phone,:address)";
    try{
        $con=new db();
        $db=$con->connection();

        $row= $db->prepare($getData);

        $row->bindParam(':fname',$fname);
        $row->bindParam(':lname',$lname);
        $row->bindParam(':phone',$phone);
        $row->bindParam(':address',$address);

        $row->execute();

        $con=null;

        return $response->withStatus(200)
            ->write("{value : { text: value successfully added!!}");

    }catch (PDOException $ex){

        echo '{"error": {"text" : '.$ex->getMessage().'} ';
    }
});

//add customer
$app->put("/api/customer/update/{id}",function (Request $request,Response $response){
    $id=$request->getAttribute('id');
    $fname=$request->getParam('fname');
    $lname=$request->getParam('lname');
    $phone=$request->getParam('phone');
    $address=$request->getParam('address');

    $updateData="UPDATE customer SET fname=:fname,lname=:lname,phone=:phone,address=:address where id=$id";
    try{
        $con=new db();
        $db=$con->connection();

        $row= $db->prepare($updateData);
        $row->bindParam(':fname',$fname);
        $row->bindParam(':lname',$lname);
        $row->bindParam(':phone',$phone);
        $row->bindParam(':address',$address);

        $row->execute();

        $con=null;
        return $response->withStatus(200)
            ->write("{value : { text: value successfully updated!!}");


    }catch (PDOException $ex){

        echo '{"error": {"text" : '.$ex->getMessage().'} ';
    }
});

//delete customer
$app->delete("/api/customer/delete/{id}",function (Request $request,Response $response){
    $id=$request->getAttribute('id');
    $getData="DELETE  FROM  customer WHERE id=$id";
    try{
        $con=new db();
        $db=$con->connection();

        $row= $db->prepare($getData);
        $row->execute();

        $con=null;

        return $response->withStatus(200) 
            ->write("{value : { text: value successfully deleted!!}");


    }catch (PDOException $ex){

        echo '{"error": {"text" : '.$ex->getMessage().'} ';
    }
});

