<div class="form-wrapper">
	<h1 class="heading"><?php echo $heading ?></h1>
	<?php if (count($errors) > 0): ?>
		<ul class="error-message">
		<?php foreach ($errors as $error): ?>
			<li><?php echo $error ?></li>
		<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<form action="confirm.php" method="post"> 
		<div class="form-item">
			<label class="form-label">顧客ID</label>
			<p>
				<?php 
					if (isset($customer['id'])) {
						echo htmlspecialchars($customer['id'], ENT_QUOTES, 'UTF-8');
					} else {
						echo "-"; 
					}
				?>
			</p>
		</div>
		<div class="form-item">
			<label class="form-label">氏名</label>
			<input type="text" name="name" value="<?php echo htmlspecialchars($customer['name'], ENT_QUOTES, 'UTF-8') ?>">
		</div>
		<div class="form-item">
			<label class="form-label">自己紹介</label>
			<textarea name="introduction"><?php echo htmlspecialchars($customer['introduction'], ENT_QUOTES, 'UTF-8') ?></textarea>
		</div>
		<div class="form-item">
			<label class="form-label">職業</label>
			<select name="occupation_id">
				<option value="">-</option>
				<?php foreach ($occupation_master as $occupation): ?>
				<option value="<?php echo htmlspecialchars($occupation['id'], ENT_QUOTES, 'UTF-8') ?>" <?php if($occupation['id'] === $customer['occupation_id']) echo 'selected' ?>><?php echo htmlspecialchars($occupation['name'], ENT_QUOTES, 'UTF-8') ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-item">
			<label class="form-label">生年月日</label>
			<input type="date" name="birthday" value="<?php echo htmlspecialchars($customer['birthday'], ENT_QUOTES, 'UTF-8') ?>">
		</div>
		<input class="form-button" type="submit" value="確認">
	</form>
</div>