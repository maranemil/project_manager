<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * Created by PhpStorm.
 * User: Emil Maran ( maran.emil[at]gmail[dot].com)
 * Date: 06.08.14
 * Time: 21:33
 */

if (($this->controller->getTask() == 'update' || $this->controller->getTask() == 'edit' || $this->controller->getTask() == 'add')
) {
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
       <div class='ccm-pane-body'>
           <!-- Show Top Navigation Package -->
		  <?php
		  // Tab setting using array
		  $tabs = array(
			 // array('tab-id', 'Tag Label', true=active)
			 array('tab-1', t('Manage Page Attributes'), true),
			 //array('tab-5', t('ToDos')),
		  );
		  // Print tab element
		  echo Loader::helper('concrete/interface')->tabs($tabs);
		  Loader::element('navigation', '', 'project_manager');
		  ?>
           <div class="clearer">&nbsp;</div>
           <br>
           <!--		<div class="ccm-attributes-list">-->
           <div id="ccm-tab-content-tab-1" class="ccm-tab-content">
               <!-- Tab Content 1 -->
               <div id="boilerplate-results-wrap">
                   <table class="table table-striped">
                       <thead>
                       <tr>
                           <th class="subheader"><?php echo t('Attribute Name') ?></th>
                           <th class="subheader" width="30"><?php echo t('Change') ?></th>
                           <th class="subheader" width="30"><?php echo t('Remove') ?></th>
                       </tr>
                       </thead>
                       <tbody>
					   <?php
					   $db              = Loader::db();
					   $rs              = $db->Execute('SELECT * FROM btProjectManagerPgAttributes');
					   $countAttributes = $rs->RecordCount();
					   while ($row = $rs->fetchRow()) {
						  echo '<tr>
                                <td>
                                    <img class="ccm-attribute-icon"
                                    src="' . DIR_REL . '/packages/project_manager/images/folder-icon.png"
                                    width="16" height="16" alt=""/>

                                    ' . $row['cText'] . '

                                  </td>
                                  <td>
                                    <a class="btn warning" href="' . $this->url("/dashboard/project_manager/attributes") . 'edit/?bID=' . $row['bID'] . '">
                                        ' . t('Edit') . '
                                    </a>
                                  </td>
                                  <td>
                                    <a class="btn danger delete-btn" data-bid="' . $row['bID'] . '"  data-task="delete">
                                        ' . t('Delete') . '
                                    </a>
                                  </td>
                                </tr>';
						  // btn danger warning primary
					   }
					   ?>
                       </tbody>
                   </table>
               </div>
           </div>

       </div>
       <div class="ccm-pane-footer"></div>
	  <?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false); ?>

	  <?php
   } // end super user
} // end view
?>

    <script type="text/javascript">

		/*$('delete-btn').bind("click", function(){

		});

		var ajaxUrlConnDel ="http://" + location.host + "" + CCM_REL;
			ajaxUrlConnDel+= "/dashboard/project_manager/attributes/edit/";

		$.ajax({
			url: ajaxUrlConn,
			type: "POST",
			data: {
				bID: bIDSel,
				task: "delete"
			},
			context: document.body
		}).done(function(response) {


		});*/

    </script>

<?php
$html = Loader::helper('html');
$pkg  = Package::getByHandle('project_manager');
$this->addFooterItem($html->css('view.css', $pkg->getPackageHandle()));
//$this->addHeaderItem($html->javascript('view.js',$pkg->getPackageHandle()));
?>