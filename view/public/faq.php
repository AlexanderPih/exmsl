<?php
namespace exmsl;
require_once("../../config/initialize.php");

// get current language to load language file
$language = new Language();
$lang = $language->userLanguage();

//getting all faq entries from DB for the current language
$faq = new Faq();
$faqSet = $faq->findAllFaq($language->getLanguage());

include("../templates/header.php");
include("../templates/publicnav.php");
?>

<!-- Title and description-->
<section class="contenu">
    <div class="description">
        <h1><?php echo $lang['FAQ_TITLE']; ?></h1>
        <p class="summary"><?php echo $lang['FAQ_DESCRIPTION']; ?></p>
    </div>
</section>
<!--show faq-->
<section class="article">
    <?php
        if($faqSet) {
            foreach($faqSet as $faq){ ?>
                <div class="faqwrapper">
                    <div class="question">
                        <h2>
                        <?= htmlentities($faq["question"]); ?>
                        </h2>

                        </div>
                        <div class="answer">
                        <?= htmlentities($faq["answer"]); ?>
                    </div>
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
<?php
include("../templates/footer.php");
?>