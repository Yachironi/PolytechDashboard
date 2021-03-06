<script type="text/javascript" src="monJS.js"></script>

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <!-- TITRE DE LA BARRE DE NAVIGATION (SUR LA GAUCHE) -->
        <li class="header">MAIN NAVIGATION</li>
        <!-- Onglet ma formation -->
        <li>
            <a href="#" onclick="activateTag('my_study_level')">
                <i class="fa fa-graduation-cap"></i> <span>Ma formation</span>       <!-- Modifier icone -->
                <i class="fa fa-angle-left pull-right"></i>
            </a>
        </li>
        <!-- Onglet taches -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-table"></i> <span>Tâches</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <!-- Liste de sous-onglets : taches attribuées et mes taches -->
            <ul class="treeview-menu">
                <li><a href="#" onclick="activateTag('my_tasks')"><i class="fa fa-circle-o"></i>Mes tâches</a></li>
                <li><a href="#" onclick="activateTag('assign_task')"><i class="fa fa-circle-o"></i>Attribuer une tache</a></li>
            </ul>
        </li>
        <!-- Onglet notes -->
        <li>
            <a href="#" onclick="activateTag('my_grades')">
                <i class="fa fa-list-alt"></i> <span>Mes notes</span>      <!-- Modifier icone -->
                <i class="fa fa-angle-left pull-right"></i>
            </a>
        </li>
        <!-- Onglet Planning -->
        <li>
            <a href="#" onclick="activateTag('planning')">
                <i class="fa fa-calendar"></i> <span>Planning</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
        </li>
        <!-- Onglet "mes notifications" -->
        <li>
            <a href="#" onclick="activateTag('my_notifications')">
                <i class="fa fa-bell"></i> <span>Mes notifications</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
        </li>
        <li>
            <a href="#" onclick="activateTag('contact')">
                <i class="fa fa-envelope"></i> <span>Contacter quelqu'un</span>     <!-- Modifier icone -->
                <i class="fa fa-angle-left pull-right"></i>
            </a>
        </li>

        <!-- Plusieurs onglets utiles pour regarder l'interface, à enlever quand on en aura plus besoin -->
        <li class="header">A SUPPRIMER</li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-laptop"></i>
                <span>UI Elements (a enlever)</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i> <span>Forms (a enlever)</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-folder"></i> <span>Login, ... (a enlever)</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            </ul>
        </li>
        <li><a href="documentation/index.html"><i class="fa fa-book"></i> Informations sur le code (a enlever)</a></li>
    </ul>
</section>
<!-- /.sidebar -->