<?php
    //Set Up Class AutoLoading
    spl_autoload_register(function ($class) {
        include_once dirname(__FILE__) . '/../includes/' . $class . '.Class.php';
    });

    //Return JSON Content Type Header
    header( 'Content-type: app/JSON; charset=UTF-8' );

    //Initiate Search Class with $_GET["term"] if Set or NOt
    $search = new Search((!empty($_GET["term"])) ? $_GET["term"] : "");

    //Render JSON Result
    $search->RenderJSONResults();
?>