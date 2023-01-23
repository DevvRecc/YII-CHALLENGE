<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Studenten $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="studenten-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'naam_student')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'klas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aantal_minuten_te_laat')->textInput() ?>

    <?= $form->field($model, 'reden_student')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
