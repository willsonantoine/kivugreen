<?php

if (!isset($_SESSION["token"])) {
   header("location:../admin/login-exit");
   exit();
}


?>

<div class="iq-sidebar">
   <div class="iq-navbar-logo d-flex justify-content-between">
      <a href="<?php url(); ?>home" class="header-logo">
         <span>KIVUGREEN</span>
      </a>
      <div class="iq-menu-bt align-self-center">
         <div class="wrapper-menu">
            <div class="main-circle"><i class="ri-menu-line"></i></div>
            <div class="hover-circle"><i class="ri-close-fill"></i></div>
         </div>
      </div>
   </div>
   <div id="sidebar-scrollbar">
      <nav class="iq-sidebar-menu">
         <ul id="iq-sidebar-toggle" class="iq-menu">

            <li <?php active_menu('home', $menu); ?>>
               <a href="<?php url(); ?>admin/home" class="iq-waves-effect">
                  <span class="ripple rippleEffect"></span><i class="las la-home iq-arrow-left"></i><span>Dashboard</span></a>
            </li>


            <li <?php active_menu('information', $menu); ?>>
               <a href="#ui-information" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                  <i class="lab la-elementor iq-arrow-left"></i><span>Informations du marché</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
               <ul id="ui-information" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                  <li><a href="<?php url(); ?>admin/informations"><i class="fa fa-bars"></i>Liste des collectes</a></li>
                  <li><a href="<?php url(); ?>admin/collecte"><i class="fa fa-bars"></i>Collete d'informations</a></li>
                  <li><a href="<?php url(); ?>admin/abonnement"><i class="fa fa-bars"></i>Formulaire d'abonnement</a></li>
                  <li><a href="<?php url(); ?>admin/abonnement-list"><i class="fa fa-bars"></i>Liste des abonnées</a></li>
               </ul>
            </li>
 

            <li <?php active_menu('message-list', $menu); ?>>
               <a href="<?php url(); ?>admin/message-list" class="iq-waves-effect">
                  <span class="ripple rippleEffect"></span><i class="fa fa-envelope-o iq-arrow-left"></i><span>Messages</span></a>
            </li>

            

            <li <?php active_menu('produit', $menu); ?>>
               <a href="#ui-produit" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                  <i class="lab la-elementor iq-arrow-left"></i><span>Produits/Services</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
               <ul id="ui-produit" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                  <li><a href="<?php url(); ?>admin/produit"><i class="fa fa-bars"></i>Liste des produits</a></li>
               </ul>
            </li>

            <li <?php active_menu('utilisateurs', $menu); ?>>
               <a href="#menu-identification" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false">
                  <i class="fa fa-address-book-o iq-arrow-left"></i><span>Utilisateurs</span>
                  <i class="ri-arrow-right-s-line iq-arrow-right"></i>
               </a>
               <ul id="menu-identification" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                  <li><a href="<?php url(); ?>admin/utilisateurs"><i class="ri-git-commit-line"></i>Liste des utlisateurs</a></li>
                  <li><a href="<?php url(); ?>admin/membres-groupes"><i class="ri-git-commit-line"></i>Liste des utilisateurs par zones</a></li>
               </ul>
            </li>

            <li <?php active_menu('zone', $menu); ?>>
               <a href="<?php url() ?>admin/zones" class="iq-waves-effect">
                  <i class="fa fa-map iq-arrow-left"></i><span>Zones</span>
                  <i class="ri-arrow-right-s-line iq-arrow-right"></i>
               </a>
            </li>

            <li <?php active_menu("conseil-agricole", $menu); ?>>
               <a href="#menu-conseil-agricole" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                  <i class="ri-record-circle-line iq-arrow-left"></i>
                  <span>Conseil agricole</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
               <ul id="menu-conseil-agricole" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                  <li><a href="<?php url(); ?>admin/conseil-agricole"><i class="ri-record-circle-line"></i>Liste des conseilles</a></li>
                  <li><a href="<?php url(); ?>admin/abonnement-conseil"><i class="ri-record-circle-line"></i>Abonnement</a></li>
               </ul>
            </li>

            <li <?php active_menu("parametre", $menu); ?>>
               <a href="#menu-level" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                  <i class="ri-record-circle-line iq-arrow-left"></i>
                  <span>Paramètres</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
               <ul id="menu-level" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                  <li><a href="<?php url(); ?>admin/organisation-entreprise"><i class="ri-record-circle-line"></i>Configuration</a></li>
               </ul>
            </li>

         </ul>
      </nav>
      <div class="p-3"></div>
   </div>
</div>

<script>

</script>