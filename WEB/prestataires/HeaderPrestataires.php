<?php

require_once '../functions.php';

Class HeaderPrestataires
{
	public $path_profil;
  public $path_planning;
  public $path_contrat;



	public function __Construct($p_profil,
								$p_planning,
                $p_contrat
                )
	{

		$this->path_profil = $p_profil;
    $this->path_planning = $p_planning;
    $this->path_contrat = $p_contrat;


	}

	public function head_structure()
	{
		echo '<ul class="navbar-nav bg-gradient-presta sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="login-success.php">
        <div class="sidebar-brand-text mx-3 form-group-row">
        '.
		 "Bonjour ".$_SESSION['firstname'].' !

        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="'.$this->path_profil.'">
          <span>'. MY_PROFILE . '</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        '. INTERFACES .'
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="'.$this->path_planning.'" id="planning">
          <span>'. SCHEDULE .'</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="'.$this->path_contrat.'" id="contrat">
          <span>Contrats</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="'.$this->path_planning.'" id="facture">
          <span>Factures</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        '. INTERFACES .'
      </div>

      <li class="nav-item">
        <a class="nav-link" href="#">
          <span>'. CONFIGURATION .'</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">



    </ul>
	';


	}

}
