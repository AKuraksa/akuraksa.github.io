<?php
mb_internal_encoding("UTF-8");

$hlaska = '';
if (isset($_GET['uspech']))
    $hlaska = 'Email byl úspěšně odeslán.';
if ($_POST) // V poli _POST něco je, odeslal se formulář
{
    if (isset($_POST['jmeno']) && $_POST['jmeno'] &&
        isset($_POST['email']) && $_POST['email'] &&
        isset($_POST['zprava']) && $_POST['zprava'] &&
        isset($_POST['rok']) && $_POST['rok'] == date('Y'))
    {
        $hlavicka = 'From:' . $_POST['email'];
        $hlavicka .= "\nMIME-Version: 1.0\n";
        $hlavicka .= "Content-Type: text/html; charset=\"utf-8\"\n";
        $adresa = 'andrej.kuraksa+githubio@gmail.com';
        $predmet = 'Formulář - Profil';
        $uspech = mb_send_mail($adresa, $predmet, $_POST['zprava'], $hlavicka);
        if ($uspech)
        {
            $hlaska = 'Email byl úspěšně odeslán.';
            header('Location: mailform.php?uspech=ano');
            exit;
        }
        else
            $hlaska = 'Email se nepodařilo odeslat. Zkontrolujte adresu.';
    }
    else
        $hlaska = 'Formulář není správně vyplněný!';
}
?>

<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kontakt</title>
        <link rel="stylesheet" href="https://akuraksa.github.io/portfolio/css/style.css">
        <link rel="stylesheet" href="https://akuraksa.github.io/portfolio/css/font.css">   
    </head>
    <body>
    <div id="page">
        <header>
            <div class="row">
                <div class="leftcolumn">
                    <img src="picture/profilovka.jpg" alt="Andrej Kuraksa" width="100px" height="100px">
                    <h1><a href="https://akuraksa.github.io/portfolio/index.html">Andrej Kuraksa</a></h1>
                </div>
                <div class="rightcolumn">
                    <div class="row" style="float: right;">
                        <a href="https://www.facebook.com/kurvaksa/" target="_blank" rel="noopener noreferrer"><img src="picture/facebook-48.png" alt="Facebook" width="40px" height="40px"></a>
                        <a href="https://www.instagram.com/kurvaksa/" target="_blank" rel="noopener noreferrer"><img src="picture/instagram-48.png" alt="Instagram" width="40px" height="40px"></a>
                        <a href="https://www.linkedin.com/in/andrej-kuraksa-30a691242/" target="_blank" rel="noopener noreferrer"><img src="picture/linkedin-48.png" alt="Linked in" width="40px" height="40px"></a>
                    </div>
                </div>
            </div>
        </header>
        <nav>
            <a href="https://akuraksa.github.io/portfolio/index.html">Domů</a>
            <a href="#projekty">Projekty</a>
            <a href="#kontakt">Kontakt</a>
            <div class="nav-right">
                <a href="https://akuraksa.github.io">Rozcestník</a>
            </div>
        </nav>
        <main>
            <div class="row">
                <div class="card">
                    <h1>Kontaktní formulář</h1>
                    <?php
                        if ($hlaska)
                            echo('<p>' . htmlspecialchars($hlaska) . '</p>');
                        $jmeno = (isset($_POST['jmeno'])) ? $_POST['jmeno'] : '';
                        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
                        $zprava = (isset($_POST['zprava'])) ? $_POST['zprava'] : '';
                    ?>
                    <form method="POST">
                        <p>Jméno: <input name="jmeno" type="text" value="<?= htmlspecialchars($jmeno) ?>"/></p>
                        <p>Email: <input name="email" type="email" value="<?= htmlspecialchars($email) ?>"/></p>
                        <p>Aktuální rok: <input name="rok" type="number" /></p>
                        <p><textarea name="zprava"><?= htmlspecialchars($zprava) ?></textarea></p>
                        <input type="submit" value="Odeslat" />
                    </form>
                </div>
            </div>
        </main>
        <footer>
            <div class="row">
                <div class="leftcolumn">
                    <p>Andrej Kuraksa</p>
                    <p id="kontakt">Kontakt: <a href="mailto:andrej.kuraksa+githubio@gmail.com">andrej.kuraksa@gmail.com</a></p>
                    <div class="row">
                        <a href="https://www.facebook.com/kurvaksa/" target="_blank" rel="noopener noreferrer"><img src="picture/facebook-48.png" alt="Facebook" width="25px" height="25px"></a>
                        <a href="https://www.instagram.com/kurvaksa/" target="_blank" rel="noopener noreferrer"><img src="picture/instagram-48.png" alt="Instagram" width="25px" height="25px"></a>
                        <a href="https://www.linkedin.com/in/andrej-kuraksa-30a691242/" target="_blank" rel="noopener noreferrer"><img src="picture/linkedin-48.png" alt="Linked in" width="25px" height="25px"></a>
                    </div>
                </div>
                <div class="rightcolumn" style="text-align: right;">
                    <p><a href="https://github.com/login?return_to=https%3A%2F%2Fgithub.com%2Fakuraksa" target="_blank" rel="noopener noreferrer">Administrace</a></p>
                </div>
            </div>
        </footer>
    </div>
    </body>
</html>