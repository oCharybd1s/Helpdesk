<?php
	@include('../../action/GetData.php');
  // echo date_format(date_create($datapinjam[0]["tanggal2"]),"Y-m-d");
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Modal Animations</title>
  

    <!-- <script src="./resources/Popup/js/prefixfree.min.js"></script> -->

</head>

<body>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form Peminjaman Hardware</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="form-horizontal form-label-left" novalidate>
				<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="noIssue">No Peminjaman</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" id="nopinjam" name="nopinjam" type="text" value="<?php echo $nomerpinjam; ?>" disabled>
				</div>
			</div>
        	<div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Tanggal Pinjam</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <input id="tanggal" type="date" class="form-control" placeholder="Default Input" value="<?php echo date_format(date_create($datapinjam[0]["tanggal2"]),"Y-m-d"); ?>">
	            </div>
          	</div>
          	<div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggalkembali">Tanggal Perkiraan Pengembalian</label>
	            <div class="col-md-3 col-sm-3 col-xs-12">
                <input id="duedate" type="date" class="form-control" placeholder="Default Input" value="<?php echo date_format(date_create($datapinjam[0]["duedate2"]),"Y-m-d"); ?>">
              </div> 
          	</div>
	        <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deskripsi">Catatan</label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	              <textarea id="catatan" name="deskripsi" class="form-control col-md-7 col-xs-12"><?php echo $datapinjam[0]["catatan"]; ?></textarea>
	            </div>	        
      </div>
    </div>
    <div class="x_content">
          <table id="detailtable" class="table table-striped table-bordered dt-responsive nowrap jambo_table" >
            <thead>
                <tr>
                  <th>Select</th>
                  <th>PRODUCT ID</th>
                  <th>DESCRIPTION</th>
                  <th>QTY</th>
                </tr>
            </thead>
            <tbody>
              <?php for($i=0;$i<count($datapinjamdetail);$i++){ ?>
              <tr>
                <td class="col-sm-1" align="left">
                      <input type="checkbox" class="form-control case" />
                </td>
                <td class="col-sm-2" align="center">
                  <input type="text" name="prodno<?php echo $i; ?>" id="prodno<?php echo $i; ?>" class="form-control" style="width: 100%;" onchange="cariprodukpinjam(event,this.id,<?php echo $i; ?>);" value="<?php echo $datapinjamdetail[$i]["idbarang"]; ?>"/>
                </td>
                <td class="col-sm-2">
                  <input type="text" name="descript<?php echo $i; ?>" id="descript<?php echo $i; ?>" class="form-control" style="width: 100%;" value="<?php echo $datapinjamdetail[$i]["namabarang"]; ?>"/>
                </td>
                <td class="col-sm-1">
                  <input type="text" name="qty<?php echo $i; ?>" id="qty<?php echo $i; ?>" class="form-control" style="width: 100%;" value="<?php echo $datapinjamdetail[$i]["qty"]; ?>" onkeyup="checkstock(<?php echo $i; ?>)"/>
                  <input type="hidden" name="qtyhd<?php echo $i; ?>" id="qtyhd<?php echo $i; ?>" class="form-control" style="width: 100%;" value="<?php echo $datapinjamdetail[$i]["available"]; ?>" />
                </td>
              </tr>
              <?php } ?>
            </tbody>
            <!-- <tfoot> -->
              <tr>
                <td colspan="12" style="text-align: left;">
                <button type="button" class='btn btn-round btn-warning delete' >- Delete</button>
                <button type="button" class='btn btn-round btn-info addmore' id='addmorebutton'>+ Add More</button>
                </td>
              </tr>
            <!-- </tfoot> -->
          </table>
        </div>   
  </div>
  <div class="x_content">
            <form class="form-horizontal form-label-left input_mask">
                <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-primary" onclick="backToAllHdList()">Batal</button>
                    <?php if($_SESSION["divisi"]=="IT"){ ?>
                      <?php if(str_replace(" ","",$datapinjam[0]["idpemberipinjaman"])==""){ ?>
                        <button type="button" class="btn btn-success" onclick="serahkanbarang('../action/serahkanbarang')">Serahkan Barang</button>
                      <?php } ?>
                      <?php if(str_replace(" ","",$datapinjam[0]["idpenerima"])=="" && str_replace(" ","",$datapinjam[0]["idpemberipinjaman"])!=""){ ?>
                        <button type="button" class="btn btn-success" onclick="terimabarang('../action/terimabarang')">Terima Barang</button>
                      <?php } ?>
                      <?php if($_SESSION['siapa']==str_replace(" ","",$datapinjam[0]["idpeminjam"]) && str_replace(" ","",$datapinjam[0]["idpemberipinjaman"])==""){ ?>
                         <button type="button" class="btn btn-success" onclick="submitpinjam('../action/newPinjam','edit')">Simpan</button>
                      <?php } ?>
                    <?php }else{ ?>
                          <button type="button" class="btn btn-success" onclick="submitpinjam('../action/newPinjam','edit')">Simpan</button>
                    <?php } ?>
                  </div>
                </div>
            </form>
        </div>
