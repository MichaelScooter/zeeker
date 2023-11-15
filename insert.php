Selvfølgelig, her er hele koden med ændringerne for at bruge en rulle menu (dropdown) til at vælge rabattypen:

```php
<?php
require "settings/init.php";
require "include/functions.php";

if (!empty($_POST["data"])) {
    $data = $_POST["data"];
    $file = $_FILES;

    if (!empty($file["kodeLogo"]["tmp_name"])) {
        move_uploaded_file($file["kodeLogo"]["tmp_name"], "uploads/" . basename($file["kodeLogo"]["name"]));
    }

    if(empty($data["kodeUnik"])){
        $data["kodeUnik"] = generateUniqueCode();
        $codeExists = true;
        while ($codeExists) {
            $result = $db->sql("SELECT COUNT(*) as count FROM kode WHERE kodeUnik = :kodeUnik", [":kodeUnik" => $data["kodeUnik"]]);

            if ($result[0]->count > 0) {
                $data["kodeUnik"] = generateUniqueCode();
            } else {
                $codeExists = false;
            }
        }
    }


    $sql = "INSERT INTO kode (kodeKunde, kodeCvr, kodeStart, kodeSlut, kodeGratisMaaneder, kodeBindingsperiode, kodeRabatType, kodeRabatInput, kodeLogo, kodeBeskrivelse, kodeUnik) 
            VALUES (:kodeKunde, :kodeCvr, :kodeStart, :kodeSlut, :kodeGratisMaaneder, :kodeBindingsperiode, :kodeRabatType, :kodeRabatInput, :kodeLogo, :kodeBeskrivelse, :kodeUnik)";
    $bind = [
        ":kodeKunde" => $data["kodeKunde"],
        ":kodeCvr" => $data["kodeCvr"],
        ":kodeStart" => $data["kodeStart"],
        ":kodeSlut" => $data["kodeSlut"],
        ":kodeGratisMaaneder" => $data["kodeGratisMaaneder"],
        ":kodeBindingsperiode" => $data["kodeBindingsperiode"],
        ":kodeRabatType" => $data["kodeRabatType"],
        ":kodeRabatInput" => $data["kodeRabatInput"],
        ":kodeLogo" => (!empty($file["kodeLogo"]["tmp_name"])) ? $file["kodeLogo"]["name"] : NULL,
        ":kodeBeskrivelse" => $data["kodeBeskrivelse"],
        ":kodeUnik" => $data["kodeUnik"],
    ];

    if (!empty($data["kodeKunde"]) && !empty($data["kodeCvr"]) && !empty($data["kodeStart"]) && !empty($data["kodeSlut"]) && !empty($data["kodeGratisMaaneder"]) && !empty($data["kodeBindingsperiode"]) && !empty($data["kodeRabatType"]) && !empty($data["kodeRabatInput"])) {
        $db->sql($sql, $bind, false);

        $statusMsg = "<h3 class='text-success pt-3 ps-3'>Kunden blev korrekt.</h3><a href='insert.php' class='text-white ps-3'><span class='text-decoration-none'>Opret en ny kunde:</span></a>";
    } else {
        $statusMsg = "<h3 class='text-danger pt-3 ps-3'>Kunden blev IKKE indsat korrekt.</h3><a href='insert.php' class='text-white ps-3'><span class='text-decoration-underline'>Prøv igen</span></a>";
    }
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">

    <title>Opret kunde</title>
    <meta name="description" content="Opret kunde til Zeeker rabat kundekartotek">

    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">

    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet" type="text/css">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tiny.cloud/1/071g1xh1hwccgkhfewg0rdoqybb95uwgaiyhpb7xt8dyxzce/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>



</head>

<body>

<?php include "include/navigation.php"; ?>
<div class="container-fluid bg-light p-5 mb-5 mb-lg-0 imageOverlay min-vh-100" style=" background-image: url('images/zeeker.webp'); background-size: cover; background-repeat: no-repeat; background-position:top ; background-attachment: fixed">
    <div class="px-lg-5">
        <div class=" py-5 pb-5 px-lg-5 mb-5 mb-lg-0 ">
            <div class="text-center ">
                <h1 class="text-primary ps-3">Oprettelse af Rabat koder</h1>
                <p class="text-white pb-3 ps-3 mb-0">Udfyld <span class="fst-italic text-primary">ALLE</span> felterne og tryk på "opret kode" knappen</p>
            </div>

            <?php
            if (!empty($statusMsg)) {
                echo $statusMsg;
            }
            ?>

            <div class=" px-5 bg-light border border-dark border-1">
                <form method="post" action="insert.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-6 pt-3">
                            <div class="form-group">
                                <label for="kodeKunde" class="fw-semibold">Kode Navn</label>
                                <input class="form-control" type="text" name="data[kodeKunde]" id="kodeKunde" placeholder="Indtast kodens navn" value="" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 pt-3">
                            <div class="form-group">
                                <label for="kodeCvr" class="fw-semibold">CVR/SE nummer.</label>
                                <input class="form-control" type="text" name="data[kodeCvr]" id="kodeCvr" placeholder="Indtast cvr/se nr." value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 pt-3">
                            <div class="form-group">
                                <label for="kodeStart" class="fw-semibold">Start dato - (F.eks. 121023)</label>
                                <input class="form-control" type="text" name="data[kodeStart]" id="kodeStart" placeholder="000000" value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 pt-3">
                            <div class="form-group">
                                <label for="kodeSlut" class="fw-semibold">Slut dato - (F.eks. 150624)</label>
                                <input class="form-control" type="text" name="data[kodeSlut]" id="kodeSlut" placeholder="000000" value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 pt-3">
                            <div class="form-group">
                                <label for="kodeGratisMaaneder" class="fw-semibold">Antal GRATIS måneder</label>
                                <input class="form-control opretProdukter" type="number" name="data[kodeGratisMaaneder]" id="kodeGratisMaaneder" placeholder="Indtast antal gratis måneder" value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 pt-3">
                            <div class="form-group">
                                <label for="kodeBindingsperiode" class="fw-semibold">Bindingsperiode</label>
                                <input class="form-control opretProdukter" type="number" name="data[kodeBindingsperiode]" lang="da" id="kodeBindingsperiode" placeholder="Indtast antal måneders binding" value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 pt-3">
                            <div class="form-group">
                                <label class="fw-semibold">Rabat Type: - Vælg</label>
                                <select class="form-select" type="text" name="data[kodeRabatType]" id="rabatType">
                                    <option value="fastBeloeb" selected>Fast Beløb</option>
                                    <option value="fastRabat">Fast Rabat</option>
                                    <option value="procentRabat">Procent Rabat</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 pt-3">
                            <div class="form-group">
                                <label for="kodeRabatInput" class="fw-semibold">Indtast Rabat: Beløb / Procent - (helt tal)</label>
                                <input class="form-control" type="number" name="data[kodeRabatInput]" id="kodeRabatInput" placeholder="f.eks. 300 eller 15" value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 pt-3">
                            <div class="form-group">
                                <label class="form-label fw-semibold" for="kodeLogo">Rabat logo - (valgfrit)</label>
                                <input type="file" class="form-control" id="kodeLogo" name="kodeLogo">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 pt-3">
                            <div class="form-group">
                                <label for="kodeUnik" class="fw-semibold">Unik Kode - Indtast <span class="text-danger">KUN</span> ved genbrug af kode</label>
                                <input class="form-control opretProdukter" type="text" name="data[kodeUnik]" id="kodeUnik" maxlength="10" placeholder="Indtast rabat kode" value="">
                            </div>
                        </div>
                        <div class="col-12 pt-3">
                            <div class="form-group">
                                <label for="kodeBeskrivelse" class="fw-semibold">Rabat beskrivelse - (valgfrit)</label>
                                <textarea class="form-control" name="data[kodeBeskrivelse]" id="kodeBeskrivelse" placeholder="Skriv beskrivelsen"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 offset-md-6 pb-3">
                            <button class="form-control btn btn-success text-white" type="submit" id="btnSubmit">Opret kode</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<script>
    tinymce.init({
        selector: 'textarea',
    });
</script>

<?php include "include/footer.php"; ?>

</body>
</html>


