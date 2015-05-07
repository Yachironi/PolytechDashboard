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
        if(form.style.display == "block" && i != indice_form_a_affiche){
            form.style.display = "none";
            // On efface les elements
            if(i == 1){
                document.getElementById('duree_absence').value = "";
                document.getElementById('motif_justification_absence').value = "";
                document.getElementById('absence_InputFile').value = "";
                clickOnImportance('id_importance1_form2', 'id_importance2_form2', 'id_importance3_form2');
                /**/
            }
            else if(i == 2){
                document.getElementById('destinataire_form3').value = "";
                document.getElementById('date_rdv').value = "";
                document.getElementById('motif_rdv').value = "";
                clickOnImportance('id_importance1_form3', 'id_importance2_form3', 'id_importance3_form3');
            }
            else if(i == 3){
                document.getElementById('list_cours').selectedIndex = 0;
                document.getElementById('list_devoirs').selectedIndex = 0;
                document.getElementById('objet_form4').value = "";
                document.getElementById('renduDevoir_InputFile').value = "";
                document.getElementById('commentaire_rendu_devoir').value = "";
            }

            else if(i == 4){
                document.getElementById('list_inscription').selectedIndex= 0;
                document.getElementById('destinataire_form5').value = "";
                document.getElementById('objet_form5').value = "";
                document.getElementById('motif_inscription').value = "";
                document.getElementById('inscription_InputFile').value = "";
                clickOnImportance('id_importance1_form5', 'id_importance2_form5', 'id_importance3_form5');
                /**/
            }
            else if(i == 5){
                document.getElementById('dates_stage').value = "";
                document.getElementById('detail_stage').value = "";
                document.getElementById('validStage_InputFile').value = "";
                clickOnImportance('id_importance1_form6', 'id_importance2_form6', 'id_importance3_form6');
                /**/
            }
            else if(i == 6){
                document.getElementById('remarque_stage').value = "";
                document.getElementById('pdf_convention_InputFile').value = "";
                clickOnImportance('id_importance1_form7', 'id_importance2_form7', 'id_importance3_form7');
                /**/
            }
            else if(i == 7){

                document.getElementById('objet_form8').value = "";
                document.getElementById('texte_form8').value = "";
                document.getElementById('taskPerso_InputFile').value = "";
                clickOnImportance('id_importance1_form8', 'id_importance2_form8', 'id_importance3_form8');
                /**/
            }
            else if(i == 8){
                document.getElementById('objet_form9').value = "";
                document.getElementById('text_autre_demande').value = "";
                document.getElementById('demandeNonRepertoriee_InputFile').value = "";
                clickOnImportance('id_importance1_form9', 'id_importance2_form9', 'id_importance3_form9');
                /**/
            }
        }
    }
    /* On affiche le formulaire passé en paramètre */
    alert(indice_form_a_affiche);
    document.getElementById(list_form[indice_form_a_affiche]).style.display = "block";
    if(indice_form_a_affiche == 0){
        document.getElementById('div_btn_envoyerTaskToInsert').style.display = "none";
    }
    else{
        document.getElementById('div_btn_envoyerTaskToInsert').style.display = "block";
    }
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

function editTask(idTask, dateFin,objet, importance, texte) {

    $("#modal_editTask").modal();
    console.log("importance =====> "+importance);
    clickOnImportanceEditTask(parseInt(importance));

    $("#TaskForm_objet_form8").val(objet);
    $("#TaskForm_texte_form8").val(texte);
    $("#TaskForm_idTask_form8").val(idTask);
    if(dateFin!=null){
        $("#TaskForm_checkbox_form8").prop( "checked", true );
        $("#TaskForm_echeance_form8").prop('disabled', false);
        $("#TaskForm_echeance_form8").val(dateFin);
    }else{
        $("#TaskForm_checkbox_form8").prop( "checked", false );
        $("#TaskForm_echeance_form8").prop('disabled', true);
    }
    $("#TaskForm_echeance_form8").daterangepicker2({
            timePicker: true,
            timePicker12Hour:false,
            timePickerIncrement: 15,
            format: 'DD/MM/YYYY H:mm'
        });
  /*  var id_list_formulaire = 'list_form'
    activateTag('assign_task');

    // select
    var select = document.getElementById(id_list_formulaire);
    select.selectedIndex = 7;
    afficheForm(id_list_formulaire);

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
*/
  /*  $.ajax({
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
*/
    // TODO : changer la date de creation et mettre celle d'aujourd'hui
}

