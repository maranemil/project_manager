<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * Created by PhpStorm.
 * User: Emil Maran ( maran.emil[at]gmail[dot].com)
 * Date: 06.08.14
 * Time: 21:33
 */

if (($this->controller->getTask() == 'update' ||
	$this->controller->getTask() == 'edit' ||
	$this->controller->getTask() == 'add'
)) {
   ?>
    <!-- ADD / EDIT / UPDATE ACTION -->
   <?php
}
else {
   $u = new User();
   if ($u->isSuperUser()) {
	  Loader::element('top_header', '', 'project_manager');

	  echo '
<script>
	const DIR_REL = "' . DIR_REL . '";
</script>';
	  ?>

       <!-- VIEW ACTION -->
       <div class='ccm-pane-body'>
           <!-- Show Top Navigation Package -->
		  <?php
		  // Tab setting using array
		  $tabs = array(
			 // array('tab-id', 'Tag Label', true=active)
			 array('tab-1', t('About Project Manager'), true),
			 //array('tab-5', t('ToDos')),
		  );
		  // Print tab element
		  echo Loader::helper('concrete/interface')->tabs($tabs);
		  ?>

		  <?php
		  //$pkg = Package::getByHandle('project_manager');
		  Loader::element('navigation', '', 'project_manager');
		  ?>

           <div style="clear: both">
               <p>&nbsp;</p>
           </div>

           <div id="ccm-tab-content-tab-1" class="ccm-tab-content">
               <!-- Tab Content 1 -->
               <div id="boilerplate-results-wrap">
                   <h3>About MCE37 Project Manage</h3>
                   <h4>What is MCE Project Manager for:</h4><br>
                   - Provide the interaction between developers and costumers inside project<br>
                   - Provide the possibility to check and update website/project status easily from everywhere.<br>
                   - Keeping the pages statuses fresh between creative team, developers & customers.<br>

               </div>
               <!-- // Tab Content 1 -->
           </div>
           <div id="ccm-tab-content-tab-2" class="ccm-tab-content">
               <!-- Tab Content 2 -->
           </div>

       </div>
       <div class="ccm-pane-footer"></div>
	  <?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false); ?>

	  <?php
   } // end super user
} // end view
?>

<?php
$html = Loader::helper('html');
$pkg  = Package::getByHandle('project_manager');
$this->addFooterItem($html->css('view.css', $pkg->getPackageHandle()));
//$this->addHeaderItem($html->javascript('view.js',$pkg->getPackageHandle()));
?>