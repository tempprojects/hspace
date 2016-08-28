<?php

/* @var $this \yii\web\View */
/* @var $content string */
use app\widgets\LeftSidebarWidget;
use backend\assets\DashboardAsset;
use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

DashboardAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
                <?= Html::csrfMetaTags() ?>
		<meta charset="<?= Yii::$app->charset ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?= Html::encode($this->title) ?></title>
                
		<?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
	<header class="main-header">
				<!-- Logo -->
				<a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b>A</b>LT</span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><b>Admin</b>LTE</span>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top" role="navigation">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<!-- Messages: style can be found in dropdown.less-->
							<li class="dropdown messages-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-envelope-o"></i>
									<span class="label label-success">4</span>
								</a>
								<ul class="dropdown-menu">
									<li class="header">You have 4 messages</li>
									<li>
										<!-- inner menu: contains the actual data -->
										<ul class="menu">
											<li><!-- start message -->
												<a href="#">
													<div class="pull-left">
														<img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
													</div>
													<h4>
														Support Team
														<small><i class="fa fa-clock-o"></i> 5 mins</small>
													</h4>
													<p>Why not buy a new awesome theme?</p>
												</a>
											</li><!-- end message -->
											<li>
												<a href="#">
													<div class="pull-left">
														<img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
													</div>
													<h4>
														AdminLTE Design Team
														<small><i class="fa fa-clock-o"></i> 2 hours</small>
													</h4>
													<p>Why not buy a new awesome theme?</p>
												</a>
											</li>
											<li>
												<a href="#">
													<div class="pull-left">
														<img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
													</div>
													<h4>
														Developers
														<small><i class="fa fa-clock-o"></i> Today</small>
													</h4>
													<p>Why not buy a new awesome theme?</p>
												</a>
											</li>
											<li>
												<a href="#">
													<div class="pull-left">
														<img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
													</div>
													<h4>
														Sales Department
														<small><i class="fa fa-clock-o"></i> Yesterday</small>
													</h4>
													<p>Why not buy a new awesome theme?</p>
												</a>
											</li>
											<li>
												<a href="#">
													<div class="pull-left">
														<img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
													</div>
													<h4>
														Reviewers
														<small><i class="fa fa-clock-o"></i> 2 days</small>
													</h4>
													<p>Why not buy a new awesome theme?</p>
												</a>
											</li>
										</ul>
									</li>
									<li class="footer"><a href="#">See All Messages</a></li>
								</ul>
							</li>
							<!-- Notifications: style can be found in dropdown.less -->
							<li class="dropdown notifications-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-bell-o"></i>
									<span class="label label-warning">10</span>
								</a>
								<ul class="dropdown-menu">
									<li class="header">You have 10 notifications</li>
									<li>
										<!-- inner menu: contains the actual data -->
										<ul class="menu">
											<li>
												<a href="#">
													<i class="fa fa-users text-aqua"></i> 5 new members joined today
												</a>
											</li>
											<li>
												<a href="#">
													<i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
												</a>
											</li>
											<li>
												<a href="#">
													<i class="fa fa-users text-red"></i> 5 new members joined
												</a>
											</li>
											<li>
												<a href="#">
													<i class="fa fa-shopping-cart text-green"></i> 25 sales made
												</a>
											</li>
											<li>
												<a href="#">
													<i class="fa fa-user text-red"></i> You changed your username
												</a>
											</li>
										</ul>
									</li>
									<li class="footer"><a href="#">View all</a></li>
								</ul>
							</li>
							<!-- Tasks: style can be found in dropdown.less -->
							<li class="dropdown tasks-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-flag-o"></i>
									<span class="label label-danger">9</span>
								</a>
								<ul class="dropdown-menu">
									<li class="header">You have 9 tasks</li>
									<li>
										<!-- inner menu: contains the actual data -->
										<ul class="menu">
											<li><!-- Task item -->
												<a href="#">
													<h3>
														Design some buttons
														<small class="pull-right">20%</small>
													</h3>
													<div class="progress xs">
														<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
															<span class="sr-only">20% Complete</span>
														</div>
													</div>
												</a>
											</li><!-- end task item -->
											<li><!-- Task item -->
												<a href="#">
													<h3>
														Create a nice theme
														<small class="pull-right">40%</small>
													</h3>
													<div class="progress xs">
														<div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
															<span class="sr-only">40% Complete</span>
														</div>
													</div>
												</a>
											</li><!-- end task item -->
											<li><!-- Task item -->
												<a href="#">
													<h3>
														Some task I need to do
														<small class="pull-right">60%</small>
													</h3>
													<div class="progress xs">
														<div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
															<span class="sr-only">60% Complete</span>
														</div>
													</div>
												</a>
											</li><!-- end task item -->
											<li><!-- Task item -->
												<a href="#">
													<h3>
														Make beautiful transitions
														<small class="pull-right">80%</small>
													</h3>
													<div class="progress xs">
														<div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
															<span class="sr-only">80% Complete</span>
														</div>
													</div>
												</a>
											</li><!-- end task item -->
										</ul>
									</li>
									<li class="footer">
										<a href="#">View all tasks</a>
									</li>
								</ul>
							</li>
							<!-- User Account: style can be found in dropdown.less -->
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        <?php 
                                                                                echo Yii::$app->user->identity->avatar? Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/profile/avatar/'. Yii::$app->user->identity->avatar),[
                                                                                'alt'=>'User Avatar',
                                                                                'class'=> 'user-image'
                                                                            ]): '<img src="' . Yii::$app->getUrlManager()->getBaseUrl() . '/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">';
                                                                        ?>
                                                                    
									<span class="hidden-xs">
											<?php 
												echo Yii::$app->user->identity->first_name; 
												echo " ";
												echo Yii::$app->user->identity->last_name;
											?>
									</span>
								</a>
								<ul class="dropdown-menu">
									<!-- User image -->
									<li class="user-header">
                                                                             <?php 
                                                                                echo Yii::$app->user->identity->avatar? Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/profile/avatar/'. Yii::$app->user->identity->avatar),[
                                                                                'alt'=>'User Avatar',
                                                                                'class'=> 'img-circle'
                                                                            ]): '<img src="' . Yii::$app->getUrlManager()->getBaseUrl() . '/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">';
                                                                            ?>
										
										<p>
											<?php 
												echo Yii::$app->user->identity->first_name; 
												echo " ";
												echo Yii::$app->user->identity->last_name;
												echo " - ";
												echo Yii::$app->user->identity->roles;
											?>
											<small>Member since <?php $miliseconds=Yii::$app->user->identity->created_at; echo date("M. Y", $miliseconds); ?></small>
										</p>
									</li>
									<!-- Menu Body -->
									<!-- Menu Footer-->
									<li class="user-footer">
										<a href="<?= Yii::$app->urlManager->createUrl(['site/logout']); ?>" class="btn btn-default btn-flat">Sign out</a>  
									</li>
								</ul>
							</li>

							
							<!-- Control Sidebar Toggle Button -->
							<li>
								<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
							</li>
						</ul>
					</div>
				</nav>
			</header>
<!-- Left side column. contains the logo and sidebar -->
	
		<?= $this->render('LeftSidebar') 
    	?>
<div>
				 <!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					
                                    <?php 
                                       echo Breadcrumbs::widget([
                                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                        ]);
                                    ?>
<!--                                        <h1>
						Dashboard
						<small>Control panel</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="active">Dashboard</li>
					</ol>-->

				</section>

				<!-- Main content -->
				<section class="breadcrumb">
				<?= $content ?>
				</section>
                    </div>
</div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
