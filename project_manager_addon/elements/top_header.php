<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * Created by PhpStorm.
 * User: Emil Maran ( maran.emil[at]gmail[dot].com)
 * Date: 09.08.14
 * Time: 20:21
 */

$pjHelpStr = t('Colour info') . ': <br />';
$pjHelpStr .= '<img width="10" src="' . DIR_REL . '/packages/project_manager/images/flow_0.png" /> &nbsp;';
$pjHelpStr .= '0 - ' . t('Not checked') . '<br />';
$pjHelpStr .= '<img width="10" src="' . DIR_REL . '/packages/project_manager/images/flow_1.png" /> &nbsp;';
$pjHelpStr .= '1 - ' . t('Not Approved') . '<br />';
$pjHelpStr .= '<img width="10" src="' . DIR_REL . '/packages/project_manager/images/flow_2.png" /> &nbsp;';
$pjHelpStr .= '2 - ' . t('Approved from DEV') . '<br />';
$pjHelpStr .= '<img width="10" src="' . DIR_REL . '/packages/project_manager/images/flow_3.png" /> &nbsp;';
$pjHelpStr .= '3 - ' . t('Approved from QA');

echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(
    t('MCE37 Project Manager'),
    $pjHelpStr,
    false,
    false
);