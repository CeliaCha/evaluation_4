<?php
include_once('./Model/Database.php');
Database::connect();

include_once('./Views/Head.php');

if (!empty($_GET)) {

    switch($_GET['page']) {
        case "home":
            include('./Views/Home.php');
            break;
        case "add-edit":
            include('./Views/AddEdit.php');
            break;
        case "delete":
            include('./Views/Delete.php');
            break;
        default:
            include('./Views/Home.php');
        }
    }

else include('./Views/Home.php');

include_once('./Views/Foot.php');








