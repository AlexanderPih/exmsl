<?php
namespace exmsl;
require_once("../../config/initialize.php");

// check if authentificated.
$auth = new Authentification();
$auth->islogged();

// language
$language = new Language();
$lang = $language->userLanguage();

//getting all faq entries from DB for the current language
$faq = new AdminFaq();
$faqSet = $faq->findAllFaq($language->getLanguage());

include("../templates/header.php");
include("../templates/adminnav.php");
?>

<!-- Title and description-->
<section class="contenu">
    <div class="description">
        <h1><?= $lang['FAQ_TITLE']; ?></h1>
        <p class="summary"><?= $lang['FAQ_ADMIN_DESCRIPTION']; ?></p>
        <?= App::message(); ?>
    </div>
</section>
<section class="article">
    <div class="faqactions">
        <a href="newfaq.php"><?= $lang['FAQ_NEWFAQ']; ?></a>
    </div>
</section>
<br>
<!--show faq-->
<section class="article">
    <!--show faq list for given language-->
    <section class="article">
        <?php
        if($faqSet) {
            foreach($faqSet as $result){ ?>
                <div class="faqwrapperadmin">
                    <div class="question">
                        <h2><?= htmlentities($result["question"]); ?></h2>
                    </div>
                    <div class="answer">
                        <?= htmlentities($result["answer"]); ?>
                    </div>
                <div class="faqactions">
                <a href="editfaq.php?id=<?= urlencode($result['id']); ?>"><?= $lang['EDIT_FAQ']; ?></a>
                <a href="deletefaq.php?id=<?= urlencode($result['id']); ?>" onclick="return confirm('<?= $lang['FAQ_DELETE']; ?>')"><?= $lang['DELETE_FAQ']; ?></a>
                </div>
                <br>
            </div>
            <?php
            }
        } else { ?>
            <div class="faqwrapper">
                <?= $lang['FAQ_NO_ENTRY']; ?>
            </div>
        <?php
        }
        ?>
    </section>
</section>


<?php
include("../templates/footer.php");
?>