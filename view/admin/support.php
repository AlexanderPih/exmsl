<?php
namespace exmsl;
require_once("../../config/initialize.php");

// check if authentificated.
$auth = new Authentification();
$auth->islogged();

// language
$language = new Language();
$lang = $language->userLanguage();

// get all open bugs:
$bugs = new Adminsupport($language->getLanguage());
$suggestions = $bugs->getSuggestions();

$openBugs = $bugs->getAllBugs($language->getLanguage(), "open");
$closedBugs = $bugs->getAllBugs($language->getLanguage(), "closed");


include("../templates/header.php");
include("../templates/adminnav.php");
?>
<!--mathjax-->
<script type="text/javascript" src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML&delayStartupUntil=configured"></script>

<!--Title and description-->
<section class="contenu" id="top">
    <div class="description">
        <h1><?= $lang['BUG_ADMIN_TITLE']; ?></h1>
        <a class="button" href="#feedback"><?= $lang['BUTTON_BUGS_OPEN']; ?></a>
        <a class="button" href="#feedback_closed"><?= $lang['BUTTON_BUGS_CLOSED']; ?></a>
        <a class="button" href="#suggestions"><?= $lang['BUTTON_SUGGESTIONS']; ?></a>
    </div>
</section>

<!--Explanation-->
<section class="article">
    <p><?= $lang['BUG_ADMIN_DESCRIPTION_1']; ?></p>
    <p><?= $lang['BUG_ADMIN_DESCRIPTION_2']; ?></p>
    <p><?= $lang['BUG_ADMIN_DESCRIPTION_3']; ?></p>
    <p><?= $lang['BUG_ADMIN_DESCRIPTION_4']; ?></p>
    <p id="feedback">
        <?= $lang['BUG_ADMIN_DESCRIPTION_5']; ?>
    </p>
</section>

<!--open bugs:-->
<section class="article">
    <h2 style="color: #000"><?= $lang['BUTTON_BUGS_OPEN']; ?></h2>
    <br>

    <!--show message-->
    <?php App::message(); ?>

    <!--open bugs here-->
    <section class="article">
        <?php
        if($openBugs) {

            foreach($openBugs as $bug){
                $datetmp = strtotime($bug['date']);
                $date    = date("d/m/Y", $datetmp);
                ?>

                <div class="bugopenwrapper">
                    <div class="titlewrapper">
                        <div class="ticket">
                            <?= $lang['BUG_TICKET'] . $bug['id']; ?>
                        </div>
                        <div class="date">
                            <?= $lang['BUG_DATE'] . $date; ?>
                        </div>
                    </div>
                    <br>
                    <div class="equation">
                        <?= $bug['bug']; ?>
                    </div>

                    <div class="infowrapper">
                        <div class="infotitle">
                            <?= $lang['BUG_USER_INFO']; ?>
                        </div>
                        <div class="userinfo">
                            <?= $bug["info"]; ?>
                        </div>

                        <div class="buttonwrapper">
                            <a class="button-dark" href="closebug.php?id= <?= urlencode($bug["id"]); ?>"><?= $lang['BUG_BUTTON_CLOSE']; ?></a>

                        <a class="button-dark" href="deletebug.php?id= <?= urlencode($bug["id"]); ?>" onclick="return confirm('<?= $lang['BUG_DELETE']; ?>')"><?= $lang['BUG_BUTTON_DELETE']; ?></a>
                    </div>
                    <div class="separator"></div>
                </div>
            <?php
            }
        } else { ?>
            <div class="faqwrapper">
                <?= $lang['BUG_NO_ENTRY']; ?>
            </div>
        <?php
        }
        ?>
    </section>
</section>

<div id="feedback_closed"></div>
</section>
<section class="article">
    <h2 style="color: #000"><?= $lang['BUTTON_BUGS_CLOSED']; ?></h2>
    <br>

    <!--show message-->
    <?= App::message(); ?>

    <!--closed bugs here-->
    <section class="article">
        <?php
        if($closedBugs) {

            foreach($closedBugs as $bug){
                $datetmp = strtotime($bug['date']);
                $date    = date("d/m/Y", $datetmp);
                ?>

        <div class="bugopenwrapper">
            <div class="titlewrapper">
                <div class="ticket">
                    <?= $lang['BUG_TICKET'] . $bug['id']; ?>
                </div>
                <div class="date">
                    <?= $lang['BUG_DATE'] . $date; ?>
                </div>
            </div>
            <br>
            <div class="equation">
                <?= $bug['bug']; ?>
            </div>

            <div class="infowrapper">
                <div class="infotitle">
                    <?= $lang['BUG_USER_INFO']; ?>
                </div>
                <div class="userinfo">
                    <?= $bug["info"]; ?>
                </div>

                <div class="buttonwrapper">
                    <a class="button-dark" href="closebug.php?id= <?= urlencode($bug["id"]); ?>"><?= $lang['BUG_BUTTON_CLOSE']; ?></a>

                    <a class="button-dark" href="deletebug.php?id= <?= urlencode($bug["id"]); ?>" onclick="return confirm('<?= $lang['BUG_DELETE']; ?>')"><?= $lang['BUG_BUTTON_DELETE']; ?></a>
                </div>
                <div class="separator"></div>
            </div>
            <?php
            }
            } else { ?>
                <div class="faqwrapper">
                    <?= $lang['BUG_NO_ENTRY']; ?>
                </div>
                <?php
            }
        ?>
    </section>
</section>

<div id="suggestions"></div>
</section>
<section class="article">
    <h2 style="color: #000"><?= $lang['BUG_SUGGESTION']; ?></h2>
    <br>

    <!--show message-->
    <?= App::message(); ?>

    <!--suggestions here-->
    <section class="article">
        <?php
        if($suggestions) {

            foreach($suggestions as $suggestion){
                $datetmp = strtotime($suggestion["date"]);
                $date    = date("d/m/Y", $datetmp);
                ?>

                <div class="faqwrapperadmin">
                    <div class="question">
                    <h3><?= $date; ?></h3>
                </div>
                <div class="info">
                    <?= $suggestion['info']; ?>
                </div>

                    <a href="deletesug.php?id=<?= urlencode($suggestion['id']); ?>" onclick="return confirm('<?= $lang['SUGGESTION_DELETE']; ?>')"><?= $lang['DELETE_FAQ']; ?></a>
                </div>
            <?php
            }
        } else { ?>
            <div class="faqwrapper">
                <?= $lang['BUG_NO_ENTRY']; ?>
            </div>
        <?php
        }
        ?>
    </section>
</section>


<?php
include("../templates/footer.php");
?>
<script type="text/javascript">MathJax.Hub.Configured()</script>