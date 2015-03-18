list_tag = new Array('main_dashboard', 'my_study_level', 'my_tasks', 'assign_task', 'my_grades', 'planning', 'my_notifications', 'contact');

function activateTag(id_tag){
    var i;
    var size = list_tag.length;

    /* On cache les div qu'il faut caché */
    for(i=0; i<size; i++){
        var tag = document.getElementById(list_tag[i]);
        /** PB : tag est null **/
        if(tag.style.display == "block"){
            tag.style.display = "none";
        }
    }

    /* On affiche l'onglet passé en paramètre */
    document.getElementById(id_tag).style.display = "block";
}