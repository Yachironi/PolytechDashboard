function activateTag(id_tag){
    var list_tag = new Array('main_dashboard', 'my_space_study_level', 'my_program', 'my_tasks', 'assign_task', 'my_grades', 'planning');

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

    /* Mise a jour des notification */
    updateNotificationByCategory(id_tag);
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
function editTask(idTask, dateFin, objet, importance){
    var id_list_formulaire = 'list_form'
    activateTag('assign_task');

    // select
    var select = document.getElementById(id_list_formulaire);
    select.selectedIndex = 7;
    afficheForm(id_list_formulaire)

    // objet
    document.getElementById('objet_form8').value = objet;

    // importance
    var nom_importance = "importance" + importance;
    var id_importance = "id_" + nom_importance + "_form8";
    document.getElementById('id_importance1_form8').classList.remove('importance1-selected');
    document.getElementById('id_importance1_form8').classList.add('importance1');
    document.getElementById(id_importance).classList.remove(nom_importance);
    document.getElementById(id_importance).classList.add(nom_importance + "-selected");

    // dateFin
    // TODO : condition a verifier
    if(dateFin != null){
        var echeance = document.getElementById('echeance_form8');
        echeance.disabled = false;
        echeance.value = dateFin;
        // TODO : si possible, changer la date du datepicker
    }
    document.getElementById('checkbox_form8').checked = true;

    $.ajax({
        type: 'POST',
        url: '/tachesList',
        dataType: 'json',
        success: function (data) {
            $.each(data, function (i, item) {
                if (item.id == idTask) {
                    alert(item.id);
                    $("#texte_form8").html(item.structure);
                    console.log(item.structure);
                }
            })
        }
    });

    // TODO : changer la date de creation et mettre celle d'aujourd'hui
}

/**
 * Lorsque l'etudiant clique sur le bouton supprimer sur une tache qu'il s'est lui meme attribue
 */
// Il faut faire passer la tache en parametre
/* TODO */
function removeTask(ID){
    alert("TODO / ID_task = " + ID);
    // Trouve sur internet :
    //$em->remove($product);
    //$em->flush();
}

/**
 * Lorsque l'etudiant clique sur le bouton Fait sur une tache qu'il s'est lui meme attribue
 */
function doneTask(ID){
    alert("TODO / ID_task = " + ID);
}


/**
 * Lorsque l'etudiant clique sur le bouton repondre sur une tache qu'un gestionnaire lui a attribue
 */
function replyTask(id_title, id_body, id_task, type_task,  nom_task, prenom_dest, nom_dest){

    var type_task = type_task;    // TODO dans la BD type_task pas attribue
    var title = document.getElementById(id_title);
    var body = document.getElementById(id_body);

    title.innerHTML = "Re: Tâche n°" + id_task + " - " + nom_task;

    // justification
    if(type_task == 2){
        body.innerHTML = "<form>" +
        "<div class='form-group'>" +
        "<label>Destinataire : </label> " + prenom_dest + " " + nom_dest + "</div>" +
        "<div class='form-group'>" +
        "<label>Date et durée de l'absence</label>" +
        "<div class='input-group'>" +
        "<div class='input-group-addon'><i class='fa fa-clock-o'></i></div>" +
        "<input type='text' class='form-control pull-right' id='duree_absence_reply'/></div></div>" +
        "<div class='form-group'>" +
        "<label>Motif de justification</label>" +
        "<textarea class='form-control'></textarea></div>" +
        "<div class='form-group'>" +
        "<label for='absence_InputFile_reply'>Sélectionner votre justificatif</label>" +
        "<input type='file' id='absence_InputFile_reply'></div>"
        + "</form>";

        $('#duree_absence_reply').daterangepicker_reply({
            timePicker: true,
            timePicker12Hour:false,
            timePickerIncrement: 15,
            format: 'DD/MM/YYYY H:mm'
        });
    }
    // prendre un rdv. TODO : recuperer l'heure et la date de rdv
    else if(type_task == 3){
        body.innerHTML = "<form>" +
        "<div class='form-group'>" +
        "<label>Destinataire : </label> " + prenom_dest + " " + nom_dest + "</div>" +
        "<div class='form-group'><div class='input-group'><span class='input-group-addon'>" +
        "<input type='radio' name='btn_radio_rdv_reply'></span>" +
        "<input type='text' class='form-control' value='Je confirme la date du rendez-vous : 12/23/4567 12:34(TODO: recuperer la date du rdv)' disabled='disabled'></div></div>" +
        "<div class='form-group'><div class='input-group'><span class='input-group-addon'>" +
        "<input type='radio' name='btn_radio_rdv_reply'></span>" +
        "<input type='text' class='form-control pull-right' id='date_rdv_reply' placeholder='Je choisi une autre date de rendez-vous...'/>" +
        "<div class='input-group-addon'><i class='fa fa-clock-o'></i></div>" +
        "</div></div>"
        + "</form>";

        $('#date_rdv_reply').daterangepicker2_reply({
            timePicker: true,
            timePicker12Hour:false,
            timePickerIncrement: 15,
            format: 'DD/MM/YYYY H:mm'
        });

    }
    // rendre un devoir
    else if(type_task == 4){
        body.innerHTML = "<form>"+
        "<div class='form-group'>" +
        "<label>Destinataire : </label> " + prenom_dest + " " + nom_dest + "</div>" +
        "<div class='form-group'>" +
        "<label for='renduDevoir_InputFile_reply'>Sélectionner votre devoir</label>" +
        "<input type='file' id='renduDevoir_InputFile_reply'></div>" +
        "<div class='form-group'>" +
        "<label>Ajouter un commentaire</label><textarea class='form-control'></textarea></div>"
        + "</form>";
    }
    // valider sujet de stage
    else if(type_task == 6){
        body.innerHTML = "<form>"+
        "<div class='form-group'>" +
        "<label>Destinataire : </label> " + prenom_dest + " " + nom_dest + "</div>" +
        "<div class='form-group'>" +
        "<label>Dates de début et de fin du stage</label>" +
        "<div class='input-group'>" +
        "<div class='input-group-addon'><i class='fa fa-clock-o'></i></div>" +
        "<input type='text' class='form-control pull-right' id='dates_stage_reply'/></div></div>" +
        "<div class='form-group'>" +
        "<label>Détail</label><textarea class='form-control'></textarea></div>"+
        "<div class='form-group'>" +
        "<label for='validStage_InputFile_reply'>Sélectionner un fichier</label>" +
        "<input type='file' id='validStage_InputFile_reply'></div>"
        + "</form>";

        $('#dates_stage_reply').daterangepicker_reply({
            timePicker: false,
            format: 'DD/MM/YYYY'
        });
    }
    // autre
    else{
        body.innerHTML = "<form>"+
        "<div class='form-group'>" +
        "<label>Destinataire : </label> " + prenom_dest + " " + nom_dest + "</div>" +
        "<label>Texte</label>" +
        "<textarea class='form-control'></textarea></div>" +
        "<div class='form-group'>" +
        "<label for='demandeNonRepertoriee_InputFile_reply'>Sélectionner un fichier</label>" +
        "<input type='file' id='demandeNonRepertoriee_InputFile_reply'></div>"
        + "</form>";
    }
}

function sendReply(){
    alert("TODO : faire le JS lorsqu'on envoie la réponse (BD + modifier HTML)");
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
    
    var tmp = 'importance'+id_importance_selected.substring(14);
    
    oFormObject = document.forms['insertTaskForm'];
    
    oFormObject.elements[tmp].value = id_importance_selected.substring(13,14);
    
//    document.getElementById(tmp).value = id_importance_selected.substring(13,14);
//    var value = document.getElementById(tmp).value;
    console.log("nom de l'input : "+tmp+" id : "+id_importance_selected.substring(13,14));
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

                document.getElementById(div_mdp2).innerHTML = "<label class='control-label' for='" + mdp2 + "'>Confirmation du mot de passe</label>"
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

                    document.getElementById(div_mdp2).innerHTML = "<label class='control-label' for='" + mdp2 + "'>Confirmation du mot de passe</label>"
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

                    document.getElementById(div_mdp2).innerHTML = "<label class='control-label' for='" + mdp2 + "'>Confirmation du mot de passe</label>"
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

                document.getElementById(div_mdp2).innerHTML = "<label class='control-label' for='" + mdp2 + "'>Confirmation du mot de passe</label>"
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

                document.getElementById(div_mdp2).innerHTML = "<label class='control-label' for='" + mdp2 + "'>Confirmation du mot de passe</label>"
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

            document.getElementById(div_mdp2).innerHTML = "<label class='control-label' for='" + mdp2 + "'>Confirmation du mot de passe</label>"
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

            document.getElementById(div_mdp2).innerHTML = "<label class='control-label' for='" + mdp2 + "'>Confirmation du mot de passe</label>"
            + "<input type='password' class='form-control' id='"+ mdp2 +"' value='" + value_mdp2 + "'>"
            + "<span class='glyphicon glyphicon-remove form-control-feedback' aria-hidden='true'></span>"
            + "<span style='color:red;'>Mot de passe incorrect</span>";

            document.getElementById(mdp2).setAttribute("onchange", "verifyPassword('" + mdp1 + "', '" + mdp2 + "', '" + div_mdp1 + "', '" + div_mdp2 + "')");
        }
    }
}

