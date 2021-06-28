<?php

use App\Core\App;
use App\Core\Auth;
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='icon' href='<?= public_url('/favicon.ico') ?>' type='image/ico' />
	<title>
		<?= ucfirst($pageTitle) . " | " . App::get('config')['app']['name'] ?>
	</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?= public_url('/assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
	<link rel="stylesheet" href="<?= public_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') ?>">

	<!-- Theme style -->
	<link rel="stylesheet" href="<?= public_url('/assets/adminlte/css/adminlte.min.css') ?>">
	<link rel="stylesheet" href="<?= public_url('/assets/adminlte/css/highlighter.css') ?>">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?= public_url('/assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">

	<style>
		@font-face {
			font-family: Nunito;
			src: url("<?= public_url('/assets/adminlte/fonts/Nunito-light.ttf') ?>");
		}

		body {
			font-weight: 300;
			font-family: Nunito;
			color: #26425f;
			background: #eef1f4;
		}
	</style>

	<!-- jQuery -->
	<script src="<?= public_url('/assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>

	<?php
	// this will auto include filepond css/js when adding filepond in public/assets
	if (file_exists('public/assets/filepond')) {
		require_once 'public/assets/filepond/filepond.php';
	}
	?>

	<script>
		const base_url = "<?= App::get('base_url') ?>";
	</script>
</head>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="#" class="nav-link"></a>
				</li>
			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" data-widget="fullscreen" href="#" role="button">
						<i class="fas fa-expand-arrows-alt"></i>
					</a>
				</li>
				<!-- Messages Dropdown Menu -->
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<span class="mr-1"><?= Auth::user('fullname') ?></span>
						<i class="fas fa-sort-down"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<span class="dropdown-header">User settings</span>
						<div class="dropdown-divider"></div>
						<a href="<?= route('/profile'); ?>" class="dropdown-item">
							<i class="fas fa-user mr-2"></i> Profile
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?= route('/logout') ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							<i class="fas fa-sign-out-alt mr-2"></i> Logout
						</a>

						<form id="logout-form" action="<?= route('/logout') ?>" method="POST" style="display:none;">
							<?= csrf() ?>
						</form>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
						<i class="fas fa-cog"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="index3.html" class="brand-link text-center">
				<span class="brand-image img-circle elevation-3" style="opacity: .8"></span>
				<span class="brand-text font-weight-light"><?= App::get('config')['app']['name'] ?></span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">

				<!-- SidebarSearch Form -->
				<div class="form-inline mt-3">
					<div class="input-group" data-widget="sidebar-search">
						<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
						<div class="input-group-append">
							<button class="btn btn-sidebar">
								<i class="fas fa-search fa-fw"></i>
							</button>
						</div>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item">
							<a href="<?= route('/home') ?>" class="nav-link">
								<i class="nav-icon fas fa-home"></i>
								<p>
									Dashboard
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									CRUD Operation
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?= route('/project') ?>" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Projects</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">

			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0"><?= ucfirst($pageTitle) ?></h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Starter Page</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">