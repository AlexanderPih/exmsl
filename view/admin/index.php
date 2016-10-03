<?php
namespace exmsl;
require_once("../../config/initialize.php");

$auth = new Authentification();
$auth->islogged();

$language = new Language();
$lang = $language->userLanguage();

include("../templates/header.php");
include("../templates/adminnav.php");
?>

<!--Title and description-->
<section class="contenu">
    <div class="description">
        <h1><?= $lang['ADMIN_INDEX_TITLE']; ?></h1>
        <p class="summary"><?= $lang['ADMIN_INDEX_DESCRIPTION']; ?></p>
    </div>
</section>
<section class="article">
    <br>
        <a href="faq.php"><?= $lang['PAGE_TITLE_FAQ']; ?></a>
        <p><?= $lang['ADMIN_INDEX_FAQ']; ?></p>
    <br>
        <a href="support.php"><?= $lang['PAGE_TITLE_FEEDBACK']; ?></a>
        <p><?= $lang['ADMIN_INDEX_FEEDBACK']; ?></p>
    <br>
        <a href="admin.php"><?= $lang['PAGE_TITLE_MANAGEADMIN']; ?></a>
        <p><?= $lang['ADMIN_INDEX_MANAGEADMIN']; ?></p>
    <br>
        <a href="logout.php"><?= $lang['PAGE_TITLE_LOGOUT']; ?></a>
        <p><?= $lang['ADMIN_INDEX_LOGOUT']; ?></p>
</section>