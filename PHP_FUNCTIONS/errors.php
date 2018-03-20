<?php  if (count($errors) > 0) : ?>
	<?= '<div class="message">' ?>
		<?php foreach ($errors as $error) : ?>
			<?= "<p>$error</p>" ?>
		<?php endforeach ?>
	<?= "</div>" ?>
<?php  endif ?>
