<?php echo validation_errors(); ?>

<?php echo form_open('forgottenpassword'); ?>


<h5>Please enter your email address</h5>
<input type="email" name="email" value="<?php echo set_value('email'); ?>" size="50" />

<div><input type="submit" value="Email my reset link" /></div>

</form>
<p><?php echo $message; ?></p>
