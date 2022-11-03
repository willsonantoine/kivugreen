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
         <!-- <img src="<?php //url(); ?>views/images/icon.png" class="img-fluid rounded" alt=""> -->
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
            <?php } else {
            ?>
               <li <?php active_menu('profil', $menu); ?>>
                  <a href="<?php url(); ?>admin/show-profil/<?php echo $_SESSION["id"]; ?>" class="iq-waves-effect">
                     <span class="ripple rippleEffect"></span><i class="las la-user iq-arrow-left"></i><span>Profil</span></a>
               </li>
            <?php
            } ?>
            <?php
            if (in_array('OPERATION', $ALL_ACCESS)) {
            ?>
               <li <?php active_menu('operation', $menu); ?>>
                  <a href="#menu-design" class="iq-waves-effect" data-toggle="collapse">
                     <i class="ri-menu-3-line iq-arrow-left"></i><span>Opérations</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                  <ul id="menu-design" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                     <li><a href="<?php url(); ?>admin/create-operation"><i class="ri-git-commit-line"></i>Faire une opération</a></li>
                     <?php
                     if (in_array('LISTE DES OPERATIONS', $ALL_ACCESS)) {
                     ?>
                        <li><a href="<?php url(); ?>admin/operation-list"><i class="ri-text-spacing"></i>Liste des opération</a></li>
                     <?PHP } ?>
                     <?php
                     if (in_array('REGARDER LE SOLDE DES COMPTES', $ALL_ACCESS)) {
                     ?>
                        <li><a href="<?php url(); ?>admin/autre-releve"><i class="ri-text-spacing"></i>Relevé de compte</a></li>
                     <?PHP } ?>
                  </ul>
               </li>
            <?php
            }
            ?>
            <?php
            if (in_array('CREDIT', $ALL_ACCESS)) {
            ?>
               <li <?php active_menu('credit', $menu); ?>>
                  <a href="#ui-credit" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                     <i class="lab la-elementor iq-arrow-left"></i><span>Crédit</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                  <ul id="ui-credit" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                     <li><a href="<?php url(); ?>admin/credit"><i class="fa fa-bars"></i>Liste des crédits</a></li>
                     <li><a href="<?php url(); ?>admin/prevision"><i class="fa fa-bars"></i>provisions</a></li>
                  </ul>
               </li>
            <?php } ?>
            
            <?php
            if (in_array('FIDELITE', $ALL_ACCESS)) {
            ?>
               <li <?php active_menu('fidelite', $menu); ?>>
                  <a href="#ui-fidelite" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                     <i class="lab la-elementor iq-arrow-left"></i><span>Compte de fidélité</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                  <ul id="ui-fidelite" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                     <li><a href="<?php url(); ?>admin/credit"><i class="fa fa-bars"></i>Historique d'aquisition des points</a></li>
                     <li><a href="<?php url(); ?>admin/prevision"><i class="fa fa-bars"></i>Historique des convestions</a></li>
                  </ul>
               </li>
            <?PHP } ?>
            <?php
            if (in_array('PRODUITS', $ALL_ACCESS)) {
            ?>
               <li <?php active_menu('produit', $menu); ?>>
                  <a href="#ui-produit" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                     <i class="lab la-elementor iq-arrow-left"></i><span>Produits/Services</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                  <ul id="ui-produit" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                     <li><a href="<?php url(); ?>admin/produit"><i class="fa fa-bars"></i>Liste des produits</a></li>
                     <li><a href="<?php url(); ?>admin/approvisionnement"><i class="fa fa-bars"></i>approvisionnement</a></li>
                     <li><a href="<?php url(); ?>admin/fiche_de_stock"><i class="las la-keyboard"></i>Fiche de stock</a></li>
                     <li><a href="<?php url(); ?>admin/rapport_de_vente"><i class="fa fa-area-chart"></i>Rapport de vente</a></li>
                  </ul>
               </li>
            <?PHP } ?>

            <?php
            if (in_array('COMPTABILITE', $ALL_ACCESS)) {
            ?>
               <li <?php active_menu('comptabilite', $menu); ?>>
                  <a href="#menu-comptabilite" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false">
                     <i class="ri-menu-3-line iq-arrow-left"></i><span>Comptabilité</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                  <ul id="menu-comptabilite" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                     <li><a href="<?php url(); ?>admin/comptabilite-liste"><i class="ri-git-commit-line"></i>Liste des comptes</a></li>
                     <li><a href="<?php url(); ?>admin/comptabilite-rapport"><i class="ri-text-spacing"></i>Journal des opérations </a></li>
                     <li><a href="<?php url(); ?>admin/comptabilite-releve"><i class="ri-text-spacing"></i>Rélévé de compte</a></li>
                     <li><a href="<?php url(); ?>admin/final-rapport"><i class="ri-indent-decrease"></i>Rapport final</a></li>
                     <li><a href="<?php url(); ?>admin/balance"><i class="ri-record-circle-line"></i>Balance des opérations</a></li>
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
            if (in_array('BILLETAGE', $ALL_ACCESS)) {
            ?>
               <li <?php active_menu("billetage", $menu); ?>>
                  <a href="#menu-billetage" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false">
                     <i class="ri-menu-3-line iq-arrow-left"></i><span>Billetage</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                  <ul id="menu-billetage" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                     <li><a href="<?php url(); ?>admin/billetage"><i class="ri-git-commit-line"></i>Stock des billets</a></li>
                  </ul>
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
                     <li><a href="<?php url(); ?>admin/web-manager"><i class="ri-record-circle-line"></i>Web Manage</a></li>
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