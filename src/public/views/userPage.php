<? $user = $pageData['user']; ?>
<div class="d-flex align-items-baseline justify-content-between">
	<h1>
		<?= $user['name'] ?>
	</h1>
	<a href="/users" class="">Back</a>
</div>

<pre>
	<?php print_r($_SESSION); ?>
</pre>

<hr>

<?php if (!empty($pageData['errors'])): ?>
	<div class="alert alert-danger">
		<?php foreach ($pageData['errors'] as $error): ?>
			<p><?php echo $error; ?></p>
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
	<input type="hidden" name="id" value="<?= $user['id'] ?>">
	<div class="mb-3">
		<label for="name">Name</label>
		<input type="text" value="<?= $user['name'] ?>" name="name" id="name" class="form-control">
	</div>
	<div class="mb-3">
		<label for="email">Email</label>
		<input type="text" value="<?= $user['email'] ?>" name="email" id="email" class="form-control">
	</div>
	<div class="mb-3">
		<label for="age">Age</label>
		<input type="text" value="<?= $user['age'] ?>" name="age" id="age" class="form-control">
	</div>
	<div class="mb-3">
		<button type="submit" class="btn btn-primary">Update</button>
	</div>
</form>
