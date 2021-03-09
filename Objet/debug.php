        <?php
        //Combat :
        // le temps que les 2 adversaires n'on pas 0 pv :
        if($Personnage->GetVie() <= 0 && $Adversaire->GetVie() <= 0)
        {
            //affichage des bouttons de choix
        ?>
            <!-- bouton d'attaque -->

            <!-- Case de texte -->
            <div id=Texte>
                <p>
                    Texte par default
                </p>
            </div>


            <form>

                <button type="button" onclick=Att()> Attaque </button>
                    <script>
                        function Att() {
                            Attaque($Adversaire, $Perso)
                        }
                    </script>



                <!-- bouton Check -->
                <button type="button" onclick=Chk()> Check </button>
                    <script>
                        function Chk() {
                            Check()
                        }
                    </script>

                <!-- bouton de soin -->
                <button type="button" onclick=Heal()> Soin </button>
                    <script>
                        function Heal() {
                            Soin()
                        }
                    </script>          
            </form>
            <?php
        }
            ?>