<?php

session_start();


Class Header
{

	public $path_profil;
	public $path_planning;
	public $path_commandes;
	public $path_abonnements;
	public $path_services;
	public $path_factures;
  public $path_parametres;
  public $path_categories;


	public function __Construct($p_profil,
								$p_planning,
								$p_commandes,
								$p_abonnements,
                $p_categories,
								$p_services,
								$p_factures,
								$p_parametres
                )
	{

		$this->path_profil = $p_profil;
		$this->path_planning = $p_planning;
		$this->path_commandes = $p_commandes;
		$this->path_abonnements = $p_abonnements;
		$this->path_services = $p_services;
		$this->path_factures = $p_factures;
    $this->path_parametres = $p_parametres;
    $this->path_categories = $p_categories;


	}

	public function head_structure()
	{
		echo '<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
          <span>Mon profil</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link collapsed" href="'.$this->path_planning.'" id="planning">
          <span>Planning</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <span>Mes commandes</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="'.$this->path_abonnements.'" id="abonnements">
          <span>Abonnements</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="'.$this->path_categories.'" id="categories">
          <span>Catégories</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="'.$this->path_services.'" id="services>
          <span">Services</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="'.$this->path_factures.'">
          <span id="factures">Factures</span>
        </a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span>Devis</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="'.$this->path_parametres.'">
          <span>Paramètres</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">



    </ul>
	';


	}

}