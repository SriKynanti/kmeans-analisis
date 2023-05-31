<?php 
	
	$code = 500;
	
	
	try {
		
		include '../conn.php';
	
		$sql = "SELECT level as kelas FROM user WHERE level != 'guru' GROUP BY level";
		$query = mysqli_query( $connect, $sql );
		
		$dt_keseluruhan = array();
		
		while ( $row = mysqli_fetch_array( $query ) ) {
				
			$isi = ['kelas' => $row['kelas']];
			array_push( $dt_keseluruhan, $isi );
		}
		
		$data = array(
			
			'status'	=> 200,
			'result'	=> $dt_keseluruhan,
			'message'	=> "Data kelas berhasil di ambil"
		);
		
	} catch ( Exception $e ){
			
		$data = array(
			'status'	=> 500,
			'result'	=> [],
			'message'	=> $e
		);
	}
	
	
	
	echo json_encode( $data );
	
	
	
	
?>