</div>
<div id="modal-container2">
  <div class="modal-background">
    <div class="modal">
      <div class="x_content">       
        <div class='col-md-12 col-sm-12 col-xs-12' id="contentTable">
          <table id="listproduct" class="table table-striped table-bordered dt-responsive nowrap jambo_table">
            <thead>
              <tr>
                <th class='col-md-1 col-sm-12 col-xs-12'>ID BARANG</th>
                <th class='col-md-1 col-sm-12 col-xs-12'>DESKRIPSI</th>
                <th class='col-md-1 col-sm-12 col-xs-12'>TERSEDIA</th>           
              </tr>
            </thead>
            <tbody>
              <?php
                for($i=0; $i<0; $i++){
              ?>
                <tr id="pilihprod">
                  <td>&nbsp;</td> <!---No--->
                  <td>&nbsp;</td> <!---No--->
                  <td>&nbsp;</td> <!---No--->
                </tr>
              <?php
                }
              ?>
            </tbody>
          </table>                
        </div>    
        <div class="col-md-12 col-sm-12 col-xs-12">
          <button type="button" class="btn btn-primary" id="batal" barisnya="" onclick="HapusDetailBarang();tutupPopupAksesDoc2();">Batal</button>
        </div>
      </div>     
    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">
  $(".delete").on('click', function() {
          $('.case:checkbox:checked').parents("tr").remove();
            $('.check_all').prop("checked", false); 
          check();
          });
$(".addmore").on('click',function(){
    //var table = $('#detailtable').DataTable();
    if ($('#koreksi').is(":checked"))
          {   
            alert("Tidak boleh menambah item pada LPB koreksi!.");
          }else
          {
            var counter = $('#detailtable tr').length-2;   
             var data ='<tr><td class="col-sm-1" align="left"><input type="checkbox" class="form-control case" /></td><td class="col-sm-2" align="center"><input type="text" name="prodno'+counter+'" id="prodno'+counter+'" class="form-control" style="width: 100%;" onchange="cariprodukpinjam(event,this.id,'+counter+');"/></td><td class="col-sm-2"><input type="text" name="descript'+counter+'" id="descript'+counter+'" class="form-control" style="width: 100%;"/></td><td class="col-sm-1"><input type="text" name="qty'+counter+'" id="qty'+counter+'" class="form-control" style="width: 100%;" onkeyup="checkstock('+counter+')"/><input type="hidden" name="qtyhd'+counter+'" id="qtyhd'+counter+'" class="form-control" style="width: 100%;" value="0" /></td></tr>';
             //alert(counter);
             $('#detailtable').append(data);
             //counter++;   
           }
     }); 
function check(){
          obj=$('table tr').find('span');
          $.each( obj, function( key, value ) {
          id=value.id;
          $('#'+id).html(key+1);
          });
          }
	// document.getElementById('tanggal').valueAsDate = new Date();
	document.getElementById('duedate').valueAsDate = new Date();
</script>