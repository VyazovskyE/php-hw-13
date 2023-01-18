<h1>Add employee</h1>

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
		<p>Employee added successfully</p>
	</div>
<?php endif; ?>

<form action="/add-employee" method="post">
	<div class="mb-3">
		<label for="employeeNumber">Number</label>
		<input type="text" name="employeeNumber" id="employeeNumber" class="form-control">
	</div>
	<div class="mb-3">
		<label for="first_name">First name</label>
		<input type="text" name="firstName" id="firstName" class="form-control">
	</div>
	<div class="mb-3">
		<label for="last_name">Last name</label>
		<input type="text" name="lastName" id="lastName" class="form-control">
	</div>
	<div class="mb-3">
		<label for="extension">Extension</label>
		<input type="text" name="extension" id="extension" class="form-control">
	</div>
	<div class="mb-3">
		<label for="email">Email</label>
		<input type="text" name="email" id="email" class="form-control">
	</div>
	<div class="mb-3">
		<label for="reportsTo">Manager</label>
		<select name="reportsTo" id="reportsTo" class="form-control">
			<?php foreach ($pageData['employees'] as $employee): ?>
				<option value="<?php echo $employee['employeeNumber']; ?>"><?php echo $employee['firstName'] . ' ' . $employee['lastName']; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="mb-3">
		<label for="officeCode">Office</label>
		<select name="officeCode" id="officeCode" class="form-control">
			<?php foreach ($pageData['offices'] as $office): ?>
				<option value="<?php echo $office['officeCode']; ?>"><?php echo $office['city'] . ' ' . $office['addressLine1']; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="mb-3">
		<label for="jobTitle">Job title</label>
		<input type="text" name="jobTitle" id="jobTitle" class="form-control">
	</div>
	<div class="mb-3">
		<button type="submit" class="btn btn-primary">Add</button>
	</div>
</form>
