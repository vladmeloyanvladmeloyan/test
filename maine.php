<?php
session_start();
require_once (__DIR__.'/autoload.php');

if(!isset($_SESSION['email'])){
    header('location:index.php');
    die;
}

echo "<h1>hello: ".$_SESSION['email']."</h1>";

?>

<div class="collapse navbar-collapse" id="navbar-collapse-4">
    <ul class="nav navbar-nav navbar-centr">
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

