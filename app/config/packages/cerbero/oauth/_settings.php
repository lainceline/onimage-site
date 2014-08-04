<?php

return array(

	/**
	 * URI where the user is redirected to
	 * after having granted authorization.
	 */
	'redirect_uri' => '',

	/**
	 * Driver to use as token storage.
	 * When null is set, the main application driver is used.
	 * Supported: "redis", "memcached", "apc", "database", "file"
	 */
	'storage' => null

);