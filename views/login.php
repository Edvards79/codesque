<h1 class="mt-3">Login</h1>
<?php $form = app\core\form\Form::begin("", "post"); ?>
  <?php echo $form->field($model, "username") ?>
  <?php echo $form->field($model, "password")->passwordField(); ?>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php app\core\form\Form::end(); ?>
