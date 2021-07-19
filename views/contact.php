<h1 class="mt-3">Contact us</h1>
<?php

use app\core\form\TextareaField;

$form = app\core\form\Form::begin("", "post"); ?>
  <?php echo $form->field($model, "email") ?>
  <?php echo new TextareaField($model, "message") ?>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php app\core\form\Form::end(); ?>
