$(document).ready(function(){	
	if(sessionStorage.getItem("yanglogin")=='' || !sessionStorage.getItem("yanglogin") ){
		// localStorage.clear();
		removelocalstorage();
	}else{
		
		if(readCookie('halaman')=='' || !readCookie('halaman')){
			var halaman = 'homehd'; 
		    var subhalaman = 'Beranda'; 
		    var namamenu = 'Beranda'; 
		    var icon = 'fa fa-home'; 
		    page_changing(halaman,subhalaman ,namamenu , icon);
		}else{
		    var halaman = readCookie('halaman'); 
		    var subhalaman = readCookie('subhalaman'); 
		    var namamenu = readCookie('namamenu'); 
		    var icon = readCookie('icon'); 
		    page_changing(halaman,subhalaman ,namamenu , icon);
		}		
		var start = new Date;
		setInterval(function() {
		    // if(Math.round((new Date - start) / 1000)%30==0){/
		    if(sessionStorage.getItem("yanglogin")=='' || !sessionStorage.getItem("yanglogin") ){
				// localStorage.clear();
				removelocalstorage();
				location.href='?';
				return;
			}
		    	$.ajax({
					async:false,
					type: "POST",
					dataType: 'json',
					data:{generatemenu:'generatemenu'},
					url:'../action/Home.php',
					success: function (result) {
						$('#jumDimintaDikerjakan').text(result[0]['jumDimintaDikerjakan']);
						$('#jumSedangDikerjakan').text(result[1]['jumSedangDikerjakan']);
						$('#jumBelumDitangani').text(result[2]['jumBelumDitangani']);
						$('#jumPengajuanBaru').text(result[3]['jumPengajuanBaru']);
						$('#jumTungguAccPATA').text(result[4]['jumTungguAccPATA']);
						$('#jumPengajuanSiap').text(result[5]['jumPengajuanSiap']);
						$('#totalHelpdesk').text(result[6]['totalHelpdesk']);
						$('#totalPengajuan').text(result[7]['totalPengajuan']);
						if(result.length>9){
							$('#jumverifHD').text(result[8]['jumverifHD']);
							$('#jumverifPeng').text(result[9]['jumverifPeng']);
							$('#totalPATA').text(result[10]['totalPATA']);
						}						
					},error: function(xhr, ajaxOptions, thrownError){
			            alert(xhr.status);
			        }
				});
		    // }/
		}, 20000);

		// setInterval(function() {
		// 	$.ajax({
		// 		async:false,
		// 		type: "POST",
		// 		data:{cekTimeOut:'cekTimeOut'},
		// 		url:'../action/Home.php',
		// 		success: function (result) {
		// 			if(result=="confirm"){
		// 				var cookies = document.cookie.split(";");
		// 				for(var i=0; i < cookies.length-1; i++) {
		// 				    var equals = cookies[i].split("=");
		// 				    var name = equals[0].replace(" ", "");
		// 				    document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
		// 				}
		// 				sessionStorage.clear();
		// 				setTimeout(function(){
		// 				    // dialog.modal('hide');
		// 				    location.href = "logout.php";
		// 				    exit();
		// 				}, 1000);
		// 			}else{}
		// 		},error: function(xhr, ajaxOptions, thrownError){
		//             alert(xhr.status);
		//         }
		// 	});
		
		// }, 1800000);			
	}
	setInterval(kirimemail,20000);
	setInterval(checkNewMessage,10000);
});
function kirimemail(){
	if(sessionStorage.getItem("yanglogin")=='' || !sessionStorage.getItem("yanglogin") ){
		// localStorage.clear();
		removelocalstorage();
		return;
	}
	var dt = new Date();
	var jam = dt.getHours();
	// alert(jam);
	if(jam=="17"){
		// alert('kirim email');
		setTimeout(function(){
		$.ajax({
		  url: '../resources/Email/index2.php',
		  type: 'post',
		  // dataType: 'json',
		  success: function(result){
		  	// alert(result);
		  }
		 });
	},500);
	}
	  
}
function removelocalstorage(){
	localStorage.removeItem('kehendak');
	localStorage.removeItem('jenis');
	localStorage.removeItem('jenisLaporan');
	localStorage.removeItem('programYangDimaksud');
	localStorage.removeItem('status');
	localStorage.removeItem('tanggal');
	localStorage.removeItem('bulan');
	localStorage.removeItem('tahun');
	localStorage.removeItem('jenisfilterlap');
	localStorage.removeItem('tanggalmulailap');
	localStorage.removeItem('tanggalsampailap');
	localStorage.removeItem('cabang');
	localStorage.removeItem('attch');
	localStorage.removeItem('statusselesai');
	localStorage.removeItem('content');
	localStorage.removeItem('halawal');
	localStorage.removeItem('tombolterpilih');
}
function checkNewMessage(){
	if(sessionStorage.getItem("yanglogin")=='' || !sessionStorage.getItem("yanglogin") ){
		// localStorage.clear();
		removelocalstorage()
		return;
	}
	var noid = sessionStorage.getItem("yanglogin");
	setTimeout(function(){
	  $.ajax({
	  url: '../action/getTugas.php',
	  type: 'post',
	  dataType: 'json',
	  data:{noidP: noid},
	  success: function(result){
	  	var alertnya = "";
	  	$('#menu1').html='<li><div class="text-center"><a><strong>See All Alerts</strong><i class="fa fa-angle-right"></i></a></div></li>';
	   // console.log(result);	   
	   $('#msgjumlah').text(result[0]);
	   // $('#msgfrom').text('Dari : '+result[1][0]["dari"]);
	   // $('#msgtime').text(result[1][0]["menit"]);
	   // $('#msgtxt').text(result[1][0]["msg"].substring(1,100)+'...');
	   for(i=0;i<result[1].length;i++){
	   	var nohd = "'"+result[1][i]["No"]+"'";
	   	var judul = "'"+result[1][i]["judul"]+"'";
	   	var issuenya = "";
	   	if(result[1][i]["issue"]===null)
	   	{
	   		issuenya = "";
	   	}else{
	   		issuenya = result[1][i]["issue"].substring(0,100);
	   	}
	   		alertnya = alertnya+'<li onclick="'+result[1][i]["linkedit"]+'('+nohd+','+judul+');"><a><span><span>Title : '+result[1][i]["judul"]+'</span></br><span>Dari : '+result[1][i]["darinama"]+'</span><span class="time">'+result[1][i]["menit"]+'</span></span><span class="message">'+issuenya+'...</span></a></li>';
	   }
	   alertnya = alertnya+'<li><div class="text-center"><a><strong>See All Alerts</strong><i class="fa fa-angle-right"></i></a></div></li>';
	   $('#menu1').html(alertnya);
	  }
	 });
	 },500);
}

function collapseOnly(param){ //ini global untuk semua yang collapse
	var $BOX_PANEL = $(param).closest('.x_panel'),
        $ICON = $(param).find('i'),
        $BOX_CONTENT = $BOX_PANEL.find('.x_content');
    if ($BOX_PANEL.attr('style')) {
        $BOX_CONTENT.slideToggle(200, function(){
            $BOX_PANEL.removeAttr('style');
        });
    } else {
        $BOX_CONTENT.slideToggle(200); 
        $BOX_PANEL.css('height', 'auto');  
    }
    $ICON.toggleClass('fa-chevron-up fa-chevron-down');
}
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

// -------------- block Login --------------
$("#Password").keydown(function(event) {
    if (event.keyCode === 13) {
        $("#login").click();
    }
});
$('#login').click(function(){
	var xname = $('#Username').val();
	var xpass = $('#Password').val();
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i> Autentikasi user...</p>'
	});
	dialog.init(function(){
		$.ajax({
		  async:false,
		  type: "POST",
		  dataType: "json",
		  // data:{target:"loginhelpdesk",
		  //           key:"XHPeBEMTDH8Kcl5FCor9",
		  //           iddbase:"DB00000007",
		  //           idapi:"API0000013",
		  //           UserNameAPI0000013: xname,
		  //           PasswordAPI0000013: xpass
		  //       },
		  data:{target:"LoginGlobal",
		            key:"abUnn2e4evpP1vXmJGMa",
		            iddbase:"DB00000058",
		            idapi:"API0000150",
		            emp_noAPI0000150: xname,
		            passAPI0000150: xpass
		        },
		  url:_api_rutan,
		  success: function (hasil) {
		    setTimeout(function(){
		      if(hasil["status"]=="success"){;
		        if(hasil["result"].length>=1){
		        	sessionStorage.setItem("yanglogin", xname);
		        	// console.log(hasil);
					// setsessionlogin(hasil,xname,xpass);
					x = setsessionlogin(hasil,xname,xpass);
					x.success(function(has){
						console.log(has);
						if(has == 1)
						{
							setTimeout(function(){
							    dialog.find('.bootbox-body').html('Login berhasil....');
							}, 1000);
							setTimeout(function(){
							    dialog.modal('hide');
							    location.href = "main/home.php";
							    exit();
							}, 1500);
						}
						else
						{
							setTimeout(function(){
							    dialog.find('.bootbox-body').html('<center><p style="color:red;">LOGIN FAILED </p> <strong>Status :</strong><br> HRIS : Exist. <br> Helpdesk : Does not Exist, </center>');
								$('#Password').val('');
							}, 1000);
							// setTimeout(function(){
							//     dialog.modal('hide');
							// }, 1500);
						}

					});

					// setTimeout(function(){
					//     dialog.find('.bootbox-body').html('Login berhasil....');
					// }, 1000);
					// setTimeout(function(){
					//     dialog.modal('hide');
					//     location.href = "main/home.php";
					//     exit();
					// }, 1500);
			    }else{
			    	setTimeout(function(){
					    dialog.find('.bootbox-body').html('<center><p style="color:red;">Login gagal.. </p> Periksa kembali Username dan Password anda..</center>');
						$('#Password').val('');
					}, 1000);
					setTimeout(function(){
					    dialog.modal('hide');
					}, 1500);
			    }
		      }else{
		      	setTimeout(function(){
				    dialog.find('.bootbox-body').html('<center><p style="color:red;">Login gagal.. </p> Periksa kembali Username dan Password anda..</center>');
					$('#Password').val('');
				}, 1000);
				setTimeout(function(){
				    dialog.modal('hide');
				}, 1500);
		      }
		    }, 2000);
		  },error: function(xhr, ajaxOptions, thrownError){
		  alert(xhr.status);
		  }
		});
	});
});
function setsessionlogin(hasil,uname,upass){
	// console.log(hasil.result[0]['NIK'])
	// console.log(hasil.result);
	return $.ajax({
		async:false,
		type: "POST",
		data:{siapa: hasil.result[0]['emp_no'],
		    siapanama: hasil.result[0]['first_name'],
		    siapanickName: hasil.result[0]['first_name'],
		    gambar: '',
		    // cabang: hasil.result[0]['kode_rep_data'].replaceAll(' ',''),
		    // namacabang: hasil.result[0]['nama_cabangrep'],
		    // jabatan: hasil.result[0]['Status'],
		    nname: hasil.result[0]['first_name'],
		    divisi: hasil.result[0]['nama_dept'],
		    uname: uname,
		    upass: upass
		},
		url:'action/Login.php',
		success: function (res) {
			// console.log('b');
			// console.log(res);
			// if(hasil)
				// return hasil;
		}
	});
}
$('#login2').click(function(){
	var xname = $('#Username').val();
	var xpass = $('#Password').val();
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i> Autentikasi user...</p>'
	});
	dialog.init(function(){
		$.ajax({
			async:false,
			type: "POST",
			data:{uname: xname,
			    upass: xpass},
			url:'action/Login.php',
			success: function (result) {
			    if(result==1){
					sessionStorage.setItem("yanglogin", xname);
					setTimeout(function(){
					    dialog.find('.bootbox-body').html('Login berhasil....');
					}, 1000);
					setTimeout(function(){
					    dialog.modal('hide');
					    location.href = "main/home.php";
					    exit();
					}, 1500);
			    }else{
					console.log(result);
			    	setTimeout(function(){
					    dialog.find('.bootbox-body').html('<center><p style="color:red;">Login gagal.. </p> Periksa kembali Username dan Password anda..</center>');
						$('#Password').val('');
					}, 1000);
					setTimeout(function(){
					    dialog.modal('hide');
					}, 1500);
			    }
			}
		});
	});
});
// ----------------------------

