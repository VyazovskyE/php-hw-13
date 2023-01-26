<?php

return [
	'/customers' => 'Customers@get',
	'/employees' => 'Employees@get',
	'/job-titles' => 'Employees@getJobTitles',
	'/orders' => 'Orders@get',
	'/add-employee' => 'Employees@addEmployee',
	'/add-customer' => 'Customers@addCustomer',
	'/create-user' => 'Users@createUser',
	'/users' => 'Users@userList',
	'/user' => 'Users@userPage',
	'/update-user' => 'Users@updateUser',
	'/delete-user' => 'Users@deleteUser',
];
