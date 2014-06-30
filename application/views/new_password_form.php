<?php echo validation_errors(); ?>

<?php echo form_open('replacepassword'); ?>

<input type="hidden" name="email" value="<?php @print($email); ?><?php echo set_value('email'); ?>" size="50"  />

<h5>New Password</h5>
<input type="password" name="password" value="<?php echo set_value('password'); ?>" size="50" />

<h5>New Password Confirm</h5>
<input type="password" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50" />



<div><input type="submit" value="Reset" /></div>

</form>