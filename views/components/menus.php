<?php

if (!isset($_SESSION["token"])) {

   header("location:../admin/login-exit");
   exit();
}

$ALL_ACCESS =  getAllAccess();

if (count($ALL_ACCESS) <= 0) {
   $message = "Access denied";
   header("Location:../error?msg=$message");
   exit();
}

?>

<div class="iq-sidebar">
   <div class="iq-navbar-logo d-flex justify-content-between">
      <a href="<?php url(); ?>home" class="header-logo">
         <!-- <img src="<?php //url(); 
                        ?>views/images/icon.png" class="img-fluid rounded" alt=""> -->
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
            <?php
            if (in_array('HOME', $ALL_ACCESS)) {
            ?>
               <li <?php active_menu('home', $menu); ?>>
                  <a href="<?php url(); ?>admin/home" class="iq-waves-effect">
                     <span class="ripple rippleEffect"></span><i class="las la-home iq-arrow-left"></i><span>Dashboard</span></a>
               </li>
            <?php }
            ?>

            <?php
            if (in_array('PRODUITS', $ALL_ACCESS)) {
            ?>
               <li <?php active_menu('produit', $menu); ?>>
                  <a href="#ui-produit" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                     <i class="lab la-elementor iq-arrow-left"></i><span>Produits/Services</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                  <ul id="ui-produit" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                     <li><a href="<?php url(); ?>admin/produit"><i class="fa fa-bars"></i>Liste des produits</a></li>
                  </ul>
               </li>
            <?PHP } ?>


            <?php
            if (in_array('IDENTIFICATION', $ALL_ACCESS)) {
            ?>
               <li <?php active_menu('identification', $menu); ?>>
                  <a href="#menu-identification" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false">
                     <i class="fa fa-address-book-o iq-arrow-left"></i><span>Identification</span>
                     <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                  </a>
                  <ul id="menu-identification" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                     <li><a href="<?php url(); ?>admin/membres"><i class="ri-git-commit-line"></i>Liste des membres</a></li>
                     <li><a href="<?php url(); ?>admin/membres-groupes"><i class="ri-git-commit-line"></i>Liste par groupes</a></li>
                  </ul>
               </li>
            <?PHP } ?>

            <?php
            if (in_array('ZONE', $ALL_ACCESS)) {
            ?>
               <li <?php active_menu('zone', $menu); ?>>
                  <a href="<?php url() ?>admin/zones" class="iq-waves-effect">
                     <i class="fa fa-map iq-arrow-left"></i><span>Zones</span>
                     <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                  </a>
               </li>
            <?PHP } ?>
            <?php
            if (in_array('PARAMETRES', $ALL_ACCESS)) {
            ?>
               <li <?php active_menu("parametre", $menu); ?>>
                  <a href="#menu-level" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                     <i class="ri-record-circle-line iq-arrow-left"></i>
                     <span>Paramètres</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                  <ul id="menu-level" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle"> 
                     <li><a href="<?php url(); ?>admin/organisation-entreprise"><i class="ri-record-circle-line"></i>Configuration</a></li> 
                  </ul>
               </li>
            <?PHP } ?>

         </ul>
      </nav>
      <div class="p-3"></div>
   </div>
</div>

<script>

</script>