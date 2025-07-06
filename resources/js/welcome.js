$(document).ready(function(){
	$.ajax({
		async:false,
		type: "POST",
		data:{logout: "logout"},
		url:'action/Home.php',
		success: function (result) {
			var cookies = document.cookie.split(";");
			for(var i=0; i < cookies.length-1; i++) {
			    var equals = cookies[i].split("=");
			    var name = equals[0].replace(" ", "");
			    document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
			}
			sessionStorage.clear();
		},error: function(xhr, ajaxOptions, thrownError){
            // alert(xhr.status);
        }
	});
	// bootbox.alert("<center><b><h2>Helpdesk BETA (Updated 23 Nov 2018)</h2></b><br><p style='display:inline;'>Apabila terdapat kesalahan tolong hubungi ext</p><p style='color:blue;display:inline;'> 112</p>.<br><br><p>Terima kasih</p></center>");
});