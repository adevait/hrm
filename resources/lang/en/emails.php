<?php

return [
	'employee_login' => [
        'subject' => 'Welcome to :name',
        'body' => '
            <p>Dear :name,</p>
            <p>Welcome to :system. Follow this <a href=":url">link</a> to log in with the details below.</p>
            <p>Email: :email</p>
            <p>Password: :password</p>
            <p>Please use the assigned password only for the initial log in, and then change it to your password of choice on the following <a href=":change_pass_route">link</a>.</p>
            <p>Thanks,</p>
            <p>:signature</p>',
    ]
];