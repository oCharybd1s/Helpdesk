<?php
	function randString($length=6){
		$key = '';
		$length = $length;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$key = '';
		for ($i = 0; $i < $length; $i++) {
			$key .= $characters[rand(0, $charactersLength - 1)];
		}

		return $key;
	}

	function rangeTimeToSecond($start_dateTime="2015-02-03 18:07:13", $end_dateTime="2015-09-08 18:11:08")
	{
		$date = new DateTime( $start_dateTime );
		$date2 = new DateTime( $end_dateTime );
	    return $date2->getTimestamp() - $date->getTimestamp(); //in seconds
	}

	function sqlToDate($date_, $format='d/m/Y')
	{
		$new_date = ($date_=='' || $date_==null || $date_==undefined)? '' : date($format, strtotime($date_));
		return $new_date;
	}

	function thisDate($date='', $format='Y-m-d', $intval_day=0){
		$date = $date==''? date('Y-m-d H:i:s'):sqlToDate($date, 'Y-m-d H:i:s');
		return date($format,strtotime("$date $intval_day days"));
	}

	function is_json($text=''){
		$result = false;
		json_encode($text);
		if( json_last_error() === JSON_ERROR_NONE ) $result = true;
		return $result;
	}

	function rangeDate($start_date="2015-09-03", $end_date="2015-09-08")
	{
		$start_date = new DateTime($start_date);
		$end_date = new DateTime($end_date);
		$interval = $start_date->diff($end_date);
		return $interval->days; //in days
	}

	function secondsToTime($seconds=0, $type='time') {
    // $type='time/value/decimal
		if($seconds>0){
			$dtF = new \DateTime('@0');
			$dtT = new \DateTime("@$seconds");
        // return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
        // return $dtF->diff($dtT)->format('%a:%h:%i:%s');
			$days = $dtF->diff($dtT)->days;
			$hour = $dtF->diff($dtT)->h+($days*24);
			$hour = $hour>9?$hour:'0'.$hour;
			$minute = $dtF->diff($dtT)->i>9?$dtF->diff($dtT)->i:'0'.$dtF->diff($dtT)->i;
			$second = $dtF->diff($dtT)->s>9?$dtF->diff($dtT)->s:'0'.$dtF->diff($dtT)->s;
			if( $type=='time' ){
				return $hour.':'.$minute.':'.$second;
			}
			if( $type=='value' ){
				return $hour.' Jam '.$minute.' Menit '.$second.' Detik';
			}
			if( $type=='minutes' ){
				return $minute. ' Menit';
			}
			if( $type=='hour' ){
				return $hour.' Jam ';
			}
			if( $type=='decimal' ){
				return number_format( ($seconds/3600), 2, '.', '');
			}

        // return $dtF->diff($dtT)->format('%h+(%a*24):%i:%s');
		}else{
			return 0;
		}
	}

	function active_interval($last_update){
		$now = date("Y-m-d H:i:s");
		$diff = strtotime($now) - strtotime($last_update);
		if($diff < 120){
			return "Aktif Baru Saja";
		}else if($diff > 120 && $diff < 3600){
			return secondsToTime($diff, 'minutes').' yang lalu'; 
		}else{
			return secondsToTime($diff, 'hour'). 'yang lalu';
		};
	}

	function uploadFile($file_post, $storeFolder ,$nama_file, $allow_type=['jpg','jpeg','png','gif'])
	{
		if (!empty($file_post)) {
			$tempFile = $file_post['tmp_name'];          
			$targetPath = create_dir($storeFolder);
			$explode_name = explode(".", $file_post['name']);
			$ext = end($explode_name);

			if ( count($allow_type)>0 && !in_array($ext,$allow_type) ) return;

			$fileName =  $nama_file.'.'.$ext;
			$targetFile =  $targetPath.$fileName;
			if( move_uploaded_file($tempFile,$targetFile) ){
				smart_resize_image($targetFile);
				return $fileName;
			}
		}
	}

	function create_dir($path)
	{
		$var = explode(_DS, str_replace(["/", "\\"], _DS, $path));
		$dir = '';
		foreach ($var as $key => $value) {
			if ($dir=='') {
				$dir.=$value;
			} else {
				$dir.=_DS.$value;
			}
			if (!is_dir($dir)) {
				mkdir($dir);
			}
		}
		$path = '';
		foreach ($var as $key => $val) {
			$path .= $val._DS;
		}
		return $path;
	}

	function smart_resize_image($file, $string=null, $width=200, $height=200, $proportional=true, $output='file', $delete_original=true, $use_linux_commands = false,$quality = 100)
	{      
		if ( $height <= 0 && $width <= 0 ) return false;
		if ( $file === null && $string === null ) return false;
		
    # Setting defaults and meta
		$info                         = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
		$image                        = '';
		$final_width                  = 0;
		$final_height                 = 0;
		list($width_old, $height_old) = $info;
		$cropHeight = $cropWidth = 0;
		if ( $height_old<=$height || $width_old<=$width ) return false;
		
    # Calculating proportionality
		if ($proportional) {
			if      ($width  == 0)  $factor = $height/$height_old;
			elseif  ($height == 0)  $factor = $width/$width_old;
			else                    $factor = min( $width / $width_old, $height / $height_old );
			
			$final_width  = round( $width_old * $factor );
			$final_height = round( $height_old * $factor );
		}
		else {
			$final_width = ( $width <= 0 ) ? $width_old : $width;
			$final_height = ( $height <= 0 ) ? $height_old : $height;
			$widthX = $width_old / $width;
			$heightX = $height_old / $height;
			
			$x = min($widthX, $heightX);
			$cropWidth = ($width_old - $width * $x) / 2;
			$cropHeight = ($height_old - $height * $x) / 2;
		}
		
    # Loading image to memory according to type
		switch ( $info[2] ) {
			case IMAGETYPE_JPEG:  $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);  break;
			case IMAGETYPE_GIF:   $file !== null ? $image = imagecreatefromgif($file)  : $image = imagecreatefromstring($string);  break;
			case IMAGETYPE_PNG:   $file !== null ? $image = imagecreatefrompng($file)  : $image = imagecreatefromstring($string);  break;
			default: return false;
		}
		
		
    # This is the resizing/resampling/transparency-preserving magic
		$image_resized = imagecreatetruecolor( $final_width, $final_height );
		if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
			$transparency = imagecolortransparent($image);
			$palletsize = imagecolorstotal($image);
			
			if ($transparency >= 0 && $transparency < $palletsize) {
				$transparent_color  = imagecolorsforindex($image, $transparency);
				$transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
				imagefill($image_resized, 0, 0, $transparency);
				imagecolortransparent($image_resized, $transparency);
			}
			elseif ($info[2] == IMAGETYPE_PNG) {
				imagealphablending($image_resized, false);
				$color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
				imagefill($image_resized, 0, 0, $color);
				imagesavealpha($image_resized, true);
			}
		}
		imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);
		
		
    # Taking care of original, if needed
		if ( $delete_original ) {
			if ( $use_linux_commands ) exec('rm '.$file);
			else @unlink($file);
		}
		
    # Preparing a method of providing result
		switch ( strtolower($output) ) {
			case 'browser':
			$mime = image_type_to_mime_type($info[2]);
			header("Content-type: $mime");
			$output = NULL;
			break;
			case 'file':
			$output = $file;
			break;
			case 'return':
			return $image_resized;
			break;
			default:
			break;
		}
		
    # Writing image according to type to the output destination and image quality
		switch ( $info[2] ) {
			case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
			case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
			case IMAGETYPE_PNG:
			$quality = 9 - (int)((0.9*$quality)/10.0);
			imagepng($image_resized, $output, $quality);
			break;
			default: return false;
		}
		
		return true;
	}

	function sendMail($to='someone@example.com', $subject='', $message=''){
	    $from = 'no-reply';
	    $noreply = 'no-reply';
	    $subject = $subject;
	    
	    $headers = "From: " . $from . "\r\n";
	    $headers .= "Reply-To: ". $noreply . "\r\n";
	    $headers .= "MIME-Version: 1.0\r\n";
	    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$msg = '<html lang="en">
				  <meta charset="utf-8">
				  <meta name="viewport" content="width=device-width, initial-scale=1">
				  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
				  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
				  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
				<body>

				<nav class="navbar navbar-inverse">
				  <div class="container-fluid">
				    
				  </div>
				</nav>
				  
				<div class="container-fluid text-center">    
				  <div class="row content">
				    <div class="col-sm-2 sidenav">
				    </div>
				    <div class="col-sm-8 text-left"> 
						<center>
							<div id="logo">
								<img src="http://terra-id.com/1KQUtlPA.png" style="height:50%;">
							</div>
							<h3>Selamat Bergabung di terra GPS</h3>
							<h3>Kode Verifikasi</h3>
							<h3>'.wordwrap($message,70).'</h3>
							<h3>Silahkan masukan kode tersebut untuk melakukan pendaftaran</h3>
						</center>
				    </div>
				    <div class="col-sm-2 sidenav">
				    </div>
				  </div>
				</div>

				<footer class="container-fluid text-center">
				</footer>

				</body>
				</html>';

		mail($to,$subject,$msg,$headers);
	}

	function otpGenerateKey($length=4){
		$key = '';
		$length = $length;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$key = '';
		for ($i = 0; $i < $length; $i++) {
			$key .= $characters[rand(0, $charactersLength - 1)];
		}

		return $key;
	}

	function coorDistance($lat1, $lon1, $lat2, $lon2, $unit="METER") { 
		//function untuk menghitung jarak antar 2 titik longitutde dan latitude
        // $lat1 = (float)$lat1;
        // $lon1 = (float)$lon1;
        // $lat2 = (float)$lat2;
        // $lon2 = (float)$lon2;
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else if ($unit == "METER") {
            return ($miles * 1609.34);
        } else {
            return $miles;
        }
    }

    function sendSmsOtp($phone_number, $content){
		$username = 'mask_demo3';
		$password = '123456';
		$sender = 'ACM';
		$url = "https://numberic1.tcastsms.net:20005/sendsms?account=$username&password=$password&numbers=$phone_number&sender=$sender&content=$content";
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch), true);
		curl_close($ch);
		$result='error';
		if( $response['success'] ){
			$result='success';
		}
		return $result;
	}

	if (!function_exists('rutanApiPhp')) {
	function rutanApiPhp($post=[]){
		$ch = curl_init(api_rutan);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch), true);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$err = curl_error($ch);
		curl_close($ch);
		if($status=='200'){
			$result = $response['result'];
		}else{
			$result = ['code'=>$status, 'error'=>$err];
		}
		return $result;
	}
}
?>