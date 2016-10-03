<?php
namespace exmsl;
require_once("../../config/initialize.php");

// check if authentificated.
$auth = new Authentification();
$auth->islogged();

// language
$language = new Language();
$lang = $language->userLanguage();

$faq = new Adminfaq();

// check if id is transmitted correctly
$faq->checkId();
// get the FAQ entry with the given id
$faqSet = $faq->getFaqById($_GET['id']);

if(isset($_POST['submit'])){
    $id = $_GET['id'];
    $faq->updateFaq($_POST, $id);
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
    <!--show mysql message-->
    <?= App::message(); ?>
    <!--edit FAQ form-->
    <?php
        if($faqSet) {
            foreach ($faqSet as $faq) { ?>
                <form id="form" action="editfaq.php?id=<?= $faq['id']; ?>" method="post">
                    <label><?= $lang['FAQ_ADMIN_LANG']; ?></label>
                    <div class="selectff">
                        <select name="language">
                        <option value="en"
                            <?php if($faq['langue'] == 'en') echo "selected"; ?>
                        >English</option>
                        <option value="de"
                            <?php if($faq['langue'] == 'de') echo "selected"; ?>
                        >Deutsch</option>
                        <option value="fr"
                            <?php if($faq['langue'] == 'fr') echo "selected"; ?>
                        >Français</option>
                        </select>
                    </div>
                    <label><?= $lang['FAQ_ADMIN_QUESTION']; ?></label>
                    <input name="question" type="text" value="<?= htmlentities($faq['question']); ?>" required>

                    <label><?= $lang['FAQ_ADMIN_ANSWER']; ?></label>
                    <textarea class="faq" name="answer" required><?= htmlentities($faq['answer']); ?></textarea>

                    <input class="Asubmit" name="submit" type="submit" value="<?= $lang['BUG_BUTTON_SUBMIT']; ?>">
                </form>
            </section>
            <?php
            }
        } else { ?>
            <!--no valid id, error message is displayed-->
            <section class="messages">
                <?= $lang['DB_NO_FAQ_ID']; ?>
            </section>
        <?php
        }
    ?>
    <section class="article">
        <a href="faq.php"><?= $lang['CANCEL']; ?></a>
    </section>
</section>

<?php
include("../templates/footer.php");
?>