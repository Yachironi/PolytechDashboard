<!-- il ne trouve pas form.js -->
<script type="text/javascript">
    list_form = new Array('1', '2', '3', '4', '5');

    function afficheForm(ID){
        var indice_form_a_affiche = document.getElementById(ID).selectedIndex;
        var i;
        var size = list_form.length;

        /* On cache les div qu'il faut caché */
        for(i=0; i<size; i++){
            var form = document.getElementById(list_form[i]);
            if(form == null){
                alert(i);
            }
            if(form.style.display == "block" && i != indice_form_a_affiche){
                form.style.display = "none";
            }
        }
        /* On affiche le formulaire passé en paramètre */
        document.getElementById(list_form[indice_form_a_affiche]).style.display = "block";
    }
</script>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Attribuer une tâche
    </h1>

    <!-- Formulaire -->
    <div class="myform" id="form_task">
        <form>

            <!-- Partie toujours présentes -->
            <div class="form-group">
                <label for="destinataire">Destinataire</label>
                <input type="text" class="form-control" id="destinataire">
            </div>
            <div class="form-group">
                <label for="objet">Objet</label>
                <input type="text" class="form-control" id="objet">
            </div>
            <div class="form-group">
                <label for="type">Type de formulaire</label>
                <select class="form-control" id="list_form" onchange="afficheForm('list_form')">
                    <option value="1"></option>
                    <option value="2">Justifier une absence</option>
                    <option value="3">Demander confirmation</option>
                    <option value="4">Envoyer une pièce jointe</option>
                    <option value="5">Demande non repertoriée</option>
                </select>
            </div>

            <!-- Vide -->
            <div id="1"></div>

            <!-- Justification absence -->
            <div id="2" style="display: none;">
                <!-- Date de début d'absence -->
                <div class="row">
                    <!-- Date -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="date">Date de début d'absence</label>
                            <input type="date" class="form-control" id="date_absence">
                        </div>
                    </div>
                    <!-- Heure -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="date">Heure</label>
                            <input type="time" class="form-control" id="heure_absence">
                        </div>
                    </div>
                </div>

                <!-- Date de retour -->
                <div class="row">
                    <!-- Date -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="date">Date de retour</label>
                            <input type="date" class="form-control" id="date_retour">
                        </div>
                    </div>
                    <!-- Heure -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="date">Heure</label>
                            <input type="time" class="form-control" id="heure_retour">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="motif">Motif de justification</label>
                    <textarea class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Sélectionner un fichier</label>
                    <input type="file" id="exampleInputFile">
                </div>
                <!-- Bouton envoyer -->
                <div class="form-group btn-center">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </div>

            <!-- 3 -->
            <div id="3" style="display: none;">
                Option 3
            </div>

            <!-- Piece jointe -->
            <div id="4" style="display: none;">
                <div class="form-group">
                    <label>Texte</label>
                    <textarea class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">Sélectionner un fichier</label>
                    <input type="file" id="exampleInputFile">
                </div>
                <!-- Bouton envoyer -->
                <div class="form-group btn-center">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </div>

            <!-- Par defaut -->
            <div id="5" style="display: none;">
                <div class="form-group">
                    <label>Texte</label>
                    <textarea class="form-control"></textarea>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Checkbox
                    </label>
                </div>
                <!-- Bouton envoyer -->
                <div class="form-group btn-center">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </div>
        </form>
    </div>
</section>