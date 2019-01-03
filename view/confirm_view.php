<div class="form-wrapper">
	<h1 class="heading"><?php echo $heading ?></h1>
	<form action="complete.php" method="post"> 
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
			<p><?php echo htmlspecialchars($customer['name'], ENT_QUOTES, 'UTF-8') ?></p>
		</div>
		<div class="form-item">
			<label class="form-label">自己紹介</label>
			<p><?php echo nl2br(htmlspecialchars($customer['introduction'], ENT_QUOTES, 'UTF-8')) ?></p>
		</div>
		<div class="form-item">
			<label class="form-label">職業</label>
			<p>
				<?php foreach ($occupation_master as $occupation): ?>
					<?php if ($occupation['id'] === $customer['occupation_id']): ?>
						<?php echo htmlspecialchars($occupation['name'], ENT_QUOTES, 'UTF-8') ?>
					<?php endif; ?>
				<?php endforeach; ?>
			</p>
		</div>
		<div class="form-item">
			<label class="form-label">生年月日</label>
			<p><?php echo htmlspecialchars($customer['birthday'], ENT_QUOTES, 'UTF-8') ?></p>
		</div>
		<a href="back.php" class="form-button">戻る</a>
		<?php if (isset($customer['id'])): ?>
			<a href="complete.php" class="form-button">更新</a>
		<?php else: ?>
			<a href="complete.php" class="form-button">登録</a>
		<?php endif; ?>
	</form>
</div>