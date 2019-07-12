<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\loading\ShowLoading;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode('GIS เด็กจมน้ำ เขตสุขภาพที่2') ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">

            <?php
            //echo ShowLoading::widget();
            ?>
            <?php
            NavBar::begin([
                'brandLabel' => Html::img('@web/img/logo.png', ['alt' => 'some', 'class' => 'navbar-left', 'height' => '28px', 'width' => '190px']),
                'brandUrl' => \Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-custom navbar-fixed-top',
                ],
                'innerContainerOptions' => ['class' => 'container-fluid'], // ขยายความกว้าง navbar
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'แผนที่เด็กจมน้ำ', 'url' => ['/gis/default/map-changwat']],
                    ['label' => 'ปฏิทินกิจกรรม', 'url' => ['/site/calendar']],
                    ['label' => 'สื่อประชาสัมพันธ์', 'url' => ['/news/default']],
                    //['label' => 'ดาวโหลด', 'url' => ['/site/contact']],
                    ['label' => 'ติดต่อสอบถาม', 'url' => ['/site/about']],
                    \Yii::$app->user->isGuest ?
                            ['label' => 'Login', 'url' => ['/user/security/login']] : [
                        'label' => 'ผู้ใช้ : (' . \Yii::$app->user->identity->username . ')',
                        'items' => [
                            ['label' => 'ข้อมูลส่วนตัว', 'url' => ['/user/settings/profile']],
                            '<li class="divider"></li>',
                            ['label' => 'ออกระบบ', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
                            '<li class="divider"></li>',
                            \Yii::$app->user->can('admin') ? ['label' => 'จัดการสิทธิ', 'url' => ['/rbac/assignment']] : ''
                        ]
                            ]
                ],
            ]);
            NavBar::end();
            ?>

            <div class="container-fluid" style="margin-top: 55px">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?php //echo Alert::widget() ?>
                <div class="row">
                    <div class="col-lg-2">
                        <?= $this->render('leftbar'); ?>
                    </div>
                    <div class="col-lg-10 container-fluid">

                        <?= $content ?>
                    </div>
                </div>

            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <p class="pull-left">
                    <span style="background-color:#C71585;color:white;padding:5px"> &copy;  <?= date('Y') ?> <a target='_blank' href="https://ddc.moph.go.th/th/site/office/view/odpc2">สคร.2</a>, สำนักงานป้องกันควบคุมโรคที่ 2 จังหวัดพิษณุโลก </span>

                    <span style="background-color:red;color:white;padding:5px"> Version 1.2.2-build-2019-07-12</span>

                </p>

                <p class="pull-right"> 
                    <span style="background-color:#FFA07A;color: black;padding: 5px;display: none">PM : thian.dpc@gmail.com</span>
                    <span style="background-color:#7CFC00;color:black;padding:5px"> ประมวลผลล่าสุด:<?= \Yii::$app->db->createCommand('select process_time from log_event order by id DESC')->queryScalar() ?></span>
                </p>


            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
