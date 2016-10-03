<nav class="fixedbar">
    <div id="menu" class="menu">
        <a class="sitelogo" href="index.php" title="<?php echo $lang['PAGE_TITLE_INDEX']; ?>"><img src="../images/eXMSL_small_logo.jpg"></a>
        <a class="visible" href="#menu">Menu</a><a class="invisible" href="#hidemenu">Menu</a>
        <ul class="menuliste">
            <li><a href="faq.php"><?php echo $lang['PAGE_TITLE_FAQ']; ?></a></li>
            <li><a href="support.php"><?php echo $lang['PAGE_TITLE_FEEDBACK']; ?></a></li>
            <li><a href="login.php"><?php echo $lang['PAGE_TITLE_ADMIN']; ?></a></li>
            <li><a href="<?php basename($_SERVER['PHP_SELF']); ?>?lang=en"><img src="../images/GB.png"></a></li>
            <li><a href="<?php basename($_SERVER['PHP_SELF']); ?>?lang=de"><img src="../images/DE.png"></a></li>
            <li><a href="<?php basename($_SERVER['PHP_SELF']); ?>?lang=fr"><img src="../images/FR.png"></a></li>
        </ul>
    </div>
</nav>