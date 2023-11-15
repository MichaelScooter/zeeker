<?php
require "settings/init.php";

if(!empty($_GET["type"])) {
    if($_GET["type"] == "slet"){
        $id = $_GET["id"];

        $db->sql("DELETE FROM kode WHERE kodeId = :kodeId", [":kodeId"=>$id], false);
    }


}

$kode = $db->sql("SELECT * FROM kode WHERE kodeId = :kodeId", [":kodeId" => $_GET["kodeId"]]);

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
    <title>Zeeker kunde</title>
    <meta name="description" content="Zeeker kunde">


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
<!-- Header Sektion --------------------------------------------------------------------------------------------------->
<div class="container-fluid min-vh-100 py-5 pt-lg-3 imageOverlay text-white" style=" background-image: url('images/zeeker.webp'); background-size: cover; background-repeat: no-repeat; background-position:top ; background-attachment: fixed">


        <?php
        foreach ($kode as $blog){
            ?>


            <div class="row align-items-center pt-5 pb-5 pb-lg-0 px-lg-5 pt-lg-5 kundeSideTextTykkelse ">
                <div class="pt-lg-5 ps-md-4">
                    <img src="uploads/<?php echo $blog->kodeLogo; ?>" alt="Kunde logo" class="kundeLogoKundeSide pt-5 px-lg-5">
                </div>

                <div class="col-lg-6 ps-md-5 text-center align-self-start align-self-md-center text-md-start pb-5 pt-4 pt-md-5">



                    <h5 class="ps-md-4 mb-0 text-primary fw-light">Kode Navn:</h5>
                    <h1 class="ps-md-4">
                        <?php echo $blog->kodeKunde; ?>
                    </h1>

                    <h3 class="pt-lg-3"><span class="ps-md-4 text-primary">Unik Kode:</span>
                        <?php
                        echo $blog->kodeUnik;
                        ?>
                    </h3>



                    <!-- Start info bokse -->
                    <div class="row ps-md-4 pt-lg-5">
                        <div class="col-12 col-md-6">
                            <div>
                                <h5><span class="text-primary">Start:</span>
                                    <?php
                                    echo $blog->kodeStart;
                                    ?>
                                </h5>

                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div>
                                <h5><span class="text-primary">Slut:</span>
                                    <?php
                                    echo $blog->kodeSlut;
                                    ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="row ps-md-4 pt-lg-1">
                        <div class="col-12 col-md-6">
                            <div>
                                <h5><span class="text-primary">Rabat type:</span>
                                    <?php
                                    echo $blog->kodeRabatType; ?>
                                </h5>

                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div>
                                <h5><span class="text-primary">Rabat input</span>
                                    <?php
                                    echo $blog->kodeRabatInput;
                                    ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="row ps-md-4 pt-lg-1">
                        <div class="col-12 col-md-6">
                            <div>
                                <h5><span class="text-primary">Gratis måneder:</span>
                                    <?php
                                    echo $blog->kodeGratisMaaneder;
                                    ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div>
                                <h5><span class="text-primary">Bindings periode:</span>
                                    <?php
                                    echo $blog->kodeBindingsperiode;
                                    ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="row ps-md-4 pt-lg-5">
                        <div class="col-12">
                            <div>
                                <h5><span class="text-primary">Kode Beskrivelse:</span>
                                    <p>
                                        <?php
                                        echo $blog->kodeBeskrivelse;
                                        ?>
                                    </p>
                                </h5>
                            </div>
                        </div>

                    </div>
                    <div class="row ps-md-4 pt-lg-1">
                        <div class="col-12 col-md-6">
                            <div>
                                <h5><span class="text-primary">CVR / SE nr.:</span></h5>
                                <p class="pb-2">
                                    <?php echo
                                    $blog->kodeCvr;
                                    ?>
                                </p>

                                <a href="/zeeker/update.php?type=rediger&kodeId=<?php echo $_GET["kodeId"] ?>" class="btn-danger btn btn-lg">Rediger</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php

        }
        ?>
    </div>




<?php include "include/footer.php"; ?>


<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>



