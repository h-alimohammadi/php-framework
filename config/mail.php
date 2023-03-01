<?php

return [
    'SMTP' => [
        'Host'       => 'smtp.google.io',
        'SMTPAuth'   => true,
        'UserName'   => 'test@gmail.com',
        'Password'   => 'test',
        'Port'       => 587,
        'setFrom'    => [
            'mail'  =>  'support@test.com',
            'name'  =>  'test'
        ]
    ]
];

