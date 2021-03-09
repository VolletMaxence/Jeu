<html>
    <head>

    </head>
    <body>
        <div id="Acceuil">
            <form method="POST" name="Acceuil">
                <input type="submit" name='Acceuil' value='Rejoins le Combat !'>
            </form>
        </div>


        <?php
            //Score
 

            //Aller dans la page d'acceuil
            if (isset($_POST["Acceuil"])) {
                echo "<script type='text/javascript'>document.location.replace('Acceuil.php');</script>";
            }
        ?>
    </body>
</html>