<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\news\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สื่อประชาสัมพันธ์';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'title',
            ['attribute' => 'Download',
            'format' => 'raw',
            'value' => function($data) {
                $basepath = str_replace('\\', '/', Yii::$app->basePath) . '/uploads/attach/';
                $path = str_replace($basepath, '', $data->attach);
                //return Html::a($data->attach, $path, array('target' => '_blank'));
                return !empty($path)?Html::a('Download file', ['download','file'=>$path],['class' => 'btn btn-primary']):'ไม่พบไฟล์';
            }
        ],
'd_update'
    ]
]) ?>