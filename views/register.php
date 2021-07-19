<h1 class="mt-3">Create an account</h1>
<?php $form = app\core\form\Form::begin("", "post"); ?>
  <?php echo $form->field($model, "username") ?>
  <?php echo $form->field($model, "email") ?>
  <?php echo $form->field($model, "password")->passwordField(); ?>
  <?php echo $form->field($model, "confirmPassword")->passwordField(); ?>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php app\core\form\Form::end(); ?>
