# wordpress_custom_logging
A piece of code that can be used to create a logging file and log data, arrays and objects into wordpress

This is Simple to install:

Add the following code to your functions.php or another included file:

<?php 
if ( ! function_exists( 'my_custom_log_file' ) ) {
	function my_custom_log_file( $entry ) { 
		$file = 'my_custom_log_file';
		
		// Get WordPress uploads directory.
		$upload_dir = wp_upload_dir();
		$upload_dir = $upload_dir['basedir'];
		// If the entry is array, json_encode.
		if ( is_array( $entry ) || is_object($entry) ) { 
			$entry = json_encode( $entry ); 
		} 

		// Write the log file.
		$file  = $upload_dir . '/' . $file . '-' . date('d-m-Y'). '.log';	  
		$mode = ( ! file_exists($file) ) ? 'w' : 'a'; //write new or append
	  
		
		if (!empty($entry)) {
			$file  = fopen( $file, $mode );
			$bytes = fwrite( $file, current_time( 'mysql' ) . "::" . $entry . "\n" ); 
			fclose( $file ); 
			return $bytes;
		}

		return;
	}
  }

  add_action( 'init', 'my_custom_log_file' );
  ?>
