<?php
 
require 'vendor/autoload.php';

function getDB()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "coder";
    $dbname = "mapveto";
 
    $mysql_conn_string = "mysql:host=$dbhost;dbname=$dbname";
    $dbConnection = new PDO($mysql_conn_string, $dbuser, $dbpass); 
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbConnection;
}
 
$app = new \Slim\Slim();
 
$app->get('/', function() use($app) {
    $app->response->setStatus(200);
    echo "Welcome to Slim based API";
});


$app->get('/getveto/', function () {
    $app = \Slim\Slim::getInstance(); 
    try 
    {
        $db = getDB();
        $sth = $db->prepare("SELECT * 
            FROM veto
            WHERE status = 'active'");
 
        //$sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
 
        $student = $sth->fetch(PDO::FETCH_OBJ);
 
        if($student) {
            $app->response->setStatus(200);
            $app->response()->headers->set('Content-Type', 'application/json');
            echo json_encode($student);
            $db = null;
        } else {
            throw new PDOException('No records found.');
        }
 
    } catch(PDOException $e) {
        $app->response()->setStatus(404);
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});

$app->get('/getmappool/', function () {
    $app = \Slim\Slim::getInstance(); 
    try 
    {
        $db = getDB();
        $sth = $db->prepare("SELECT * FROM map_pool");
 
        //$sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
 
        $maps = $sth->fetchAll(PDO::FETCH_OBJ);
 
        if($maps) {
            $app->response->setStatus(200);
            $app->response()->headers->set('Content-Type', 'application/json');
            echo json_encode($maps);
            $db = null;
        } else {
            throw new PDOException('No records found.');
        }
 
    } catch(PDOException $e) {
        $app->response()->setStatus(404);
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}); 
 
$app->run();