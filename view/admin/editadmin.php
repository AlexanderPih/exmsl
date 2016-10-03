<?php
namespace exmsl;
require_once("../../config/initialize.php");

// check if authentificated.
$auth = new Authentification();
$auth->islogged();

// language
$language = new Language();
$lang = $language->userLanguage();

$admin = new Admin();

// check if id is transmitted correctly
$admin->checkId();
// get the FAQ entry with the given id
$adminSet = $admin->getAdminById($_GET['id']);

if(isset($_POST['submit'])){
    $id = $_GET['id'];
    $admin->updateAdmin($_POST, $id);
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


<section class="contenu">
	<div class="description">
		<h1><?= $lang['ADMIN_EDIT_ADMIN'] ?></h1>
		<p class="summary"><?= $lang['ADMIN_EDIT_ADMINDESCRIPTION'] ?></p>
    </div>
</section>

<!-- edit admin form -->
<section class="article">
<!--show mysql message-->
    <div class=\"messages\">
        <?= App::message(); ?>
    </div>
    <!--edit admin form-->
    <?php $admin->editAdmin($adminSet); ?>
    
</section>

<section class="article">
    <a href="manageadmins.php"><?= $lang['CANCEL'] ?></a>
</section>
    
<?php
include("../templates/footer.php");
?>