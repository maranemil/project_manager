<?php
defined('C5_EXECUTE') or die("Access Denied.");

$pID = $_REQUEST["pID"]; // Page ID
$aID = $_REQUEST["aID"]; // Attribute ID
$sID = $_REQUEST["sID"]; // Status ID

$u   = new User();
$uID = $u->getUserID();
//$ui = UserInfo::getByID($uID);

$db = Loader::db();

$queryCheck = "SELECT * FROM btProjectManagerPgStatus WHERE aID = " . $aID . " AND pID = " . $pID . " ";
$rs         = $db->Execute($queryCheck);
$countCheck = $rs->RecordCount();

//echo $pID."<br>";

if ($countCheck) {
   $queryUpdate = "UPDATE btProjectManagerPgStatus SET sID = " . $sID . " WHERE aID = " . $aID . " AND pID = " . $pID . " ";
   $rs          = $db->Execute($queryUpdate);
}
else {
   $queryInsert = "INSERT INTO btProjectManagerPgStatus (bID,pID,aID,cDate,uID,sID) VALUES( NULL," . $pID . "," . $aID . ",NOW()," . $uID . "," . $sID . " ) ";
   $rs          = $db->Execute($queryInsert);
}

$rs              = $db->Execute('SELECT * FROM btProjectManagerPgAttributes');
$countAttributes = $rs->RecordCount();

$pm = Loader::model("percent", "project_manager");
echo PercentModel::PercentByPage($pID, $countAttributes);


