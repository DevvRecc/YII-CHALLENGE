<?php

use app\models\Studenten;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\StudentenSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Overzicht studenten die te laat waren';
?>
<div class="studenten-index">

    <h5><?= Html::encode($this->title) ?></h5>

    <?= GridView::widget([
        
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'naam_student',
            'klas',
            [
                'label' => 'Minuten te laat	',
                'attribute'=>'aantal_minuten_te_laat',
            ],   
            [
                'label' => 'Reden te laat	',
                'attribute'=>'reden_student',
            ],            
            
            
            [
                'class' => ActionColumn::className(), 'template' => '{delete}',
                'urlCreator' => function ($action, Studenten $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                    
                 },
            ],
        ],
        
    ]); 
    ?>
        <?php

        $this->title = 'statstieken';
?>
<div class="studenten-index">


<table class="table table-striped">
    <thead>
        <tr>
            <th><?= Html::encode($this->title) ?></th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td>Hoogste aantal minuten te laat</td>
            <td><?php echo $hoogste ?></td>
        </tr>

    </br>

        <tr>
            <td>Gemiddeld aantal minuten</td>
            <td><?php echo $gemiddelde ?></td>
        </tr>

    </br>

        <tr>
            <td>Totaal aantal minuten</td>
            <td><?php echo $totaal ?></td>
        </tr>
    </tbody>
</table>

    </br>

        <?= Html::a('Weer eentje te laat!', ['create'], ['class' => 'btn btn-success']) ?>

</div>
