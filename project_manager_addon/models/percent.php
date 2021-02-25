<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * Created by PhpStorm.
 * User: e.maran
 * Date: 03.03.14
 * Time: 11:14
 */
class PercentModel extends Model {

   public function PercentByPage($pID, $countAttributes) {
	  $db    = Loader::db();
	  $Total = $countAttributes * 3;

	  for ($i = 1; $i <= $countAttributes; $i++) {
		 $aID          = $i;
		 $queryPercent = "SELECT sID FROM btProjectManagerPgStatus WHERE aID = " . $aID . " AND pID = " . $pID . " ";
		 $rs           = $db->Execute($queryPercent);
		 $countPercent = $rs->RecordCount();
		 $row          = $rs->fetchRow();
		 if ($row["sID"]) {
			$arStat[] = $row["sID"];
		 }
	  }

	  if (is_array($arStat)) {
		 $PgPercent = intval(array_sum($arStat) / $Total * 100);
	  }
	  else {
		 $PgPercent = 0;
	  }
	  return $PgPercent;
   }

}