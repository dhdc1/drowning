<?php

use yii\helpers\Url;
?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">



                <a href="<?= Url::to(['/report-dead/index']) ?>"><i class="fa fa-file-text"></i> รายงานสอบสวน</a>
                <a href="<?= Url::to(['/water']) ?>"><i class="fa fa-tree"></i>  แหล่งน้ำเสี่ยง</a>
                <a href="<?= Url::to(['/team/team/index']) ?>"><i class="fa fa-group"></i> ทีมผู้ก่อการดี</a>
                <a href="<?= Url::to(['/pop/population-base/index']) ?>"><i class="fa fa-group"></i> ประชากร 0-14ปี</a>
                <a href="<?= Url::to(['/pop/population-target/index']) ?>"><i class="fa fa-group"></i> กลุ่มเสี่ยง</a>
                <?php if (\Yii::$app->user->can('admin')): ?>
                    <a href="<?= Url::to(['/news/news/index']) ?>"><i class="fa fa-newspaper-o"></i> จัดการสื่อประชาสัมพันธ์</a>

                    <a href="<?= Url::to(['/user/admin/index']) ?>"><i class="fa fa-user"></i> จัดการผู้ใช้งาน</a>
                <?php endif; ?>

               
            </li>



        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
