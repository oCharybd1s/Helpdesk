<?php 
file_put_contents('./for_rollback/config/config.php', 'dawda');
// function scan($path, $file_list){
// 	$tmp = [];
// 	foreach (scandir($path) as $key => $value) {
// 		if( !in_array($value, ['.','..' ]) ){
// 			if( is_dir($path.$value) ){
// 				// dd( $path.$value.'/' , false);
// 				scan($path.$value.'/', []);
// 			}else{
// 				if( file_exists($path.$value) ){
// 					$modif_date = date("Y-m-d H:i:s.", filemtime($path.$value));
// 					if( $modif_date>=date("Y-m-d H:i:s.", strtotime('-7 days')) ){
// 						dd(  [
// 							'last_modified' => $modif_date,
// 							'filename' => $path.$value,
// 						], false );
// 						// $tmp[] = [
// 						// 	'filename' => $path.$value,
// 						// 	'last_modified' => $modif_date
// 						// ];
// 					}
// 				}
// 			}
// 		}
// 	}
// }
// $file_list = [];
// scan('./module/', $file_list);
// scan('./page/', $file_list);

?>
<script src="template/porto/vendor/jquery/jquery.js"></script>
<?php require sis_core('js/autoload.php'); ?>
<script type="text/javascript">
	swal.close();
	var all_file = {};
	function tes(check_path='./'){
		sendPost('Dev_protect', {
			type_submit : 'getScanDir',
			check_path : check_path
		}, (r)=>{
			if( r.status=='success' ){
				$.map(r.data.file, function(file) {
					all_file[file.name] = file.modified_date;
					return file;
				});
				$.map(r.data.folder, function(folder) {
					// tes(`${folder}/`);
					return folder;
				});
			}
		});
	}
</script>