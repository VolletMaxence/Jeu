$CommResult = $MaBase->query("SELECT COUNT(*), IDJeu, nom FROM `ArticleLike` INNER JOIN Game ON ArticleLike.IDJeu = Game.id GROUP BY IDJeu ORDER BY `COUNT(*)` DESC LIMIT 3");
                        // selectionne le id du jeux le nom et sa fait une jointure avec articlelike et game
                        While($don = $CommResult->fetch()){   // boucle while qui affiche les 3 meuilleur jeux
                            ?>        
                                <div class="center">
                                    <a class="zone1" href="jeux.php?GameName=<?= $don['IDJeu']; ?>"> 
                                        <div class="">
                                        <!--met l'affiche du jeu selectioné dans la base-->
                                            <img class="Affiche2" src="IMG/Games/<?= $don['IDJeu']; ?>_Affiche.jpg" alt="Affiche"> <!--affiche l'image du jeu-->
                                        </div>
                                        <div class="nom">
                                            <?php
                                            //affiche les commentaires et le pseudo de la persone qui a posté un commentaire
                                                echo '<h1 class="">'.$don['nom'].'</h1>'; //affiche le nom du jeu
                                                echo '<h1 class="">'.$don['COUNT(*)'].'❤️</h1>'; //affiche le mombre de coeur
                                            ?>
                                        </div>
                                    </a>
                                </div>
                            <?php
                        }

                        SELECT COUNT(*) FROM 'adversaire'