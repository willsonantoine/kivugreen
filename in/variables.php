<?php



$error_message = "";




function active_menu($interface, $menu)
{
    if ($interface == $menu) {
        echo 'class="active"';
    }
}

function selectMenu($interface, $menu)
{
    if ($interface == $menu) {
        echo 'active';
    }
}

function getAllAccess()
{
    $cls = new Http();
    $tab = [];

    $json = $cls->getHttpData('/api/login/getaccess', [], 'POST');

    if ($json->status == 200) {
        $data = $json->data->data;
        $_SESSION["id"] = $json->data->id;
        $x = 0;


        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $tab[$x++] = $value->access;
            }
        }
        // Url de base pour les images
        define('URL_IMAGES', URL_ROOT . $json->file_folder);
    } else {
        $error_message  = $json->message;
    }



    return  $tab;
}

function getProfilData($id)
{
    $cls = new Http();
    $json = $cls->getHttpData('/api/account/profil', ["id" => $id], 'POST');

    return $json;
}

function url($link = null)
{
    $url = $_SERVER['REQUEST_URI'];

    $tab = explode('/', $url);
    $i = "";


    if (count($tab) > 2) {
        for ($x = 2; $x < count($tab); $x++) {
            $i .= '../';
        }
    }

    if ($link != null) {
        echo $i . $link;
    } else {
        echo $i;
    }
}
