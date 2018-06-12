<?php
include_once('./Model/Database.php');
Database::connect();

include_once('./Views/Head.php');

if (!empty($_GET)) {

    switch($_GET['action']) {
        case "home":
            include_once('./Views/Home.php');
            break;
        case "addedit":
            include_once('./Views/AddEdit.php');
            break;
        case "delete":
            include_once('./Views/Delete.php');
            break;
        default:
            include_once('./Views/Home.php');
        }
    }

else include_once('./Views/Home.php');

include_once('./Views/Foot.php');








