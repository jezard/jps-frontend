<section class="section-ln">
<h3>Password reset</h3>
<div class="content-container">
<?php echo validation_errors(); ?>

<?php echo form_open('forgottenpassword'); ?>

<h5>Please enter your email address</h5>
<input type="email" name="email" value="<?php echo set_value('email'); ?>" size="50" />

<div><button type="submit" class="btn-default">Send my password reset link</button></div>

</form>
<p><?php echo $message; ?></p>
</div>
</section>
