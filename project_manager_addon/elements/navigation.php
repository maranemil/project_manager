<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * Created by PhpStorm.
 * User: Emil Maran ( maran.emil[at]gmail[dot].com)
 * Date: 09.08.14
 * Time: 18:33
 */

?>

<div style="float: left; ">
    <a href="<?php  echo $this->url("/dashboard/project_manager/view")?>"
        class="btn primary">Overview Pages</a>
</div>
<div style="float: left; margin-left: 5px">
    <a href="<?php  echo $this->url("/dashboard/project_manager/attributes")?>"
        class="btn primary">Page attributes</a>
</div>
<div style="float: left; margin-left: 5px">
    <a href="<?php  echo $this->url("/dashboard/project_manager/about")?>"
       class="btn warning">About</a>
</div>

<div style="clear: both"></div>
<!-- End Top Navigation Package  -->