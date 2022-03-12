<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * Created by PhpStorm.
 * User: Emil Maran ( maran.emil[at]gmail[dot].com)
 * Date: 06.08.14
 * Time: 21:33
 */

if (
    ($this->controller->getTask() === 'update' || $this->controller->getTask() === 'edit' || $this->controller->getTask() === 'add')
    && $this->post["task"]
) {
    ?>
    <!-- ADD / EDIT / UPDATE ACTION -->

    <?php
} else {
    $u = new User();
    if ($u->isSuperUser()) {
        ?>

        <?php
        Loader::element('top_header', '', 'project_manager');
        echo '<script> 	const DIR_REL = "' . DIR_REL . '"; </script>';
        ?>

        <!-- <div class="ccm-pane-header"> header </div> -->
        <div class='ccm-pane-body'>
            <!-- Show Top Navigation Package -->
            <?php
            // Tab setting using array
            $tabs = array(
                array('tab-1', t('Manage Page Attributes - Edit'), true),
            );
            // Print tab element
            echo Loader::helper('concrete/interface')->tabs($tabs);
            ?>

            <?php Loader::element('navigation', '', 'project_manager'); ?>

            <div style="clear: both"><p>&nbsp;</p></div>

            <div class="ccm-attributes-list">

                <form id='template_form'
                      action="<?php echo $this->action('') ?>" method="post">
                    <!-- /dashboard/project_manager/attributes/edit/ -->
                    <?php
                    $bIDSel = $_GET['bID'] ?: $bID;

                    $db = Loader::db();
                    $rs = $db->Execute('SELECT * FROM btProjectManagerPgAttributes WHERE bID= ' . $bIDSel);
                    $countAttributes = $rs->RecordCount();
                    $row = $rs->fetchRow();

                    if ($row['bID']) {
                        echo '
                    <input type="text" name="cText" value="' . $row['cText'] . '"
                     placeholder="' . $row['cText'] . '"/><br />

                    <input type="hidden" name="bID" value="' . $row['bID'] . '" /><br />
                    <input type="hidden" name="task" value="edit" /><br />

                    <input type="submit" value="' . t('Update Attribute') . '"
                    class="ui-state-default ui-corner-all custom_style big_button"/><br />
                    ';
                    }
                    ?>
                </form>

                <form id='template_form_delete'
                      action="<?php echo $this->action('') ?>" method="post">
                    <?php
                    if ($row['bID']) {
                        echo '
                        <input type="hidden" name="bID" value="' . $row['bID'] . '" /><br />
                        <input type="hidden" name="task" value="delete" /><br />
                        <input type="submit" value="' . t('Delete Attribute') . '"
                            class="ui-state-important ui-corner-all big_button"/><br />
                        ';
                    }
                    ?>
                </form>

            </div>

            <script type="text/javascript">/*<![CDATA[*/
                $(document).ready(function () {
                        $(".custom_style").hover(
                            function () {
                                $(this).addClass("ui-state-active");
                            },
                            function () {
                                $(this).removeClass("ui-state-active");
                            }
                        );
                    }
                );
                /*]]>*/
            </script>
            <style type="text/css">

            </style>

        </div>
        <div class="ccm-pane-footer"></div>
        <?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false); ?>

        <?php
    } // end superuser

} // end view
?>

<?php
$html = Loader::helper('html');
$pkg = Package::getByHandle('project_manager');
$this->addFooterItem($html->css('view.css', $pkg->getPackageHandle()));
//$this->addHeaderItem($html->javascript('view.js',$pkg->getPackageHandle()));
?>