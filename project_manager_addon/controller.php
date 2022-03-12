<?php /** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */
/** @noinspection PhpUndefinedFunctionInspection */
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection AutoloadingIssuesInspection */
/** @noinspection PhpUnused */
defined('C5_EXECUTE') or die("Access Denied.");

/**
 * Created by PhpStorm.
 * User: Emil Maran ( maran.emil[at]gmail[dot].com)
 * Date: 06.08.14
 * Time: 21:33
 */
class ProjectManagerPackage extends Package
{

    /**
     * @var string
     */
    protected $pkgHandle = 'project_manager';
    /**
     * @var string
     */
    protected $appVersionRequired = "5.4.1";
    /**
     * @var string
     */
    protected $pkgVersion = "0.9";

    /**
     * @return mixed
     */
    public function getPackageDescription()
    {
        return t("Manage Status from All Pages");
    }

    /**
     * @return mixed
     */
    public function GetPackageName()
    {
        return t("MCE37 Project Manager v0.9");
    }

    /**
     *
     */
    public function on_start()
    {
    }

    /**
     *
     */
    public function install()
    {
        $pkg = parent::install();
        // add dummy pages attributes
        $db = Loader::db();
        $strSQL = "INSERT INTO `btProjectManagerPgAttributes` (`bID`, `cText`)
		VALUES (1, 'IMAGE'),
		       (2, 'TEXT'),
		       (3, 'HTML'),
		       (4, 'JS/CSS'),
		       (5, 'FLOW');
		       ";
        $db->Execute($strSQL);

        Loader::model('single_page');
        SinglePage::add('/dashboard/project_manager/view', $pkg);
        SinglePage::add('/dashboard/project_manager/attributes', $pkg);
        SinglePage::add('/dashboard/project_manager/attributes/edit', $pkg);
        SinglePage::add('/dashboard/project_manager/attributes/delete', $pkg);
        SinglePage::add('/dashboard/project_manager/about', $pkg);
    }

    /**
     *
     */
    public function upgrade()
    {
        Package::getByHandle($this->pkgHandle);
        parent::upgrade();
    }

    /**
     *
     */
    public function uninstall()
    {
        // clean Database
        parent::uninstall();
        $btTable = 'btProjectManagerPgStatus, btProjectManagerPgAttributes';
        $db = Loader::db();
        $db->Execute('DROP TABLE ' . $btTable);
    }
}