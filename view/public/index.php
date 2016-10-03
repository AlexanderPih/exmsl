<?php
namespace exmsl;
require_once("../../config/initialize.php");

$language = new Language();
$lang = $language->userLanguage();

include("../templates/header.php");
include("../templates/publicnav.php");
?>
<section class="contenu">
    <div class="description">
        <h1><?= $lang['INDEX_TITLE']; ?></h1>
        <img src="../images/eXMSL_big_logo.jpg">
        <p class="summary"><?= $lang['INDEX_DESCRIPTION']; ?></p>
        <a class="button" href="#fortran"><?= $lang['INDEX_FORTRAN']; ?></a>
        <a class="button" href="#feedback_closed"><?= $lang['INDEX_OFFICE']; ?></a>
    </div>
</section>
<!--general info-->
<section class="article">
    <div>
        <h2>
            <i>
            <?= $lang['INDEX_EXMSL']; ?>
            </i>
        </h2>
    </div>
    <br>
        <p><?= $lang['INDEX_INFO1']; ?></p>
        <p><?= $lang['INDEX_INFO2']; ?></p>
        <p id="fortran"><?= $lang['INDEX_INFO3']; ?></p>

    <br>
</section>
    <br>
    <br>
<!--fortran-->
<section class="article">
    <div id="fortran">
            <h2>
                <i>
                   <?= $lang['INDEX_FORTRAN']; ?>
                </i>
            </h2>
        </div>
            <br>
            <p><?= $lang['INDEX_FORTRAN_INFO1']; ?></p>
            <p><?= $lang['INDEX_FORTRAN_INFO2']; ?></p>

            <br>
            <div class="button-right">
                <a class="button-dark" href="#"><?= $lang['BUTTON_DOWNLOAD_FORTRAN']; ?></a>
            </div>
</section>
<!--microsoft office-->
<div id="feedback_closed"></div>
<section class="article">
    <div>
        <h2>
            <i>
               <?= $lang['INDEX_OFFICE']; ?>
            </i>
        </h2>
    </div>
    <br>
        <p><?= $lang['INDEX_OFFICE_INFO1']; ?></p>
        <p><?= $lang['INDEX_OFFICE_INFO2']; ?></p>
        <p><?= $lang['INDEX_OFFICE_INFO3']; ?></p>

        <div class="button-right">
            <a class="button-dark" href="#"><?= $lang['BUTTON_DOWNLOAD_OFFICE']; ?></a>
        </div>
</section>

<?php
include("../templates/footer.php");
?>
<!--navigate back to top-->
<a href="#0" class="cd-top">Top</a>
<script src="../javascript/main.js"></script>
