<?php /** @noinspection PhpUndefinedClassInspection */
/** @noinspection AutoloadingIssuesInspection */
/** @noinspection PhpUnused */
defined('C5_EXECUTE') or die("Access Denied.");

/**
 * Created by PhpStorm.
 * User: Emil Maran ( maran.emil[at]gmail[dot].com)
 * Date: 06.08.14
 * Time: 21:33
 * @property $error
 * @method  set(string $string, $bID)
 */
class DashboardProjectManagerController extends Controller {

   /**
	* @var string[]
	*/
   public $helpers = array('html', 'form');

   /**
	*
	*/
   public function on_start() {
	  Loader::model('page_list');
	  $this->error = Loader::helper('validation/error');
	  /*
	   * Events::extend('on_page_view',
		  'ModelClass',
		  'modelMethod',
		  DIR_BASE . '/packages/' . $this->pkgHandle . '/models/model_class.php'
	  );
	  */
   }

   /*
	* public function view() {
	   $this->redirect("/dashboard/project_manager/overview/");
   }
   */

   /**
	*
	*/
   public function view() {
	  $db              = Loader::db();
	  $rs              = $db->Execute('SELECT * FROM btProjectManagerPgAttributes');
	  $countAttributes = $rs->RecordCount();
	  $arAttributes    = array();
	  while ($row = $rs->fetchRow()) {
		 $arAttributes[] = $row['cText'];
	  }

	  $this->set('arAttributes', $arAttributes);
	  $this->set('countAttributes', $countAttributes);

	  Loader::model('page_list');
	  $pageList = new PageList();
	  #$pageList->sortBy('cDateAdded', 'desc');
	  $pageList->sortBy('cID', 'asc');
	  $this->set('pageList', $pageList);
	  $this->set('pageResults', $pageList->getPage());
	  $this->set('pageTotal', $pageList->getTotal());
	  $this->set('pageSummary', $pageList->displaySummary());
   }

}