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
            document.getElementById(destinataire).value = "Dominique Beau - dominique.beau@u-psud.fr";
            document.getElementById(objet).value = "[" + value_inscription + "] Demande de réinscription";
        }
        else{
            if(value_inscription == "TOEIC"){
                document.getElementById(destinataire).value = "Chantal Escudie - chantal.escudie@u-psud.fr";
            }
            else if(value_inscription == "M2R"){
                document.getElementById(destinataire).value = "Emmanuelle Frenoux - emmanuelle.frenoux@u-psud.fr";
            }
            else if(value_inscription == "Sport"){
                document.getElementById(destinataire).value = "Marcelo Bielsa - marcelo.bielsa@u-psud.fr";
            }
            else if(value_inscription == "Bourse"){
                document.getElementById(destinataire).value = "Nadia Chapiteau - nadia.chapiteau@u-psud.fr";
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

/* TODO : modifier l'espace en question dans la BDD */
function suppressionEspace(ID){
    alert(ID);
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