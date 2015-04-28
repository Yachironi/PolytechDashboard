function activateTag(id_tag){
    var list_tag = new Array('main_dashboard', 'my_space_study_level', 'my_program', 'my_tasks', 'assign_task', 'my_grades', 'planning', 'my_notifications', 'contact');

    var i;
    var size = list_tag.length;

    /* On cache les div qu'il faut caché */
    for(i=0; i<size; i++){
        var tag = document.getElementById(list_tag[i]);
        if(tag == null) {
            alert(i);
        }
        if(tag.style.display == "block"){
            tag.style.display = "none";
        }
    }

    /* On affiche l'onglet passé en paramètre */
    document.getElementById(id_tag).style.display = "block";
    if(id_tag=='planning')  {
        $('#calendar').fullCalendar('render');
    }
}

function activeSemestre(ID){
    /* Ajout/Suppression de la classe semestreActive */
    if(document.getElementById(ID).classList.contains("semestreActive")){
        document.getElementById(ID).classList.remove("semestreActive");
    }
    else{
        document.getElementById(ID).classList.add("semestreActive");
        var autre_id;
        if(ID == 'semestre1'){
            autre_id = 'semestre2';
        }
        else{
            autre_id = 'semestre1';
        }
        document.getElementById(autre_id).classList.remove("semestreActive");
    }

    if(document.getElementById('semestre1').classList.contains("semestreActive") || document.getElementById('semestre2').classList.contains("semestreActive")){
        document.getElementById('semestre2').style.borderTopColor = "#003B59";
    }
    else{
        document.getElementById('semestre2').style.borderTopColor = "transparent";
    }
}



