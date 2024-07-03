<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php if( $saved ): ?>
<div class="row">
  <div class="col">
    <div class="alert alert-success" role="alert"><?= $message ?></div>
  </div>
</div>
<?php endif ?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row mb-3">
  <div class="col">
    <div class="card mb-3">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <?= $form->field( $model, 'fname' )->textInput() ?>
          </div>
          <div class="col-md-6">
            <?= $form->field( $model, 'lname' )->textInput() ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?= $form->field( $model, 'cv' )->fileInput() ?>
          </div>
          <div class="col-md-6">
            <?= $form->field( $model, 'letter' )->fileInput() ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row mb-5">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="col-md-4">
            <a href="/" class="btn btn-outline-secondary w-100">
              <?= Yii::t( 'app', 'Go Back' ) ?>
            </a>
          </div>
          <div class="col-md-4">
            <?= Html::submitButton( $status, [
                'class' => 'form-control btn btn-primary',
                'id' => 'new-application',
                'name' => 'new-application'
              ] ) ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end();