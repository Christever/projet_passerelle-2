<?php
// TODO : A Améliorer !!!
require_once "models/utils/Utils.php";

class Utils {

    static $message;
    static $newImage;
    static $send;
    static $photo;

    static function code($password){
        $password = "sq1".sha1($password."123")."25";
        return $password;
    }

    static function verifImage(){
        if (isset($_FILES['image']) && $_FILES["image"]["error"]===0){
            if ($_FILES['image']['size'] <= 3000000){
                $information    = pathinfo($_FILES["image"]["name"]);
                $extentionImg   = $information["extension"];
                $extArray       = ["png", "gif", "jpg", "jpeg"];

                if (in_array($extentionImg, $extArray)){
                    Utils::$newImage = time().rand().rand().".".$extentionImg;
                    Utils::$send       = true;
                    Utils::$message="Ok";
                    move_uploaded_file($_FILES["image"]["tmp_name"], "public/images/".Utils::$newImage);
                }
                else {
                    Utils::$send = false;
                    Utils::$message = "Extension invalide";
                }
            }
            else {
                Utils::$send       = false;
                Utils::$message    = "Image trop grande";
            }
        }
        else {
            Utils::$send       = false;
            Utils::$message    = "Erreur sur l'image";
        }
    }

    static function verifAdmin() : bool {
        if (isset($_SESSION["role"])&&$_SESSION["role"]==="administrateur"){
            return true;
        }

        return false;
    }

}