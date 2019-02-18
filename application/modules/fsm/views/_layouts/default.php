<!-- Page Loader -->
   <div class="page-loader-wrapper">
       <div class="loader">
           <div class="preloader">
               <div class="spinner-layer pl-red">
                   <div class="circle-clipper left">
                       <div class="circle"></div>
                   </div>
                   <div class="circle-clipper right">
                       <div class="circle"></div>
                   </div>
               </div>
           </div>
           <p>Please wait...</p>
       </div>
   </div>
   <!-- #END# Page Loader -->
   <!-- Overlay For Sidebars -->
   <div class="overlay"></div>
   <!-- #END# Overlay For Sidebars -->
   <!-- Search Bar -->
   <div class="search-bar">
       <div class="search-icon">
           <i class="material-icons">search</i>
       </div>
       <input type="text" placeholder="START TYPING...">
       <div class="close-search">
           <i class="material-icons">close</i>
       </div>
   </div>
   <!-- #END# Search Bar -->
<!--<div class="wrapper">-->

	<?php $this->load->view('_partials/navbar'); ?>

	<?php // Left side column. contains the logo and sidebar ?>
	<section>
            <aside class="sidebar" id="leftsidebar">

    <!--			<div class="user-panel" style="height:65px">
                                    <div class="pull-left info" style="left:5px">
                                            <p><?php //echo $user->first_name; ?></p>
                                            <a href="panel/account"><i class="fa fa-circle text-success"></i> Online</a>
                                    </div>
                            </div>
                -->
                             <div class="user-info">                                 
                                <div class="info-container">                                    
                                    <div class="btn-group user-helper-dropdown">
                                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <?php // (Optional) Add Search box here ?>
                            <?php //$this->load->view('_partials/sidemenu_search'); ?>
                            <?php $this->load->view('_partials/sidemenu'); ?>
                                        <!-- Footer -->
                    <div class="legal">
                        <div class="copyright">
                            &copy; 2016 - 2018 <a href="javascript:void(0);"><?php echo $site_name; ?></a>
                        </div>
                        <div class="version">
                            <b>Version: </b> 1.0.6
                        </div>
                    </div>
            <!-- #Footer -->

            </aside>

        </section>

	<?php // Right side column. Contains the navbar and content of the page ?>
        <section class="content">
            <div class="container-fluid">
                
                <div class="block-header">
			<h2><?php echo $page_title; ?></h2>                        
		</div>
                    <?php //$this->load->view('_partials/breadcrumb'); ?>
                    <?php $this->load->view($inner_view); ?>
                    <?php //$this->load->view('_partials/back_btn'); ?>
            </div>
	</section>