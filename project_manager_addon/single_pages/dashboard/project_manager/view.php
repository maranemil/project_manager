<?php  defined('C5_EXECUTE') or die("Access Denied.");

/**
 * Created by PhpStorm.
 * User: Emil Maran ( maran.emil[at]gmail[dot].com)
 * Date: 06.08.14
 * Time: 21:33
 */

if ( preg_match('/update|edit|add/',$this->controller->getTask()) ){ ?>
<!-- ADD / EDIT / UPDATE -->
<?php } else {
    $u = new User();
    if ($u->isSuperUser()) {
?>
<?php Loader::element('top_header','', 'project_manager'); ?>
<?php
// DIR_PACKAGES
echo '
<script> 
	var DIR_REL = "'.DIR_REL.'"
	var BASE_URL = "'.BASE_URL.'"
	var pkgHandler =  "project_manager"
</script>';
?>
    <!-- VIEW ACTION -->
	<script>
		$(document).ready( function(){
		
			$(".pm_button").bind("click",function() {

				jQuery.fn.dialog.showLoader();

				var type = "";
				var pageID = parseInt( $(this).attr("id").replace("pg_",""));
				var numStat = parseInt( $(this).attr("data-stat") );
				var typStat = parseInt( $(this).attr("data-type") );
				var imgStat = $(this).find('img').attr("src");
				
				var currStat;
				
				if(numStat < 3){
					currStat = parseInt(numStat) + 1;
				}
				else{
					currStat = 0;
				}
				
				$(this ).attr("data-stat",currStat);
				
				var newImgStat = imgStat.replace("flow_" + numStat + ".png","flow_" + currStat + ".png");
				$(this).find('img').attr("src",newImgStat);

                var ajaxUrlConn = "http://" + location.host + "" + CCM_REL;
                    ajaxUrlConn+= "/index.php/tools/packages/"+pkgHandler+"/ajax_connector";
				
				$.ajax({
					url: ajaxUrlConn,
					type: "GET",
					data: { 
						sID: currStat,
						pID: pageID,
						aID: typStat
					},
					context: document.body
				}).done(function(response) {
					$("#pr_" + pageID).text(response + "%");

					if(response < 30){ $("#pr_" + pageID).css("color","#FF0000"); }
					else if(response > 30 && response < 80){ $("#pr_" + pageID).css("color","#FF8C00"); }
					else if(response > 80){ $("#pr_" + pageID).css("color","#008B00"); }
					
					$("#pr_" + pageID).css("font-weight","bold");

					 setTimeout( function(){ jQuery.fn.dialog.hideLoader(); },500)
					//$('#bfr-order-form-ajax-loader').toggle(true);
				});

			});

            $.each($('.percent_span'),function(index,value){
                //console.log($(this).attr('id'));
                //console.log(parseInt( $(this).text() ) );
                if( parseInt( $(this).text() ) >80 ){
                    $(this).css('color','#008B00');
                }
                else if( parseInt( $(this).text() ) > 30 && parseInt( $(this).text() ) < 80 ){
                    $(this).css('color','#FF8C00');
                }
                else{
                    $(this).css('color','#FF0000');
                }

            });
            //

		});
	</script>
	
	<div class='ccm-pane-body'>
		<!-- Show Top Navigation Package -->
		<?php
		// Tab setting using array
		$tabs = array(
			// array('tab-id', 'Tag Label', true=active)
			array('tab-1', t('Manage Pages Status'), true),
			//array('tab-5', t('ToDos')),
		);
		// Print tab element
		echo Loader::helper('concrete/interface')->tabs($tabs);
		?>

        <?php Loader::element('navigation','', 'project_manager'); ?>

        <div class="clearer">&nbsp;</div><br>

		<div id="ccm-tab-content-tab-1" class="ccm-tab-content">
		<!-- Tab Content 1 -->
		<div id="boilerplate-results-wrap">
		
			<table border="0" cellspacing="1" cellpadding="0" class="table table-striped">
				<thead>
					<tr>
						<th class="subheader"><?php echo t('Page Name')?></th>
						<th class="subheader" width="60"><?php echo t('Page ID')?></th>
						<?php
                        if(is_array($arAttributes)){
                            foreach($arAttributes as $pAttribute) {
                                    echo '<th class="subheader" width="40">'. $pAttribute.'</th>';
                            }
                        }
						?>
						<th class="subheader"><?php echo t('Percent')?></th>
					</tr>
				</thead>
				<tbody>

					<?php
					$pm = Loader::model("percent","project_manager");
					$nh = Loader::helper('navigation');

					if ($pageTotal > 0) {

						foreach($pageResults as $page) {
						
							$pgLink 	= $nh->getLinkToCollection($page);
							$pgId 		= $page->getCollectionID();
							$pgName 	= $page->getCollectionName();
							
							echo '
							<tr>
								<td>
								<img class="ccm-attribute-icon"
						            src="'.DIR_REL.'/packages/project_manager/images/folder-icon.png"
						            width="16" height="16" />
									<a href="'.$pgLink.'"> 
										'. $pgName .' 
									</a>
								</td>
								<td>
									'. $pgId .' 
								</td>
								';
								
								for($i=1;$i<=$countAttributes;$i++){
								
								$aID = 	$i;	
								$pID = $pgId;
                                $db = Loader::db();
								$queryCheck = "SELECT * FROM btProjectManagerPgStatus WHERE aID = ".$aID." AND pID = ".$pID." ";
		
								$rs = $db->Execute($queryCheck);
								$countCheck = $rs->RecordCount();
								if($countCheck){
									$row = $rs->fetchRow();
									$thisStatus = $row["sID"];
								}
								else{
									$thisStatus = 0;
								}
								
								echo '
								<td>
									<a class="pm_button" id="pg_'.$pgId.'" data-type="'.$i.'" data-stat="'.$thisStatus.'">
										<img src="'.DIR_REL.'/packages/project_manager/images/flow_'.$thisStatus.'.png" width="17" />
									</a>
								</td>';
								}
								
							echo '
								<td>
									<span class="percent_span" id="pr_'.$pgId.'">'.PercentModel::PercentByPage($pID,$countAttributes).'%<span>
								</td>
							</tr>';
						}
					}
					?>
				<tbody>
			</table>
				
		</div>
		<!-- // Tab Content 1 -->
				
		</div>
		<div id="ccm-tab-content-tab-2" class="ccm-tab-content">
			<!-- Tab Content 2 -->
		</div>
		
	</div>
	<div class="ccm-pane-footer"> 
			<?php
				if ($pageTotal > 0) {
                    echo $pageSummary;
				}
			?>
	</div>
	<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false); ?>
	 
    <?php 
	} // end super user
} // end view
?>

<?php
$html = Loader::helper('html');
$pkg = Package::getByHandle('project_manager');
$this->addFooterItem($html->css('view.css',$pkg->getPackageHandle()));
//$this->addHeaderItem($html->javascript('view.js',$pkg->getPackageHandle()));
?>