/* Permet de faire un affichage dynamique des formulaires lorsqu'on veut attribuer une tache */
function afficheForm(ID){
    $(".token-input-dropdown-facebook").css("width", $('#list_form').width()-13);

    list_form = new Array('form1', 'form2', 'form3', 'form4', 'form5', 'form6', 'form7', 'form8', 'form9');

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

/* TODO */
function specifyNameHomework(cours, devoir){
    return "[" + document.getElementById(cours).selectedIndex + "] " + document.getElementById(devoir).selectedIndex;
}

function openPopup(nom, width, height){
    if(window.innerWidth) {
        var left = (window.innerWidth-width)/2;
        var top = (window.innerHeight-height)/2;
    }
    else {
        var left = (document.body.clientWidth-width)/2;
        var top = (document.body.clientHeight-height)/2;
    }
    window.open(nom,'Sélectionner un destinataire','menubar=no, top='+top+', left='+left+', width='+width+', height='+height+'');
}

/**
 * Lorsque l'etudiant clique sur le bouton editer sur une tache qu'il s'est lui meme attribue
 */
function editTask(){

}

/**
 * Lorsque l'etudiant clique sur le bouton supprimer sur une tache qu'il s'est lui meme attribue
 */
// Il faut faire passer la tache en parametre
function removeTask(){
    // Trouve sur internet :
    //$em->remove($product);
    //$em->flush();
}

/**
 * Lorsque l'etudiant clique sur le bouton Fait sur une tache qu'il s'est lui meme attribue
 */
function doneTask(){

}


/**
 * Lorsque l'etudiant clique sur le bouton repondre sur une tache qu'un gestionnaire lui a attribue
 */
function replyTask(){

}

/* Affiche ou cache le champ "echeance" */
function showEcheance(checkbox, ID){
    var echeance = document.getElementById(ID);
    if(document.getElementById(checkbox).checked == true){
        echeance.disabled = false;
    }
    else{
        echeance.disabled = true;
        echeance.value = "";

    }
}

function updateObjetRDV(list_cours, list_devoirs, objet){
    var select_cours = document.getElementById(list_cours);
    var value_cours = select_cours.options[select_cours.selectedIndex].value;
    var select_devoir = document.getElementById(list_devoirs);
    var value_devoir = select_devoir.options[select_devoir.selectedIndex].value;
    if(value_cours == "" && value_devoir == ""){
        document.getElementById(objet).value = "";
    }
    else if(value_cours != "" && value_devoir == ""){
        document.getElementById(objet).value = "[" + value_cours + "]";
    }
    else if(value_cours == "" && value_devoir != ""){
        document.getElementById(objet).value = "[" + value_devoir + "]";

    }
    else{
        document.getElementById(objet).value = "[" + value_cours + " - " + value_devoir + "]";
    }

}

/* TODO : chercher les destinataires dans la BD */
function updateInscription(inscription, destinataire, objet){
    var select_inscription = document.getElementById(inscription);
    var value_inscription = select_inscription.options[select_inscription.selectedIndex].value;
    if(value_inscription != ""){
        if(value_inscription == "Polytech"){
            document.getElementById(destinataire).value = "Dominique Beau - dominique.beau@u-psud.fr (a chercher dans BD)";
            document.getElementById(objet).value = "[" + value_inscription + "] Demande de réinscription";
        }
        else{
            if(value_inscription == "TOEIC"){
                document.getElementById(destinataire).value = "Chantal Escudie - chantal.escudie@u-psud.fr (a chercher dans BD)";
            }
            else if(value_inscription == "M2R"){
                document.getElementById(destinataire).value = "Emmanuelle Frenoux - emmanuelle.frenoux@u-psud.fr (a chercher dans BD)";
            }
            else if(value_inscription == "Sport"){
                document.getElementById(destinataire).value = "Marcelo Bielsa - marcelo.bielsa@u-psud.fr (a chercher dans BD)";
            }
            else if(value_inscription == "Bourse"){
                document.getElementById(destinataire).value = "Nadia Chapiteau - nadia.chapiteau@u-psud.fr (a chercher dans BD)";
            }
            document.getElementById(objet).value = "[" + value_inscription + "] Demande d'inscription";
        }
    }
}

/* Mon espace */
function changeModal(id_espace, id_nom_espace_modal, id_button_modal){
    document.getElementById(id_nom_espace_modal).innerHTML = id_espace;
    document.getElementById(id_button_modal).onclick = function(){
        suppressionEspace(id_espace);
    }
}

/* TODO : modifier l'espace en question dans la BDD et recharger (sans rechargement de page) */
function suppressionEspace(ID){
    alert(ID);
}

/* TODO : Ajouter l'espace dans la BD et recharger (sans rechargement de page) */
function addEspace(ID){
    var select = document.getElementById(ID);
    var value_select = select.options[select.selectedIndex].value;
    alert(value_select);
}

/* Lorsque l'étudiant attribue une tache a qqn et qu'il selectionne l'importance */
function clickOnImportance(id_importance_selected, other_id_importance_1, other_id_importance_2){
    var importance_selected = document.getElementById(id_importance_selected);
    var name_importance_selected = id_importance_selected.substring(3, 14);
    // il faut le passer en selected
    if(importance_selected.classList.contains(name_importance_selected)){
        importance_selected.classList.remove(name_importance_selected);
        importance_selected.classList.add(name_importance_selected + "-selected");

        // On enleve le selected des autres si y'a
        var importance_other1 = document.getElementById(other_id_importance_1);
        var importance_other2 = document.getElementById(other_id_importance_2);
        var name_importance_other1 = other_id_importance_1.substring(3, 14);
        var name_importance_other2 = other_id_importance_2.substring(3, 14);
        if(importance_other1.classList.contains(name_importance_other1 + "-selected")){
            importance_other1.classList.remove(name_importance_other1 + "-selected");
            importance_other1.classList.add(name_importance_other1);
        }
        else if(importance_other2.classList.contains(name_importance_other2 + "-selected")){
            importance_other2.classList.remove(name_importance_other2 + "-selected");
            importance_other2.classList.add(name_importance_other2);
        }
    }
    // il faut enlever le selected
    else{
        importance_selected.classList.remove(name_importance_selected + "-selected");
        importance_selected.classList.add(name_importance_selected);
    }

}

/* Permet de faire un changement d'onglet lorsque l'etudiant clique sur un onglet qui est dans le dropdown */
function changeOnglet(onglet, last_onglet){
    // echange contenu html
    var contenu_onglet = document.getElementById(onglet).innerHTML;
    var contenu_lastOnglet = document.getElementById(last_onglet).innerHTML;
    document.getElementById(onglet).innerHTML = contenu_lastOnglet;
    document.getElementById(last_onglet).innerHTML = contenu_onglet;

    // ajout/suppression des onclick
    document.getElementById(last_onglet).getElementsByTagName("a")[0].setAttribute('onclick', '');
    var var_onglet = "'" + onglet + "'";
    var var_lastOnglet = "'" + last_onglet + "'";
    document.getElementById(onglet).getElementsByTagName("a")[0].setAttribute('onclick', 'changeOnglet(' + var_onglet + ',' + var_lastOnglet + ')');

    // ajout/suppresion de la classe active
    var ul = document.getElementById('ul_navbar_onglets').getElementsByTagName("li");
    var i=0;
    var size = ul.length;
    while(i<size){
        if(ul.item(i).classList.contains("active")){
            ul.item(i).classList.remove("active");
            i=size;
        }
        i++;
    }
    document.getElementById(last_onglet).classList.add("active");

}

/* Verifie si les mots de passe sont identiques*/
function verifyPassword(mdp1, mdp2, div_mdp1, div_mdp2){
    var longueur_min = 8;
    var longueur_max = 20;

    var value_mdp1 = document.getElementById(mdp1).value;
    var value_mdp2 = document.getElementById(mdp2).value;

    var id_mdp1 = "'" + mdp1 + "'";
    var id_mdp2 = "'" + mdp2 + "'";
    var id_div_mdp1 = "'" + div_mdp1 + "'";
    var id_div_mdp2 = "'" + div_mdp2 + "'";

    if(value_mdp1 != ""){
        // correct
        if(value_mdp1.length >= longueur_min && value_mdp1.length <= longueur_max){
            if(!document.getElementById(div_mdp1).classList.contains('has-success')){
                document.getElementById(div_mdp1).classList.add('has-success');
            }
            if(!document.getElementById(div_mdp1).classList.contains('has-feedback')){
                document.getElementById(div_mdp1).classList.add('has-feedback');
            }
            if(document.getElementById(div_mdp1).classList.contains('has-error')){
                document.getElementById(div_mdp1).classList.remove('has-error');
            }

            document.getElementById(div_mdp1).innerHTML = "<label class='control-label' for='" + mdp1 + "'>Nouveau mot de passe</label>"
            + "<input type='password' class='form-control' id='"+ mdp1 +"' value='" + value_mdp1 + "'>"
            + "<span class='glyphicon glyphicon-ok form-control-feedback' aria-hidden='true'></span>";
            document.getElementById(mdp1).setAttribute("onchange", "verifyPassword('" + mdp1 + "', '" + mdp2 + "', '" + div_mdp1 + "', '" + div_mdp2 + "')");

            // afficher mdp2 normalement
            if(value_mdp2 == ""){
                if(document.getElementById(div_mdp2).classList.contains('has-success')){
                    document.getElementById(div_mdp2).classList.remove('has-success');
                }
                if(document.getElementById(div_mdp2).classList.contains('has-feedback')) {
                    document.getElementById(div_mdp2).classList.remove('has-feedback');
                }
                if(document.getElementById(div_mdp2).classList.contains('has-error')) {
                    document.getElementById(div_mdp2).classList.remove('has-error');
                }

                document.getElementById(div_mdp2).innerHTML = "<label class='control-label' for='" + mdp2 + "'>Nouveau mot de passe</label>"
                + "<input type='password' class='form-control' id='"+ mdp2 +"' value='" + value_mdp2 + "'>"
                + "</div>";
                document.getElementById(mdp2).setAttribute("onchange", "verifyPassword('" + mdp1 + "', '" + mdp2 + "', '" + div_mdp1 + "', '" + div_mdp2 + "')");
            }
            else{
                // correct
                if(value_mdp1 == value_mdp2){
                    if(!document.getElementById(div_mdp2).classList.contains('has-success')){
                        document.getElementById(div_mdp2).classList.add('has-success');
                    }
                    if(!document.getElementById(div_mdp2).classList.contains('has-feedback')) {
                        document.getElementById(div_mdp2).classList.add('has-feedback');
                    }
                    if(document.getElementById(div_mdp2).classList.contains('has-error')) {
                        document.getElementById(div_mdp2).classList.remove('has-error');
                    }

                    document.getElementById(div_mdp2).innerHTML = "<label class='control-label' for='" + mdp2 + "'>Nouveau mot de passe</label>"
                    + "<input type='password' class='form-control' id='"+ mdp2 +"' value='" + value_mdp2 + "'>"
                    + "<span class='glyphicon glyphicon-ok form-control-feedback' aria-hidden='true'></span>";

                    document.getElementById(mdp2).setAttribute("onchange", "verifyPassword('" + mdp1 + "', '" + mdp2 + "', '" + div_mdp1 + "', '" + div_mdp2 + "')");
                }
                // erreur au niveau de la confirmation
                else{
                    if(!document.getElementById(div_mdp2).classList.contains('has-error')){
                        document.getElementById(div_mdp2).classList.add('has-error');
                    }
                    if(!document.getElementById(div_mdp2).classList.contains('has-feedback')) {
                        document.getElementById(div_mdp2).classList.add('has-feedback');
                    }
                    if(document.getElementById(div_mdp2).classList.contains('has-success')) {
                        document.getElementById(div_mdp2).classList.remove('has-success');
                    }

                    document.getElementById(div_mdp2).innerHTML = "<label class='control-label' for='" + mdp2 + "'>Nouveau mot de passe</label>"
                    + "<input type='password' class='form-control' id='"+ mdp2 +"' value='" + value_mdp2 + "'>"
                    + "<span class='glyphicon glyphicon-remove form-control-feedback' aria-hidden='true'></span>"
                    + "<span style='color:red;'>Les mots de passe sont différents</span>";

                    document.getElementById(mdp2).setAttribute("onchange", "verifyPassword('" + mdp1 + "', '" + mdp2 + "', '" + div_mdp1 + "', '" + div_mdp2 + "')");
                }
            }

        }
        // erreur
        else{
            if(!document.getElementById(div_mdp1).classList.contains('has-error')){
                document.getElementById(div_mdp1).classList.add('has-error');
            }
            if(!document.getElementById(div_mdp1).classList.contains('has-feedback')) {
                document.getElementById(div_mdp1).classList.add('has-feedback');
            }
            if(document.getElementById(div_mdp1).classList.contains('has-success')) {
                document.getElementById(div_mdp1).classList.remove('has-success');
            }

            document.getElementById(div_mdp1).innerHTML = "<label class='control-label' for='" + mdp1 + "'>Nouveau mot de passe</label>"
            + "<input type='password' class='form-control' id='"+ mdp1 +"' value='" + value_mdp1 + "'>"
            + "<span class='glyphicon glyphicon-remove form-control-feedback' aria-hidden='true'></span>"
            + "<span style='color:red;'>Le mot de passe doit avoir entre " + longueur_min + " et " + longueur_max + " caractères</span>";

            document.getElementById(mdp1).setAttribute("onchange", "verifyPassword('" + mdp1 + "', '" + mdp2 + "', '" + div_mdp1 + "', '" + div_mdp2 + "')");

            // afficher mdp2 normal
            if(value_mdp2 == ""){
                if(document.getElementById(div_mdp2).classList.contains('has-success')){
                    document.getElementById(div_mdp2).classList.remove('has-success');
                }
                if(document.getElementById(div_mdp2).classList.contains('has-feedback')) {
                    document.getElementById(div_mdp2).classList.remove('has-feedback');
                }
                if(document.getElementById(div_mdp2).classList.contains('has-error')) {
                    document.getElementById(div_mdp2).classList.remove('has-error');
                }

                document.getElementById(div_mdp2).innerHTML = "<label class='control-label' for='" + mdp2 + "'>Nouveau mot de passe</label>"
                + "<input type='password' class='form-control' id='"+ mdp2 +"' value='" + value_mdp2 + "'>"
                + "</div>";
                document.getElementById(mdp2).setAttribute("onchange", "verifyPassword('" + mdp1 + "', '" + mdp2 + "', '" + div_mdp1 + "', '" + div_mdp2 + "')");
            }
            // erreur
            else{
                if(!document.getElementById(div_mdp2).classList.contains('has-error')){
                    document.getElementById(div_mdp2).classList.add('has-error');
                }
                if(!document.getElementById(div_mdp2).classList.contains('has-feedback')) {
                    document.getElementById(div_mdp2).classList.add('has-feedback');
                }
                if(document.getElementById(div_mdp2).classList.contains('has-success')) {
                    document.getElementById(div_mdp2).classList.remove('has-success');
                }

                document.getElementById(div_mdp2).innerHTML = "<label class='control-label' for='" + mdp2 + "'>Nouveau mot de passe</label>"
                + "<input type='password' class='form-control' id='"+ mdp2 +"' value='" + value_mdp2 + "'>"
                + "<span class='glyphicon glyphicon-remove form-control-feedback' aria-hidden='true'></span>"
                + "<span style='color:red;'>Mot de passe incorrect</span>";
                document.getElementById(mdp2).setAttribute("onchange", "verifyPassword('" + mdp1 + "', '" + mdp2 + "', '" + div_mdp1 + "', '" + div_mdp2 + "')");
            }
        }
    }
    else{
        // afficher mdp1 et mdp2 normal
        if(value_mdp2 == ""){
            if(document.getElementById(div_mdp1).classList.contains('has-success')){
                document.getElementById(div_mdp1).classList.remove('has-success');
            }
            if(document.getElementById(div_mdp1).classList.contains('has-feedback')) {
                document.getElementById(div_mdp1).classList.remove('has-feedback');
            }
            if(document.getElementById(div_mdp1).classList.contains('has-error')) {
                document.getElementById(div_mdp1).classList.remove('has-error');
            }
            if(document.getElementById(div_mdp2).classList.contains('has-success')){
                document.getElementById(div_mdp2).classList.remove('has-success');
            }
            if(document.getElementById(div_mdp2).classList.contains('has-feedback')) {
                document.getElementById(div_mdp2).classList.remove('has-feedback');
            }
            if(document.getElementById(div_mdp2).classList.contains('has-error')) {
                document.getElementById(div_mdp2).classList.remove('has-error');
            }

            document.getElementById(div_mdp1).innerHTML = "<label class='control-label' for='" + mdp1 + "'>Nouveau mot de passe</label>"
            + "<input type='password' class='form-control' id='"+ mdp1 +"' value='" + value_mdp1 + "'>"
            + "</div>";
            document.getElementById(mdp1).setAttribute("onchange", "verifyPassword('" + mdp1 + "', '" + mdp2 + "', '" + div_mdp1 + "', '" + div_mdp2 + "')");

            document.getElementById(div_mdp2).innerHTML = "<label class='control-label' for='" + mdp2 + "'>Nouveau mot de passe</label>"
            + "<input type='password' class='form-control' id='"+ mdp2 +"' value='" + value_mdp2 + "'>"
            + "</div>";
            document.getElementById(mdp2).setAttribute("onchange", "verifyPassword('" + mdp1 + "', '" + mdp2 + "', '" + div_mdp1 + "', '" + div_mdp2 + "')");
        }
        // Probleme pour les 2
        else{
            if(!document.getElementById(div_mdp1).classList.contains('has-error')){
                document.getElementById(div_mdp1).classList.add('has-error');
            }
            if(!document.getElementById(div_mdp1).classList.contains('has-feedback')) {
                document.getElementById(div_mdp1).classList.add('has-feedback');
            }
            if(document.getElementById(div_mdp1).classList.contains('has-success')) {
                document.getElementById(div_mdp1).classList.remove('has-success');
            }

            if(!document.getElementById(div_mdp2).classList.contains('has-error')){
                document.getElementById(div_mdp2).classList.add('has-error');
            }
            if(!document.getElementById(div_mdp2).classList.contains('has-feedback')) {
                document.getElementById(div_mdp2).classList.add('has-feedback');
            }
            if(document.getElementById(div_mdp2).classList.contains('has-success')) {
                document.getElementById(div_mdp2).classList.remove('has-success');
            }


            document.getElementById(div_mdp1).innerHTML = "<label class='control-label' for='" + mdp1 + "'>Nouveau mot de passe</label>"
            + "<input type='password' class='form-control' id='"+ mdp1 +"' value='" + value_mdp1 + "'>"
            + "<span class='glyphicon glyphicon-remove form-control-feedback' aria-hidden='true'></span>"
            + "<span style='color:red;'>Veuillez entrer un mot de passe valide</span>";
            document.getElementById(mdp1).setAttribute("onchange", "verifyPassword('" + mdp1 + "', '" + mdp2 + "', '" + div_mdp1 + "', '" + div_mdp2 + "')");

            document.getElementById(div_mdp2).innerHTML = "<label class='control-label' for='" + mdp2 + "'>Nouveau mot de passe</label>"
            + "<input type='password' class='form-control' id='"+ mdp2 +"' value='" + value_mdp2 + "'>"
            + "<span class='glyphicon glyphicon-remove form-control-feedback' aria-hidden='true'></span>"
            + "<span style='color:red;'>Mot de passe incorrect</span>";

            document.getElementById(mdp2).setAttribute("onchange", "verifyPassword('" + mdp1 + "', '" + mdp2 + "', '" + div_mdp1 + "', '" + div_mdp2 + "')");
        }
    }
}
