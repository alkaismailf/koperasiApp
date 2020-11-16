<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = ' - Change Password';

?>
<h2>Hi! <?php echo $model->nama;?> :v</h2>
<div class="form">
    <h2>Change Password</h2>
    
<?php $form=$this->beginWidget('ActiveForm', array(
	'id'=>'Ganti-form',
)); ?>

	<div class="row">
            New Password : <input name="Ganti[password]" id="ContactForm_email" type="password">
            <input name="Ganti[tokenhid]" id="ContactForm_email" type="hidden" value="<?php echo $model->token?>">
	</div>

	<div class="row buttons">
		<?php Html::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->