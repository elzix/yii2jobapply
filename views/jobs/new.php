<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$status = array( 'open' => 'Open', 'closed' => 'Closed' );
?>

<?php if( $saved ): ?>
<div class="row">
  <div class="col">
    <div class="alert alert-success" role="alert"><?= $message ?></div>
  </div>
</div>
<?php endif ?>
<?php $form = ActiveForm::begin(); ?>
<div class="row mb-3">
  <div class="col">
    <div class="card mb-3">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <?= $form->field( $model, 'job_title' )->textInput() ?>
          </div>
          <div class="col-md-6">
            <?= $form->field( $model, 'category' )->textInput() ?>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <?= $form->field( $model, 'job_desc' )->textarea() ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?= $form->field( $model, 'deadline' )->textInput( [
                'type' => 'date',
                'autocomplete'=>'created'
              ] ) ?>
          </div>
          <div class="col-md-6">
            <?= $form->field( $model, 'status' )->dropDownList( $status ) ?>
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
            <?= Html::submitButton( 'Submit', [
                'class' => 'form-control btn btn-primary',
                'id' => 'new-job',
                'name' => 'new-job'
              ] ) ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end();