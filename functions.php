
/**
 * Write an entry to a log file in the uploads directory.
 * 
 * @since x.x.x
<?php  
* 
 * @param mixed $entry String or array of the information to write to the log.
 * @param string $file Optional. The file basename for the .log file.
 * @param string $mode Optional. The type of write. See 'mode' at https://www.php.net/manual/en/function.fopen.php.
 * @return boolean|int Number of bytes written to the lof file, false otherwise.
 */
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


// Use the following to trigger a log file
my_custom_log_file('------------------------------------------------------------------------------------------------------------------------------------');
my_custom_log_file('------------------------------------------------------------------------------------------------------------------------------------');
my_custom_log_file(current_action());
my_custom_log_file($data);
my_custom_log_file('Check Address');
my_custom_log_file($response);
my_custom_log_file('httpcode: '. $httpcode);



?>
