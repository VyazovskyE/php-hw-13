<div class="d-flex align-items-baseline justify-content-between">
	<h1>Add User</h1>
	<a href="/users" class="">Users List</a>
</div>

<hr>

<?php if (!empty($pageData['errors'])): ?>
	<div class="alert alert-danger">
		<?php foreach ($pageData['errors'] as $error): ?>
			<p><?php echo $error; ?></p>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<?php if ($pageData['success']): ?>
	<div class="alert alert-success">
		<p>User added successfully</p>
	</div>
<?php endif; ?>

<form action="/create-user" method="post">
	<div class="mb-3">
		<label for="name">Name</label>
		<input type="text" name="name" id="name" class="form-control">
	</div>
	<div class="mb-3">
		<label for="email">Email</label>
		<input type="text" name="email" id="email" class="form-control">
	</div>
	<div class="mb-3">
		<label for="age">Age</label>
		<input type="text" name="age" id="age" class="form-control">
	</div>
	<div class="mb-3">
		<button type="submit" class="btn btn-primary">Create</button>
	</div>
</form>
