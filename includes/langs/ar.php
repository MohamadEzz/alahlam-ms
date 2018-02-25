<?php

	function lang ( $phrase ){
		static $lang = array(

			'MASAGE' => 'اهلا',
			'ADMIN' => 'المدير'

			);
		return $lang[$phrase];

	}