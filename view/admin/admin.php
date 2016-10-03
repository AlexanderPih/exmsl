<?php
namespace exmsl;
require_once("../../config/initialize.php");

// check if authentificated.
$auth = new Authentification();
//$auth->islogged();

// language
$language = new Language();
$lang = $language->userLanguage();

$admin = new Admin();
$adminSet = $admin->findAllAdmins();

include("../templates/header.php");
include("../templates/adminnav.php");
?>


<section class="contenu">
    <div class="description">
        <h1><?= $lang['PAGE_TITLE_MANAGEADMIN'] ?></h1>
        <p class="summary"><?= $lang['ADMIN_DESCRIPTION'] ?></p>
    </div>
</section>

<!-- show admin list plus manage buttons with admin's id -->
<section class="article">
    <!-- show mysql message -->
    <?=  App::message(); ?>
    
	<div class="admincontainer">
		<div class="adminwrapper">
			<div class="username">
				<h2><?= $lang['ADMIN_USERNAME'] ?></h2>
            </div>
				<div class="actions">
				<h2><?= $lang['ADMIN_ACTION'] ?></h2>
            </div>
        </div>
<!-- show admin list -->
<?php
    $admin->showAdmin($adminSet);
?>
    </div>
</section>
<br>
<section class="article">
	<!-- create a new admin -->
	<div class="newadmin">
		<a href="newadmin.php"><?= $lang['ADMIN_ADD_NEW'] ?></a>
    </div>
</section>

<?php
include("../templates/footer.php");
?>