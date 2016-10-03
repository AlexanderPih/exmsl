<?php
namespace exmsl;
require_once("../../config/initialize.php");

// check if authentificated.
$auth = new Authentification();
$auth->islogged();

// language
$language = new Language();
$lang = $language->userLanguage();

$faq = new adminfaq();

if(isset($_POST["submit"])) {
    $faq->newFaq($_POST);
}

include("../templates/header.php");
include("../templates/adminnav.php");
?>

<script>
    $(window).load(function() {
        $('#form input[type=text], textarea').on('change invalid', function() {
            var field = $(this).get(0);
            field.setCustomValidity('');
            var lang = "<?= $language->getLanguage(); ?>";

            if(lang === 'en') {
                var message = "Please fill in this field.";
            } else if(lang === 'de') {
                var message = "Bitte füllen Sie dieses Feld aus.";
            } else {
                var message = "Merci de remplir ce champ.";
            }

            if(!field.validity.valid) {
                field.setCustomValidity(message);
            }
        });
    });
</script>

<!--Title and description-->
<section class="contenu">
    <div class="description">
        <h1><?= $lang['FAQ_ADMIN_TITLE']; ?></h1>
        <p class="summary"><?= $lang['FAQ_ADMIN_SUBTITLE']; ?></p>
    </div>
</section>

<!--faq creation form-->
<section class="article">
<!--show message-->

    <form id="form" action="newfaq.php" method="post">
        <label><?= $lang['FAQ_ADMIN_LANG']; ?></label>
            <div class="selectff">
            <!--language selection, default selected language = current language-->
            <select name="language">
                <option value="en"
                    <?php if($lang == 'en') echo "selected"; ?>>English</option>
                <option value="de"
                    <?php if($lang == 'de') echo "selected"; ?>>Deutsch</option>
                <option value="fr"
                    <?php if($lang == 'fr') echo "selected"; ?>>Français</option>
            </select>
        </div>
        
        <label><?= $lang['FAQ_ADMIN_QUESTION']; ?></label>
        <input name="question" type="text" required>

        <label><?= $lang['FAQ_ADMIN_ANSWER']; ?></label>
        <textarea class="faq" name="answer" required></textarea>

        <input class="Asubmit" name="submit" type="submit" value="<?= $lang['BUG_BUTTON_SUBMIT']; ?>">
    </form>
</section>
<section class="article">
    <a href="faq.php"><?= $lang['CANCEL']; ?></a>
</section>