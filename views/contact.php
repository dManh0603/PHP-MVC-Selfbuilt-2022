<?php
/**
 * @var $this View
 * @var $model ContactForm
 */

use dmanh0603\phpmvc\form\TextareaField;
use dmanh0603\phpmvc\View;
use app\models\ContactForm;

$this->title = 'Contact';
?>

<h1>Contact</h1>
<?php $form = \dmanh0603\phpmvc\form\Form::begin('','post') ?>
<?php echo $form->field($model, 'subject') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo new TextareaField($model,'body') ?>

<button type="submit" class="btn btn-primary">Submit</button>
<?php \dmanh0603\phpmvc\form\Form::end() ?>

