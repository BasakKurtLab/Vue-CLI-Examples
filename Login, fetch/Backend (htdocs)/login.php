<?php



    sleep(2);


    // CROSS-ORIGIN-ERLAUBNIS
    if (isset($_SERVER['HTTP_ORIGIN']))
    {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
    }
    //------------------------


    if(isset($_GET["benutzername"]) && isset($_GET["passwort"]))
    {
        $b = $_GET["benutzername"];
        $p = $_GET["passwort"];

        if($b == "admin" && $p == "123")
        {
            echo("1");
        }
        else
        {
            echo("0");
        }

    }
    else
    {
        echo("Parameter nicht vollständig");
    }


    












?>