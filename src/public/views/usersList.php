<div class="d-flex align-items-baseline justify-content-between">
	<h1>Users</h1>
	<a href="/create-user" class="">Create User</a>
</div>

<?php
if (count($pageData['messages']) > 0) {
	foreach ($pageData['messages'] as $message) {
		$type = $message['type'] === 'success' ? 'success' : 'danger';
		echo "<div class=\"alert alert-$type\" role=\"alert\">";
		echo $message['message'] . '<br>';
		echo '</div>';
	}
}
?>

<hr>

<form method="get" action="/users">
	<div class="input-group">
		<span class="input-group-text">Age From/To</span>
		<input class="form-control" type="number" name="age_from" min="0" max="100"
			value="<?php echo $pageData['ageFrom']; ?>">
		<input class="form-control" type="number" name="age_to" min="0" max="100"
			value="<?php echo $pageData['ageTo']; ?>">
		<button type="submit" class="btn btn-primary">Filter</button>
	</div>
</form>

<hr>

<table class="table table-hover align-middle">
	<thead>
		<th>#</th>
		<th>Name</th>
		<th>Email</th>
		<th>Age</th>
		<th>Registered</th>
		<th class="text-end">Actions</th>
	</thead>
	<tbody class="table-group-divider">
		<?php foreach ($pageData['users'] as $user): ?>
			<tr>
				<td>
					<?= $user['id']; ?>
				</td>
				<td>
					<?= $user['name']; ?>
				</td>
				<td>
					<?= $user['email']; ?>
				</td>
				<td>
					<?= $user['age']; ?>
				</td>
				<td>
					<?= $user['registered_at']; ?>
				</td>
				<td class="text-end">
					<div class="btn-group">
						<a class="btn btn-sm btn-primary" href="/user?id=<?= $user['id'] ?>">Update</a>
						<a class="btn btn-sm btn-danger" href="/delete-user?id=<?= $user['id'] ?>">Delete</a>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
