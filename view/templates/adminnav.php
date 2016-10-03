<nav class="fixedbar">
    <div id="menu" class="menu">
        <a class="sitelogo" href="index.php">
            <?php if(isset($_SESSION['username'])){
                echo $_SESSION['username'];
            } else {
                echo $lang['PAGE_TITLE_INDEX'];
            }
             ?></a>
        <a class="visible" href="#menu">Menu</a><a class="invisible" href="#hidemenu">Menu</a>
        <ul class="menuliste">
            <li><a href="faq.php"><?php echo $lang['PAGE_TITLE_FAQ']; ?></a></li>
            <li><a href="support.php"><?php echo $lang['PAGE_TITLE_FEEDBACK']; ?></a></li>
            <li><a href="admin.php"><?php echo $lang['PAGE_TITLE_ADMIN']; ?></a></li>
            <li><a href="<?php basename($_SERVER['PHP_SELF']); ?>?lang=en"><img src="../images/GB.png" alt="English"></a></li>
            <li><a href="<?php basename($_SERVER['PHP_SELF']); ?>?lang=de"><img src="../images/DE.png" alt="Deutsch"></a></li>
            <li><a href="<?php basename($_SERVER['PHP_SELF']); ?>?lang=fr"><img src="../images/FR.png" alt="Français"></a></li>
        </ul>
    </div>
</nav>