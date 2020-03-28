<?php

return [

	'response' => [

		'add'    => [

			'code'    => 'A01',
			'message' => 'Item added successfully!'
		],

		'remove' => [

			'code'    => 'R01',
			'message' => 'Item removed successfully!'
		],

		'status' => [

			'code'    => 'Z01',
			'message' => 'Status updated!'
		],

		'success' => [

			'code'    => 'S01',
			'message' => 'Success!'
		],

		'error' => [

			'code'    => 'E01',
			'message' => 'Whoops, looks like something went wrong! Please try again.'
		],

		'login' => [
			'inactive' => [
				'code'    => 'L01',
				'message' => 'User is inactive'
			],			
			'invalid' => [
                'code'    => 'L02',
                'message' => 'Wrong email or password!'
            ],
            'not_verified' => [
				'code'    => 'L03',
				'message' => 'User is not verified'
			],		  
		],        
	],

];