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
    list_form = new Array('1', '2', '3', '4', '5');

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