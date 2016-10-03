<?php
namespace exmsl;
use exmsl\App;
require_once("../../config/initialize.php");

$message = '';

$language = new Language();
$lang = $language->userLanguage();

$form = new Form();

if(isset($_POST["submit"])) {
    $login = new Login();
    $trylogin = $login->attemptLogin();

    if($trylogin){
        $app = new App();
        $app->redirect("../admin/index.php");
    } else {
        $_SESSION["message"] = $lang['NO_LOGIN'];
    }
}



include("../templates/header.php");
include("../templates/publicnav.php");
?>

<!--Title and description-->
<section class="contenu">
    <div class="description">
        <h1><?= $lang['ADMIN_LOGIN_TITLE']; ?></h1>
        <p class="summary"><?= $lang['ADMIN_LOGIN_DESCRIPTION']; ?></p>
    </div>
</section>
<!--login form-->
<section class="article">
    <?= App::message(); ?>
    <section class="article" style="width: 60%;">
        <form id="form" action="login.php" method="post">
            <?php
            echo $form->label($lang['ADMIN_USERNAME']);
            echo $form->input('text', ['name' => 'username']);
            echo $form->label($lang['ADMIN_FORM_PASSWORD']);
            echo $form->input('password', ['name' => 'password']);
            echo $form->submit($lang['BUG_BUTTON_SUBMIT'], 'submit');
            ?>
        </form>
    </section>
</section>
<br>
<br>

<?php
    include("../templates/footer.php");
?>