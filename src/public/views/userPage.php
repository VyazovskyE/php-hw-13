<?
$user = $pageData['user'];
$formFields = $pageData['formFields'];
?>
<div class="d-flex align-items-baseline justify-content-between">
	<h1>
		<?= $user['name'] ?>
	</h1>
	<a href="/users" class="">Back</a>
</div>
<p class="text-muted">
	Registered at <?= $user['registered_at'] ?>
</p>

<hr>

<?php if (!empty($pageData['errors'])): ?>
	<div class="alert alert-danger">
		<?php foreach ($pageData['errors'] as $error): ?>
			<p>
				<?php echo $error; ?>
			</p>
		<?php endforeach; ?>
	</div>

	<hr>
<?php endif; ?>

<?php if ($pageData['success']): ?>
	<div class="alert alert-success">
		<p>User updated successfully</p>
	</div>

	<hr>
<?php endif; ?>

<form action="/update-user" method="post">
	<?php foreach ($formFields as $key => $value): ?>
		<?php if ($key === 'id'): ?>
			<input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
		<?php else: ?>
			<div class="mb-3">
				<label for="<?= $key ?>"><?= ucfirst($key) ?></label>
				<input type="text" value="<?= $value ?>" name="<?= $key ?>" id="<?= $key ?>" class="form-control">
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
	<div class="mb-3">
		<button type="submit" class="btn btn-primary">Update</button>
	</div>
</form>
