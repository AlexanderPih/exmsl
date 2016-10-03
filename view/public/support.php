<?php
namespace exmsl;
require_once("../../config/initialize.php");



// get current language to load language file
$language = new Language();
$lang = $language->userLanguage();

$support = new Support();

if(isset($_POST['submit1'])) {
    $data = ['bug' => $_POST['bug'], 'message' => $_POST['message']];
    $support->addBug($data, $language->getLanguage());
}
if(isset($_POST['submit2'])) {
    $data = ['suggestion' => $_POST['suggestion']];
    $support->addSuggestion($data, $language->getLanguage());
}

include("../templates/header.php");
include("../templates/publicnav.php");

// form
$form = new Form();


?>
<!--function loadMath et getdrop-->
<script src="../javascript/loadMath.js"></script>
<script src="../javascript/getdrop.js"></script>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<!-- display javascript message for required form entries in the current language-->
<script>
    $(window).load(function() {
        $('#form input[type=text], textarea').on('change invalid', function() {
            var field = $(this).get(0);
            field.setCustomValidity('');
            var lang = "<?= $language->getLanguage(); ?>"; // get current language

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

<!-- Title and description-->
<section class="contenu">
    <div class="description">
        <h1><?= $lang['FAQ_TITLE']; ?></h1>
        <p class="summary"><?= $lang['FAQ_DESCRIPTION']; ?></p>
    </div>
</section>
<!--show query message-->
<?= App::message(); ?>
<!--Explanation-->
<section class="article">
    <h2><?= $lang['BUG_REPORTING_TITLE']; ?></h2>
    <p><?= $lang['BUG_REPORTING']; ?></p>
</section>
<!--section drop, ondrop charge loadMath to executes Typeset-->
<section id="drop" ondrop="start();loadMath()" class="article">
    <div>
        <p class="mathInput"><?= $lang['BUG_DROP']; ?></p>
    </div>
</section>
<br>
<!--textarea-->
<section class="article">
    <!--form message-->
    <form action="support.php" method="post">

        <?php
            echo $form->input('hidden', ['name' => 'bug', 'id' => 'hiddenfield']);
            echo $form->input('textarea', ['name' => 'message', 'placeholder' => $lang['BUG_DROP_EXPLANATION']]);
            echo $form->submit($lang['BUG_BUTTON_SUBMIT'], 'submit1');
        ?>

    </form>
</section>

<section class="article">
    <h2><?= $lang['FAQ_SUGGESTION']; ?></h2>
    <p><?= $lang['BUG_FEEDBACK']; ?></p>
</section>
<section class="article">
    <!-- suggestion form-->
    <form action="support.php" method="post">
        <!-- <input type=\"text\" name=\"langue\" value=\"".getCurrentLang()."\" class=\"invisible\">";-->

        <?php
            echo $form->input('hidden', ['name' => 'bug', 'id' => 'hiddenfield']);
            echo $form->input('textarea', ['name' => 'suggestion', 'placeholder' => $lang['BUG_SUGGESTION']]);
            echo $form->submit($lang['BUG_BUTTON_SUBMIT'], 'submit2');
        ?>
    </form>
</section>

<!--pour faire marcher le drag and drop-->
<script src="../javascript/feedback.js"></script>
<?php
    include("../templates/footer.php");
?>