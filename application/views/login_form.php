<?php echo validation_errors(); ?>

<?php echo form_open('login'); ?>

<h5>Email</h5>
<input type="email" name="email" value="<?php echo set_value('email'); ?>" size="50" />

<h5>Password</h5>
<input type="password" name="password" value="<?php echo set_value('password'); ?>" size="50" />


<div><input type="submit" value="Submit" /></div>

</form>