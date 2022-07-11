# wordpress_custom_logging
A piece of code that can be used to create a logging file and log data, arrays and objects into wordpress

This is Simple to install:

Add the following code to your functions.php or another included file:


```
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

```

Then all you need to do is call the log function from anywhere in your code:

Spacing: 
```
my_custom_log_file('------------------------------------------------------------------------------------------------------------------------------------');
```

Text/string: 
```
my_custom_log_file('This is a string log');
```

Variables: 
```
$test = 'this is a string';
my_custom_log_file('What does the string say?' . $test);
```

array: 
```
my_custom_log_file(['test' => $data, 'test2' => $data2]);
```

obj: 
```
$obj = new stdObj;
$obj->test = 'hi';
$obj->test2 = 'hi2';

my_custom_log_file($obj);
```

WordPress Actions: (displays current hook running)
```
my_custom_log_file(current_action());
```
