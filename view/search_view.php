<!-- 検索ボックス -->
<form class="form-wrapper search-box" action="search.php" method="post">
	<h1 class="heading">顧客検索</h1>
	<?php if (count($errors) > 0): ?>
		<ul class="error-message">
		<?php foreach ($errors as $error): ?>
			<li><?php echo $error ?></li>
		<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<div class="form-item">
		<label class="form-label">氏名</label>
		<input type="text" name="name" value="<?php echo htmlspecialchars($searchform['name'], ENT_QUOTES, 'UTF-8') ?>">
	</div>
	<div class="form-item">
		<label class="form-label">職業</label>
		<?php foreach ($occupation_master as $occupation): ?>
			<label for="occupation-<?php echo htmlspecialchars($occupation['id'], ENT_QUOTES, 'UTF-8') ?>">
			<input type="checkbox" name="occupations[]" value="<?php echo htmlspecialchars($occupation['id'], ENT_QUOTES, 'UTF-8') ?>" id="occupation-<?php echo htmlspecialchars($occupation['id'], ENT_QUOTES, 'UTF-8') ?>" <?php if (in_array($occupation['id'], $searchform['occupations'])) echo 'checked' ?>>
			<?php echo htmlspecialchars($occupation['name'], ENT_QUOTES, 'UTF-8') ?>
			</label>
		<?php endforeach; ?>
	</div>
	<div class="form-item">
		<label class="form-label">生年月日</label>
		<input type="date" name="from_birthday" class="search-date" value="<?php echo htmlspecialchars($searchform['from_birthday'], ENT_QUOTES, 'UTF-8') ?>"> ~ 
		<input type="date" name="to_birthday" class="search-date" value="<?php echo htmlspecialchars($searchform['to_birthday'], ENT_QUOTES, 'UTF-8') ?>">
	</div>
	<input class="form-button" type="submit" value="検索">
</form>

<!-- 検索結果 -->
<?php if (count($customers) > 0): ?>
<p>検索結果 <?php echo htmlspecialchars($count, ENT_QUOTES, 'UTF-8') ?>件</p>
<table class="search-result">
	<thead>
		<tr>
			<th>ID</th>
			<th>氏名</th>
			<th>職業</th>
			<th>生年月日</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($customers as $customer): ?>
		<tr>
			<td><?php echo htmlspecialchars($customer['customer_id'], ENT_QUOTES, 'UTF-8') ?></td>
			<td><?php echo htmlspecialchars($customer['customer_name'], ENT_QUOTES, 'UTF-8') ?></td>
			<td><?php echo htmlspecialchars($customer['occupation_name'], ENT_QUOTES, 'UTF-8') ?></td>
			<td><?php echo htmlspecialchars($customer['customer_birthday'], ENT_QUOTES, 'UTF-8') ?></td>
			<td><a href="edit.php?id=<?php echo htmlspecialchars($customer['customer_id'], ENT_QUOTES, 'UTF-8') ?>">編集</a><a href="delete.php?id=<?php echo htmlspecialchars($customer['customer_id'], ENT_QUOTES, 'UTF-8') ?>">削除</a></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<div class="pagination clearfix">
	<?php if ($hasPrevious): ?>
		<a href="paginate.php?page=<?php echo $page - 1 ?>" class="form-button float-left">前へ</a>
	<?php endif; ?>
	<?php if ($hasNext): ?>
		<a href="paginate.php?page=<?php echo $page + 1 ?>" class="form-button float-right">次へ</a>
	<?php endif; ?>
</div>
<?php endif; ?>