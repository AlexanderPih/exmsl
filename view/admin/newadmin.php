<?php
namespace exmsl;
require_once("../../config/initialize.php");


// check if authentificated.
$auth = new Authentification();
//$auth->islogged();

// language
$language = new Language();
$lang = $language->userLanguage();

// load form class
$form = new Form();

// load admin class
$admin = new Admin();

// check if $_POST is send, if so add new admin
if(isset($_POST["submit"]) && !empty($_POST)) {

    $admin->newAdmin($_POST);

}

include("../templates/header.php");
include("../templates/adminnav.php");
?>
<script>
    $(window).load(function() {
        $('#form input[type=text], input[type=password]').on('change invalid', function() {
            var field = $(this).get(0);
            field.setCustomValidity('');
            var lang = "<?= $language->getLanguage(); ?>";
            console.log(lang);

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


<section class="contenu">
	<div class="description">
		<h1><?= $lang['ADMIN_TITLE_NEWADMIN'] ?></h1>
		<p class="summary"><?= $lang['ADMIN_NEW_DESCRIPTION'] ?></p>
    </div>
</section>
<!--new admin form-->
<section class="article">
    <!--show mysql message-->
	<div class="messages">
		<?= App::message(); ?>
    </div>
    <!--new admin form-->
	<form id="form" action="newadmin.php" method="post">


		<label><?= $lang['ADMIN_USERNAME'] ?></label>
        <?= $form->input('text', ['name' => 'username']); ?>

		<label><?= $lang['ADMIN_FORM_PASSWORD'] ?></label>
        <?= $form->input('password', ['name' => 'password']); ?>

		<label><?= $lang['ADMIN_FORM_PASSWORD2'] ?></label>
        <?= $form->input('password', ['name' => 'passverify']); ?>

        <?= $form->submit($lang['BUG_BUTTON_SUBMIT'], 'submit'); ?>
        
	</form>
</section>

<section class="article">
	<a href="admin.php"><?= $lang['CANCEL'] ?></a>
</section>


<?php
include("../templates/footer.php");
?>