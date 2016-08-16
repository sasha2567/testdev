<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RegistrationForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-registration">

    <?php $form = ActiveForm::begin([
        'id' => 'registration-form',
        'options' => ['class' => 'form-horizontal form-group-sm'],
        'fieldConfig' => [
            'template' => "<div class=\"form-group\">{label}<div class=\"col-sm-6\">{input}</div>{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->textInput(['placeholder' => 'Login']) ?>

    <?= $form->field($model, 'email')->textInput()->textInput(['placeholder' => 'Email']) ?>

    <?= $form->field($model, 'password')->passwordInput()->textInput(['placeholder' => 'Password']) ?>

    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-12 registration">
            <?= Html::submitButton('Registration', ['class' => 'btn btn-primary col-sm-6', 'name' => 'registration-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="col-lg-offset-1 col-sm-12 registration" style="color:#999;">
        <p>Wait! I already have account! <a href="/user/login">Login</a></p>
    </div>

</div>
