<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StatisticsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Thống kê truy cập';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="statistics-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'sessions',
            'date_log',
            'sources',
            'ip',
            'address',
            'opera',
            'browser',

            'full_name',
            'email:email',
            'phone',
            'date_contact',
            'content:ntext',


//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
