<?php
require "settings/init.php";

if(!empty($_GET["type"])) {
    if($_GET["type"] == "slet"){
        $id = $_GET["id"];

        $db->sql("DELETE FROM kode WHERE kodeId = :kodeId", [":kodeId"=>$id], false);
    }


}

$kode = $db->sql("SELECT * FROM kode ORDER BY kodeKunde ASC");

?>


<!-- Instruktion til webbrowser om at vi kører HTML5 -->
<!DOCTYPE html>

<!-- html starter og slutter hele dokumentet / lang=da: Fortæller siden er på dansk -->
<html lang="da">

<!-- I <head> har man opsætning - det ser brugeren ikke, men det fortæller noget om siden -->
<head>
    <!-- Sætter tegnsætning til utf-8 som bl.a. tillader danske bogstaver -->
    <meta charset="utf-8">

    <!-- Titel som ses oppe i browserens tab mv. -->
    <title>Ret / Slet kunde</title>
    <meta name="description" content="Ret og slet kunde">


    <!-- Metatags der fortæller at søgemaskiner er velkomne, hvem der udgiver siden og copyright information -->
    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">

    <?php include "include/head.php"; ?>

    <!-- Sikrer den vises korrekt på mobil, tablet mv. ved at tage ift. skærmstørrelse - bliver brugt til responsive websider -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<!-- i <body> har man alt indhold på siden som brugeren kan se -->
<body>

<?php include "include/navigation.php"; ?>

<!-- Her skal sidens indhold ligge -->


<div class="container-fluid pt-3 p-lg-5 mb-5 imageOverlay min-vh-100" style=" background-image: url('images/zeeker.webp'); background-size: cover; background-repeat: no-repeat; background-position:top ; background-attachment: fixed">
    <div class="pb-5 pb-lg-0">
        <div class="pb-5 pb-lg-0">
            <div class="pb-3 pb-lg-0">
                <div class="px-lg-5 pt-5 pt-lg-4">
                    <div class="px-lg-5">
                        <div>
                            <h1 class="mt-5 text-primary text-center">Ret / Slet</h1>
                        </div>
                    </div>
                </div>
                <?php
                foreach ($kode as $blog){
                    ?>
                    <div class="pt-3 px-lg-5">
                        <div class="px-lg-5">
                            <div class="bg-white rounded-3 border border-dark">
                                <div class="row p-3">
                                    <div class="col-12 col-md-6">
                                        <?php
                                        echo $blog->kodeKunde;
                                        ?>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <button class="btn bg-success">  <a href="update.php?type=rediger&kodeId=<?php echo $blog->kodeId; ?>" class="text-white">Rediger</a></button>
                                        <button class="btn bg-danger">   <a href="update_kunder.php?type=slet&id=<?php echo $blog->kodeId; ?>" class="text-white">Slet</a></button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php

                }
                ?>
            </div>
        </div>
    </div>
</div>


<?php include "include/footer.php"; ?>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>



