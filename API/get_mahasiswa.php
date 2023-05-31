<?php 
	
	$code = 500;
	try {
		
		include '../conn.php';
	
		$sql = "SELECT * FROM user WHERE level != 'guru'";
		$query = mysqli_query( $connect, $sql );
		
		$dt_keseluruhan = array();
		
		while ( $row = mysqli_fetch_array( $query ) ) {
				
			$isi = [
				'id_user'     => $row['id_user'],
				'nomor_induk' => $row['nomor_induk'],
				'email'	=> $row['email'],
				'nama'	=> $row['nama'],
				'level' => $row['level']
			];
			array_push( $dt_keseluruhan, $isi );
		}
		
		$data = array(
			
			'status'	=> 200,
			'result'	=> $dt_keseluruhan,
			'message'	=> "Data user berhasil di ambil"
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