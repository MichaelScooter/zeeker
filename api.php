<?php
require "settings/init.php";


$data = json_decode(file_get_contents('php://input'), true);

/*

    - Password skal udfyldes og være ZeekerKode

*/

header('content-type: application/json; chartset=utf-8');

$data["password"] = "ZeekerKode";

if($data["password"] == "ZeekerKode") {


    $sql = "SELECT * FROM kode WHERE 1=1 ";
    $bind = [];

    /* Her er valgt $data, da det er det vi har kaldt i linje 5 + nameSearch, da vi har valgt vi ville have det med linje 11
    - Denne kode: $sql = $sql . ""; er skrevet kortere med denne = $sql .= "";
    */
    if (isset($data["nameSearch"]) && !empty($data["nameSearch"])) {
        // Tjek om "nameSearch" eksisterer i det indkomne data og ikke er tomt.
        // Hvis det er tilfældet, udfør følgende:

        $nameSearch = "%" . $data["nameSearch"] . "%";
        // Opret en variabel $nameSearch og tildel den en værdi, der indeholder brugersøgningen med jokertegn (%) foran og bagved.

        $sql .= " AND (kodeKunde LIKE :kodeKunde OR kodeCvr LIKE :kodeCvr OR kodeUnik LIKE :kodeUnik)";
        // Tilføj betingelsen til SQL-forespørgslen. Dette søger i 2 kolonner (kodeKunde, kodeCvr, kodeUnik) og bruger LIKE-operatoren til delvise tekstmatcher.

        $bind[":kodeKunde"] = $nameSearch;
        $bind[":kodeCvr"] = $nameSearch;
        $bind[":kodeUnik"] = $nameSearch;
        // Opret en associeret liste (array) med placeholders for SQL-bindings. Dette sikrer, at søgeudtrykket bliver erstattet i SQL-forespørgslen.
    }


    $sql .= " ORDER BY kodeKunde ASC";

    $kode = $db->sql($sql, $bind);
    header("HTTP/1.1 200 OK");

    /* Grunden til json_encode er, at så kommer det som et json format og ikke et array*/
    echo json_encode($kode);

} else{
    header("HTTP/1.1 401 Unauthorized");
    $error["errorMessage"] = "Dit kodeord var forkert";

    echo json_encode($error);
}


?>