/**
 * Lorsque l'etudiant clique sur le bouton supprimer sur une tache qu'il s'est lui meme attribue
 */
// Il faut faire passer la tache en parametre
/* TODO */
function removeTask(ID){
    //alert("TODO / ID_task = " + ID);

    // Trouve sur internet :
    //$em->remove($product);
    //$em->flush();

    $.ajax({
        type: 'POST',
        url: '/removeTask',
        dataType: 'json',
        data: {'id':ID},
        success: function(data){
            console.log("success");
            console.log(data);

            $.ajax({
                type: 'POST',
                url: '/getMytasksRendred',
                success: function(data){
                    console.log("success================> getMytasksRendred");
                    //  $("my_tasks").append("#####################################");
                    $("#my_tasks").html(data);
                    $(function () {
                        $(".table-task").dataTable({
                            "bAutoWidth": false,
                            "aoColumns": [
                                null,
                                null,
                                null,
                                null,
                                null,
                                null,
                                {"bSortable": false, "bSearchable": false},
                            ]
                        });
                    });
                    /*var w = window.open();
                     var html = data;

                     $(w.document.body).html(html);*/
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

function modif_reply_task(){


    if($("#input_reply_task_3_rad2").is(':checked')){
        console.log("input_reply_task_3_rad2");
        $("#input_reply_task_3_dateRDVModif").prop('disabled', false);
    }else {
        $("#input_reply_task_3_dateRDVModif").prop('disabled', true);

        console.log("input_reply_task_3_rad1");
    }

}

/**
 * Lorsque l'etudiant clique sur le bouton repondre sur une tache qu'un gestionnaire lui a attribue
 */
function replyTask(id_title, id_body, id_task, type_task,  nom_task, prenom_dest, nom_dest,id_admin){

    var type_task = type_task;    // TODO dans la BD type_task pas attribue
    var title = document.getElementById(id_title);
    var body = document.getElementById(id_body);

    title.innerHTML = "Re: Tâche n°" + id_task + " - " + nom_task;

    // justification

    if(type_task == 2){

        body.innerHTML = "<form id='form_reply_task_2'>" +
        "<input type='hidden' name='nom' value='"+nom_task+"'>"+
        "<input type='hidden' name='type' value='"+type_task+"'>"+
        "<input type='hidden' name='id' value='"+id_task+"'>"+
        "<input type='hidden' name='idGestionnaire' value='"+id_admin+"'>"+
        "<div class='form-group'>" +
        "<label>Destinataire : </label> " + prenom_dest + " " + nom_dest + "</div>" +
        "<div class='form-group'>" +
        "<label>Date et durée de l'absence</label>" +
        "<div class='input-group'>" +
        "<div class='input-group-addon'><i class='fa fa-clock-o'></i></div>" +
        "<input type='text' class='form-control pull-right' id='input_reply_task_2_duree_absence' name='input_reply_task_2_duree_absence' disabled='true'/></div></div>" +
        "<div class='form-group'>" +
        "<label>Motif de justification</label>" +
        "<textarea class='form-control' id='input_reply_task_2_justification' name='input_reply_task_2_justification' disabled='true'></textarea></div>" +
        "<div class='form-group'>" +
        "<label for='absence_InputFile_reply'>Sélectionner votre justificatif</label>" +
        "<input type='file' id='input_reply_task_2_file' name='input_reply_task_2_file'></div>"
        + "</form>";

        $('#input_reply_task_2_duree_absence').daterangepicker_reply({
            timePicker: true,
            timePicker12Hour:false,
            timePickerIncrement: 15,
            format: 'YYYY-MM-DD H:mm'
        });
    }
    // prendre un rdv. TODO : recuperer l'heure et la date de rdv
    else if(type_task == 3){

        $('input[type=radio][name=input_reply_task_3_modif]').change(function() {
            console.log('change');
            /* if (this.value == 'allot') {
             alert("Allot Thai Gayo Bhai");
             }
             else if (this.value == 'transfer') {
             alert("Transfer Thai Gayo");
             }*/
        });

        body.innerHTML = "<form id='form_reply_task_3'>" +
        "<input type='hidden' name='nom' value='"+nom_task+"'>"+
        "<input type='hidden' name='type' value='"+type_task+"'>"+
        "<input type='hidden' name='id' value='"+id_task+"'>"+
        "<input type='hidden' name='idGestionnaire' value='"+id_admin+"'>"+
        "<div class='form-group'>" +
        "<label>Destinataire : </label> " + prenom_dest + " " + nom_dest + "</div>" +
        "<div class='form-group'><div class='input-group'><span class='input-group-addon'>" +
        "<input type='radio' id='input_reply_task_3_rad1' name='input_reply_task_3_modif' onchange='modif_reply_task()'  value='1' checked></span>" +
        "<input type='text' id='input_reply_task_3_dateRDV' name='input_reply_task_3_dateRDV' class='form-control'   value='2016-05-20 08:00' disabled></div></div>" +
        "<div class='form-group'><div class='input-group'><span class='input-group-addon'>" +
        "<input type='radio' id='input_reply_task_3_rad2' name='input_reply_task_3_modif' onchange='modif_reply_task()' value='2'></span>" +
        "<input type='text' id='input_reply_task_3_dateRDVModif' name='input_reply_task_3_dateRDVModif'class='form-control pull-right'   placeholder='Je choisi une autre date de rendez-vous...' disabled/>" +
        "<div class='input-group-addon'><i class='fa fa-clock-o'></i></div>" +
        "</div></div>"
        + "</form>";

        $('#input_reply_task_3_dateRDVModif').daterangepicker2_reply({
            timePicker: true,
            timePicker12Hour:false,
            timePickerIncrement: 15,
            format: 'YYYY-MM-DD H:mm'
        });

    }
    // rendre un devoir
    else if(type_task == 4){
        body.innerHTML = "<form id='form_reply_task_4'>"+
        "<input type='hidden' name='nom' value='"+nom_task+"'>"+
        "<input type='hidden' name='type' value='"+type_task+"'>"+
        "<input type='hidden' name='id' value='"+id_task+"'>"+
        "<input type='hidden' name='idGestionnaire' value='"+id_admin+"'>"+
        "<div class='form-group'>" +
        "<label>Destinataire : </label> " + prenom_dest + " " + nom_dest + "</div>" +
        "<div class='form-group'>" +
        "<label for='input_reply_task_4_renduDevoir'>Sélectionner votre devoir</label>" +
        "<input type='file' id='input_reply_task_4_renduDevoir' name='input_reply_task_4_renduDevoir' ></div>" +
        "<div class='form-group'>" +
        "<label>Ajouter un commentaire</label><textarea class='form-control' id='input_reply_task_4_commentaire' name='input_reply_task_4_commentaire' ></textarea></div>"
        + "</form>";
    }
    // valider sujet de stage
    else if(type_task == 6){
        body.innerHTML = "<form id='form_reply_task_6'>"+
        "<input type='hidden' name='nom' value='"+nom_task+"'>"+
        "<input type='hidden' name='type' value='"+type_task+"'>"+
        "<input type='hidden' name='id' value='"+id_task+"'>"+
        "<input type='hidden' name='idGestionnaire' value='"+id_admin+"'>"+
        "<div class='form-group'>" +
        "<label>Destinataire : </label> " + prenom_dest + " " + nom_dest + "</div>" +
        "<div class='form-group'>" +
        "<label>Dates de début et de fin du stage</label>" +
        "<div class='input-group'>" +
        "<div class='input-group-addon'><i class='fa fa-clock-o'></i></div>" +
        "<input type='text' class='form-control pull-right' id='input_reply_task_6_date' name='input_reply_task_6_date' /></div></div>" +
        "<div class='form-group'>" +
        "<label>Détail</label><textarea class='form-control' id='input_reply_task_6_detail' name='input_reply_task_6_detail'></textarea></div>"+
        "<div class='form-group'>" +
        "<label for='validStage_InputFile_reply'>Sélectionner un fichier</label>" +
        "<input type='file' id='input_reply_task_6_file' name='input_reply_task_6_file'></div>"
        + "</form>";

        $('#input_reply_task_6_date').daterangepicker_reply({
            timePicker: false,
            format: 'YYYY-MM-DD H:mm'
        });
    }
    // autre
    else{
        body.innerHTML = "<form id='form_reply_task_9'>"+
        "<input type='hidden' name='nom' value='"+nom_task+"'>"+
        "<input type='hidden' name='type' value='"+type_task+"'>"+
        "<input type='hidden' name='id' value='"+id_task+"'>"+
        "<input type='hidden' name='idGestionnaire' value='"+id_admin+"'>"+
        "<div class='form-group'>" +
        "<label>Destinataire : </label> " + prenom_dest + " " + nom_dest + "</div>" +
        "<label>Texte</label>" +
        "<textarea class='form-control' id='input_reply_task_9_texte' name='input_reply_task_9_texte'></textarea></div>" +
        "<div class='form-group'>" +
        "<label for='demandeNonRepertoriee_InputFile_reply'>Sélectionner un fichier</label>" +
        "<input type='file' id='input_reply_task_9_file' name='input_reply_task_9_file'></div>"
        + "</form>";
    }
}

function sendReply(){
    //alert("TODO : faire le JS lorsqu'on envoie la réponse (BD + modifier HTML)");

    /*    console.log($('#form_reply_task_2').serializeArray());
     console.log($('#form_reply_task_3').serializeArray());
     console.log($('#form_reply_task_4').serializeArray());
     console.log($('#form_reply_task_6').serializeArray());
     console.log($('#form_reply_task_9').serializeArray());
     */


    var formData = {};
    $('#form_reply_task_2').serializeArray().map(function(item) {
        if ( formData[item.name] ) {
            if ( typeof(formData[item.name]) === "string" ) {
                formData[item.name] = [formData[item.name]];
            }
            formData[item.name].push(item.value);
        } else {
            formData[item.name] = item.value;
        }
    });
    var formData2 = formData;

    var formData = {};
    $('#form_reply_task_3').serializeArray().map(function(item) {
        if ( formData[item.name] ) {
            if ( typeof(formData[item.name]) === "string" ) {
                formData[item.name] = [formData[item.name]];
            }
            formData[item.name].push(item.value);
        } else {
            formData[item.name] = item.value;
        }
    });
    var formData3 = formData;

    var formData = {};
    $('#form_reply_task_4').serializeArray().map(function(item) {
        if ( formData[item.name] ) {
            if ( typeof(formData[item.name]) === "string" ) {
                formData[item.name] = [formData[item.name]];
            }
            formData[item.name].push(item.value);
        } else {
            formData[item.name] = item.value;
        }
    });
    var formData4 = formData;

    var formData = {};
    $('#form_reply_task_6').serializeArray().map(function(item) {
        if ( formData[item.name] ) {
            if ( typeof(formData[item.name]) === "string" ) {
                formData[item.name] = [formData[item.name]];
            }
            formData[item.name].push(item.value);
        } else {
            formData[item.name] = item.value;
        }
    });
    var formData6 = formData;

    var formData = {};
    $('#form_reply_task_9').serializeArray().map(function(item) {
        if ( formData[item.name] ) {
            if ( typeof(formData[item.name]) === "string" ) {
                formData[item.name] = [formData[item.name]];
            }
            formData[item.name].push(item.value);
        } else {
            formData[item.name] = item.value;
        }
    });
    var formData9 = formData;

    console.log("=====");
    console.log(formData2);
    console.log(formData3);
    console.log(formData4);
    console.log(formData6);
    console.log(formData9);
    console.log("=====");

    var FormToSend;
    if(!jQuery.isEmptyObject(formData2))
        FormToSend=formData2;
    if(!jQuery.isEmptyObject(formData3))
        FormToSend=formData3;
    if(!jQuery.isEmptyObject(formData4))
        FormToSend=formData4;
    if(!jQuery.isEmptyObject(formData6))
        FormToSend=formData6;
    if(!jQuery.isEmptyObject(formData9))
        FormToSend=formData9;



    $.ajax({
        type: 'POST',
        url: '/insertReplayTask',
        dataType: 'json',
        data: FormToSend,
        success: function(data) {
            console.log("success");
            console.log("Reponse serveur : ");
            console.log(data);
            $.ajax({
                type: 'POST',
                url: '/getMytasksRendred',
                success: function(data) {
                    $("#my_tasks").html(data);

                    $(function() {
                        $(".table-task").dataTable({
                            "bAutoWidth": false,
                            "aoColumns": [
                                null,
                                null,
                                null,
                                null,
                                null,
                                null, {
                                    "bSortable": false,
                                    "bSearchable": false
                                },
                            ]
                        });
                    });

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    console.log()
                    var w = window.open();
                    var html = xhr.responseText;

                    $(w.document.body).html(html);
                }
            });

            generateNotification('success', "Success")
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log()
            var w = window.open();
            var html = xhr.responseText;

            $(w.document.body).html(html);
        }

    });

     console.log("fin ajax");

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
function updateInscription(inscription, destinataire, objet,gestionnaireAdmin,gestionnaireToeic,gestionnaireM2R,gestionnaireSport,gestionnaireBourse){
    var select_inscription = document.getElementById(inscription);
    var value_inscription = select_inscription.options[select_inscription.selectedIndex].value;
    if(value_inscription != ""){
        if(value_inscription == "Polytech"){
            document.getElementById(destinataire).value = gestionnaireAdmin;
            document.getElementById(objet).value = "[" + value_inscription + "] Demande de réinscription";
        }
        else{
            if(value_inscription == "TOEIC"){
                document.getElementById(destinataire).value = gestionnaireToeic;
            }
            else if(value_inscription == "M2R"){
                document.getElementById(destinataire).value = gestionnaireM2R;
            }
            else if(value_inscription == "Sport"){
                document.getElementById(destinataire).value = gestionnaireSport;
            }
            else if(value_inscription == "Bourse"){
                document.getElementById(destinataire).value = gestionnaireBourse;
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
    
    var inputName = 'importance'+id_importance_selected.substring(14);
    
    console.log(inputName);

    oFormObject = document.forms['insertTaskForm'];
    console.log(document.getElementById(inputName))
    
    console.log(document.getElementById(inputName).value);
    document.getElementById(inputName).value = id_importance_selected.substring(13,14);
    console.log(document.getElementById(inputName).value);

//    document.getElementById(tmp).value = id_importance_selected.substring(13,14);
//    var value = document.getElementById(tmp).value;
    console.log("nom de l'input : "+inputName+" id : "+id_importance_selected.substring(13,14));
}

function clickOnImportanceEditTask(id){

    console.log(id);
    switch(id) {
        case 1:
            $("#TaskForm_id_importance1_form8").removeClass('importance1');
            $("#TaskForm_id_importance1_form8").addClass('importance1-selected');
            $("#TaskForm_id_importance2_form8").removeClass('importance2-selected');
            $("#TaskForm_id_importance2_form8").addClass('importance2')
            $("#TaskForm_id_importance3_form8").removeClass('importance3-selected');
            $("#TaskForm_id_importance3_form8").addClass('importance3');
            $("#TaskForm_importance_form8").val(1);
            break;
        case 2:
            console.log("set imortance => "+id);
            $("#TaskForm_id_importance1_form8").removeClass('importance1-selected');
            $("#TaskForm_id_importance1_form8").addClass('importance1');
            $("#TaskForm_id_importance2_form8").removeClass('importance2');
            $("#TaskForm_id_importance2_form8").addClass('importance2-selected')
            $("#TaskForm_id_importance3_form8").removeClass('importance3-selected');
            $("#TaskForm_id_importance3_form8").addClass('importance3');
            $("#TaskForm_importance_form8").val(2);
            break;
        case 3:
            console.log(id);
            $("#TaskForm_id_importance1_form8").removeClass('importance1-selected');
            $("#TaskForm_id_importance1_form8").addClass('importance1');
            $("#TaskForm_id_importance2_form8").removeClass('importance2-selected');
            $("#TaskForm_id_importance2_form8").addClass('importance2')
            $("#TaskForm_id_importance3_form8").removeClass('importance3');
            $("#TaskForm_id_importance3_form8").addClass('importance3-selected');
            $("#TaskForm_importance_form8").val(3);
            break;
        default:
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

/* Permet de faire un affichage dynamique des formulaires lorsqu'on veut attribuer une tache */
function afficheFormEditTask(ID){
    $(".token-input-dropdown-facebook").css("width", $('#list_form').width()-13);

    list_form = new Array('TaskForm1', 'TaskForm2', 'TaskForm3', 'TaskForm4', 'TaskForm5', 'TaskForm6',
        'TaskForm7', 'TaskForm8', 'TaskForm9');

    var indice_form_a_affiche = document.getElementById(ID).selectedIndex;
   // var indice_form_a_affiche = ID;
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
       console.log($('#insertTaskForm').serializeArray());
    	  event.preventDefault();

    	    console.log("CLICK BOUTON ENVOYER");

        var formData = {};
        $('#insertTaskFormNew').serializeArray().map(function(item) {
            if ( formData[item.name] ) {
                if ( typeof(formData[item.name]) === "string" ) {
                    formData[item.name] = [formData[item.name]];
                }
                formData[item.name].push(item.value);
            } else {
                formData[item.name] = item.value;
            }
        });

        console.log("DATA : ");
        console.log(formData);
        $.ajax({
            type: 'POST',
            url: '/insertTask',
            dataType: 'json',
            data: formData,
            success: function(data){
                console.log("success");
                console.log(data);
                $.ajax({
                    type: 'POST',
                    url: '/getMytasksRendred',
                    success: function(data){
                        console.log("success================> getMytasksRendred");
                        //  $("my_tasks").append("################################# ####");
                        $("#my_tasks").html(data);

                        $(function () {
                            $(".table-task").dataTable({
                                "bAutoWidth": false,
                                "aoColumns": [
                                    null,
                                    null,
                                    null,
                                    null,
                                    null,
                                    null,
                                    {"bSortable": false, "bSearchable": false},
                                ]
                            });
                        });
                        /*var w = window.open();
                         var html = data;

                         $(w.document.body).html(html);*/
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
                /* afficher le formulaire 1*/
                document.getElementById('list_form').selectedIndex = 0;
                afficheForm('list_form');
                generateNotification('success', "Tache ajoutée a la base de donnée")
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




function updateTask(id){

    var formData = {};
    $('#'+id).serializeArray().map(function(item) {
        if ( formData[item.name] ) {
            if ( typeof(formData[item.name]) === "string" ) {
                formData[item.name] = [formData[item.name]];
            }
            formData[item.name].push(item.value);
        } else {
            formData[item.name] = item.value;
        }
    });
    //console.log(formData);
    formData.TaskForm_echeance_form8 = formData.TaskForm_echeance_form8.replace(/\//g,"-");
   // console.log(formData.TaskForm_echeance_form8);
        $.ajax({
                type: 'POST',
                url: '/updateTask',
                dataType: 'json',
                data: formData,
            success: function(data){
              //  console.log("success");
               // console.log("le php a retourné => "+data);

                $.ajax({
                    type: 'POST',
                    url: '/getMytasksRendred',
                    success: function(data){
                        console.log("success================> getMytasksRendred");
                      //  $("my_tasks").append("################################# ####");
                       $("#my_tasks").html(data);

                        $(function () {
                            $(".table-task").dataTable({
                                "bAutoWidth": false,
                                "aoColumns": [
                                    null,
                                    null,
                                    null,
                                    null,
                                    null,
                                    null,
                                    {"bSortable": false, "bSearchable": false},
                                ]
                            });
                        });
                        /*var w = window.open();
                        var html = data;

                        $(w.document.body).html(html);*/
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

    $('#insertTaskForm').trigger("reset");

}

function suprimeVALIDTask(){

    console.log("appel remove==========>");
    $.ajax({
        type: 'POST',
        url: '/removeValidTask',
        success: function(data){
            //  console.log("success");
            // console.log("le php a retourné => "+data);
            generateNotification('success','opération terminée avec succès');
            $.ajax({
                type: 'POST',
                url: '/getMytasksRendred',
                success: function(data){
                    console.log("success================> getMytasksRendred");
                    //  $("my_tasks").append("################################# ####");
                    $("#my_tasks").html(data);

                    $(function () {
                        $(".table-task").dataTable({
                            "bAutoWidth": false,
                            "aoColumns": [
                                null,
                                null,
                                null,
                                null,
                                null,
                                null,
                                {"bSortable": false, "bSearchable": false},
                            ]
                        });
                    });
                    /*var w = window.open();
                     var html = data;

                     $(w.document.body).html(html);*/
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

    $('#insertTaskForm').trigger("reset");
}


function suprimeVALIDTaskSended(){

    console.log("appel remove==========>");
    $.ajax({
        type: 'POST',
        url: '/removeSendedValidTask',
        success: function(data){
            //  console.log("success");
            // console.log("le php a retourné => "+data);
            generateNotification('success','opération terminée avec succès');
            $.ajax({
                type: 'POST',
                url: '/getMytasksRendred',
                success: function(data){
                    console.log("success================> getMytasksRendred");
                    //  $("my_tasks").append("################################# ####");
                    $("#my_tasks").html(data);

                    $(function () {
                        $(".table-task").dataTable({
                            "bAutoWidth": false,
                            "aoColumns": [
                                null,
                                null,
                                null,
                                null,
                                null,
                                null,
                                {"bSortable": false, "bSearchable": false},
                            ]
                        });
                    });
                    /*var w = window.open();
                     var html = data;

                     $(w.document.body).html(html);*/
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

    $('#insertTaskForm').trigger("reset");
}

function generateNotification(type, text) {

    var n = noty({
        text        : text,
        type        : type,
        layout      : 'topRight', /* bottomRight */
        theme       : 'relax',
        maxVisible  : 1,
        timeout: 1000
    });
    console.log('html: ' + n.options.id);
}
