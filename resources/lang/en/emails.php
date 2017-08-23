<?php

return [
	'employee_login' => [
        'subject' => 'Welcome to :name',
        'body' => '
            <p>Dear :name,</p>
            <p>Welcome to :system. Please follow this <a href=":change_pass_route">link</a> to set up your password. Your email address is :email.</p>
            <p>Thanks,</p>
            <p>:signature</p>',
    ]
];