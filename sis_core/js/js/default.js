function rutanApi(target = "", key = "", data = [], event='') {
  // {
  // 		target:"GetDataKaryawan",
  // 		key:"oN6OH83TbuNLFGB1x59s",
  // 		iddbase:"DB00000023",
  // 		idapi:"API0000121",
  // 		emp_noAPI0000121: ''
  // 	}
  var return_data = "";
  data["target"] = target;
  data["key"] = key;
  $.ajax({
    async: typeof event == 'string'? false : true,
    type: "POST",
    dataType: "json",
    data: data,
    url: _api_rutan,
    success: function (result) {
      if(typeof event == 'string'){
        if (typeof result.status != "undefined" && result.status == "success") {
          return_data = result.result;
        } else {
          return_data = result;
        }
			}else{
				event(result);
			}
    },
  });
  return return_data;
}

function setSession(data_session=[]){
	var return_data = [];
	if( typeof session_login=='undefined' ){
		$.ajax({
			async:false,
			type: "POST",
			dataType: "json",
			url:`${base_url}/post`,
			data:data_session,
			success: function (result) {
				return_data = result;
			}
		});
	}
	return return_data;
}

function sendPost(post_target, data = {}, event='') {
  var return_data = "";
  data["target"] = post_target;
  $.ajax({
    async: typeof event == 'string'? false : true,
    type: "POST",
    dataType: "json",
    url: `${base_url}/post`,
    data: data,
    success: function (result) {
      if(typeof event == 'string'){
        return_data = result;
      }else{
        event(result);
      }
    },
  });
  return return_data;
}

// function terraApi(url='post', module_name, type_submit, data={}){
// 	var return_data = '';
// 	data['target']=module_name;
// 	data['type_submit']=type_submit;
// 	$.ajax({
// 		async:false,
// 		type: "POST",
// 		url:'https://api.terra-id.com/'+url,
// 		data:data,
// 		success: function (result) {
// 			return_data = JSON.parse(result);
// 		}
// 	});
// 	return return_data;
// }

function submitPost(target='', type_submit='', id_form='', data={}, event=''){
	if(id_form==''){
		var form_data = new FormData();
	}else{
		var form_data = new FormData( $('#'+id_form)[0] );
	}
	var return_data = '';
	form_data.append('target', target);
	form_data.append('type_submit', type_submit);
	$.each(data, function(key, val) {
		form_data.append(key, val);
	});
	$.ajax({
		enctype: 'multipart/form-data',
		type: "POST",
		dataType: "json",
		data:form_data, 
		cache: false,
		contentType: false,
		processData: false,
		async: typeof event == 'string'? false : true,
		url:base_url+'post',
		success: function (result) {
			if(typeof event == 'string'){
				return_data = result;
			  }else{
				event(result);
			  }
			// return_data=JSON.parse(result);
			// swal.close();
		},error: function(xhr, ajaxOptions, thrownError){
			swalMessage('error');
		}
	});
	return return_data;
}

function disableBack(){
	window.history.pushState(null, "", window.location.href);  
	window.onpopstate = function() {
		page.backhistory();
		// page.view(page.backhistory().url);
	}; 
}

function swalMessage(option){
  Swal.fire(option);
}

function swalConfirm(title='', message='', type='warning', event){
  Swal.fire({
		  title: title,
		  text: message,
		  type: type,
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes!'
		})
		.then((accept) => {
		  if (accept.value) {		  	
				event();
		  } 
		});
}

function swalLoading(title=''){
  Swal.fire({
      title: title,
      allowOutsideClick: false,
      allowEscapeKey: false,
      showCancelButton: false,
      showConfirmButton: false,
      onBeforeOpen: () => {Swal.showLoading()}
    });
}

function numberFormat(value=0){
	// if( value==0 || value==null || value==undefined )
	value = parseInt(value);
	if( !value )
		return 0;

	value = value.toString();

	if(value.substr(0, 1)==0)
		value=value.substr(1);

	return value
	.replace(/\D/g, "")
	.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function secondToTime(second, type='time'){
	//type='time/value/hour/decimal'
	var seconds = parseInt(second);
	if( type=='decimal' ){
		return (seconds/3600).toFixed(2);
	}

	var days = Math.floor(seconds / (3600*24));
	seconds  -= days*3600*24;
	var hrs   = Math.floor(seconds / 3600);
	seconds  -= hrs*3600;
	var mnts = Math.floor(seconds / 60);
	seconds  -= mnts*60;

	if( type=='time' ){
		return ((hrs + (days*24))+":"+mnts+":"+seconds);
	}
	if( type=='value' ){
		return ((hrs + (days*24))+" Jam "+mnts+" Menit "+seconds+" Detik");
	}
	if( type=='hour' ){
		return ((hrs + (days*24))+":"+mnts);
	}
	
}

function dateToSecond(date_=""){
	if(date_=='')
		date_ = dateNow();
	date = new Date(date_);
	return date.getTime()/1000;
}

function dateNow(diff_day=0) {
	var date = new Date();
	date.setDate(date.getDate()+diff_day);
	var aaaa = date.getFullYear();
	var gg = date.getDate();
	var mm = (date.getMonth() + 1);

	if (gg < 10)
		gg = "0" + gg;

	if (mm < 10)
		mm = "0" + mm;

	var cur_day = aaaa + "-" + mm + "-" + gg;
	var hours = date.getHours()
	var minutes = date.getMinutes()
	var seconds = date.getSeconds();

	if (hours < 10)
		hours = "0" + hours;

	if (minutes < 10)
		minutes = "0" + minutes;

	if (seconds < 10)
		seconds = "0" + seconds;

	return cur_day + " " + hours + ":" + minutes + ":" + seconds;
}

function getDaysInMonth(month, year) {
	  var date = new Date(year, month, 1);
	  var days = [];
	  while (date.getMonth() === month) {
	    days.push(dateFormat(new Date(date), format='d M'));
	    date.setDate(date.getDate() + 1);
	  }
	  return days;
	}

function dateFormat(date_='', format='d/m/Y h:i') {
	var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Des'];
	
	if(date_==''){
		var date = new Date();
	}else{
		var date = new Date(date_);
	}
	var Y = date.getFullYear();
	var d = date.getDate();
	var m = (date.getMonth() + 1);
	var M = month[m-1];

	if (d < 10)
		d = "0" + d;

	if (m < 10)
		m = "0" + m;


	var cur_day = d + "/" + m + "/" + Y;
	var h = date.getHours()
	var i = date.getMinutes()
	var s = date.getSeconds();

	if (h < 10)
		h = "0" + h;

	if (i < 10)
		i = "0" + i;

	if (s < 10)
		s = "0" + s;

	format = format.replace('Y', Y);
	format = format.replace('m', m);
	format = format.replace('M', M);
	format = format.replace('d', d);
	format = format.replace('h', h);
	format = format.replace('i', i);
	format = format.replace('s', s);
	format = (date_=='' || date_==null || typeof date_=='undefined')? '':format;
	return format;
}