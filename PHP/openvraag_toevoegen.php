<?php

$titel = 'Toevoegen Open Vraag';
include_once "header.php";
$vraagnaam = $_SESSION['VRAAGNAAM'];
$select = "SELECT MAX(VRAAGONDERDEELNUMMER) FROM VRAAGONDERDEEL INNER JOIN VRAAG ON VRAAGONDERDEEL.VRAAG_ID = VRAAG.VRAAG_ID WHERE VRAAGONDERDEEL.VRAAG_ID = (SELECT VRAAG_ID FROM VRAAG WHERE VRAAG_NAAM = '$vraagnaam')";
$data = $conn->query($select);
$array = $data->fetch();
$maxvraagonderdeelnummer = $array[0];
$vraagonderdeelnummer = $maxvraagonderdeelnummer + 1;


if (isset($_POST['openvraag_toevoegen']) || isset($_POST['openvraag_afronden'])) {

    $e_sql = 'EXEC dbo.usp_Vraagonderdeel_Insert @VRAAG_NAAM = \'' . $vraagnaam . '\', @VRAAGONDERDEELNUMMER = \'' . $vraagonderdeelnummer . '\', @VRAAGONDERDEEL = \'' . $_POST['VRAAG'] . '\', @VRAAGSOORT = \'' . $_SESSION['VRAAGSOORT'] . '\'';
    echo $e_sql;
    $e_query = $conn->prepare($e_sql);
    $e_query->execute();

    $e_sql2 = 'EXEC dbo.usp_Antwoord_Insert @VRAAG_NAAM = \'' . $vraagnaam . '\', @VRAAGONDERDEELNUMMER = \'' . $vraagonderdeelnummer . '\', @ANTWOORD = \'' . $_POST['ANTWOORD'] . '\', @PUNTEN = \'' . $_POST['AANTALPUNTEN'] . '\'';
    echo $e_sql2;
    $e_query2 = $conn->prepare($e_sql2);
    $e_query2->execute();

    $_SESSION['AANTALANTWOORDOPTIES'] = $_POST['AANTALANTWOORDOPTIES'];
    if (isset($_POST['openvraag_afronden'])) {
        header('Location:vragenOverzicht.php');
    } else {
        header("Location:bepaal_vraagtype.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<body>
<!-- container section start -->
<section id="container" class="">
    <!--header start-->
    <header class="header dark-bg" style="border-bottom: none;">
        <div class="toggle-nav">
            <button id="openNav" onclick="w3_open()" style="background-color: rgba(0,0,0,0.0000001); border-color: rgba(0,0,0,0.0000001);color: whitesmoke;">
                <!-- de kleur voor de headerbackground = rgba(0,0,0,0.0000001)-->
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu" style="font-size: 40px;                         margin-top: 0px;"></i></div>
            </button>
            <button id="closeNav" onclick="w3_close()" style="display: none; background-color: rgba(0,0,0,0.0000001); border-color: rgba(0,0,0,0.0000001);color: whitesmoke;">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="arrow_left_alt" style="font-size: 40px;                         margin-top: 0px;"></i></div>
            </button>
        </div>

    </header>
    <!--header end-->

    <!--sidebar start-->
    <?php
    include_once "sidebar.php";
    ?>
    <!--sidebar end-->
    <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
    <!--main content start-->
    <section id="main-content" style="margin-right: 10%;">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!--
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
                        <li><i class="fa fa-bars"></i>Pages</li>
                        <li><i class="fa fa-square-o"></i>Pages</li>
                    </ol>
                    Hierboven staat een breadcrumb, moeilijk te implementeren. Voor nu nog disabled
                    -->
                </div>
            </div>

            <!-- page start-->

            <div id="main">
                <div class="w3-container">
                    <h1 style="margin-left: 17px;"><?=$vraagnaam?></h1>
                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                Vraag Toevoegen
                            </header>
                            <div class="panel-body">
                                <form method="POST" action="" role="form">
                                    <div class="form-group">
                                        <label for="VRAAG">Vraag</label>
                                        <input type="text" class="form-control" id="VRAAG" name="VRAAG">
                                    </div>
                                    <div class="form-group">
                                        <label for="ANTWOORD">Antwoord</label>
                                        <input type="text" class="form-control" id="ANTWOORD" name="ANTWOORD">
                                    </div>
                                    <div class="form-group">
                                        <label for="AANTALPUNTEN">Aantal Punten Voor Antwoord</label>
                                        <input type="text" class="form-control" id="AANTALPUNTEN" name="AANTALPUNTEN">
                                    </div>
                            </div>
                        </section>
                        <section class="panel">
                            <header class="panel-heading">
                                Nog een Vraag Toevoegen?
                            </header>
                            <div class="panel-body">
                                <p>Indien gesloten, hoeveel antwoordopties wilt u toevoegen?</p>
                                <div class="form-group">
                                    <label for="inputSuccess">Aantal Vraagopties</label>
                                    <select class="form-control m-bot15" name="AANTALANTWOORDOPTIES">
                                        <option value="OPEN">Ik wil een open vraag toevoegen</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" name="openvraag_toevoegen">Nog Een Vraag Toevoegen</button>
                                <button type="submit" class="btn btn-danger" name="openvraag_afronden">Aanmaken Afronden</button>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
    <!--main content end-->
    <div class="text-right">
        <div class="credits">

        </div>
    </div>
</section>

</body>

</html>