document.addEventListener("DOMContentLoaded", function(event) { 
	$("#buttonEnregistrerEtudiant").click(function() {
		 

		$.ajax({
	        type: 'POST',
	        url: '/updateEtudiant',
	        dataType: 'json',
	        data: {'email': $('#profil_InputEmail').val(),'password': $('#profil_InputPassword2').val(),'telephone': $('#profil_InputTel').val()},
	        success: function(data){
	        	
	        }
	    });
		
	});

    $("#EnvoyerTaskToInsert").click(function() {
   // $("#result").click(function() {
       //console.log($('#insertTaskForm').serializeArray());
    	  event.preventDefault();


        var formData = {};
        $('#insertTaskForm').serializeArray().map(function(item) {
            if ( formData[item.name] ) {
                if ( typeof(formData[item.name]) === "string" ) {
                    formData[item.name] = [formData[item.name]];
                }
                formData[item.name].push(item.value);
            } else {
                formData[item.name] = item.value;
            }
        });

        console.log(formData);
        $.ajax({
            type: 'POST',
            url: '/insertTask',
            dataType: 'json',
            data: formData,
            success: function(data){
                console.log("success");
                console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                console.log()
                var w = window.open();
                var html = xhr.responseText;

                $(w.document.body).html(html);
            }

        });
        console.log("fin ajax");


    });
});