// -------------- block Home --------------
function page_changing(param,paramsubhalaman,paramnamamenu,paramicon){
	if(paramsubhalaman=='',paramnamamenu=='' ,paramicon==''){
		var halaman = param.id;
		var subhalaman = param.getAttribute('submenu'); 
		var namamenu = param.getAttribute('text');
		var icon = param.getAttribute('iconnya');
		if(param.getAttribute('text')=="Auto Pilot"){}else{
			document.cookie = "halaman="+halaman; 
			document.cookie = "subhalaman="+subhalaman; 
			document.cookie = "namamenu="+namamenu; 
			document.cookie = "icon="+icon;
		}
	}else{
		var halaman = param;
		var subhalaman = paramsubhalaman;
		var namamenu = paramnamamenu;
		var icon = paramicon;
	}
	// alert(halaman+'====='+subhalaman);
	if(namamenu=="Auto Pilot"){
		if(icon=="fa fa-toggle-on"){
			var statusPATA = 0;
			var stringPATA = "Auto Pilot Off";
			var dialog = bootbox.dialog({
			  	message: '<p>Mematikan Auto Pilot..  <i class="fa fa-spin fa-spinner"></i></p>'
			});
		}else if(icon=="fa fa-toggle-off"){
			var statusPATA = 1;
			var stringPATA = "Auto Pilot On";
			var dialog = bootbox.dialog({
			  	message: '<p>Menghidupkan Auto Pilot..  <i class="fa fa-spin fa-spinner"></i></p>'
			});
		}
		dialog.init(function(){
			$.ajax({
				async:false,
				type: "POST",
				data:{statusPATA: statusPATA},
				url:'../action/Home.php',
				success: function (result) {
			    	setTimeout(function(){
					    dialog.find('.bootbox-body').html('<center><p >Status PATA telah diganti.. '+stringPATA+'</center>');
					}, 1000);
					setTimeout(function(){
					    dialog.modal('hide');
					}, 2000);
					setTimeout(function(){
					    location.reload(true);
					}, 3000);
				},error: function(xhr, ajaxOptions, thrownError){
	                alert(xhr.status);
	            }
			});
		});
		var dialogprev = dialog;
	}else{
	    var dialog = bootbox.dialog({
		  title: 'Membuka halaman...',
		  message: '<p><i class="fa fa-spin fa-spinner"></i>  Tunggu sebentar.. </p>'
		});
		var dialogprev = dialog;
		setTimeout(function(){
			dialog.init(function(){
				$.ajax({
					async:false,
					type: "POST",
					data:{halaman: halaman,
						subhalaman: subhalaman},
					url:'../action/Home.php',
					success: function (result){
						dialog.modal('hide');
						setTimeout(function(){
						    // dialog.modal('hide');
					   		$('#main-section').html(result);
					   		if(namamenu=="Tulis Helpdesk" || namamenu=="Tulis Pengajuan" || namamenu=="Tulis Pengajuan Lama"){
								$('#main-section').load(result, function() {
								  Dropzone.discover();
								});
					   		}
							$(".submenu").removeClass('active');
							$('#main-section').find('#datatable').dataTable({
								 'order': [[ 1, 'asc' ]],
								 "stateSave": true
							});
							if(namamenu=='Beranda' && subhalaman=='Beranda'){ //Untuk Grafik di home IT
								$('#main-section').find('#datatableSemua').dataTable({
									 'order': [[ 1, 'desc' ]],
									 'responsive': true,
									 'bDestroy': true
								});
								$('#main-section').find('#datatableSelesai').dataTable({
									 'order': [[ 1, 'desc' ]],
									 'bDestroy': true
								});
								$('#main-section').find('#datatableDitolak').dataTable({
									 'order': [[ 1, 'desc' ]],
									 'bDestroy': true
								});
								$('#main-section').find('#datatableterbuka').dataTable({
									 'order': [[ 1, 'desc' ]],
									 'bFilter': false, 
									 'bInfo': false,
									 'bPaginate': false,
									 'bDestroy': true
								});
								$('#main-section').find('#datatablesolved').dataTable({
									 'order': [[ 1, 'desc' ]],
									 'bFilter': true, 
									 'bInfo': true,
									 'bPaginate': true,
									 'stateSave': true
								});
								$('#main-section').find('#datatableontime').dataTable({
									 'order': [[ 1, 'desc' ]],
									 'bFilter': true, 
									 'bInfo': true,
									 'bPaginate': true,
									 'stateSave': true
								});
								$('#main-section').find('#datatableovertime').dataTable({
									 'order': [[ 1, 'desc' ]],
									 'bFilter': true, 
									 'bInfo': true,
									 'bPaginate': true,
									 'stateSave': true
								});
								$('#main-section').find('#datatableonprogress').dataTable({
									 'order': [[ 1, 'desc' ]],
									 'bFilter': true, 
									 'bInfo': true,
									 'bPaginate': true,
									 'stateSave': true
								});
								$('#main-section').find('#datatablekomplainditangani').dataTable({
									 'order': [[ 1, 'desc' ]],
									 'bFilter': false, 
									 'bInfo': false,
									 'bPaginate': false,
									 'stateSave': true
								});
								$('#main-section').find('#datatabledetkomplaintahun').dataTable({
									 'order': [[ 1, 'desc' ]],
									 'bFilter': true, 
									 'bInfo': true,
									 'bPaginate': true,
									 'stateSave': true
								});
								$.ajax({
									async:false,
									type: "POST",
									dataType: 'json',
									data:{yearlyProgress: 'yearlyProgress'},
									url:'../action/Home.php',
									success: function (result) {	
										localStorage.resultgraph = result;
										var ctx = document.getElementById("lineChart"); 
										var lineChart = new Chart(ctx, {
											type: 'line',
											data: {
											  labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
											  datasets: [{
												label: "My First dataset",
												// backgroundColor: "rgba(38, 185, 154, 0.31)",
												backgroundColor: "rgba(130,162,132, 0.31)",
												borderColor: "rgba(68,106,70, 0.8)",
												pointBorderColor: "rgba(68,106,70, 0.7)",
												pointBackgroundColor: "rgba(68,106,70, 0.7)",
												pointHoverBackgroundColor: "rgba(228,174,197,0.6)",
												pointHoverBorderColor: "rgba(68,106,70,1)",
												pointBorderWidth: 1,
												data: [result[0]['juml'],result[1]['juml'],result[2]['juml'],result[3]['juml'],result[4]['juml'],result[5]['juml'],result[6]['juml'],result[7]['juml'],result[8]['juml'],result[9]['juml'],result[10]['juml'],result[11]['juml']],
												pointStyle: 'circle',
												pointRadius: 5,
												pointHoverRadius: 10
											  }]
											},
										  });
									},error: function(xhr, ajaxOptions, thrownError){
						                alert(xhr.status);
						            }
								});
							}
							if((namamenu=='Absensi Saya' || namamenu=='Cuti Massal' || namamenu=='Cuti Saya') && subhalaman=='Absensi'){
								// $('#main-section').find('#datatableAbsen').dataTable().ajax.reload();
								// $('#main-section').find('#datatableAbsen').dataTable({
								// 	 'order': [[ 0, 'asc' ]],
								// 	 bFilter: false,
								// 	 bInfo: false
								// });
							}
							if(namamenu=='Semua Komplain' && subhalaman=='Laporan'){ //Untuk Grafik di Laporan Semua komplain PATA
								$('#main-section').find('#datatable1').dataTable({
									"ordering": false,
									 bFilter: false,
									 bInfo: false,
									 "paging":   false,
								});
								$.ajax({
									async:false,
									type: "POST",
									dataType: 'json',
									data:{lallp: 'lallp',
										bulanx: 'All',
										tahunx: 'All'},
									url:'../action/Lallp.php',
									success: function (result) {
										var bulan = $('#bulan :selected').text();
										var tahun = $('#tahun :selected').text();
										$('#judulGrafikPengerjaan').html('Grafik Pengerjaan '+bulan);
										$('#judulGrafikTotal').html('Grafik Grafik Total Helpdesk '+bulan);	
										var nama = []; var persentase = []; var pengerjaan = []; 
										for(i=0; i<result.length -1;i++){
											nama.push(result[i]['nama']);
											persentase.push(result[i]['total']);
										}
										pengerjaan.push(result[result.length -1]['selesai']);
										pengerjaan.push(result[result.length -1]['progress']);

										var ctx = document.getElementById("pieChart");
										var data = {
											datasets: [{
											  data: persentase,
											  backgroundColor: ["#8abb6f","#bdc3c7","#34495e","#9b59b6","#26b99a","#3498db"],
											  label: 'My dataset' // for legend
											}],
											labels: nama
										};
										var pieChart = new Chart(ctx, {
											data: data,
											type: 'pie'
										});

										var ctx1 = document.getElementById("pieChart1");
										var data1 = {
											datasets: [{
											  data: pengerjaan,
											  backgroundColor: ["#8abb6f","#bdc3c7"],
											  label: 'My dataset' // for legend
											}],
											labels: ["Selesai","Progress"]
										};
										var pieChart1 = new Chart(ctx1, {
											data: data1,
											type: 'pie'
										});
									},error: function(xhr, ajaxOptions, thrownError){
						                alert(xhr.status);
						            }
								});
							}
							if(namamenu=='Komplain Selesai' && subhalaman=='Laporan'){ //Untuk Grafik di Laporan Semua komplain PATA
								$('#main-section').find('#datatable1').dataTable({
									 "ordering": false,
									 bFilter: false,
									 bInfo: false,
									 "paging":   false
								});
								$('#main-section').find('#datatable2').dataTable({
									"ordering": false,
									 bFilter: false,
									 bInfo: false,
									 "paging":   false
								});
								$('#main-section').find('#datatable3').dataTable({
									 "ordering": false,
									 bFilter: false,
									 bInfo: false,
									 "paging":   false
								});

								var bulan = $('#bulan :selected').text();
								var tahun = $('#tahun :selected').text();
								$('#judulGrafikPerCabang').html('Grafik pengerjaan Per Cabang ');
								$('#judulGrafikPerKaryawan').html('Grafik Helpdesk Per Karyawan ');
								$('#judulGrafikPerProgram').html('Grafik Helpdesk Per Program ');	
								$.ajax({
									async:false,
									type: "POST",
									dataType: 'json',
									data:{lapfinishnama: 'lapfinish',
											bulanx: 'All',
											tahunx: 'All'},
									url:'../action/Lallp.php',
									success: function (result) {	
										var nama = []; var persentase = []; 
										for(i=0; i<result.length -1;i++){
											nama.push(result[i]['nama']);
											persentase.push(result[i]['total']);
										}
										var ctx = document.getElementById("pieChart");
										var data = {
											datasets: [{
											  data: persentase,
											  backgroundColor: ["#8abb6f","#bdc3c7","#34495e","#9b59b6","#26b99a","#3498db"],
											  label: 'My dataset' // for legend
											}],
											labels: nama
										};
										var pieChart = new Chart(ctx, {
											data: data,
											type: 'pie'
										});
									},error: function(xhr, ajaxOptions, thrownError){
						                alert(xhr.status);
						            }
								});
								$.ajax({
									async:false,
									type: "POST",
									dataType: 'json',
									data:{lapfinishcabang: 'lapfinish',
											bulanx: 'All',
											tahunx: 'All'},
									url:'../action/Lallp.php',
									success: function (result) {	
										var nama = []; var persentase = []; 
										for(i=0; i<result.length -1;i++){
											nama.push(result[i]['namacab']);
											persentase.push(result[i]['total']);
										}
										var ctx = document.getElementById("pieChart1");
										var data = {
											datasets: [{
											  data: persentase,
											  backgroundColor: ["#8abb6f","#bdc3c7","#34495e","#9b59b6","#26b99a","#3498db","#f442e8","#1bfc4c"],
											  label: 'My dataset' // for legend
											}],
											labels: nama
										};
										var pieChart = new Chart(ctx, {
											data: data,
											type: 'pie'
										});
									},error: function(xhr, ajaxOptions, thrownError){
						                alert(xhr.status);
						            }
								});
								$.ajax({
									async:false,
									type: "POST",
									dataType: 'json',
									data:{lapfinishprogram: 'lapfinish',
											bulanx: 'All',
											tahunx: 'All'},
									url:'../action/Lallp.php',
									success: function (result) {	
										var nama = []; var persentase = []; 
										for(i=0; i<result.length -1;i++){
											nama.push(result[i]['NamaAplikasi']);
											persentase.push(result[i]['total']);
										}
										var ctx = document.getElementById("pieChart2");
										var data = {
											datasets: [{
											  data: persentase,
											  backgroundColor: ["#8abb6f","#bdc3c7","#34495e","#9b59b6","#26b99a","#3498db","#f442e8","#1bfc4c"],
											  label: 'My dataset' // for legend
											}],
											labels: nama
										};
										var pieChart = new Chart(ctx, {
											data: data,
											type: 'pie'
										});
									},error: function(xhr, ajaxOptions, thrownError){
						                alert(xhr.status);
						            }
								});
							}

							if(namamenu=='Semua Pengajuan' && subhalaman=='Laporan'){ //Untuk Grafik di Laporan Semua komplain PATA
								$('#main-section').find('#datatable1').dataTable({
									"ordering": false,
									 bFilter: false,
									 bInfo: false
								});
								$.ajax({
									async:false,
									type: "POST",
									dataType: 'json',
									data:{lappengajuan: 'lallp'},
									url:'../action/Lallp.php',
									success: function (result) {	
										var nama = []; var persentase = [];
										for(i=0; i<result.length -1;i++){
											nama.push(result[i]['cabang']);
											persentase.push(result[i]['JUMLAH']);
										}

										var ctx = document.getElementById("pieChart");
										var data = {
											datasets: [{
											  data: persentase,
											  backgroundColor: ["#8abb6f","#bdc3c7","#34495e","#9b59b6","#26b99a","#3498db","#f442e8","#1bfc4c"],
											  label: 'My dataset' // for legend
											}],
											labels: nama
										};
										var pieChart = new Chart(ctx, {
											data: data,
											type: 'pie'
										});
									},error: function(xhr, ajaxOptions, thrownError){
						                alert(xhr.status);
						            }
								});
							}
							if(namamenu=='Laporan Tambahan' && subhalaman=='Laporan'){
								init_knob();
								
							}
							if(namamenu=='Dashboard'){
								$('#main-section').find('#datatableuserlogin').dataTable({
									"ordering": false,
									 bFilter: true,
									 bInfo: true,
									 "paging":   true
								});
								$('#main-section').find('#datatablepengajuan').dataTable({
									"ordering": false,
									 bFilter: true,
									 bInfo: true,
									 "paging":   true
								});
								$('#main-section').find('#datatablehelpdesk').dataTable({
									"ordering": false,
									 bFilter: true,
									 bInfo: true,
									 "paging":   true
								});
								$('#main-section').find('#datatablejumlahhelpdesk').dataTable({
									"ordering": false,
									 bFilter: true,
									 bInfo: true,
									 "paging":   true
								});
								$('#main-section').find('#datatablejumlahpekerjaan').dataTable({
									"ordering": false,
									 bFilter: true,
									 bInfo: true,
									 "paging":   true
								});
								$('#main-section').find('#datatablejumlahselesai').dataTable({
									"ordering": false,
									 bFilter: true,
									 bInfo: true,
									 "paging":   true
								});
								$('#main-section').find('#datatablejumlahselesaibulan').dataTable({
									"ordering": false,
									 bFilter: true,
									 bInfo: true,
									 "paging":   true
								});
								$('#main-section').find('#datatableavgpekerjaan').dataTable({
									"ordering": false,
									 bFilter: true,
									 bInfo: true,
									 "paging":   true
								});
								$('#main-section').find('#tblhdbelumselesaibulan').dataTable({
									"ordering": false,
									 bFilter: true,
									 bInfo: true,
									 "paging":   true
								});
								$('#main-section').find('#datatablekurang3menit').dataTable({
									"ordering": false,
									 bFilter: true,
									 bInfo: true,
									 "paging":   true
								});
								$('#main-section').find('#datatableovertime').dataTable({
									"ordering": false,
									 bFilter: true,
									 bInfo: true,
									 "paging":   true
								});							
								$('#main-section').find('#datatableavgpekerjaanbulan').dataTable({
									"ordering": false,
									 bFilter: true,
									 bInfo: true,
									 "paging":   true
								});
								$('#main-section').find('#datatableavgpenangananbulan').dataTable({
									"ordering": false,
									 bFilter: true,
									 bInfo: true,
									 "paging":   true
								});	
							}
							var judul = $('#title').text(); 
							var histjudul = readCookie('histjudul');		
							var hitungshorting = 0;								
							if(judul==histjudul && histjudul!=""){								
								// $('#main-section').html(localStorage.content);
								// alert(localStorage.length);
								for (var i = 0; i < localStorage.length; i++) {
									var key = localStorage.key(i);
									var value = localStorage.getItem(key);
									if (key.indexOf("DataTable") >= 0)
									{

									}else{
										if($('#'+key).val()===undefined){

										}else{
											$('#'+key).val(value);
											hitungshorting = hitungshorting + 1;
										}									
										// alert(localStorage.getItem(key));
									}									
								}
								// if(hitungshorting>=1 && judul!=''){
									filterHD();
								// }	
							}else{
								document.cookie = "histjudul=";
								if(halaman!='homehd'){
									// localStorage.clear();
								}								
								// filterHD();
							}													
						}, 500);
					},error: function(xhr, ajaxOptions, thrownError){
		                alert(xhr.status);
		            }
				});
			});
		}, 500);
		
	}
	
};
function logout(){
	var dialog = bootbox.dialog({
	  title: 'Mohon tunggu sebentar',
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Keluar...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{logout: "logout"},
		url:'../action/Home.php',
		success: function (result) {
			if(result=="Confirm"){
				var cookies = document.cookie.split(";");
				for(var i=0; i < cookies.length-1; i++) {
				    var equals = cookies[i].split("=");
				    var name = equals[0].replace(" ", "");
				    document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
				}
				// sessionStorage.clear();
				sessionStorage.removeItem('yanglogin');
				removelocalstorage();
				setTimeout(function(){
				    dialog.modal('hide');
				    location.href = "logout.php";
				    exit();
				}, 1000);
			}else{
				setTimeout(function(){
				    dialog.find('.bootbox-body').html('<center>Silahkan coba lagi..</center>');
				}, 1000);
				setTimeout(function(){
				    dialog.modal('hide');
				}, 2000);
			}
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function profil(){
	var dialog = bootbox.dialog({
	  title: 'Membuka halaman...',
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Tunggu sebentar.. </p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{profile: "profile"},
		url:'../action/Home.php',
		success: function (result) {
			setTimeout(function(){
				dialog.modal('hide');
		   		$('#main-section').html(result);
				$('#main-section').load(result, function() {
				  Dropzone.discover();
				});
			    
			}, 500);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function ubahFoto(){
  	$("#uploadFoto").fadeIn("slow");
}
function simpanProfile(){
  	var nik = $('#nik').val();
  	var nickname = $('#nickname').val();
  	var paswot = $('#password').val();
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Memperbarui Data.. </p>'
	});
  	$.ajax({
		async:false,
		type: "POST",
		data:{nik: nik,
			nicknameEdit: nickname,
			paswotEdit: paswot},
		url:'../action/Home.php',
		success: function (result) {
			$('#myAwesomeDropzone').get(0).dropzone.processQueue();
			setTimeout(function(){
				 dialog.find('.bootbox-body').html('<center>Profil telah dirubah</center>');
			}, 500);
			setTimeout(function(){
				dialog.modal('hide');
				location.reload(true);
			}, 500);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
// --------------------------------------------------------

// -------------- block New HD --------------
//Pada action kenapa cuma mundur sekali ../ nya, karena ini dipanggil pada main/home.php
Dropzone.options.myAwesomeDropzone = { 
	autoProcessQueue: false,
	addRemoveLinks: true,
	maxFiles: 5,
	dictRemoveFile: "Hapus",
	init: function() {
		myAwesomeDropzone = this;
		this.on("success", function() {
           myAwesomeDropzone.options.autoProcessQueue = true; 
        });
		this.on("removedfile", function(file) {
			var uploadedFileName = file.name;
			$.ajax({
				url: "../action/Delete.php", 
				type: "POST",
				data: { filename: uploadedFileName}
			}); 
		});
		this.on("maxfilesexceeded", function(file){
			alert("Maximal 5 yang diupload, 5 Gambar pertama saja yang terupload");
		});
	}
}
Dropzone.options.notaDropzone = { 
	autoProcessQueue: false,
	addRemoveLinks: true,
	maxFiles: 5,
	dictRemoveFile: "Hapus",
	init: function() {
		myAwesomeDropzone = this;
		this.on("success", function() {
           myAwesomeDropzone.options.autoProcessQueue = true; 
        });
		this.on("removedfile", function(file) {
			$('#jumfile').val(( $('#jumfile').val()*1)-1);
			var uploadedFileName = file.name;
			$.ajax({
				url: "../action/Delete.php", 
				type: "POST",
				data: { filename: uploadedFileName}
			}); 
		});
		this.on("maxfilesexceeded", function(file){
			alert("Maximal 5 yang diupload, 5 Gambar pertama saja yang terupload");
		});
		this.on("addedfile", function(file) {
      // Show submit button here and/or inform user to click it.
	    // var count = notaDropzone.file.length;
	    $('#jumfile').val(( $('#jumfile').val()*1)+1);
	    });
	}
}
function setmenitformat(){
	if($('#perkiraanwaktu').val!==undefined){
		var waktu = $('#perkiraanwaktu').val();
		waktu = waktu.replaceAll(' ','');
		waktu = waktu.replaceAll(' - Menit','');
		waktu = waktu.replaceAll('-','');
		waktu = waktu.replaceAll('Menit','');
		$('#perkiraanwaktu').val(waktu+' - Menit');
	}	
}
function gantijenishd(){
	var jenis = $('#jenishd').val();
	if(jenis==1 || jenis===undefined){
		$('#divtanggaldikerjakan').hide();
		$('#divtanggalselesai').hide();
		$('#estimasi').hide();
		$('#catatan').hide();
		$('#submitSelesaiHelpdesk').hide();
		$('#submitHelpdesk').show();
	}else{
		$('#divtanggaldikerjakan').show();
		$('#divtanggalselesai').show();
		$('#estimasi').show();
		$('#catatan').show();
		$('#submitSelesaiHelpdesk').show();
		$('#submitHelpdesk').hide();
	}
}
function submitHD(statusselesai){
	var perkiraanwaktu = 0;
	var catatan = '';
	var tanggaldikerjakan = '';
	var tanggalselesai = '';
	if(statusselesai==1){
		var tanggalIssue = new Date($('#tglIssue').val()).format('m/d/Y H:i');
		var perkiraanwaktu = $('#perkiraanwaktu').val();
		perkiraanwaktu = perkiraanwaktu.replaceAll(' - Menit','');
		catatan = $('#catatan1').val();
		tanggaldikerjakan = new Date($('#tanggaldikerjakan').val()).format('m/d/Y H:i:s');
		tanggalselesai = new Date($('#tanggalselesai').val()).format('m/d/Y H:i:s');
	}else{
		var tanggalIssue = new Date($('#tglIssue').val()).format('m/d/Y H:i');
	}	
	var issueDari = $('#dari').attr('nameonly');
	var tujuan = $('#kehendak :selected').val();
	var kategori = $('#jenis :selected').val();
	var jenisLap = $('#jenisLaporan :selected').val();
	var progDimaksud = $('#programYangDimaksud :selected').val();
	var desk = $('#deskripsi').val();
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Menambahkan komplain baru ke Helpdesk...</p>'
	});
	$('#myAwesomeDropzone').get(0).dropzone.processQueue();
	$.ajax({
		async:false,
		type: "POST",
		data:{tanggalIssueP: tanggalIssue,
			issueDariP: issueDari,
			tujuanP: tujuan,
			kategoriP: kategori,
			jenisLapP: jenisLap,
			progDimaksudP: progDimaksud,
			deskP: desk,
			perkiraanwaktuP: perkiraanwaktu,
			catatanP: catatan,
			statusselesaiP: statusselesai,
			tanggaldikerjakanP: tanggaldikerjakan,
			tanggalselesaiP: tanggalselesai},
		url:'../action/Newhd.php',
		success: function (result) {
			// $('#myAwesomeDropzone').get(0).dropzone.processQueue();
			setTimeout(function(){
			    dialog.find('.bootbox-body').html('<center>Komplain berhasil ditambahkan..</center>');
			}, 5000);
			setTimeout(function(){
			    dialog.modal('hide');
			    document.cookie = "halaman=allp";
			    document.cookie = "subhalaman=Helpdesk";
			    document.cookie = "namamenu=History Helpdesk";
			    document.cookie = "icon=fa fa-history";
			    location.reload(true);
			    // alert(result);
			}, 5000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function simpanedit(nohelpdesk,kolom,i){	
	//alert($('#'+kolom+i+' :selected').val());
	var nilai = $('#'+kolom+i+' :selected').val();
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Menyimpan data...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{noP: nohelpdesk,
			kolomP: kolom,
			nilaiP: nilai},
		url:'../action/edithist.php',
		success: function (result) {
			//$('#myAwesomeDropzone').get(0).dropzone.processQueue();
			setTimeout(function(){
			    dialog.find('.bootbox-body').html('<center>helpdesk berhasil diedit..</center>');
			}, 1000);
			setTimeout(function(){
			    dialog.modal('hide');
			    // document.cookie = "halaman=allp";
			    // document.cookie = "subhalaman=Helpdesk";
			    // document.cookie = "namamenu=History Helpdesk";
			    // document.cookie = "icon=fa fa-history";
			    //location.reload(true);
			    // alert(result);
			}, 2000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function gantiTujuan(){
	var textOri = 'Silahkan Pilih Kategori ';
	$('#defaultKategori').text(textOri+$('#kehendak :selected').text());
	$("#jenis").prop('disabled', false);
	$("#jenis").val("0").change();
	$("#jenisLaporan").val("0").change();
	$("#programYangDimaksud").val("0").change();
	$("#jenisLaporan").prop('disabled', true);
	$("#programYangDimaksud").prop('disabled', true);
	$("#deskripsi").prop('disabled', true);
	$("#submitHelpdesk").prop('disabled', true);
	$("#submitSelesaiHelpdesk").prop('disabled', true);
	$("#catatan").prop('disabled', true);
}
function resetJenisLaporan(){
	$("#jenisLaporan").val("0").change();
	$("#programYangDimaksud").prop('disabled', true);
	$("#deskripsi").prop('disabled', true);
	$("#catatan").prop('disabled', true);
	$("#submitHelpdesk").prop('disabled', true);
	$("#submitSelesaiHelpdesk").prop('disabled', true);
	for(var i=1;i<=9;i++){
		$("#jenisLaporan"+i).show();
	}
}
function gantiKategori(){
	var tujuan = $('#kehendak :selected').val();
	var jenis = $('#jenis :selected').val();
	$("#jenisLaporan").val("0").change();
	$("#programYangDimaksud").val("0").change();
	$("#jenisLaporan").prop('disabled', false);
	if(tujuan=='Komplain'){
		if(jenis=='Software'){
			resetJenisLaporan();
			//index 1-n adalah nilai Lap di Table
			//select * from mjlaporan where Aktif=1 order by Lap*1
			// $("#jenisLaporan1").hide();
			$("#jenisLaporan3").hide();
			// $("#jenisLaporan4").hide();
			$("#jenisLaporan5").hide();
			$("#jenisLaporan6").hide();
			// $("#jenisLaporan7").hide();
			$("#jenisLaporan8").hide();
			// $("#jenisLaporan9").hide();
			// $("#jenisLaporan10").hide();
			// $("#jenisLaporan11").hide();
			$("#jenisLaporan13").hide();
			$("#jenisLaporan14").hide();
			$("#jenisLaporan15").hide();
			// $("#jenisLaporan16").hide();
			
			// $("#jenisLaporan98").hide();
			// $("#jenisLaporan99").hide();
			
			$("#bts0").hide();
			// $("#bts1").hide();
			// $("#bts2").hide();
			// $("#bts3").hide();

		}else if(jenis=='Hardware'){
			resetJenisLaporan();
			$("#jenisLaporan1").hide();
			$("#jenisLaporan3").hide();
			$("#jenisLaporan4").hide();
			// $("#jenisLaporan5").hide();
			$("#jenisLaporan6").hide();
			$("#jenisLaporan7").hide();
			$("#jenisLaporan8").hide();
			// $("#jenisLaporan9").hide();
			$("#jenisLaporan10").hide();
			$("#jenisLaporan11").hide();
			// $("#jenisLaporan13").hide();
			$("#jenisLaporan14").hide();
			// $("#jenisLaporan15").hide();
			$("#jenisLaporan16").hide();
			
			// $("#jenisLaporan98").hide();
			// $("#jenisLaporan99").hide();

			$("#bts0").hide();
			$("#bts1").hide();
			// $("#bts2").hide();
			$("#bts3").hide();
		}
	}else if(tujuan=='Request'){
		if(jenis=='Software'){
			resetJenisLaporan();
			//index 1-n adalah nilai Lap di Table
			//select * from mjlaporan where Aktif=1 order by Lap*1
			$("#jenisLaporan1").hide();
			// $("#jenisLaporan3").hide();
			$("#jenisLaporan4").hide();
			$("#jenisLaporan5").hide();
			// $("#jenisLaporan6").hide();
			$("#jenisLaporan7").hide();
			$("#jenisLaporan8").hide();
			// $("#jenisLaporan9").hide();
			$("#jenisLaporan10").hide();
			$("#jenisLaporan11").hide();
			$("#jenisLaporan13").hide();
			$("#jenisLaporan14").hide();
			$("#jenisLaporan15").hide();
			$("#jenisLaporan16").hide();
			
			// $("#jenisLaporan98").hide();
			// $("#jenisLaporan99").hide();

			$("#bts0").hide();
			$("#bts1").hide();
			// $("#bts2").hide();
			$("#bts3").hide();

	
		}else if(jenis=='Hardware'){
			resetJenisLaporan();
			$("#jenisLaporan1").hide();
			$("#jenisLaporan3").hide();
			$("#jenisLaporan4").hide();
			$("#jenisLaporan5").hide();
			$("#jenisLaporan6").hide();
			$("#jenisLaporan7").hide();
			// $("#jenisLaporan8").hide();
			// $("#jenisLaporan9").hide();
			$("#jenisLaporan10").hide();
			$("#jenisLaporan11").hide();
			// $("#jenisLaporan13").hide();
			// $("#jenisLaporan14").hide();
			// $("#jenisLaporan15").hide();
			$("#jenisLaporan16").hide();
			
			// $("#jenisLaporan98").hide();
			// $("#jenisLaporan99").hide();
			
			$("#bts0").hide();
			$("#bts1").hide();
			// $("#bts2").hide();
			$("#bts3").hide();
		}
	}
}
function gantiJenisLaporan(){
	if($('#jenis :selected').val()=='Hardware'){
		$("#deskripsi").prop('disabled', false);
		$("#catatan").prop('disabled', false);
	}else{
		$("#programYangDimaksud").prop('disabled', false);
	}
	$("#submitHelpdesk").prop('disabled', false);
	$("#submitSelesaiHelpdesk").prop('disabled', false);
}
function openDeskripsi(){
	$("#deskripsi").prop('disabled', false);
	$("#catatan").prop('disabled', false);
}
//--------------------------------------------------------

// -------------- block Verif HD & Pengajuan PATA  --------------
function reject(index){
	var judul = $('#title').text();
	var tujuan = '';
	if(judul=='Verifikasi Helpdesk' || judul=='List Pekerjaan IT'){
		tujuan = $('#kehendak'+index+' :selected').val();
		var idReject = $('#idhdpata'+index).text();
		var jenisLaporan = $('#jenisLaporan'+index).val();
		var jenisProgram = $('#programYangDimaksud'+index).val();
		var suksesReject = '<center>Komplain '+idReject+' telah <font color="red">direject</font>..<br>Terima kasih...</center>';
		var ranah = 'Helpdesk';
	}else if(judul=='Detail Helpdesk'){
		var idReject = $('#noIssue').val();
		var jenisLaporan = $('#jenislaporan :selected').val();
		var jenisProgram = $('#programYangDimaksud :selected').val();
		var suksesReject = '<center>Komplain '+idReject+' telah <font color="red">direject</font>..<br>Terima kasih...</center>';
		var ranah = 'Helpdesk';
	}else if(judul=='Verifikasi Pengajuan'){
		var idReject = $('#idpj'+index).text();
		var jenisLaporan = '';
		var jenisProgram = '';
		var suksesReject = '<center>Pengajuan '+idReject+' telah <font color="red">direject</font>..<br>Terima kasih...</center>';
		var ranah = 'Pengajuan';
	}else if(judul=='Detail Pengajuan'){
		var idReject = $('#noIssue').val();
		var jenisLaporan = '';
		var jenisProgram = '';
		var suksesReject = '<center>Pengajuan '+idReject+' telah <font color="red">direject</font>..<br>Terima kasih...</center>';
		var ranah = 'Pengajuan';
	}
	//upload file dulu	
	addAttachment();
    bootbox.prompt({
        title: "Masukkan penjelasan untuk rejection",
        inputType: 'textarea',
        callback: function (result) {
        	if(result === null){}else{
	        	var dialog = bootbox.dialog({
				  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Mohon tunggu...</p>'
				});
	   			$.ajax({
					async:false,
					type: "POST",
					data:{alasanReject: result,
						idReject: idReject,
						jenisLaporan: jenisLaporan,
						jenisProgram: jenisProgram,
						ranah: ranah,
						tujuan: tujuan},
					url:'../action/VerifPATA.php',
					success: function (resultDalam) {						
						setTimeout(function(){
						    dialog.find('.bootbox-body').html(suksesReject);
						}, 500);
						setTimeout(function(){
						    dialog.modal('hide');
						    // console.log(resultDalam);
						    location.reload(true);
						}, 1000);
					},error: function(xhr, ajaxOptions, thrownError){
			            alert(xhr.status);
			        }
				});
        	}
        }
    });
}
function confirm(index){
	//upload file dulu
	addAttachment();
	var judul = $('#title').text();	
	var tujuan = '';
	if(judul=='Verifikasi Helpdesk' || judul=='List Pekerjaan IT'){
		tujuan = $('#kehendak'+index+' :selected').val();
		var idConfirm = $('#idhdpata'+index).text();
		var jenisLaporan = $('#jenisLaporan'+index).val();
		var kategori = $('#kategori'+index).val();
		var jenisProgram = $('#programYangDimaksud'+index).val();
		var estimasiPATA = $('#estimasiPATA'+index).val();
		var suksesConfirm = '<center>Komplain '+idConfirm+' <font color="green">Sukses</font> diverifikasi..<br>Terima kasih...</center>';
		var ranah = 'Helpdesk';		
	}else if(judul=='Detail Helpdesk'){
		tujuan = $('#kehendak :selected').val();
		var idConfirm = $('#noIssue').val();
		var jenisLaporan = $('#jenislaporan :selected').val();
		var jenisProgram = $('#programYangDimaksud :selected').val();
		if($('#estWaktu').val()===undefined){
			var estimasi =  '1';
		}else{
			var estimasi =  $('#estWaktu').val().split("-");
		}		
		// var estimasi =  '10';
		var estimasiPATA = estimasi[0];
		var suksesConfirm = '<center>Komplain '+idConfirm+' <font color="green">Sukses</font> diverifikasi..<br>Terima kasih...</center>';
		var ranah = 'Helpdesk';
	}else if(judul=='Verifikasi Pengajuan'){
		var idConfirm = $('#idpj'+index).text();
		var jenisLaporan = '';
		var jenisProgram = '';
		var estimasiPATA = '';
		var suksesConfirm = '<center>Pengajuan '+idConfirm+' <font color="green">Sukses</font> diverifikasi..<br>Terima kasih...</center>';
		var ranah = 'Pengajuan';
	}else if(judul=='Detail Pengajuan'){
		var idConfirm = $('#noIssue').val();
		var jenisLaporan = '';
		var jenisProgram = '';
		var estimasiPATA = '';
		var suksesConfirm = '<center>Pengajuan '+idConfirm+' <font color="green">Sukses</font> diverifikasi..<br>Terima kasih...</center>';
		var ranah = 'Pengajuan';
	}
	if(ranah=='Helpdesk'){
		bootbox.dialog({
	        title: "Konfirmasi",
	        message: '<div class="row"><label class="control-label col-md-1 col-sm-1 col-xs-12">Prioritas</label><div class="col-md-10 col-sm-10 col-xs-12"><select id="selprioritas"><option value="2">Prioritas kedua (menunggu antrian)</option><option value="1">Prioritas pertama (urgent)</option></select></div><label class="control-label col-md-2 col-sm-2 col-xs-12"></label><div class="col-md-10 col-sm-10 col-xs-12"><textarea id="notepata" class="form-control col-md-10 col-sm-10 col-xs-12" rows="10" placeholder="Note...."></textarea></div></div>',
	        size: 'large',
		closeButton: false,
		buttons: {
			tutup: {
				label: 'Tutup',
				className: 'btn-warning',
			    callback: function(){
			    		              		              
			    }
						},
			simpan: {
				label: 'Simpan',
				className: 'btn-success',
				callback: function(){
						var prior = $('#selprioritas').val();
						var notepata = $('#notepata').val();
							$.ajax({
								async:false,
								type: "POST",
								data:{estimasiPATA: estimasiPATA,
									idConfirm: idConfirm,
									jenisLaporan: jenisLaporan,
									jenisProgram: jenisProgram,
									ranah: ranah,
									prioritas:prior,
									notepata: notepata,
									tujuan: tujuan,
									kategori: kategori},
								url:'../action/VerifPATA.php',
								success: function (resultDalam) {
									// setTimeout(function(){
									//     dialog.find('.bootbox-body').html('<center>Komplain '+idReject+' telah di accept dengan proritas '+result+'<br>Terima kasih...</center>');
									// }, 1000);
									setTimeout(function(){
									    // dialog.modal('hide');
									    $('.modal').modal('hide');
									    location.reload(true);
									}, 2000);
								},error: function(xhr, ajaxOptions, thrownError){
						            alert(xhr.status);
						        }
							});
					}
				}
			}				
	    });
	    // bootbox.prompt({
	    //     title: "Pilih prioritas dari helpdesk ini",
	    //     inputType: 'select',
	    //     inputOptions: [
	    //         {
	    //             text: 'Prioritas kedua (menunggu antrian)',
	    //             value: '',
	    //         },
	    //         {
	    //             text: 'Prioritas pertama (urgent)',
	    //             value: '1',
	    //         }
	    //     ],
	    //     callback: function (result) {
	    //     	if(result==''){
	    //     		result = 2;
	    //     	}
	    //        	if(result === null){}else{
	    //        		var dialog = bootbox.dialog({
					//   	message: '<p><i class="fa fa-spin fa-spinner"></i>  Mohon tunggu...</p>'
					// });
					// $.ajax({
					// 	async:false,
					// 	type: "POST",
					// 	data:{estimasiPATA: estimasiPATA,
					// 		idConfirm: idConfirm,
					// 		jenisLaporan: jenisLaporan,
					// 		jenisProgram: jenisProgram,
					// 		ranah: ranah,
					// 		prioritas:result},
					// 	url:'../action/VerifPATA.php',
					// 	success: function (resultDalam) {
					// 		setTimeout(function(){
					// 		    dialog.find('.bootbox-body').html('<center>Komplain '+idReject+' telah di accept dengan proritas '+result+'<br>Terima kasih...</center>');
					// 		}, 1000);
					// 		setTimeout(function(){
					// 		    dialog.modal('hide');
					// 		    // location.reload(true);
					// 		}, 2000);
					// 	},error: function(xhr, ajaxOptions, thrownError){
				 //            alert(xhr.status);
				 //        }
					// });
	    //     	}
	    //     }
	    // });
	}else{
		bootbox.dialog({
	        title: "Konfirmasi",
	        message: '<div class="row"><label class="control-label col-md-1 col-sm-1 col-xs-12">Note</label><div class="col-md-10 col-sm-10 col-xs-12"><textarea id="notepata" class="form-control col-md-10 col-sm-10 col-xs-12" rows="10" placeholder="Note...."></textarea></div></div>',
	        size: 'large',
		closeButton: false,
		buttons: {
			tutup: {
				label: 'Tutup',
				className: 'btn-warning',
			    callback: function(){
			    		              		              
			    }
						},
			simpan: {
				label: 'Simpan',
				className: 'btn-success',
				callback: function(){
						var notepata = $('#notepata').val();
							$.ajax({
								async:false,
								type: "POST",
								data:{estimasiPATA: estimasiPATA,
									idConfirm: idConfirm,
									jenisLaporan: jenisLaporan,
									jenisProgram: jenisProgram,
									ranah: ranah,
									prioritas:'0',
									notepata: notepata},
								url:'../action/VerifPATA.php',
								success: function (resultDalam) {
									setTimeout(function(){
									    dialog.find('.bootbox-body').html(suksesConfirm);
									}, 500);
									setTimeout(function(){
									    // dialog.modal('hide');
									    $('.modal').modal('hide');
									    location.reload(true);
									}, 1000);
								},error: function(xhr, ajaxOptions, thrownError){
						            alert(xhr.status);
						        }
							});
					}
				}
			}				
	    });
		// var dialog = bootbox.dialog({
		//   	message: '<p><i class="fa fa-spin fa-spinner"></i>  Mohon tunggu...</p>'
		// });
		// $.ajax({
		// 	async:false,
		// 	type: "POST",
		// 	data:{estimasiPATA: estimasiPATA,
		// 		idConfirm: idConfirm,
		// 		jenisLaporan: jenisLaporan,
		// 		jenisProgram: jenisProgram,
		// 		ranah: ranah,
		// 		prioritas:'0'},
		// 	url:'../action/VerifPATA.php',
		// 	success: function (resultDalam) {
		// 		setTimeout(function(){
		// 		    dialog.find('.bootbox-body').html(suksesConfirm);
		// 		}, 500);
		// 		setTimeout(function(){
		// 		    dialog.modal('hide');
		// 		    location.reload(true);
		// 		}, 1000);
		// 	},error: function(xhr, ajaxOptions, thrownError){
	 //            alert(xhr.status);
	 //        }
		// });
	}
}
// --------------------------------------------------------

// -------------- block ITHD --------------
function filterHD(){ //Sekalian untuk To Do List	
	// $('#main-section').html(histpage);
	var judul = $('#title').text();
	var halaman = ''; var tujuan = ''; var kategori = ''; var jenis = '';
	var program = ''; var status = ''; var tanggal = ''; var bulan = ''; 
	var tahun = ''; var cabang = ''; 
	var d = new Date();
	var jenis = "";
	var tahunSekarang = d.getFullYear();
	var attch = "";	
	var jenisfilterlap = "";
	var tanggalmulailap = "";
	var tanggalsampailap = "";	
	var statusselesai = "";
	if(judul=="Helpdesk Yang Anda Ambil"){
		halaman = "Todo.php";
		var tujuan = $('#kehendak :selected').val();
		var kategori = $('#jenis :selected').val();
		var jenis = $('#jenisLaporan :selected').val();
		var program = $('#programYangDimaksud :selected').val();
		var tanggal = "All";
		var bulan = "All";
		var status = $('#status :selected').val();
		var tahun = tahunSekarang;	
		localStorage.kehendak = tujuan;
		localStorage.jenis = kategori;
		localStorage.jenisLaporan = jenis;
		localStorage.programYangDimaksud = program;
	}else if(judul=="Helpdesk SAP Belum Ditangani"){
		halaman = "ithdSAP.php";
		var tujuan = $('#kehendak :selected').val();
		var kategori = $('#jenis :selected').val();
		var jenis = $('#jenisLaporan :selected').val();
		var program = $('#programYangDimaksud :selected').val();
		var status = $('#status :selected').val();
		var tanggal = $('#tanggal :selected').val();
		var bulan = $('#bulan :selected').val();
		var tahun = $('#tahun :selected').val();	
		localStorage.kehendak = tujuan;
		localStorage.jenis = kategori;
		localStorage.jenisLaporan = jenis;
		localStorage.programYangDimaksud = program;
		localStorage.status = status;
		localStorage.tanggal = tanggal;
		localStorage.bulan = bulan;
		localStorage.tahun = tahun;	
	}else if(judul=="ITJob yang perlu dikerjakan"){
		halaman = "ithdJOB.php";
		// var tujuan = $('#kehendak :selected').val();
		// var kategori = $('#jenis :selected').val();
		var jenis = $('#jenisLaporan :selected').val();
		var program = $('#programYangDimaksud :selected').val();
		// var status = $('#status :selected').val();
		var tanggal = $('#tanggal :selected').val();
		var bulan = $('#bulan :selected').val();
		var tahun = $('#tahun :selected').val();	
		// localStorage.kehendak = tujuan;
		// localStorage.jenis = kategori;
		localStorage.jenisLaporan = jenis;
		localStorage.programYangDimaksud = program;
		// localStorage.status = status;
		localStorage.tanggal = tanggal;
		localStorage.bulan = bulan;
		localStorage.tahun = tahun;	
	}else if(judul=="Helpdesk Belum Ditangani"){
		halaman = "Ithd.php";
		var tujuan = $('#kehendak :selected').val();
		var kategori = $('#jenis :selected').val();
		var jenis = $('#jenisLaporan :selected').val();
		var program = $('#programYangDimaksud :selected').val();
		var status = $('#status :selected').val();
		var tanggal = $('#tanggal :selected').val();
		var bulan = $('#bulan :selected').val();
		var tahun = $('#tahun :selected').val();
		localStorage.kehendak = tujuan;
		localStorage.jenis = kategori;
		localStorage.jenisLaporan = jenis;
		localStorage.programYangDimaksud = program;
		localStorage.status = status;
		localStorage.tanggal = tanggal;
		localStorage.bulan = bulan;
		localStorage.tahun = tahun;
	}else if(judul=="Verifikasi Helpdesk"){
		halaman = "verifhd.php";		
		var jenis = $('#jenisLaporan :selected').val();
		var program = $('#programYangDimaksud :selected').val();
		var status = $('#status :selected').val();
		var tanggal = $('#tanggal :selected').val();
		var bulan = $('#bulan :selected').val();
		var tahun = $('#tahun :selected').val();
		localStorage.jenisLaporan = jenis;
		localStorage.programYangDimaksud = program;
		localStorage.status = status;
		localStorage.tanggal = tanggal;
		localStorage.bulan = bulan;
		localStorage.tahun = tahun;
	}else if (judul == "Semua Helpdesk" || judul == "Helpdesk Ditolak" || judul == "Laporan Semua Helpdesk" || judul == "Laporan Helpdesk Selesai" || judul == "Edit History" ){
		if(judul=="Semua Helpdesk"){
			halaman = "Allp.php";
			var tujuan = $('#kehendak :selected').val();
			var kategori = $('#jenis :selected').val();
			var jenis = $('#jenisLaporan :selected').val();
			var program = $('#programYangDimaksud :selected').val();
			var status = $('#status :selected').val();
			var tanggal = $('#tanggal :selected').val();
			var bulan = $('#bulan :selected').val();
			var tahun = $('#tahun :selected').val();	
			localStorage.kehendak = tujuan;
			localStorage.jenis = kategori;
			localStorage.jenisLaporan = jenis;
			localStorage.programYangDimaksud = program;
			localStorage.status = status;
			localStorage.tanggal = tanggal;
			localStorage.bulan = bulan;
			localStorage.tahun = tahun;	
		}else if(judul=="Laporan Semua Helpdesk" || judul=="Laporan Helpdesk Selesai"){
			halaman = "Lallp.php";
			var jenisfilterlap = $('#jenisfilterlap').val();
			var tanggalmulailap = $('#tanggalmulailap').val();
			var tanggalsampailap = $('#tanggalsampailap').val();	
			localStorage.jenisfilterlap = jenisfilterlap;
			localStorage.tanggalmulailap = tanggalmulailap;
			localStorage.tanggalsampailap = tanggalsampailap;		
			if(jenisfilterlap.replaceAll(' ','')=='bulanan'){
				$('#divtanggalmulai').hide();
				$('#divtanggalsampai').hide();
				$('#divbulan').show();
				$('#divtahun').show();				
			}else{
				$('#divtanggalmulai').show();
				$('#divtanggalsampai').show();
				$('#divbulan').hide();
				$('#divtahun').hide();		
			}
			// return;
		}else if(judul=="Helpdesk Ditolak"){
			halaman = "Rejectedhd.php";
		} else if (judul == "Edit History") {
			halaman = "Alledithist.php";
			
		}
		var tujuan = $('#kehendak :selected').val();
		var kategori = $('#jenis :selected').val();
		var jenis = $('#jenisLaporan :selected').val();
		var program = $('#programYangDimaksud :selected').val();
		var tanggal = $('#tanggal :selected').val();
		var status = $('#status :selected').val();
		var bulan = $('#bulan :selected').val();
		var tahun = $('#tahun :selected').val();
		localStorage.kehendak = tujuan;
		localStorage.jenis = kategori;
		localStorage.jenisLaporan = jenis;
		localStorage.programYangDimaksud = program;
		localStorage.status = status;
		localStorage.tanggal = tanggal;
		localStorage.bulan = bulan;
		localStorage.tahun = tahun;
	}else if(judul=="Helpdesk Yang Ditugaskan PATA"){
		halaman = "Offertodo.php";
		var tujuan = $('#kehendak :selected').val();
		var kategori = $('#jenis :selected').val();
		var jenis = $('#jenisLaporan :selected').val();
		var program = $('#programYangDimaksud :selected').val();
		var tanggal = $('#tanggal :selected').val();
		var status = $('#status :selected').val();
		var bulan = $('#bulan :selected').val();
		var tahun = $('#tahun :selected').val();
		localStorage.kehendak = tujuan;
		localStorage.jenis = kategori;
		localStorage.jenisLaporan = jenis;
		localStorage.programYangDimaksud = program;
		localStorage.status = status;
		localStorage.tanggal = tanggal;
		localStorage.bulan = bulan;
		localStorage.tahun = tahun;
	}else if(judul=="Semua Pengajuan" || judul=="Pengajuan Ditolak"){
		if(judul=="Semua Pengajuan"){
			halaman = "Allpj.php";
		}else if(judul=="Pengajuan Ditolak"){
			halaman = "Rejectedpj.php";
		}else if(judul=="Laporan Semua Pengajuan"){
			halaman = "Lallp.php";
		}
		var tanggal = $('#tanggal :selected').val(); 
		var bulan = $('#bulan :selected').val(); 
		var tahun = $('#tahun :selected').val(); 
		var cabang = $('#cabang :selected').val(); 
		var attch = $('#attch :selected').val(); 
		localStorage.cabang = cabang;
		localStorage.tanggal = tanggal;
		localStorage.bulan = bulan;
		localStorage.tahun = tahun;
		localStorage.attch = attch;
	}else if(judul=="Pengajuan Baru"){
		halaman = "Waiteditpj.php";
		var tanggal = $('#tanggal :selected').val(); 
		var bulan = $('#bulan :selected').val(); 
		var tahun = $('#tahun :selected').val();
		var cabang = $('#cabang :selected').val(); 
		localStorage.cabang = cabang;
		localStorage.tanggal = tanggal;
		localStorage.bulan = bulan;
		localStorage.tahun = tahun;
	}else if(judul=="Verifikasi Pengajuan"){
		halaman = "verifpj.php";
		var tanggal = $('#tanggal :selected').val(); 
		var bulan = $('#bulan :selected').val(); 
		var tahun = $('#tahun :selected').val();
		var cabang = $('#cabang :selected').val(); 
		localStorage.cabang = cabang;
		localStorage.tanggal = tanggal;
		localStorage.bulan = bulan;
		localStorage.tahun = tahun;
	}else if(judul=="Pengajuan Tunggu Verif PATA"){
		halaman = "waitverifpj.php";
		var tanggal = $('#tanggal :selected').val(); 
		var bulan = $('#bulan :selected').val(); 
		var tahun = $('#tahun :selected').val();
		var cabang = $('#cabang :selected').val(); 
		localStorage.cabang = cabang;
		localStorage.tanggal = tanggal;
		localStorage.bulan = bulan;
		localStorage.tahun = tahun;
	}else if(judul=="Absen Anda"){
		halaman = "Absen.php";
		var bulan = $('#bulan :selected').val(); 
		var tahun = $('#tahun :selected').val();
		localStorage.bulan = bulan;
		localStorage.tahun = tahun;
	}else if(judul=="Pengajuan Siap Dikerjakan" || judul=="Pengajuan Berjalan (Menunggu Proses Acc Selesai)" || judul=="Pengajuan Selesai"){
		halaman = "Itpj.php";
		var tanggal = $('#tanggal :selected').val(); 
		var bulan = $('#bulan :selected').val(); 
		var tahun = $('#tahun :selected').val();
		var cabang = $('#cabang :selected').val(); 
		if(judul=="Pengajuan Siap Dikerjakan"){
			jenis = "siap";
		}else if(judul=="Pengajuan Berjalan (Menunggu Proses Acc Selesai)"){
			jenis = "berjalan";
		}else{
			jenis = "selesai";
		}
		localStorage.cabang = cabang;
		localStorage.tanggal = tanggal;
		localStorage.bulan = bulan;
		localStorage.tahun = tahun;
	}else if(judul=="Peminjaman Hardware"){
		// halaman = "mpinjam.php";
		return;
	}else if(judul=="Helpdesk Dibuat Oleh IT"){
		halaman = "DibuatIT.php";
		statusselesai = $('#statusselesai :selected').val();
		var tanggal = $('#tanggal :selected').val();
		var bulan = $('#bulan :selected').val();
		var tahun = $('#tahun :selected').val();	
		localStorage.statusselesai = statusselesai;
		localStorage.tanggal = tanggal;
		localStorage.bulan = bulan;
		localStorage.tahun = tahun;	
	}else if(judul=="List Pekerjaan IT"){
		halaman = "ListLebih90.php";
		var bulan = $('#bulan :selected').val();
		var tahun = $('#tahun :selected').val();	
		localStorage.bulan = bulan;
		localStorage.tahun = tahun;	
	}
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Memfilter...</p>'
	});

	setTimeout(function(){
		$.ajax({
			async:false,
			type: "POST",
			data:{tujuanHelpdesk: tujuan,
				kategoriHelpdesk: kategori,
				jenisHelpdesk: jenis,
				programHelpdesk: program,
				statusHelpdesk: status,
				tanggalHelpdesk: tanggal,
				bulanHelpdesk: bulan,
				tahunHelpdesk: tahun,
				judul: judul,
				cabang: cabang,
				jenisP: jenis,
				attchP: attch,
				jenisfilterlap: jenisfilterlap,
				tanggalmulailap: tanggalmulailap,
				tanggalsampailap: tanggalsampailap,
				statusselesaiP: statusselesai
				},
			url:'../action/'+halaman,
			success: function (resultDalam) {
				setTimeout(function(){	
					$('#contentTable').html('');
					$('#contentTable').html(resultDalam);
					$('#main-section').load(resultDalam.split('<script', 1), function() {
						if(halaman == "Absen.php"){
							$('#datatableAbsen').dataTable({
								'order': [[ 0, 'asc' ]],
								 bFilter: false,
								 bInfo: false,
							});
						}else if(halaman == "Absen.php"){
							$('#datatableAbsen').dataTable({
								'order': [[ 0, 'asc' ]],
								 bFilter: false,
								 bInfo: false,
							});
						}else{
							$('#datatable').dataTable({
								"bDestroy": true,
								'order': [[ 1, 'asc' ]],
								"stateSave": true,
							});
						}

						if(judul=="Laporan Semua Helpdesk"){
							$.ajax({
								async:false,
								type: "POST",
								dataType: 'json',
								data:{lallp: 'lallp',
									bulanx: bulan,
									tahunx: tahun},
								url:'../action/Lallp.php',
								success: function (result) {	
									var bulan = $('#bulan :selected').text();
									var tahun = $('#tahun :selected').text();
									$('#judulGrafikPengerjaan').html('Grafik Pengerjaan '+bulan);
									$('#judulGrafikTotal').html('Grafik Grafik Total Helpdesk '+bulan);	
									var nama = []; var persentase = []; var pengerjaan = []; 
									for(i=0; i<result.length -1;i++){
										nama.push(result[i]['nama']);
										persentase.push(result[i]['total']);
									}
									pengerjaan.push(result[result.length -1]['selesai']);
									pengerjaan.push(result[result.length -1]['progress']);

									var ctx = document.getElementById("pieChart");
									var data = {
										datasets: [{
										  data: persentase,
										  backgroundColor: ["#8abb6f","#bdc3c7","#34495e","#9b59b6","#26b99a","#3498db"],
										  label: 'My dataset' // for legend
										}],
										labels: nama
									};
									var pieChart = new Chart(ctx, {
										data: data,
										type: 'pie'
									});

									var ctx1 = document.getElementById("pieChart1");
									var data1 = {
										datasets: [{
										  data: pengerjaan,
										  backgroundColor: ["#8abb6f","#bdc3c7"],
										  label: 'My dataset' // for legend
										}],
										labels: ["Selesai","Progress"]
									};
									var pieChart1 = new Chart(ctx1, {
										data: data1,
										type: 'pie'
									});
								},error: function(xhr, ajaxOptions, thrownError){
					                alert(xhr.status);
					            }
							});
						}
						if(judul=="Laporan Helpdesk Selesai"){
							var bulan = $('#bulan :selected').val();
							var tahun = $('#tahun :selected').val();							
							var jenisfilterlap = $('#jenisfilterlap').val();
							var tanggalmulailap = $('#tanggalmulailap').val();
							var tanggalsampailap = $('#tanggalsampailap').val();
							$('#judulGrafikPerCabang').html('Grafik pengerjaan Per Cabang ');
							$('#judulGrafikPerKaryawan').html('Grafik Helpdesk Per Karyawan ');
							$('#judulGrafikPerProgram').html('Grafik Helpdesk Per Program ');	
							$.ajax({
								async:false,
								type: "POST",
								dataType: 'json',
								data:{lapfinishnama: 'lapfinish',
										bulanx: bulan,
										tahunx: tahun,
										jenisfilterlap: jenisfilterlap,
										tanggalmulailap: tanggalmulailap,
										tanggalsampailap: tanggalsampailap
										},
								url:'../action/Lallp.php',
								success: function (result) {	
									var nama = []; var persentase = []; 
									for(i=0; i<result.length -1;i++){
										nama.push(result[i]['nama']);
										persentase.push(result[i]['total']);
									}
									var ctx = document.getElementById("pieChart");
									var data = {
										datasets: [{
										  data: persentase,
										  backgroundColor: ["#8abb6f","#bdc3c7","#34495e","#9b59b6","#26b99a","#3498db"],
										  label: 'My dataset' // for legend
										}],
										labels: nama
									};
									var pieChart = new Chart(ctx, {
										data: data,
										type: 'pie'
									});
								},error: function(xhr, ajaxOptions, thrownError){
					                alert(xhr.status);
					            }
							});
							$.ajax({
								async:false,
								type: "POST",
								dataType: 'json',
								data:{lapfinishcabang: 'lapfinish',
										bulanx: bulan,
										tahunx: tahun,
										jenisfilterlap: jenisfilterlap,
										tanggalmulailap: tanggalmulailap,
										tanggalsampailap: tanggalsampailap},
								url:'../action/Lallp.php',
								success: function (result) {	
									var nama = []; var persentase = []; 
									for(i=0; i<result.length;i++){
										nama.push(result[i]['namacab']);
										persentase.push(result[i]['total']);
									}
									var ctx = document.getElementById("pieChart1");
									var data = {
										datasets: [{
										  data: persentase,
										  backgroundColor: ["#8abb6f","#bdc3c7","#34495e","#9b59b6","#26b99a","#3498db","#f442e8","#1bfc4c"],
										  label: 'My dataset' // for legend
										}],
										labels: nama
									};
									var pieChart = new Chart(ctx, {
										data: data,
										type: 'pie'
									});
								},error: function(xhr, ajaxOptions, thrownError){
					                alert(xhr.status);
					            }
							});
							$.ajax({
								async:false,
								type: "POST",
								dataType: 'json',
								data:{lapfinishprogram: 'lapfinish',
										bulanx: bulan,
										tahunx: tahun,
										jenisfilterlap: jenisfilterlap,
										tanggalmulailap: tanggalmulailap,
										tanggalsampailap: tanggalsampailap},
								url:'../action/Lallp.php',
								success: function (result) {	
									var nama = []; var persentase = []; 
									for(i=0; i<result.length;i++){
										nama.push(result[i]['NamaAplikasi']);
										persentase.push(result[i]['total']);
									}
									var ctx = document.getElementById("pieChart2");
									var data = {
										datasets: [{
										  data: persentase,
										  backgroundColor: ["#8abb6f","#bdc3c7","#34495e","#9b59b6","#26b99a","#3498db","#f442e8","#1bfc4c"],
										  label: 'My dataset' // for legend
										}],
										labels: nama
									};
									var pieChart = new Chart(ctx, {
										data: data,
										type: 'pie'
									});
								},error: function(xhr, ajaxOptions, thrownError){
					                alert(xhr.status);
					            }
							});
						}
					});
				    dialog.modal('hide');
				}, 500);
			},error: function(xhr, ajaxOptions, thrownError){
	            alert(xhr.status);
	        }
		});
	}, 1000);
}
function goEdit(index){
	var judul = $('#title').text(); 
	var jenis = "";
	// alert(judul);
	localStorage.content = $('#main-section>div').html();	
	// if(localStorage.length<=1){
	// 	var d = new Date();

	//     n = d.getMonth();

	//     y = d.getFullYear();
	// 	localStorage.bulan = n;
	// 	localStorage.tahun = y;	
	// }
	document.cookie = "histjudul="+judul;	
	if(judul=='Verifikasi Helpdesk'){
		var idHelpdesk = $('#idhdpata'+index).text();
		var action='../action/Ithd.php';
	}else if(judul.includes("Helpdesk") || judul.includes("ITJob yang perlu dikerjakan") || judul.includes("List Pekerjaan IT")){
		var idHelpdesk = $('#idhd'+index).text();
		var action='../action/Ithd.php';
	}else if(judul=='Peminjaman Hardware'){
		var idHelpdesk = $('#idhd'+index).text();
		var action='../action/itpinjam.php';
	}else if(judul=='Master Hardware'){
		var idHelpdesk = $('#idhd'+index).text();
		var action='../action/ithardware.php';
	}else if(judul.includes('Semua Komplain') || judul.includes('Komplain Selesai')){
		var idHelpdesk = $('#'+index).text();
		var action='../action/Ithd.php';
	}else if(judul=='Edit History'){
		var idHelpdesk = $('#idhd'+index).text();
		var action='../action/Ithd.php';
	}else if(judul.includes("Pengajuan")){
		var idHelpdesk = $('#idpj'+index).text();
		var action='../action/Itpj.php';
		if(judul.includes("Siap")){
			var jenis = "siap";
		}else if(judul.includes("Berjalan")){
			var jenis = "berjalan";
		}else{
			var jenis = "selesai";
		}
	}
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Pindah halaman edit...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{idHelpdeskEdit: idHelpdesk,
			judulPageEdit:judul,
			jenisP: jenis},
		url:action,
		success: function (resultDalam) {
			setTimeout(function(){
				$('#main-section').html(resultDalam);
				$('#main-section').load(resultDalam, function() {
				  Dropzone.discover();
				});
				$('#main-section').find('input').iCheck({checkboxClass: 'icheckbox_flat-green',radioClass: 'iradio_flat-green'});
			    dialog.modal('hide');

			    if(judul.includes("Helpdesk")){
					$('#tags_1').tagsinput({
			          maxTags: 8
			        });
				}
			    
			}, 500);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function goEditPengajuanFromNotif(nomer,ket){
	nomer = nomer.replaceAll(' ','');
	var judul = 'Pengajuan Baru'; 
	// alert(ket);
	if(ket=='SELESAI DITANGANI'){
		var jenis = "selesai";
	}else if(ket=='PENGAJUAN BARU'){
		var jenis = "berjalan";
	}else{
		var jenis = "siap";
	}
	// var jenis = "siap";
	var idHelpdesk = nomer;
	var action='../action/Itpj.php';
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Pindah halaman edit...</p>'
	});
	var a = "<?php echo $_SESSION['halaman_terbuka']=='editpengajuan'); ?>";
	$.ajax({
		async:false,
		type: "POST",
		data:{idHelpdeskEdit: idHelpdesk,
			judulPageEdit:judul,
			jenisP: jenis},
		url:action,
		success: function (resultDalam) {
			setTimeout(function(){
				$('#main-section').html(resultDalam);
				$('#main-section').load(resultDalam, function() {
				  Dropzone.discover();
				});
				$('#main-section').find('input').iCheck({checkboxClass: 'icheckbox_flat-green',radioClass: 'iradio_flat-green'});
			    dialog.modal('hide');

			    if(judul.includes("Helpdesk")){
					$('#tags_1').tagsinput({
			          maxTags: 8
			        });
				}
			    
			}, 500);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
// --------------------------------------------------------
function goDetail(nohd){
	var jenis = "";
	var judul = "Helpdesk Belum Ditangani";
	localStorage.content = $('#main-section').html();	
	var idHelpdesk = nohd;
	var action='../action/Ithd.php';
	
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Pindah halaman edit...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{idHelpdeskEdit: idHelpdesk,
			judulPageEdit:judul,
			jenisP: jenis},
		url:action,
		success: function (resultDalam) {
			setTimeout(function(){
				$('#main-section').html(resultDalam);
				$('#main-section').load(resultDalam, function() {
				  Dropzone.discover();
				});
				$('#main-section').find('input').iCheck({checkboxClass: 'icheckbox_flat-green',radioClass: 'iradio_flat-green'});
			    dialog.modal('hide');

			    if(judul.includes("Helpdesk")){
					$('#tags_1').tagsinput({
			          maxTags: 8
			        });
				}
			    
			}, 500);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
// -------------- Edit HD --------------
function estimasiMenit(){
	var estimasiIT = $('#estWaktu').val()+'-Menit';
	$('#estWaktu').val(estimasiIT);
}
function komcli(halaman){
	var d = new Date();
	var tahun = d.getFullYear();
	var bulan = d.getMonth()+1;
	var tanggal = d.getDate();
	var jam = d.getHours();
	var menit = d.getMinutes();
	var detik = d.getSeconds();

	var isi = $('#komunikasi').val();
	var noissue = $('#noIssue').val();
	var no = $('#jumlahKomunikasi').val();
	var waktu = tahun+"-"+bulan+"-"+tanggal+" "+jam+":"+menit+":"+detik;
	var dari = $('#nname').text();
	var allText = "•"+dari+" : "+isi+"\n";
	var action='';
	if(halaman=='helpdesk'){
		action='Edithd.php';
	}else if(halaman=='pengajuan'){
		action='Editpj.php';
	}
	$.ajax({
		async:false,
		type: "POST",
		data:{isiComCli: isi,
			noissueComCli: noissue,
			noComCli: no,
			waktuComCli: waktu,
			dariComCli: dari},
		url:'../action/'+action,
		success: function (resultDalam) {
			if(halaman=='helpdesk'){
				$('#chatClient').append(allText); 
			}else if(halaman=='pengajuan'){
				$('#chatClientPJ').append(allText); 
			}
			$('#komunikasi').val('');
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function backToAllHdList(){
	location.reload(true);
	// location.href='';
}
function previewGambar(lokasi){
	bootbox.dialog({
		size:'large',
	  	message: '<img src="../upload/'+lokasi+'" class="img-responsive" >'
	});
}

function simpanCatatan() {
	var nohelpdesk = $('#noIssue').val(); //alert(nohelpdesk);
	var catatan = $('#solusi').val(); //alert(catatan);
	var dialog = bootbox.dialog({
		message: '<p><i class="fa fa-spin fa-spinner"></i>  Mohon tunggu...</p>'
	});

	$.ajax({
		async:false,
		type: "POST",
		data:{noHelpdesk: nohelpdesk,
			catatanEdit: catatan},
		url:'../action/Edithd.php',
		success: function (resultDalam) {
			setTimeout(function(){
				// alert("Data Telah Berhasil Disimpan.");
				// alert (resultDalam);
				dialog.modal('hide');
				loadUrl = "edit.php";
				// $('#main_section').load(loadUrl);
				location.reload(true);
			}, 1000);
		},error: function(xhr, ajaxOptions, thrownError){
			alert(xhr.status);
		}
	});
}

function simpanEditPATAF(){
	var nohelpdesk = $('#noIssue').val(); //alert(nohelpdesk);
	var tujuan = $('#kehendak :selected').val();//alert(tujuan);
	var kategori = $('#jenis :selected').val();//alert(kategori);
	var jenisLap = $('#jenislaporan :selected').val();//alert(jenisLap);
	var progDimaksud = $('#programYangDimaksud :selected').val();//alert(progDimaksud);
	var catatan = $('#solusi').val(); //alert(catatan);

	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Mohon tunggu...</p>'
	});

	$.ajax({
		async:false,
		type: "POST",
		data:{nohelpdeskEditPATA: nohelpdesk,
			tujuanEditPATA: tujuan,
			kategoriEditPATA: kategori,
			jenisLapEditPATA:jenisLap,
			progDimaksudEditPATA:progDimaksud,
			catatanEditPATA: catatan},
		url:'../action/Edithd.php',
		success: function (resultDalam) {
			setTimeout(function(){
				alert("Data Telah Berhasil Disimpan.");
				// alert(resultDalam);
			    dialog.modal('hide');
			    location.reload(true);
			}, 1000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function simpanEdituser(){
	var nohelpdesk = $('#noIssue').val(); //alert(nohelpdesk);
	var tujuan = $('#kehendak :selected').val();//alert(tujuan);
	var kategori = $('#jenis :selected').val();//alert(kategori);
	var jenisLap = $('#jenislaporan :selected').val();//alert(jenisLap);
	var progDimaksud = $('#programYangDimaksud :selected').val();//alert(progDimaksud);
	var catatan = $('#solusi').val(); //alert(catatan);
	var deskripsi = $('#deskripsi').val().replace('Tambahkan deskripsi disini','');

	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Mohon tunggu...</p>'
	});

	$.ajax({
		async:false,
		type: "POST",
		data:{nohelpdeskEditPATA: nohelpdesk,
			tujuanEditPATA: tujuan,
			kategoriEditPATA: kategori,
			jenisLapEditPATA:jenisLap,
			progDimaksudEditPATA:progDimaksud,
			catatanEditPATA: catatan,
			deskripsiP: deskripsi},
		url:'../action/Edithd.php',
		success: function (resultDalam) {
			setTimeout(function(){
				$('#myAwesomeDropzone').get(0).dropzone.processQueue();
				alert("Data Telah Berhasil Disimpan.");
				// alert(resultDalam);
			    dialog.modal('hide');
			    location.reload(true);
			}, 1000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function acceptWork(){
	var nohelpdesk = $('#noIssue').val(); 
	var ditangani = $('#siapa').text();
	var status = 0;
	var tujuan = $('#kehendak :selected').val();
	var kategori = $('#jenis :selected').val();
	var jenisLap = $('#jenislaporan :selected').val();
	var progDimaksud = $('#programYangDimaksud :selected').val();
	var stnotifIT = 1;
	var EstITOK = 1;
	var EstIT = $('#estWaktu').val().split("-");
	var ITTake = 1;
	var catatan = $('#solusi').val(); 

	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Mohon tunggu...</p>'
	});

	$.ajax({
		async:false,
		type: "POST",
		data:{nohelpdeskAccWork: nohelpdesk,
			ditanganiAccWork: ditangani,
			statusAccWork: status,
			tujuanAccWork:tujuan,
			kategoriAccWork:kategori,
			jenisLapAccWork: jenisLap,
			progDimaksudAccWork: progDimaksud,
			stnotifITAccWork: stnotifIT,
			EstITOKAccWork: EstITOK,
			EstITAccWork: EstIT[0],
			ITTakeAccWork: ITTake,
			catatanAccWork:catatan},
		url:'../action/Edithd.php',
		success: function (resultDalam) {
			setTimeout(function(){
			    dialog.modal('hide');
			    location.reload(true);
			}, 1000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function clearHelpdesk(){
	var nohelpdesk = $('#noIssue').val(); 
	var status = 1;
	var stnotifIT = 1;
	var catatan = $('#solusi').val(); 
	var keywords = $("#tags_1").val();  
	if(catatan==' ' || !catatan){
		bootbox.alert("Solusi / Catatan harus diisi");
	}else{
		var dialog = bootbox.dialog({
		  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Menyelesaikan helpdesk...</p>'
		});
		$.ajax({
			async:false,
			type: "POST",
			data:{nohelpdeskSelesai: nohelpdesk,
				statusSelesai: status,
				stnotifITSelesai: stnotifIT,
				catatanSelesai: catatan,
				keywordsSelesai: keywords},
			url:'../action/Edithd.php',
			success: function (resultDalam) {
				setTimeout(function(){
				    dialog.find('.bootbox-body').html('<center>Komplain '+nohelpdesk+' telah <font color="blue">selesai</font>..<br>Terima kasih...</center>');
				}, 1000);
				setTimeout(function(){
				    dialog.modal('hide');
				    location.reload(true);
				}, 2000);
			},error: function(xhr, ajaxOptions, thrownError){
	            alert(xhr.status);
	        }
		});
	}
}	
function beriTugas(){
	var itmember = $('#itmemberlist :selected').val();
	var itmemberNama = $('#itmemberlist :selected').text();
	var nohelpdesk = $('#noIssue').val(); 
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Memberi tugas kepada '+ itmemberNama+' ...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{tugaskanIT: itmember,
			nohelpdeskTugaskanIT:nohelpdesk},
		url:'../action/Edithd.php',
		success: function (resultDalam) {
			setTimeout(function(){
			    dialog.find('.bootbox-body').html('<center>Berhasil memberi tugas kepada '+ itmemberNama +'</center>');
			}, 1000);
			setTimeout(function(){
			    dialog.modal('hide');
			    location.reload(true);
			}, 2000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}

function ubahPersonil(){
	var itmember = $('#userIT :selected').val();
	var itmemberNama = $('#userIT :selected').text();
	var itmemberlama = $('#ITLama').val();
	var nohelpdesk = $('#noIssue').val(); 
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Mengalihkan tugas dari '+itmemberlama+' kepada '+ itmemberNama+' ...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{ubahITMember: itmember,
			nohelpdeskTugaskanIT:nohelpdesk,
			ITLama : itmemberlama},
		url:'../action/Edithd.php',
		success: function (resultDalam) {
			setTimeout(function(){
			    dialog.find('.bootbox-body').html('<center>Berhasil memberi tugas kepada '+ itmemberNama +'</center>');
			}, 1000);
			setTimeout(function(){
			    dialog.modal('hide');
			    location.reload(true);
			}, 2000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
// --------------------------------------------------------

// -------------- Block Tulis Pengajuan --------------
function submitPengajuan(){
	var tanggalPengajuan = $('#tglPeng').attr('tanggal');
	var pengajuanDari = $('#dari').attr('nameonly');
	var cabang = $('#cabang').val();
	var kepada = $('#kepada').val();
	var up = $('#up').val();
	var investasi = $('#investasi').val();
	var biaya = $('#biaya').val();
	if(biaya=='' || !biaya){
		biaya = 0;
	}
	var jadwal = $('#jadwal').val();
	var alasan = $('#alasan').val();
	// var analisis = $('#analisis').val();
	var analisis = '';

	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Menambahkan pengajuan baru ke Helpdesk...</p>'
	});
	$('#myAwesomeDropzone').get(0).dropzone.processQueue();
	$.ajax({
		async:false,
		type: "POST",
		data:{tanggalPengajuanP: tanggalPengajuan,
			pengajuanDariP: pengajuanDari,
			cabangP: cabang,
			kepadaP: kepada,
			upP: up,
			investasiP: investasi,
			biayaP: biaya,
			jadwalP: jadwal,
			alasanP: alasan,
			analisisP: analisis},
		url:'../action/Newpj.php',
		success: function (result) {
			// $('#myAwesomeDropzone').get(0).dropzone.processQueue();
			setTimeout(function(){
			    dialog.find('.bootbox-body').html('<center>Pengajuan berhasil ditambahkan..</center>');
			}, 5000);
			setTimeout(function(){
			    dialog.modal('hide');
			    document.cookie = "halaman=allpj";
			    document.cookie = "subhalaman=PengajuanIT";
			    document.cookie = "namamenu=History Pengajuan";
			    document.cookie = "icon=fa fa-history";
			    location.reload(true);
			}, 5000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}

// --------------------------------------------------------


// -------------- Block Edit Pengajuan --------------
function backToAllPengajuanList(){
	//upload file dulu
	addAttachment();
	location.reload(true);
}
function ubahNoPengajuan(){
    var biaya = $('#biaya').val();
	var no = $('#noIssue').val();
	if(isNaN(biaya)==true){
		bootbox.alert("Biaya harus berupa angka saja, tanpa huruf atau tanda baca apapun!");
	}else{
		if(no.length==16){
			var noDepan = no.substr(0, 7);
	    	var noBelakang = no.substr(9, 16);
		}else if(no.length==14){
			var noDepan = no.substr(0, 7);
	    	var noBelakang = no.substr(7, 13);
		}
		if(biaya == ''){
			bootbox.alert("Biaya jangan dikosongi !");
			$('#noIssue').val(noDepan+noBelakang);
		}else if(biaya <= 1000000){
	    	$('#noIssue').val(noDepan+'1-'+noBelakang);
	    }else if (biaya <= 5000000){
			$('#noIssue').val(noDepan+'2-'+noBelakang);
		}else if (biaya >= 5000001){
			$('#noIssue').val(noDepan+'3-'+noBelakang);
		}
	}	
}
function getNoPengajuan(){
    var biaya = $('#biaya').val();
	var no = $('#noIssue').val();
	var kategori = '';
	if(isNaN(biaya)==true){
		bootbox.alert("Biaya harus berupa angka saja, tanpa huruf atau tanda baca apapun!");
		return;
	}else{
		if(no.length==16){
			var noDepan = no.substr(0, 7);
	    	var noBelakang = no.substr(9, 16);
		}else if(no.length==14){
			var noDepan = no.substr(0, 7);
	    	var noBelakang = no.substr(7, 13);
		}
		if(biaya == ''){
			bootbox.alert("Biaya jangan dikosongi !");
			$('#noIssue').val(noDepan+noBelakang);
			return;
		}else if(biaya <= 1000000){
	    	// $('#noIssue').val(noDepan+'1-'+noBelakang);
	    	kategori = noDepan+'1-';
	    }else if (biaya <= 5000000){
			// $('#noIssue').val(noDepan+'2-'+noBelakang);
			kategori = noDepan+'2-';
		}else if (biaya >= 5000001){
			// $('#noIssue').val(noDepan+'3-'+noBelakang);
			kategori = noDepan+'3-';
		}
	}	
	$.ajax({
		async:false,
		type: "POST",
		dataType: 'json',
		data:{	kategori: kategori,

		},
		url:'../action/getNomorPengajuanBaru.php',          
	      success: function (result) {
	        $('#noIssue').val(result[0]["nomor"]);      
	      },error: function(xhr, ajaxOptions, thrownError){
	              alert(xhr.status);
	          }
	});
}
function ShowCusApp()
{
	$('#tblapproval').show();
	$('#hideCusApp').show();

	$('#showCusApp').hide();
	$('#approvlevel').hide();
}

function HideCusApp()
{
	$('#tblapproval').hide();
	$('#hideCusApp').hide();

	$('#showCusApp').show();
	$('#approvlevel').show();
}
function setApprovalLevel()
{
	var biaya = $('#biaya').val()

	$.ajax({
		async:false,
		type: "POST",
		dataType: 'json',
		data:{	biayaP: biaya,

		},
		url:'../action/setApprovalLevel.php',          
	      success: function (result) {
	        if(result.length > 0)
	        {
	        	// alert(biaya);
	        	$('#approvlevel').show();
	        	$('#tblapproval').hide();
				$('#hideCusApp').hide();
	        	document.getElementById('approvlevel').innerHTML = '';
	        	for(var i=0;i<=result.length;i++)
	        	{
	        		// var apphtml = result[i]['Position'];
	        		var apphtml = "<div class='col-md-2 col-sm-2 col-xs-12' id='"+result[i]['Position']+"'><a class='btn btn-app' id='acc"+i+"' name='"+result[i]['Position']+"'><i class='fa fa-thumbs-o-up'></i>"+result[i]['Position']+"</a></div>"
	        		// document.getElementById('approvlevel').innerHTML = apphtml;
	        		$('#approvlevel').append(apphtml);
	        	}

	        	var btnShow = "<input type='button' onclick='ShowCusApp()' class='col-md-12 btn btn-success' style='float:right;' id='showCusApp' value='Insert Custom Approval' >"
	        	$('#approvlevel').append(btnShow);
	        	
	        }else
	        {
	        	
	        }
	      },error: function(xhr, ajaxOptions, thrownError){
	              alert(xhr.status);
	          }
	});
}

function simpanPengajuanLama(){
	var initial = $('#submitPengajuan').attr('initial');
	var nopengajuan = $('#noIssue').val();
	var oldnumber = $('#oldnumber').val();
	var dateentry = $('#dateentry').attr('tanggal'); 
	var tanggalPengajuan = $('#tglPeng').val(); 
	var kepada = $('#kepada').val(); 
	var up = $('#up').val(); 
	var dari = $('#dari').attr('nameonly'); 
	var cabang = $('#cabang').val(); 
	var namainvest = $('#investasi').val(); 
	var biaya = $('#biaya').val(); 
	var jadwal = $('#jadwal').val(); 
	var alasan = $('#alasan').val(); 
	var analisis = $('#analisis').val(); 
	var realisasi = $('#realisasi').val();
	var approval = [];
	var approvalname = [];
	var approvaldate = [];


	var statapp = document.getElementById("tblapproval");
	if(window.getComputedStyle(statapp).display === "none")
	{
		// alert("default");
		// approvalname = "0";
		// approvaldate = "0";
		var jumapprove = 20;
		for(i=0;i<=jumapprove;i++)
		{
			if($('#acc'+i).val()===undefined){}else{
				// alert('default'+i);
				approval.push($('#acc'+i+'').attr('name'));	
				// alert($('#acc'+i+'').attr('name'));
			}
		}		
	}
	else
	{
		// alert("custom");
		// approval="0";
		var jumapprove = 20;
		for(i=0;i<=jumapprove;i++)
		{
			if($('#approvalname'+i).val()===undefined){}else{				
				approvalname.push($('#approvalname'+i+'').val());	
				approvaldate.push($('#approvaldate'+i+'').val());	
				// alert($('#acc'+i+'').attr('name'));
			}
		}		
	}

	// var jumapprove = 20;
	// for(i=0;i<=jumapprove;i++)
	// {
	// 	if($('#approvalname'+i).val()===undefined)
	// 	{
			
	// 		if($('#acc'+i).val()===undefined){}else{
	// 			alert('default'+i);
	// 			approval.push($('#acc'+i+'').attr('name'));	
	// 			// alert($('#acc'+i+'').attr('name'));
	// 		}
	// 	}
	// 	else
	// 	{
	// 		alert('custom'+i);
	// 		approvalname.push($('#approvalname'+i+'').val());
	// 		approvaldate.push($('#approvaldate'+i+'').val());
	// 	}
		
	// }

	// for(i=0;i<=jumapprove;i++)
	// {
	// 	if($('#acc'+i).val()===undefined){}else{
	// 		alert('default'+i);
	// 		approval.push($('#acc'+i+'').attr('name'));	
	// 		// alert($('#acc'+i+'').attr('name'));
	// 	}
	// }





    bootbox.confirm({
        message: "<h2>Pastikan nomor pengajuan sudah sesuai dengan no pengajuan hardcopy</h2>",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
        	if(result==true){
        		var dialog = bootbox.dialog({
				  message: '<p><i class="fa fa-spin fa-spinner"></i>  Menambahkan pengajuan baru ke Helpdesk...</p>'
				});
				$('#myAwesomeDropzone').get(0).dropzone.processQueue();				
				$.ajax({
					async:false,
					type: "POST",
					data:{initialP:initial,
						nopengP: nopengajuan,
						oldnumberP: oldnumber,
						dateentryP:dateentry,
						tanggalPengajuanP: tanggalPengajuan,
						kepadaP: kepada,
						upP: up,
						dariP: dari,
						cabangP: cabang,
						namainvestP: namainvest,
						biayaP: biaya,
						jadwalP: jadwal,
						alasanP: alasan,
						analisisP: analisis,
						realisasiP: realisasi,
						approvalP:approval,
						approvalnameP: approvalname,
						approvaldateP: approvaldate

					},
					url:'../action/Newpjlama.php',
					success: function (result) {
						$('#notaDropzone').get(0).dropzone.processQueue();
						setTimeout(function(){
						    dialog.modal('hide');
						    document.cookie = "halaman=pjselesai";
						    document.cookie = "subhalaman=PengajuanIT";
						    document.cookie = "namamenu=Pengajuan Selesai";
						    document.cookie = "icon=fa fa-spinner";
						    location.reload(true);
						}, 2000);
					},error: function(xhr, ajaxOptions, thrownError){
			            alert(xhr.status);
			        }
				});
        	}
        }
    });
}

function simpanPengajuan(){
	
	getNoPengajuan();

	var nopengajuan = $('#noIssue').val(); 
	//upload file dulu
	addAttachment();
	if(nopengajuan.length==16){
		var nopengajuanLama = $('#noIssueLama').val(); 
		var tanggalPengajuan = $('#tglPengajuan').attr('tanggal'); 
		var kepada = $('#kepada').val(); 
		var up = $('#up').val(); 
		var dari = $('#dari').attr('idonly'); 
		var cabang = $('#cabang').val(); 
		var namainvest = $('#investasi').val(); 
		var biaya = $('#biaya').val(); 
		var jadwal = $('#jadwal').val(); 
		var alasan = $('#alasan').val(); 
		var analisis = $('#analisis').val(); 

	    bootbox.confirm({
	        message: "<h2>Pastikan nomor pengajuan sudah tergolong berdasarkan harga !!</h2>",
	        buttons: {
	            confirm: {
	                label: 'Yes',
	                className: 'btn-success'
	            },
	            cancel: {
	                label: 'No',
	                className: 'btn-danger'
	            }
	        },
	        callback: function (result) {
	        	if(result==true){
	        		var dialog = bootbox.dialog({
					  message: '<p><i class="fa fa-spin fa-spinner"></i>  Menambahkan pengajuan baru ke Helpdesk...</p>'
					});
					$.ajax({
						async:false,
						type: "POST",
						data:{nopengajuanEdit: nopengajuan,
							nopengajuanLamaEdit: nopengajuanLama,
							tanggalPengajuanEdit: tanggalPengajuan,
							kepadaEdit: kepada,
							upEdit: up,
							dariEdit: dari,
							cabangEdit: cabang,
							namainvestEdit: namainvest,
							biayaEdit: biaya,
							jadwalEdit: jadwal,
							alasanEdit: alasan,
							analisisEdit: analisis},
						url:'../action/Editpj.php',
						success: function (result) {
							// $('#myAwesomeDropzone').get(0).dropzone.processQueue();
							setTimeout(function(){
							    dialog.find('.bootbox-body').html('<center>Pengajuan Telah Dilengkapi..<br>Silahkan tunggu konfirmasi PATA terlebih dahulu.</center>');
							}, 1000);
							setTimeout(function(){
							    dialog.modal('hide');
							    document.cookie = "halaman=waitverifpj";
							    document.cookie = "subhalaman=PengajuanIT";
							    document.cookie = "namamenu=Tunggu Acc PATA";
							    document.cookie = "icon=fa fa-spinner";
							    location.reload(true);
							}, 2000);
						},error: function(xhr, ajaxOptions, thrownError){
				            alert(xhr.status);
				        }
					});
	        	}
	        }
	    });
	}else if(nopengajuan.length==14){
		bootbox.alert("Nomor Pengajuan belum berubah / tergolong dengan benar !");
	}
}

function addAttachment(){
	var nopeng = $('#noIssue').val();
	var jumGambar = $('#ctrGambar').val();
	// var dialog = bootbox.dialog({
	//   message: '<p><i class="fa fa-spin fa-spinner"></i>  Mengupload Gambar</p>'
	// });
	$.ajax({
		async:false,
		type: "POST",
		data:{nopengTambahan: nopeng,
			jumGambarTambahan: jumGambar},
		url:'../action/Editpj.php',
		success: function (result) {
			$('#myAwesomeDropzone').get(0).dropzone.processQueue();
			setTimeout(function(){
			    // dialog.find('.bootbox-body').html('<center>File berhasil diupload !</center>');
			}, 1000);
			setTimeout(function(){
    			// dialog.modal('hide');
			    // location.reload(true);
			}, 2000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function clickACC(param, jumlahAcc){
	var idacc = param.id.split("-");
	var yangDiAcc = idacc[1];
	var idBtn = '#acc-'+yangDiAcc;
	var nopengajuan = $('#noIssue').val();
	var d = new Date();
	var locale = "en-us";
	var bulan = d.toLocaleString(locale, {month: "long"}).substr(0,3);
	var tahun = d.getFullYear();
	var tanggal = d.getDate();
	var jam = d.getHours();
	var menit = d.getMinutes();
	var detik = d.getSeconds();

	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  ACC '+yangDiAcc+' pada pengajuan '+nopengajuan+'</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		dataType: 'json',
		data:{yangDiAcc: yangDiAcc,
			nopengajuan: nopengajuan},
		url:'../action/Editpj.php',
		success: function (result) {
			setTimeout(function(){
				$('#'+param.id).empty();
				$('#'+param.id).html("<p style='display:inline;'>"+yangDiAcc+" : </p><br /> <p style='color:green;display:inline;'>"+tanggal+" "+bulan+" "+tahun+" "+jam+":"+menit+":"+detik);
				$(idBtn).attr('disabled','disabled');
    			dialog.modal('hide');
    			if(result.length==jumlahAcc){
					$("#clearPengajuan").removeAttr('disabled');
				}
			}, 500);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function printPengajuan(){	
	//upload file dulu
	addAttachment();
	bootbox.confirm({
        message: "<h2>Apakah anda ingin cetak lampirannya juga?</h2>",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
        	var no = $('#noIssue').val(); 
			var tanggal = $('#tglPengajuan').val(); 
			var dari = $('#dari').val(); 
			var nama = $('#dari').attr('nameonly'); 
			var cabang = $('#cabang').val(); 
			var kepada = $('#kepada').val(); 
			var up = $('#up').val(); 
			var biaya = $('#biaya').val(); 
			var jadwal = $('#jadwal').val(); 
			var namainvestasi = $('#investasi').val(); 
			var alasan = $('#alasanprint').val(); 
			var analisis = $('#analisisprint').val(); 
			var lstpeng = [];
			var printlampiran = 0;
			for(var i=0;i<listaccpengajuan.length;i++){
				if(listaccpengajuan[i]['KodeACC'].replaceAll(' ','')!='PATA' && listaccpengajuan[i]['KodeACC'].replaceAll(' ','')!='KepalaBagian'){
					lstpeng.push(listaccpengajuan[i]['KodeACC']);
				}
			}
        	if(result==true){
        		printlampiran = 1;            		
        	}else{
        		printlampiran = 0;        		
        	}
        	var dialog = bootbox.dialog({
				  message: '<p><i class="fa fa-spin fa-spinner"></i></p>'
				});        						
				dialog.modal('hide');				
				$.ajax({
					async:false,
					type: "POST",
					data:{noPrint: no,
						tanggalPrint: tanggal,
						dariPrint: dari,
						namaPrint: nama,
						cabangPrint: cabang,
						kepadaPrint: kepada,
						upPrint: up,
						biayaPrint: biaya,
						jadwalPrint: jadwal,
						namainvestasiPrint: namainvestasi,
						alasanPrint: alasan,
						analisisPrint: analisis,
						printlampiranP: printlampiran,
						listaccpengajuanP: lstpeng},
					url:'../action/Editpj.php',
					success: function (result) {
					 	var downloadLink = document.createElement("a");
					    downloadLink.href = result;
					    downloadLink.target='_blank';
					    downloadLink.click();
					},error: function(xhr, ajaxOptions, thrownError){
			            alert(xhr.status);
			        }
				});
        }
    });	
}
function checkfiledanrealisasi(){
	var no = $('#noIssue').val(); 
	//upload file dulu
	addAttachment();
	$('#modal-container2').removeAttr('class').addClass('two');
	$('body').addClass('modal-active');	
					
}
function checkfiledanrealisasilama(){
	var no = $('#noIssue').val(); 
	$('#modal-container2').removeAttr('class').addClass('two');
	$('body').addClass('modal-active');	
					
}
function clearPengajuan(){
	var no = $('#noIssue').val(); 
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Menyelesaikan pengajuan....</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{noClear: no},
		url:'../action/Editpj.php',
		success: function (result) {
			setTimeout(function(){
			    dialog.find('.bootbox-body').html('<center>Pengajuan berhasil diselesaikan</center>');
			}, 1000);
			setTimeout(function(){
    			dialog.modal('hide');
			    // location.reload(true);
			}, 2000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
// --------------------------------------------------------

// -------------- Block Aplikasi / JLaporan / Hak Admin PATA --------------
function actionAplikasi(idaplikasi,namaaplikasi,action){
	var namaAplikasiBaru = $('#tambahData-'+idaplikasi).val();
	var judulPage = $('#title').text(); 
	if(action=='hapus'){
		var judul="Apakah anda yakin menghapus aplikasi "+namaaplikasi+" dari database?";
		var isi="Menghapus aplikasi...";
		var hasilnya="Aplikasi telah dihapus";
	}else if(action=='ubah'){
		var judul="Apakah anda yakin mengubah nama aplikasi "+namaaplikasi+" menjadi "+ namaAplikasiBaru +"?";
		var isi="Mengubah nama aplikasi..";
		var hasilnya="Nama aplikasi telah dirubah";
	}
	bootbox.confirm({
        message: "<h2>"+judul+"</h2>",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
        	if(result==true){
        		var dialog = bootbox.dialog({
				  message: '<p><i class="fa fa-spin fa-spinner"></i>   '+isi+'</p>'
				});
				$.ajax({
					async:false,
					type: "POST",
					data:{idaplikasiEdit: idaplikasi,
						namaAplikasiBaruEdit: namaAplikasiBaru,
						actionEdit:action,
						judulEdit:judulPage},
					url:'../action/MasterPATA.php',
					success: function (result) {
						setTimeout(function(){
						    dialog.find('.bootbox-body').html('<center>'+hasilnya+'</center>');
						}, 1000);
						setTimeout(function(){
						    dialog.modal('hide');
						    location.reload(true);
						}, 2000);
					},error: function(xhr, ajaxOptions, thrownError){
			            alert(xhr.status);
			        }
				});
        	}
        }
    });
}
function addAplikasi(){
	$(".hidden-top").animate({"opacity": 1});
	var x = document.getElementById("hidden-top");
	if ($(".hidden-top").css('display') == 'none') {
		$(".hidden-top").css('display','inline');
	} else {
		$(".hidden-top").css('display','none');
	}
	// $(".hidden-top").animate({"opacity": 0});
}
function simpanAplikasi(){
	var nomorAplikasi = $('#nomorAplikasi').val(); 
	var namaAplikasi = $('#namaAplikasi').val(); 
	var judul = $('#title').text(); 
	$.ajax({
		async:false,
		type: "POST",
		data:{nomorAplikasiBaru: nomorAplikasi,
			namaAplikasiBaru: namaAplikasi,
			judulBaru:judul },
		url:'../action/MasterPATA.php',
		success: function (result) {
			bootbox.alert("Data aplikasi ditambahkan");
		    location.reload(true);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function gantiNama(){
	var id = $('#idpegawai').val();
	$('#namapegawai').val(id);
}
function gantiID(){
	var id = $('#namapegawai').val();
	$('#idpegawai').val(id);
}
function tambahOrangIT(){
	var id = $('#idpegawai').val();
	$.ajax({
		async:false,
		type: "POST",
		data:{idIT: id },
		url:'../action/MasterPATA.php',
		success: function (result) {
			bootbox.alert("Orang IT baru ditambahkan");
		    location.reload(true);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function actionHakAdmin(idPegawai,statusLama,action){
	var statusData = $('#statusData-'+idPegawai).val();
	if(action=='hapus'){
		var judul="Apakah anda yakin menonaktifkan "+idPegawai+" dari Team IT?";
		var isi="Menonaktifkan...";
		var hasilnya="Pegawai telah tidak aktif";
	}else if(action=='ubah'){
		var isi="Mengubah status..";
		var hasilnya="Status telah berubah";
	}
	bootbox.confirm({
        message: "<h2>"+judul+"</h2>",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
        	if(result==true){
        		var dialog = bootbox.dialog({
				  message: '<p><i class="fa fa-spin fa-spinner"></i>   '+isi+'</p>'
				});
				$.ajax({
					async:false,
					type: "POST",
					data:{idPegawaiEdit: idPegawai,
						statusDataEdit: statusData,
						actionEdit:action},
					url:'../action/MasterPATA.php',
					success: function (result) {
						setTimeout(function(){
						    dialog.find('.bootbox-body').html('<center>'+hasilnya+'</center>');
						}, 1000);
						setTimeout(function(){
						    dialog.modal('hide');
						    location.reload(true);
						    // alert(result);
						}, 2000);
					},error: function(xhr, ajaxOptions, thrownError){
			            alert(xhr.status);
			        }
				});
        	}
        }
    });
}

function eidturl() {
  var readOnlyLength = $('#deskripsi2').val().length;
  var $textarea = $('#deskripsi');
  $textarea.scrollTop($textarea[0].scrollHeight);
  $textarea.val($textarea.val().replace('Tambahkan deskripsi disini',''));
  $('#deskripsi').on('keypress, keydown', function(event) {
    if ((event.which != 37 && (event.which != 39)) &&
      ((this.selectionStart < readOnlyLength) ||
        ((this.selectionStart == readOnlyLength) && (event.which == 8)))) {
      return false;
    }
  });
}
function hapusgambar(halaman,nohd,namafile,prenya){
	var table = $('#tblgambar').DataTable({
	 	"bAutoWidth": false,
	 	"bDestroy": true,
	 	"search": false,
		"perPageSelect": false,
		"perPageSelect": false,
		"bPaginate": false,
		"bInfo": false,
	 });
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i> Menghapus Gambar...</p>'
	});
	$.ajax({
			async:false,
			type: "POST",
			dataType: 'json',
			data:{nodhP: nohd,
				  namafileP: namafile},
			url: ''+halaman+'.php',
			success: function (result) {
				setTimeout(function(){
					table.clear();					
					var lnk = "'../action/hapusgambar'";
	          		for (var i=0;i<result.length;i++)
	          		{		    
	          		var linkprev = prenya+result[i]["NamaFile"];  
	          		var prenya2 = "'"+prenya+"'";
	          		var nohd = "'"+result[i]["No"]+"'";
	          		var nmfilehd = "'"+result[i]["NamaFile"]+"'";
	          		var prevbtn = '<a href="'+linkprev+'" target="_blank">Preview</a>';          	
	          		var dwlbtn = '<a href="'+linkprev+'" target="_blank">Download</a>';          	
	          		var delvbtn = '<a style="color: red;" href="#"" onclick="hapusgambar('+lnk+','+nohd+','+nmfilehd+','+prenya2+');">Delete</a>';          	
		            table.row.add( [
			            result[i]["NamaFile"],
			            prevbtn,
			            dwlbtn,
			            delvbtn
			        	] );
			        }
			        //table.addClass('table table-striped table-bordered dt-responsive nowrap jambo_table');
			        //table.responsive();
	                table.draw(true);    								
					alert('Gambar telah berhasil dihapus');
				dialog.modal('hide');
			}, 500);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
// --------------------------------------------------------

// -------------- Block xxx --------------

// --------------------------------------------------------
// -------------- Block xxx --------------

// --------------------------------------------------------
function ubahdari(){
	var dari2 = $('#dari2 :selected').text();
	var nik = $('#dari2 :selected').val();
	$('#dari').val(dari2);
	$('#dari').attr('nameonly',nik);
	// alert($('#dari').attr('nameonly'));
}
function addPinjam(halaman){
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Pindah halaman ...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{},
		url:halaman+'.php',
		success: function (resultDalam) {
			setTimeout(function(){
				$('#main-section').html(resultDalam);
				// $('#main-section').load(resultDalam, function() {
				//   Dropzone.discover();
				// });
				// $('#main-section').find('input').iCheck({checkboxClass: 'icheckbox_flat-green',radioClass: 'iradio_flat-green'});
			    dialog.modal('hide');
			    
			}, 500);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function cariprodukpinjam(e,buttonid,fieldid){
	e.keyCode = 13;
	cariprodukpinjampopup(e,buttonid,fieldid);	
}
function cariprodukpinjampopup(e,buttonid,fieldid)
{
	if (e.keyCode === 13) {
		var prodno = $('#'+buttonid).val();
		//var prodno = "";
		var table = $('#listproduct').DataTable({
			"bAutoWidth": true,
			"sScrollY": "200px",
			"bDestroy": true
		});
		var dialog = bootbox.dialog({
		  message: '<p><i class="fa fa-spin fa-spinner"></i>  Mencari Data...</p>'
		});
	
		$.ajax({
			async:false,
			type: "POST",
			dataType: 'json',
			data:{	prodnoP: prodno
				  },
			//judulPageEdit:judul},		
			url:'../action/cariproduct.php',
			success: function (result) {

				setTimeout(function(){					
					if(result.length==1)
					{
						$('#prodno'+fieldid).val(result[0]['idbarang']);  
						$('#descript'+fieldid).val(result[0]['descript']);
						$('#qty'+fieldid).val(result[0]['available']);
						$('#qtyhd'+fieldid).val(result[0]['available']);
					}else
					{
						// $('#descript'+fieldid).val("");  
						// $('#unit'+fieldid).val(""); 
						// $('#qtyavailablehd'+fieldid).val(0);
						// alert('data tidak ditemukan');
						$('#modal-container2').removeAttr('class').addClass('two');
						$('body').addClass('modal-active');	
						table.clear();
						for (var i=0;i<result.length;i++)
						{
							var prodcode = "'"+result[i]['idbarang']+"'";							
							var nama = "'"+result[i]['descript']+"'";
							var satuan = "'"+result[i]['available']+"'";							
							var addevent = '<a href="#" onclick="tutupPopupAksesDoc2();setPilihProducthelpdesk('+prodcode+','+nama+','+result[i]['available']+','+fieldid+');">'+result[i]['idbarang']+'</a>';							
							table.row.add( [
							addevent,
							result[i]["descript"],
							result[i]["available"]
							] );
						}               
						table.draw(true);
					}
					// dialog.find('.bootbox-body').html($('#contentTable').html());
					dialog.modal('hide');	
					// $('#order'+fieldid).focus();	
					$('#batal').attr('barisnya',fieldid);	    
				}, 1000);
			},error: function(xhr, ajaxOptions, thrownError){
				alert(xhr.status);
			}
		});
    }	
}

function tutupPopupAksesDoc2()
{	
	$('#modal-container2').addClass('out');
	$('body').removeClass('modal-active');	
}
function setPilihProducthelpdesk(prodno,nama,available,baris)
{
	$('#prodno'+baris).val(prodno);  
	$('#descript'+baris).val(nama);
	$('#qty'+baris).val(available);
	$('#qtyhd'+baris).val(available);
}
function HapusDetailBarang()
{
	var baris = $('#batal').attr('barisnya');
	$('#prodno'+baris).val('');
	$('#descript'+baris).val('');
	$('#qty'+baris).val(0);
}
function tutupPopupAksesDoc2()
{	
	$('#modal-container2').addClass('out');
	$('body').removeClass('modal-active');	
}
function submitpinjam(halaman,aksi){
	var nopinjam = $('#nopinjam').val();
	var tanggal = $('#tanggal').val();
	var duedate = $('#duedate').val();
	var catatan = $('#catatan').val();
	var baris = $('#detailtable tr').length-2; 
	var idbarang= [];
	var descript = [];
	var qty = [];
	for(var i=0; i<baris;i++){
		idbarang.push($('#prodno'+i).val());
		descript.push($('#descript'+i).val());
		qty.push($('#qty'+i).val());
	}
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Proses Simpan...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{ 
			nopinjamP: nopinjam,
			tanggalP: tanggal,
			duedateP: duedate,
			catatanP: catatan,
			idbarangP: idbarang,
			descriptP: descript,
			qtyP: qty,
			aksiP: aksi
		},
		url: halaman+'.php',
		success: function (result) {
			setTimeout(function(){
			    // dialog.find('.bootbox-body').html('<center>Komplain berhasil ditambahkan..</center>');
			}, 1000);
			setTimeout(function(){
				// alert(result);
			    dialog.modal('hide');
			    location.reload(true);
			    // alert(result);
			}, 2000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function checkstock(baris){
	if($('#qty'+baris).val()*1>$('#qtyhd'+baris).val()*1){
		alert('Stock barang hanya '+$('#qtyhd'+baris).val());
		$('#qty'+baris).val($('#qtyhd'+baris).val()*1);
	}		
}
function addhardware(halaman){
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Pindah halaman ...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{},
		url:halaman+'.php',
		success: function (resultDalam) {
			setTimeout(function(){
				$('#main-section').html(resultDalam);
				// $('#main-section').load(resultDalam, function() {
				//   Dropzone.discover();
				// });
				// $('#main-section').find('input').iCheck({checkboxClass: 'icheckbox_flat-green',radioClass: 'iradio_flat-green'});
			    dialog.modal('hide');
			    
			}, 500);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function submithardware(halaman,aksi){
	var idbarang = $('#idbarang').val();
	var descript = $('#descript').val();
	var onhand = $('#onhand').val();
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Proses Simpan...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{ 
			idbarangP: idbarang,
			descriptP: descript,
			onhandP: onhand,
			aksiP: aksi
		},
		url: halaman+'.php',
		success: function (result) {
			setTimeout(function(){
			    // dialog.find('.bootbox-body').html('<center>Komplain berhasil ditambahkan..</center>');
			}, 1000);
			setTimeout(function(){
				// alert(result);
			    dialog.modal('hide');
			    location.reload(true);
			    // alert(result);
			}, 2000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function checkbarang(){
	var onhand = $('#onhand').val()*1;
	var alocate = $('#alocate').val()*1;
	if(alocate>onhand){
		alert('Jumlah barang harus lebih besar atau sama dengan alokasi');
		$('#onhand').val(alocate);
	}
}
function hapushardware(halaman){
	var idbarang = $('#idbarang').val();
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Proses Hapus...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{ 
			idbarangP: idbarang
		},
		url: halaman+'.php',
		success: function (result) {
			setTimeout(function(){
			    // dialog.find('.bootbox-body').html('<center>Komplain berhasil ditambahkan..</center>');
			}, 1000);
			setTimeout(function(){
				// alert(result);
			    dialog.modal('hide');
			    location.reload(true);
			    // alert(result);
			}, 2000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function serahkanbarang(halaman){
	var nopinjam = $('#nopinjam').val();
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Proses Simpan...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{ 
			nopinjamP: nopinjam
		},
		url: halaman+'.php',
		success: function (result) {
			setTimeout(function(){
			    // dialog.find('.bootbox-body').html('<center>Komplain berhasil ditambahkan..</center>');
			}, 1000);
			setTimeout(function(){
				// alert(result);
			    dialog.modal('hide');
			    location.reload(true);
			    // alert(result);
			}, 2000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function terimabarang(halaman){
	var nopinjam = $('#nopinjam').val();
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Proses Simpan...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{ 
			nopinjamP: nopinjam
		},
		url: halaman+'.php',
		success: function (result) {
			setTimeout(function(){
			    // dialog.find('.bootbox-body').html('<center>Komplain berhasil ditambahkan..</center>');
			}, 1000);
			setTimeout(function(){
				// alert(result);
			    dialog.modal('hide');
			    location.reload(true);
			    // alert(result);
			}, 2000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function updatemrealisasi(){
	var nopeng = $('#noIssue').val();
	var realisasi = remove_formatid($('#realisasi').val());
	var nopr = $('#nopr').val();
	var tanggaldatang = $('#tanggaldatang').val();
	var noinventaris = $('#noinventaris').val();
	$.ajax({
    async: false,
    type: "POST",
    dataType: "json",
    data: {
      target: "UpdateMRealisasiHelpdesk",
      key: "awa0N2zb4EgeqFrynvrA",
      iddbase: "DB00000007",      
      idapi: "API0000379",
      NoPengajuanAPI0000379: nopeng,
      nilairealisasiAPI0000379: realisasi,
      noprAPI0000379: nopr,
      tgldatangAPI0000379: tanggaldatang,
      noinventarisAPI0000379: noinventaris
    },
    url: "https://api.rutan.tech",
    success: function (hasil) {
      if (hasil["status"] == "success") {
        console.log('update realisasi sukses!');
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status);
    },
  });
}
function checknoprenter(e){
	if(e.keyCode===13){
		checknopr(e);
	}else{
		return;
	}
}	
function checknopr(e){	
	var nopr = $('#nopr').val();
	if(nopr.replaceAll(' ','')==''){
		updatemrealisasi();
	}else{
		$.ajax({
		    async: false,
		    type: "POST",
		    dataType: "json",
		    data: {
		      target: "CheckNoPaymentRequest",
		      key: "vIrXhZ6SbOa841NWPVX7",
		      // iddbase: "DB00000007",
		      iddbase: "DB00000001",
		      idapi: "API0000380",
		      NoPRAPI0000380: nopr
		    },
		    url: "https://api.rutan.tech",
		    success: function (hasil) {
		      if (hasil["status"] == "success") {
		        if(hasil["result"].length<1){ //data tidak ditemukan
		        	alert('Nomor Purchase Request tidak ditemukan!')
		        	$('#nopr').val(''); //kosongkan nomor PR
		        }else{
		        	updatemrealisasi();
		        }
		      }
		    },
		    error: function (xhr, ajaxOptions, thrownError) {
		      alert(xhr.status);
		    },
		  });
	}	
}
function addAttachmentNota(){
	var nopeng = $('#noIssue').val();
	var jumGambar = $('#jumfile').val();
	var realisasi = remove_formatid($('#realisasi').val());
	var nopr = $('#nopr').val();
	var tanggaldatang = $('#tanggaldatang').val();
	var noinventaris = $('#noinventaris').val();
	
	if(realisasi.replace(' ','')=='' || realisasi.replace(' ','')=='0'){
		alert('silahkan masukkan nilai realisasi dahulu!');
		$('#realisasi').focus();
		return;
	}else if(nopr.replace(' ','')==''){
		alert('silahkan Masukkan nomor Payment Request!');
		return;
	}else if(tanggaldatang.replace(' ','')==''){
		alert('silahkan Masukkan tanggal barang datang!');
		return;
	}else if(noinventaris.replace(' ','')==''){
		alert('silahkan masukkan nomor inventaris!');
		return;
	}else if(($('#jumfile').val()*1)<1){
		alert('silahkan upload gambar nota pembelian!');
		return;
	}else{
		var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Mengupload Gambar</p>'
		});
		$.ajax({
			async:false,
			type: "POST",
			data:{nopengTambahan: nopeng,
				jumGambarTambahan: jumGambar,
				realisasiP: realisasi},
			url:'../action/Editpj.php',
			success: function (result) {
				$('#notaDropzone').get(0).dropzone.processQueue();
				setTimeout(function(){
				    dialog.find('.bootbox-body').html('<center>File berhasil diupload !</center>');
				    dialog.modal('hide');
				    clearPengajuan();
				}, 1000);
				setTimeout(function(){
	    			// dialog.modal('hide');
				    location.reload(true);
				}, 2000);
			},error: function(xhr, ajaxOptions, thrownError){
	            alert(xhr.status);
	        }
		});
	}	
}
function ubahformat(id){
 	var nilai = $('#'+id).val();
 	nilai = remove_formatid(nilai);
 	nilai = number_format(nilai,0,',','.');
 	$('#'+id).val(nilai);
}
function remove_formatid(angka){
	var hasil = angka;
	hasil = hasil.replaceAll(',00','');
	hasil = hasil.replaceAll(',','');
	hasil = hasil.replaceAll('.','');
	return hasil;
}
function tampilkantabel(tombol){
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Memuat</p>'
	});
	$('#btnuserlogin').removeClass('btnaktif');
	$('#btnpengajuanbaru').removeClass('btnaktif');
	$('#btnhelpdeskbaru').removeClass('btnaktif');
	$('#btnpekerjaan').removeClass('btnaktif');
	$('#btnselesai').removeClass('btnaktif');
	$('#btnbelumselesai').removeClass('btnaktif');
	$('#btnovertime').removeClass('btnaktif');

	$('#userlogintbl').hide();
	$('#pengajuantbl').hide();
	$('#helpdesktbl').hide();
	$('#jumhelpdesktbl').hide();
	$('#jumpekerjaantbl').hide();
	$('#jumhdselesai').hide();
	$('#jumhdselesaibulan').hide();
	$('#avgpengerjaan').hide();
	$('#hdbelumselesai').hide();
	$('#kurang3menit').hide();
	$('#hdovertime').hide();
	$('#avgpengerjaanbulan').hide();
	$('#avgpenangananbulan').hide();
	if(tombol==1){
		$('#userlogintbl').show();
		$('#btnuserlogin').addClass('btnaktif');
	}else if(tombol==2){
		$('#pengajuantbl').show();
		$('#btnpengajuanbaru').addClass('btnaktif');
	}else if(tombol==3){
		$('#helpdesktbl').show();
		$('#jumhelpdesktbl').show();
		$('#btnhelpdeskbaru').addClass('btnaktif');
	}else if(tombol==4){
		$('#jumpekerjaantbl').show();
		$('#btnpekerjaan').addClass('btnaktif');
	}else if(tombol==5){
		$('#jumhdselesai').show();
		$('#jumhdselesaibulan').show();
		$('#kurang3menit').show();
		$('#avgpengerjaan').show();
		$('#avgpengerjaanbulan').show();
		$('#avgpenangananbulan').show();
		$('#btnselesai').addClass('btnaktif');
	}else if(tombol==6){
		$('#hdbelumselesai').show();
		$('#btnbelumselesai').addClass('btnaktif');
	}else if(tombol==7){
		$('#hdovertime').show();
		$('#btnovertime').addClass('btnaktif');
	}
	dialog.modal('hide');
}
function filterrepbulan(){
	var bulan = $('#bulan').val();
	var tahun = $('#tahun').val();
	var app = 'hd3menit';
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Memuatr</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		dataType: 'json',
		data:{appP: app,
			  bulanP: bulan,
			  tahunP: tahun},
		url:'../action/ShortingData.php',
		success: function (result) {
			var table = $('#datatablekurang3menit').DataTable();
			table.clear();
			for(var i=0;i<result.length;i++){
			table.row.add( [
			            result[i]["No"],
			            result[i]["tanggal2"],
			            result[i]["namadari"],
			            result[i]["issue"],
			            result[i]["namaditangani"],
			            result[i]["acceptwork2"],
			            result[i]["tanggalselesai2"],
			            result[i]["waktupengerjaan"]
			        	] );
			}
	                table.draw(true);   
	                dialog.modal('hide');			
		},error: function(xhr, ajaxOptions, thrownError){
	        alert(xhr.status);
	    }
	});
}
function filterbulanover(){
	var bulan = $('#bulanover').val();
	var tahun = $('#tahunover').val();
	var app = 'overtime';
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Memuat</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		dataType: 'json',
		data:{appP: app,
			  bulanP: bulan,
			  tahunP: tahun},
		url:'../action/ShortingData.php',
		success: function (result) {
			var table = $('#datatableovertime').DataTable();
			table.clear();
			for(var i=0;i<result.length;i++){
			table.row.add( [
			            result[i]["No"],
			            result[i]["tanggal2"],
			            result[i]["namadari"],
			            result[i]["issue"],
			            result[i]["namaditangani"],
			            result[i]["acceptwork2"],
			            result[i]["tanggalselesai2"],
			            result[i]["EstIT"]+' Menit',
			            result[i]["waktupengerjaan"]
			        	] );
			}
	                table.draw(true);   
	                dialog.modal('hide'); 			
		},error: function(xhr, ajaxOptions, thrownError){
	        alert(xhr.status);
	    }
	});
}
function pausehd(no){
	// alert('pause');
	$('#btnpause').hide();
	$('#clearHelpdesk').hide();
	$('#btnresume').show();
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Loading</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{pauseP: 1,
			  nohdP: no},
		url:'../action/PauseHD.php',
		success: function (result) {  
	             
	             dialog.modal('hide'); 			
		},error: function(xhr, ajaxOptions, thrownError){
	        alert(xhr.status);
	    }
	});
}
function resumehd(no){
	// alert('resume');
	$('#btnpause').show();
	$('#clearHelpdesk').show();
	$('#btnresume').hide();
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Loading</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{pauseP: 0,
			  nohdP: no},
		url:'../action/PauseHD.php',
		success: function (result) {  
	             
	             dialog.modal('hide'); 			
		},error: function(xhr, ajaxOptions, thrownError){
	        alert(xhr.status);
	    }
	});
}
function hidepause(ispause){
	if(ispause==1){
		$('#btnpause').hide();
		$('#clearHelpdesk').hide();
		$('#btnresume').show();
	}else{
		$('#btnpause').show();
		$('#clearHelpdesk').show();
		$('#btnresume').hide();
	}
}
// function setDetailBeranda(tombol){	
// 	// alert(tombol);
// 	localStorage.tombolterpilih = tombol;
// 	$('#btnsolved').removeClass('terpilih');
// 	$('#btnontime').removeClass('terpilih');
// 	$('#btnovertime').removeClass('terpilih');
// 	$('#btnonprogress').removeClass('terpilih');
// 	$('#btnterbuka').removeClass('terpilih');
// 	$('#btnditangani').removeClass('terpilih');
// 	$('#btnkomplain').removeClass('terpilih');
// 	if(tombol==1){
// 		$('#btnsolved').addClass('terpilih');
// 		$('#chartprogress').show();
// 		$('#tblontime').hide();
// 		$('#tblkomplainterbuka').hide();
// 		$('#tblhdditangani').hide();
// 		$('#detkomplaintahun').hide();
// 		$('#tblsolved').show();
// 		$('#tblovertime').hide();
// 		$('#tblonprogress').hide();
// 	}else if(tombol==2){
// 		$('#btnontime').addClass('terpilih');
// 		$('#chartprogress').hide();
// 		$('#tblontime').show();
// 		$('#tblkomplainterbuka').hide();
// 		$('#tblhdditangani').hide();
// 		$('#detkomplaintahun').hide();
// 		$('#tblsolved').hide();
// 		$('#tblovertime').hide();
// 		$('#tblonprogress').hide();
// 	}else if(tombol==3){
// 		$('#btnovertime').addClass('terpilih');
// 		$('#chartprogress').hide();
// 		$('#tblontime').hide();
// 		$('#tblkomplainterbuka').hide();
// 		$('#tblhdditangani').hide();
// 		$('#detkomplaintahun').hide();
// 		$('#tblsolved').hide();
// 		$('#tblovertime').show();
// 		$('#tblonprogress').hide();
// 	}else if(tombol==4){
// 		$('#btnonprogress').addClass('terpilih');
// 		$('#chartprogress').hide();
// 		$('#tblontime').hide();
// 		$('#tblkomplainterbuka').hide();
// 		$('#tblhdditangani').hide();
// 		$('#detkomplaintahun').hide();
// 		$('#tblsolved').hide();
// 		$('#tblovertime').hide();
// 		$('#tblonprogress').show();
// 	}else if(tombol==5){
// 		$('#btnterbuka').addClass('terpilih');
// 		$('#chartprogress').hide();
// 		$('#tblontime').hide();
// 		$('#tblkomplainterbuka').show();
// 		$('#tblhdditangani').hide();
// 		$('#detkomplaintahun').hide();
// 		$('#tblsolved').hide();
// 		$('#tblovertime').hide();
// 		$('#tblonprogress').hide();
// 	}else if(tombol==6){
// 		$('#btnditangani').addClass('terpilih');
// 		$('#tblhdditangani').show();
// 		$('#chartprogress').hide();
// 		$('#tblkomplainterbuka').hide();
// 		$('#detkomplaintahun').hide();
// 		$('#tblsolved').hide();
// 		$('#tblontime').hide();
// 		$('#tblovertime').hide();
// 		$('#tblonprogress').hide();
// 	}
// 	else if(tombol==7){
// 		$('#btnkomplain').addClass('terpilih');
// 		$('#detkomplaintahun').show();
// 		$('#tblhdditangani').hide();
// 		$('#chartprogress').hide();
// 		$('#tblkomplainterbuka').hide();
// 		$('#tblsolved').hide();
// 		$('#tblontime').hide();
// 		$('#tblovertime').hide();
// 		$('#tblonprogress').hide();
// 	}
// }
function setDetailBeranda(tombol){	
	// alert(tombol);
	var hal = '';
	var div_isi = '';
	localStorage.tombolterpilih = tombol;
	$('#btnsolved').removeClass('terpilih');
	$('#btnontime').removeClass('terpilih');
	$('#btnovertime').removeClass('terpilih');
	$('#btnonprogress').removeClass('terpilih');
	$('#btnterbuka').removeClass('terpilih');
	$('#btnditangani').removeClass('terpilih');
	$('#btnkomplain').removeClass('terpilih');
	$('#btnterbuka_nonit').removeClass('terpilih');
	$('#btnselesai_nonit').removeClass('terpilih');
	$('#btnditolak_nonit').removeClass('terpilih');
	$('#btnringkasan_nonit').removeClass('terpilih');
	$('#btnterbukaall_nonit').removeClass('terpilih');
	if(tombol==1){
		$('#btnsolved').addClass('terpilih');
		$('#chartprogress').show();
		hal = 'Beranda/ItemSolved.php';
		div_isi = 'isitabel';
	}else if(tombol==2){
		$('#btnontime').addClass('terpilih');	
		$('#chartprogress').hide();
		hal = 'Beranda/ItemOntime.php';
		div_isi = 'isitabel';
	}else if(tombol==3){
		$('#btnovertime').addClass('terpilih');
		$('#chartprogress').hide();
		hal = 'Beranda/ItemOverTime.php';
		div_isi = 'isitabel';
	}else if(tombol==4){
		$('#btnonprogress').addClass('terpilih');
		$('#chartprogress').hide();
		hal = 'Beranda/ItemOnProgress.php';
		div_isi = 'isitabel';
	}else if(tombol==5){
		$('#btnterbuka').addClass('terpilih');
		$('#chartprogress').hide();
		hal = 'Beranda/ItemTerbuka.php';
		div_isi = 'isitabel';
	}else if(tombol==6){
		$('#btnditangani').addClass('terpilih');
		$('#chartprogress').hide();
		hal = 'Beranda/ItemDitangani.php';
		div_isi = 'isitabel';
	}else if(tombol==7){
		$('#btnkomplain').addClass('terpilih');
		$('#chartprogress').hide();
		hal = 'Beranda/ItemHd.php';
		div_isi = 'isitabel';
	}else if(tombol==8){
		$('#btnterbuka_nonit').addClass('terpilih');
		$('#chartprogress').hide();
		hal = 'Beranda/ItemTerbuka_nonit.php';
		div_isi = 'isitabel_nonit';
	}else if(tombol==9){
		$('#btnselesai_nonit').addClass('terpilih');
		$('#chartprogress').hide();
		hal = 'Beranda/ItemSelesai_nonit.php';
		div_isi = 'isitabel_nonit';
	}else if(tombol==10){
		$('#btnditolak_nonit').addClass('terpilih');
		$('#chartprogress').hide();
		hal = 'Beranda/ItemDitolak_nonit.php';
		div_isi = 'isitabel_nonit';
	}else if(tombol==11){
		$('#btnringkasan_nonit').addClass('terpilih');
		$('#chartprogress').hide();
		hal = 'Beranda/ItemRingkasanHd_nonit.php';
		div_isi = 'isitabel_nonit';
	}else if(tombol==12){
		$('#btnterbukaall_nonit').addClass('terpilih');
		$('#chartprogress').hide();
		hal = 'Beranda/ItemTerbukaAll_nonit.php';
		div_isi = 'isitabel_nonit';
	}
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Mengambil Data...</p>'
	});
	setTimeout(function(){
		$.ajax({
			async:false,
			type: "POST",
			data:{tombol: tombol},
			url: hal,
			success: function (result) {  
		             $('#'+div_isi).html(result);
		             dialog.modal('hide'); 			
			},error: function(xhr, ajaxOptions, thrownError){
		        alert(xhr.status);
		    }
		});
	},500);
}
function filterhomehd(tombol){
	var data = {};
	var hal = '';
	var div_isi = '';
	if(tombol==8){
		var tahun = $('#tahuntebuka_nonit').val();
		hal = 'Beranda/ItemTerbuka_nonit.php';
		div_isi = 'isitabel_nonit';
		data = {tahun: tahun,
				tombol: tombol};
	}else if(tombol==9){
		var tahun = $('#tahunselesai_nonit').val();
		var bulan = $('#bulanselesai_nonit').val();
		hal = 'Beranda/ItemSelesai_nonit.php';
		div_isi = 'isitabel_nonit';
		data = {tahun: tahun,
				bulan: bulan,
				tombol: tombol};
	}
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Mengambil Data...</p>'
	});
	setTimeout(function(){
		$.ajax({
			async:false,
			type: "POST",
			data: data,
			url: hal,
			success: function (result) {  
		             $('#'+div_isi).html(result);
		             dialog.modal('hide'); 			
			},error: function(xhr, ajaxOptions, thrownError){
		        alert(xhr.status);
		    }
		});
	},500);
}
function UpdatePengajuanIT(){
	var nopj = $('#noIssue').val();
	var nopjlama = $('#noIssueLama').val();
	var kepada = $('#kepada').val();
	var up = $('#up').val();
	var biaya = $('#biaya').val();
	biaya = biaya.replaceAll('.','');
	var jadwal = $('#jadwal').val();
	var investasi = $('#investasi').val();
	var alasan = $('#alasan').val();
	var analisis = $('#analisis').val();
	var iseditanalisis = $('#isedited_analisis').val();
	// alert(iseditanalisis);
	// alert(nopj+' --- '+nopjlama);
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Update Data...</p>'
	});
	//upload file dulu
	addAttachment();
	$.ajax({
	  url: '../action/UpdatePengajuanIT.php',
	  type: 'post',
	  data:{nopjP: nopj,
	  		nopjlamaP: nopjlama,
	  		kepadaP: kepada,
	  		upP: up,
	  		biayaP: biaya,
	  		jadwalP: jadwal,
	  		investasiP: investasi,
	  		alasanP: alasan,
	  		analisisP: analisis,
	  		iseditanalisisP: iseditanalisis
	  },
	  success: function(result){
	  	dialog.modal('hide');
	  	location.reload(true);
	  }
	 });
}
function updateMPengajuan(){
	var nopj = $('#noIssue').val();
	var nopjlama = $('#noIssueLama').val();
	var kepada = $('#kepada').val();
	var up = $('#up').val();
	var biaya = $('#biaya').val();
	var jadwal = $('#jadwal').val();
	var investasi = $('#investasi').val();
	var alasan = $('#alasan').val();
	var analisis = $('#analisis').val();

	//upload file dulu
	addAttachment();
	// alert(nopj+' --- '+nopjlama);
	biaya = biaya.replaceAll('.','');
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Update Data...</p>'
	});
	$.ajax({
	  url: '../action/UpdateMPengajuanIT.php',
	  type: 'post',
	  data:{nopjP: nopj,
	  		nopjlamaP: nopjlama,
	  		kepadaP: kepada,
	  		upP: up,
	  		biayaP: biaya,
	  		jadwalP: jadwal,
	  		investasiP: investasi,
	  		alasanP: alasan,
	  		analisisP: analisis
	  },
	  success: function(result){
	  	dialog.modal('hide');
	  	// console.log(result);
	  	location.reload(true);
	  }
	 });
}
function editAnalisisPJ(){
	$('#isedited_analisis').val(1);
	$('#analisis').prop('disabled', false);
}
function addalasanpj(){
	var nopj = $('#noIssue').val();
	var alasantxt = $('#alasantxt').val();
	$.ajax({
	  url: '../action/AddAlasanPJ.php',
	  type: 'post',
	  data:{nopjP: nopj,
	  		alasanP: alasantxt
	  },
	  success: function(result){
	  	var alasan = $('#alasan').val();
	  	var alasanprint = $('#alasanprint').val();
	  	var alasantxt = $('#alasantxt').val();
	  	$('#alasan').val('');
	  	$('#alasan').val(alasan+'\n'+result+' : '+alasantxt);
	  	$('#alasanprint').val(alasanprint+'\n'+alasantxt);
	  	dialog.modal('hide');	  	
	  }
	 });
}
function tampilkanalasanpj(){
	var nopj = $('#noIssue').val();
	$.ajax({
	  async: false,
	  url: '../action/CariAlasan.php',
	  type: 'POST',
	  dataType: 'json',
	  data:{nopjP: nopj
	  },
	  success: function(result){	  	  	
	  	// console.log(result);
	  	for(var i=0;i<result.length;i++){
	  		// alert(result[i]["nama"]);
	  		var alasan = $('#alasan').val();
	  		var alasanprint = $('#alasanprint').val();
	  		$('#alasan').val(alasan+'\n'+result[i]["nama"]+' : '+result[i]["Alasan"]);
	  		$('#alasanprint').val(alasanprint+'\n'+result[i]["Alasan"]);
	  	}	  		  		
	  }
	 });
}
function addanalisispj(){
	var nopj = $('#noIssue').val();
	var analisistxt = $('#analisistxt').val();
	$.ajax({
	  url: '../action/AddAnalisisPJ.php',
	  type: 'post',
	  data:{nopjP: nopj,
	  		analisisP: analisistxt
	  },
	  success: function(result){
	  	var analisis = $('#analisis').val();
	  	var analisisprint = $('#analisisprint').val();
	  	var analisistxt = $('#analisistxt').val();
	  	$('#analisistxt').val('');
	  	$('#analisis').val(analisis+'\n'+result+' : '+analisistxt);
	  	$('#analisisprint').val(analisisprint+'\n'+analisistxt);
	  	dialog.modal('hide');	  	
	  }
	 });
}
function tampilkananalisispj(){
	var nopj = $('#noIssue').val();
	$.ajax({
	  async: false,
	  url: '../action/CariAnalisa.php',
	  type: 'POST',
	  dataType: 'json',
	  data:{nopjP: nopj
	  },
	  success: function(result){	  	  	
	  	// console.log(result);
	  	for(var i=0;i<result.length;i++){
	  		// alert(result[i]["nama"]);
	  		var analisis = $('#analisis').val();	
	  		var analisisprint = $('#analisisprint').val();	
	  		$('#analisis').val(analisis+'\n'+result[i]["nama"]+' : '+result[i]["analisis"]);
	  		$('#analisisprint').val(analisisprint+'\n'+result[i]["analisis"]);
	  	}	  		  		
	  }
	 });
}
function addJobHW(halaman){
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Pindah halaman ...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{},
		url:halaman+'.php',
		success: function (resultDalam) {
			setTimeout(function(){
				$('#main-section').html(resultDalam);
				// $('#main-section').load(resultDalam, function() {
				//   Dropzone.discover();
				// });
				// $('#main-section').find('input').iCheck({checkboxClass: 'icheckbox_flat-green',radioClass: 'iradio_flat-green'});
			    dialog.modal('hide');
			    
			}, 500);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function submitJobHW(aksi){
	var no = $('#no').val();
	var dari = $('#dari').val();
	var job = $('#job').val();
	if(job.replaceAll(' ','')==''){
		alert('Harap masukkan deskripsi pekerjaan dulu!')
		return;
	}
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Menyimpan data ...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{aksiP: aksi,
				dariP: dari,
				jobP: job,
				noP: no
			},
		url:'../action/NewJobHd.php',
		success: function (resultDalam) {
			setTimeout(function(){
				$('#main-section').html(resultDalam);
				// $('#main-section').load(resultDalam, function() {
				//   Dropzone.discover();
				// });
				// $('#main-section').find('input').iCheck({checkboxClass: 'icheckbox_flat-green',radioClass: 'iradio_flat-green'});
			    dialog.modal('hide');
			    location.reload(true);
			}, 500);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function EditJob(nomor,halaman){
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Pindah Halaman Edit ...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{nomorP: nomor,
			  editP: 1},
		url:halaman+'.php',
		success: function (resultDalam) {
			setTimeout(function(){
				$('#main-section').html(resultDalam);
				dialog.modal('hide');
			}, 500);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function kerjakanJobHW(){
	var no = $('#no').val();
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Kerjakan Job...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{nomorP: no},
		url:'../action/KerjakanJobHW.php',
		success: function (resultDalam) {
			setTimeout(function(){
				$('#btnkerjakan').hide();
				$('#btnupdate').hide();
				$('#btnselesai').show();
				$('#grpsolusi').show();
				$('#dari').prop('disabled', true);
				$('#job').prop('disabled', true);
				$('#solusi').prop('disabled', false);
				dialog.modal('hide');
			}, 500);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function SelesaiJobHW(){
	var no = $('#no').val();
	var solusi = $('#solusi').val();
	if(solusi.replaceAll(' ','')==''){
		alert('Solusi harap diisi dulu!');
		return;
	}
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Kerjakan Job...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{nomorP: no,
			solusiP: solusi},
		url:'../action/SelesaiJobHW.php',
		success: function (resultDalam) {
			setTimeout(function(){
				$('#btnkerjakan').hide();
				$('#btnupdate').hide();
				$('#btnselesai').show();
				dialog.modal('hide');
				location.reload(true);
			}, 500);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function settingdisplay(ditangani,selesai,userlevel,ispaused,userditangani,useraktif){
	if(selesai==1){
		$('#btnkerjakan').hide();
		$('#btnupdate').hide();
		$('#btnselesai').hide();
		$('#grpsolusi').show();
		$('#dari').prop('disabled', true);
		$('#job').prop('disabled', true);
		$('#solusi').prop('disabled', true);
		$('#btnpause').hide();
		$('#btnresume').hide();
	}else{
		if(ditangani==1){
			$('#btnkerjakan').hide();
			$('#btnupdate').hide();			
			$('#grpsolusi').show();
			$('#dari').prop('disabled', true);
			$('#job').prop('disabled', true);
			$('#solusi').prop('disabled', false);
			if(userditangani.replaceAll(' ','')==useraktif.replaceAll(' ','')){
				$('#btnselesai').show();
				if(ispaused==1){
					$('#btnpause').hide();
					$('#btnresume').show();
				}else{
					$('#btnpause').show();
					$('#btnresume').hide();
				}
			}else{
				$('#btnpause').hide();
				$('#btnresume').hide();
				$('#btnselesai').hide();
			}			
		}else{
			$('#btnkerjakan').show();			
			$('#btnselesai').hide();
			$('#grpsolusi').hide();
			$('#dari').prop('disabled', false);
			$('#job').prop('disabled', false);
			$('#solusi').prop('disabled', true);
			if(userlevel>1){
				$('#btnupdate').show();
			}else{
				$('#btnupdate').hide();
			}
			$('#btnpause').hide();
			$('#btnresume').hide();
		}
	}
}
function pauseJob(){
	var no = $('#no').val();
	$('#btnpause').hide();
	$('#btnresume').show();
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Loading</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{pauseP: 1,
			  nohdP: no},
		url:'../action/PauseJob.php',
		success: function (result) {  
	             
	             dialog.modal('hide'); 			
		},error: function(xhr, ajaxOptions, thrownError){
	        alert(xhr.status);
	    }
	});
}
function resumejob(){
	var no = $('#no').val();
	$('#btnpause').show();
	$('#btnresume').hide();
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Loading...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{pauseP: 2,
			  nohdP: no},
		url:'../action/PauseJob.php',
		success: function (result) {  	             
	             dialog.modal('hide'); 			
		},error: function(xhr, ajaxOptions, thrownError){
	        alert(xhr.status);
	    }
	});
}
function filterJob(){
	var tahun = $('#tahun').val();
	var bulan = $('#bulan').val();
	var table = $('#datatable').DataTable({
	 	"bDestroy": true,
	 	"stateSave": true,
	 });
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Loading...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		dataType: 'json',
		data:{bulanP: bulan,
			  tahunP: tahun},
		url:'../action/FilterInternalHW.php',
		success: function (result) {  
				table.clear();
				for(var i=0;i<result.length;i++){
					// console.log(result[i]["Tanggal"]["date"]);
					var no = "'"+result[i]["No"]+"'";
					var hl = "'IT Hardware/EditInternalHW'";
					var nomer = "<a href='#' onclick='EditJob("+no+","+hl+");'>"+result[i]['No']+"</a>";
					table.row.add([
					nomer,
					result[i]["Tanggal2"],
					result[i]["namadari"],
					result[i]["Job"],
					result[i]["namaditangani"],
					result[i]["TanggalDitangani2"],
					result[i]["TanggalSelesai2"],
					result[i]["Solusi"],
					result[i]["waktupengerjaan"]+' Menit'
					]);
				}
				table.draw(true);
	            dialog.modal('hide'); 			
		},error: function(xhr, ajaxOptions, thrownError){
	        alert(xhr.status);
	    }
	});
}
function tampilkantabelmingguan(tombol){
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Memuat</p>'
	});
	$('#btnrating').removeClass('btnaktif');
	$('#btnrekap').removeClass('btnaktif');
	if(tombol==1){
		$('#userlogintbl').show();
		$('#rekapmingguantbl').hide();
		$('#rekapmingguantblcab').hide();
		$('#btnrating').addClass('btnaktif');
	}
	if(tombol==2){
		$('#userlogintbl').hide();
		$('#rekapmingguantbl').show();
		$('#rekapmingguantblcab').show();
		$('#btnrekap').addClass('btnaktif');
	}
	dialog.modal('hide');
}
function setKondisiLaporanHarian(){
	var d = new Date();
	var strDate = (d.getMonth()+1) + "/" + d.getDate() + "/" + d.getFullYear();
	$('#kondisi').text(strDate+' s/d '+strDate);
}

function getDataLaporanHarian(){
	var mulai = $('#mulai').val();
	var sampai = $('#sampai').val();
	$('#kondisi').text(mulai+' s/d '+sampai);
	var table = $('#datatable').DataTable({
	 	"bDestroy": true,
	 	"stateSave": true,
	 });
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Mencari...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		dataType: 'json',
		data:{mulaiP: mulai,
			  sampaiP: sampai},
		url:'../action/getDataLaporanHarian.php',
		success: function (result) {  
				// console.log(result);
				table.clear();
				for(var i=0;i<result.length;i++){
					// console.log(result[i]["Tanggal"]["date"]);					
					table.row.add([
					result[i]["no"],
					result[i]["tanggal"],
					result[i]["namadari"],
					result[i]["tujuan"],
					result[i]["kategori"],
					result[i]["issue"],
					result[i]["solusi"],
					result[i]["tanggalkonfirmasi"],
					result[i]["namaditangani"],
					result[i]["acceptwork"],
					result[i]["tanggalselesai"],
					result[i]["lamapengerjaan"]+' Menit'
					]);
				}
				table.draw(true);
	            dialog.modal('hide'); 			
		},error: function(xhr, ajaxOptions, thrownError){
	        alert(xhr.status);
	    }
	});
}

//lapallPATA
function fa_getDataevaluasi() {
	var tanggal = $('#tanggal').val();
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Menampilkan Data...</p>'
	});
	$.ajax ({
		method: "POST",
	  	url: "../action/act_getDataEvaluasi.php",
	  	data: { tgl: tanggal }
	})
  	.done(function( response ) {
  		dialog.modal('hide'); 		
    	$("p.data").html(response);
  	});
}

function getNamelampiranPJ(nmfile){
	var a = $('#addlampiran')[0].files[0];
	var namafile = a.name;
	var ext = namafile.split('.').pop();
	nmfile = nmfile+'.'+ext;
	return nmfile;
}
function addlampiranPJ(){	
	var formData = new FormData();
	var no = $('#noIssue').val();
	formData.append('file', $('#addlampiran')[0].files[0]);
	var typefile = $('#addlampiran')[0].files[0].type;
	if(typefile.substring(0,5)!='image'){
		alert('Hanya bisa upload file gambar!');
		return;
	}
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i>  Upload Gambar...</p>'
	});
	var table = $('#datatable').DataTable({
		 	"bAutoWidth": false,
		 	"bDestroy": true,
		 	"search": false,
			"perPageSelect": false,
			"perPageSelect": false,
			"bPaginate": false,
			"bInfo": false,
			"ordering": false,
			"bFilter": false,
			"paging":   false,
			"stateSave": true,
		 });
	$.ajax({
	  url: '../action/SetSession.php',
	  type: 'post',
	  data:{noP: no},
	  success: function(result){
	  	var namafile_dbase = getNamelampiranPJ(result);
   		var prv = '<a href="../uploadLampiranPJ/'+namafile_dbase+'" target="_blank">Preview</a>';
   		var dl = '<a href="../uploadLampiranPJ/'+namafile_dbase+'" download>Download</a>';
   	 	table.row.add([
   	 		namafile_dbase,
   	 		prv,
   	 		dl
   	 	]);
   	 	table.draw(true);
   	 	dialog.modal('hide'); 
  //  	 	
	  	$.ajax({
	       url : '../action/UploadLampiranPJ.php',
	       type: 'POST',
	       data: formData,
	       async: false,
	       cache: false,
	       contentType: false,
	       enctype: 'multipart/form-data',
	       processData: false,
	       success: function (response) {	
	       		$('#addlampiran').val('');
	         	dialog.modal('hide'); 		
	       }
		});
	  }
	 });
}
function kliktambahlampiran(){
	$("#addlampiran").trigger('click');
}

function prevhd_jumlahissue(nik,nama,judul,halaman){
	dialogprev = bootbox.dialog({
        message: "<div id='isi' class='row'></div>",
        size: "small",
        className: "dialogku",
        buttons: {
		            confirm: {
		                label: 'Yes',
		                className: 'no-close',
		                display: 'none'
		            },
		            cancel: {
		                label: 'Tutup',
		                className: 'btn-danger'
		            },            
		        }
    });
	$.ajax({
	       url : halaman+'.php',
	       type: 'POST',
	       async: false,
	       data:{nikP: nik,
	       	namaP: nama,
	       	judulP: judul},
	       success: function (result) {	
	       		// var btn = '<div class="form-group"><div class="col-md-2 col-md-offset-3"><input type="button" class="btn btn-danger" value="Tutup" onclick="tutuppreviewhd('+dialog+');"/></div></div>';
	       		dialogprev.html(result);
	       		// dialog.find('.bootbox-body').html(result);
	       }
		});
}
function prevhd_jumlahissuepusat(nik,nama,judul,halaman,divisi){
	dialogprev = bootbox.dialog({
        message: "<div id='isi' class='row'></div>",
        size: "small",
        className: "dialogku",
        buttons: {
		            confirm: {
		                label: 'Yes',
		                className: 'no-close',
		                display: 'none'
		            },
		            cancel: {
		                label: 'Tutup',
		                className: 'btn-danger'
		            },            
		        }
    });
	$.ajax({
	       url : halaman+'.php',
	       type: 'POST',
	       async: false,
	       data:{nikP: nik,
	       	namaP: nama,
	       	judulP: judul,
	        divisiP: divisi},
	       success: function (result) {	
	       		// var btn = '<div class="form-group"><div class="col-md-2 col-md-offset-3"><input type="button" class="btn btn-danger" value="Tutup" onclick="tutuppreviewhd('+dialog+');"/></div></div>';
	       		dialogprev.html(result);
	       		// dialog.find('.bootbox-body').html(result);
	       }
		});
}
function tutuppreviewhd(){
	// dialog.find('.bootbox-body').html('Login berhasil....');
	// alert(dialogprev);
	dialogprev.modal('hide'); 		
}
function showdetailhd(nohd,judul,halaman){
	$('#btnback').show();
	localStorage.halawal = $('#bdpreview').html();
	$.ajax({
	       url : halaman+'.php',
	       type: 'POST',
	       async: false,
	       data:{nohdP: nohd,
	       		judulP: judul},
	       success: function (result) {	
	       		// var btn = '<div class="form-group"><div class="col-md-2 col-md-offset-3"><input type="button" class="btn btn-danger" value="Tutup" onclick="tutuppreviewhd('+dialog+');"/></div></div>';
	       		$('#bdpreview').html(result);
	       		// dialog.find('.bootbox-body').html(result);
	       }
		});
}
function kembalipreviewhd(){
	$('#btnback').hide();
	$('#bdpreview').html(localStorage.halawal);
}
function showdetailhdberanda(nohd,judul,halaman){
	// $('#btnback').show();
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i> Memuat...</p>'
	});
	localStorage.halawal = $('#main-section').html();
	$.ajax({
	       url : halaman+'.php',
	       type: 'POST',
	       async: false,
	       data:{nohdP: nohd,
	       		judulP: judul},
	       success: function (result) {	
	       		// var btn = '<div class="form-group"><div class="col-md-2 col-md-offset-3"><input type="button" class="btn btn-danger" value="Tutup" onclick="tutuppreviewhd('+dialog+');"/></div></div>';
	       		$('#main-section').html(result);
	       		// dialog.find('.bootbox-body').html(result);
	       		dialog.modal('hide');
	       }
		});
}
function kembalipreviewhdberanda(){	
	// $('#btnback').hide();
	location.reload(true);
	// var btn = localStorage.tombolterpilih*1;	
	// $('#main-section').html(localStorage.halawal);	
	// setDetailBeranda(btn);	
	// $.ajax({
	// 	async:false,
	// 	type: "POST",
	// 	dataType: 'json',
	// 	data:{yearlyProgress: 'yearlyProgress'},
	// 	url:'../action/Home.php',
	// 	success: function (result) {	
	// 		localStorage.resultgraph = result;
	// 		var ctx = document.getElementById("lineChart"); 
	// 		var lineChart = new Chart(ctx, {
	// 			type: 'line',
	// 			data: {
	// 			  labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
	// 			  datasets: [{
	// 				label: "My First dataset",
	// 				backgroundColor: "rgba(38, 185, 154, 0.31)",
	// 				borderColor: "rgba(38, 185, 154, 0.7)",
	// 				pointBorderColor: "rgba(38, 185, 154, 0.7)",
	// 				pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
	// 				pointHoverBackgroundColor: "#fff",
	// 				pointHoverBorderColor: "rgba(220,220,220,1)",
	// 				pointBorderWidth: 1,
	// 				data: [result[0]['juml'],result[1]['juml'],result[2]['juml'],result[3]['juml'],result[4]['juml'],result[5]['juml'],result[6]['juml'],result[7]['juml'],result[8]['juml'],result[9]['juml'],result[10]['juml'],result[11]['juml']]
	// 			  }]
	// 			},
	// 		  });			
	// 	},error: function(xhr, ajaxOptions, thrownError){
 //            alert(xhr.status);
 //        }
	// });
}
function gantifilter(){
	var jenis = $('#jenisfilter').val();
	if(jenis=="bulanan"){
		$('#bulanan').show();
		$('#harian').hide();
	}else{
		$('#bulanan').hide();
		$('#harian').show();
	}
	filterreport('../action/FilterKomplainBeranda');
}
function popupdetail(halaman,nama,nik){
	var jenisfilter = $('#jenisfilter').val();
	var tanggalmulai = $('#tanggalmulai').val();
	var tanggalsampai = $('#tanggalsampai').val();
	var bulanfilter = $('#bulanfilter').val();
	var tahunfilter = $('#tahunfilter').val();
	var namabulan = $('#bulanfilter :selected').text();
	var dialog = bootbox.dialog({
		size: 'large',
		onEscape: true,
		message: '<div id="isidialog"><p><i class="fa fa-spin fa-spinner"></i>  Memuat...</p></div>'
	});	
	setTimeout(function(){
		$.ajax({
			async:false,
			type: "POST",
			//dataType: 'json',
			data:{	nama: nama,
					nik: nik,
					jenisfilter: jenisfilter,
					tanggalmulai: tanggalmulai,
					tanggalsampai: tanggalsampai,
					bulanfilter: bulanfilter,
					tahunfilter: tahunfilter,
					namabulan: namabulan
				  },
			// 	judulPageEdit:judul},		
			url: halaman+'.php',
			success: function (result) {	
				$('#isidialog').html(result);
			},error: function(xhr, ajaxOptions, thrownError){
		        alert(xhr.status);
		    }
		});
	},1000);
}
function filterreport(halaman){
	var jenisfilter = $('#jenisfilter').val();
	var tanggalmulai = $('#tanggalmulai').val();
	var tanggalsampai = $('#tanggalsampai').val();
	var bulanfilter = $('#bulanfilter').val();
	var tahunfilter = $('#tahunfilter').val();
	var namabulan = $('#bulanfilter :selected').text();
	var table = $('#datatablekomplainditangani').DataTable({
	 	"bAutoWidth": false,
	 	"bDestroy": true,
	 	"search": false,
		"perPageSelect": false,
		"bPaginate": false,
		"bInfo": false,
	 });
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i> Memuat...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		dataType: 'json',
		data:{	jenisfilter: jenisfilter,
				tanggalmulai: tanggalmulai,
				tanggalsampai: tanggalsampai,
				bulanfilter: bulanfilter,
				tahunfilter: tahunfilter
			  },
		// 	judulPageEdit:judul},		
		url: halaman+'.php',
		success: function (result) {	
			table.clear();
			for(var i=0;i<result.length;i++){
				var hal = "'Beranda/popuplisthd'";
				var nm = "'"+result[i]["Nama"]+"'";
				var nik = "'"+result[i]["nik"]+"'";
				var lnkjum = '<span style="cursor: pointer; color: #0fb8a9" onclick="popupdetail('+hal+','+nm+','+nik+');">'+result[i]['jum']+'</span>';
				var lnkwaktu = '<span style="cursor: pointer; color: #0fb8a9" onclick="popupdetail('+hal+','+nm+','+nik+');">'+result[i]['waktu']+'</span>';
				table.row.add([
					result[i]['Nama'],
					lnkjum,
					lnkwaktu
				]);
			}
			table.draw(true);
			dialog.modal('hide');
		},error: function(xhr, ajaxOptions, thrownError){
	        alert(xhr.status);
	    }
	});
}
function simpanrating(baris,no){
	var rating = $('#tmprating'+baris).val();
	var dialog = bootbox.dialog({
	  message: '<p><i class="fa fa-spin fa-spinner"></i> Menyimpan...</p>'
	});
	$.ajax({
		async:false,
		type: "POST",
		data:{	
				ValNomor: no,
				ValRating: rating,
				ValCatatan: '' 
			  },
		// 	judulPageEdit:judul},		
		url: '../action/Ratinghd.php',
		success: function (result) {	
			// alert(result);
			dialog.modal('hide');
		},error: function(xhr, ajaxOptions, thrownError){
	        alert(xhr.status);
	    }
	});
}
function ubahbintang(baris,nilai,a){
	nilai = nilai + 1;	
	$('#tmprating'+baris).val(nilai);	
	for(var i=0;i<5;i++){
		$('.bintang'+baris+'_'+i).removeClass('checkedrating');		
	}

	for(var i=0;i<nilai;i++){
		$('.bintang'+baris+'_'+i).addClass('checkedrating');
	}
}
function setkerjakan(baris,nohelpdesk){
	var estwaktu = $('#estimasiPATA'+baris).val();
	var tujuan = $('#kehendak'+baris).val();
	var jenislaporan = $('#jenisLaporan'+baris).val();
	var program = $('#programYangDimaksud'+baris).val();
	if(tmpwaktu.idwaktu=='estimasiPATA'+baris){
		if(tmpwaktu.value!=''){
			estwaktu = tmpwaktu.value;
		}
		if(tmpwaktu.jenislap!=''){
			jenislaporan = tmpwaktu.jenislap;
		}	
		if(tmpwaktu.program!=''){
			program = tmpwaktu.program;
		}							
	}else{
		estwaktu = $('#estimasiPATA'+baris).val();
		jenislaporan = $('#jenisLaporan'+baris).val();
		program = $('#programYangDimaksud'+baris).val();
	}	
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Mohon tunggu...</p>'
	});

	$.ajax({
		async:false,
		type: "POST",
		data:{nohelpdeskAccWork: nohelpdesk,
			estwaktu: estwaktu,
			tujuan: tujuan,
			jenislaporan: jenislaporan,
			program: program
		},
		url:'../action/SetKerjakan.php',
		success: function (resultDalam) {
			setTimeout(function(){
			    dialog.modal('hide');
			    location.reload(true);
			}, 1000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}

function simpantemp(self,baris){
	tmpwaktu.idwaktu = 'estimasiPATA'+baris;
	tmpwaktu.value = $(self).val();			
}
function simpantmpjenislap(self,baris){
	tmpwaktu.idwaktu = 'estimasiPATA'+baris;
	tmpwaktu.jenislap = $(self).val();			
}
function simpantmpprogram(self,baris){
	tmpwaktu.idwaktu = 'estimasiPATA'+baris;
	tmpwaktu.program = $(self).val();		
}
function setselesai(no){
	var dialog = bootbox.dialog({
	  	message: '<p><i class="fa fa-spin fa-spinner"></i>  Mohon tunggu...</p>'
	});

	$.ajax({
		async:false,
		type: "POST",
		data:{nohelpdeskAccWork: no
		},
		url:'../action/SetSelesaiHD.php',
		success: function (resultDalam) {
			setTimeout(function(){
			    dialog.modal('hide');
			    location.reload(true);
			}, 1000);
		},error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
        }
	});
}
function number_format(number, decimals, dec_point, thousands_sep) {
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
    dec = typeof dec_point === "undefined" ? "." : dec_point,
    toFixedFix = function (n, prec) {
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      var k = Math.pow(10, prec);
      return Math.round(n * k) / k;
    },
    s = (prec ? toFixedFix(n, prec) : Math.round(n)).toString().split(".");
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || "").length < prec) {
    s[1] = s[1] || "";
    s[1] += new Array(prec - s[1].length + 1).join("0");
  }
  return s.join(dec);
}