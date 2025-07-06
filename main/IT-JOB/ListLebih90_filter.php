<?php
  @include('../../action/GetData.php');
  $getListHD90 = FDataListHD90($_SESSION['bulanFilter'],$_SESSION['tahunFilter']);
?>
<table id="datatable" class="table table-striped table-bordered dt-responsive" style="width: 100%">
              <thead>
                <tr>
                   <th>No</th>
                   <th>Tanggal</th>
                   <th>Dari</th>
                   <th>Tujuan</th>
                   <th>Jenis Laporan</th>
                   <th>Program</th>
                   <th>Waktu</th>
                   <th>Konfirm</th>
                   <th>Detail</th>                   
                   <th>Kategori</th>
                   <th>Diinput Oleh</th>
                   <th>Selesai</th>
                </tr>
              </thead>
        <tbody>
          <?php
            for($i=0; $i<count($getListHD90); $i++){
          ?>
                <tr>
                <td id="idhd<?php echo $i;?>"><a onclick="goEdit('<?php echo $i;?>')"><?php echo $getListHD90[$i]['No']?></a></td>
                <td><?php echo date_format($getListHD90[$i]["Tanggal"],"d/m/Y"); ?></td>
                <td><?php echo $getListHD90[$i]['namadari']?></td>
                <td>
                <select id="kehendak<?php echo $i; ?>" name="kehendak<?php echo $i; ?>" class="form-control">
                          <option value="All" <?php if(str_replace(" ","",$getListHD90[$i]['tujuan'])!="Request" && str_replace(" ","",$getListHD90[$i]['tujuan'])!="Komplain"){ ?> Selected <?php } ?>>All</option>
                    <option value="Komplain" <?php if(str_replace(" ","",$getListHD90[$i]['tujuan'])=="Komplain"){ ?> Selected <?php } ?>>Komplain</option>
                    <option value="Request" <?php if(str_replace(" ","",$getListHD90[$i]['tujuan'])=="Request"){ ?> Selected <?php } ?>>Request</option>
                  </select>
                  </td>
                <td>
                  <select id="jenisLaporan<?php echo $i; ?>" name="jenisLaporan<?php echo $i; ?>" class="form-control" onchange="simpantmpjenislap(this,<?php echo $i; ?>);">
                      <?php for($j=0; $j<count($jenisLaporan); $j++){ ?>
                          <option value="<?php echo $jenisLaporan[$j]['Lap']?>" <?php if($jenisLaporan[$j]['NamaLaporan']==$getListHD90[$i]['Jenis2']){?> Selected <?php } ?> ><?php echo $jenisLaporan[$j]['NamaLaporan']; ?></option>
                      <?php } ?>
                   </select>
                </td>
                <td>
                  <select id="programYangDimaksud<?php echo $i; ?>" name="programYangDimaksud<?php echo $i; ?>" class="form-control col-md-7 col-xs-12" onchange="simpantmpprogram(this,<?php echo $i; ?>)">
                            <option value="All">All</option>
                      <?php for($j=0; $j<count($jenisAplikasi); $j++){ ?>
                          <option value="<?php echo $jenisAplikasi[$j]['Apl']?>" <?php if($jenisAplikasi[$j]['Apl']==$getListHD90[$i]['Aplikasi']){?> Selected <?php } ?>><?php echo $jenisAplikasi[$j]['NamaAplikasi']?></option>
                      <?php } ?>
                    </select>
                </td>
                <td>
                  <input type="text" class="form-control" id="estimasiPATA<?php echo $i; ?>" onkeyup="simpantemp(this,<?php echo $i; ?>);" name="estimasiPATA<?php echo $i; ?>" value="<?php echo $getListHD90[$i]['EstPATA']; ?>">
                </td>
                <td>
                  <?php if($getListHD90[$i]['Konfirmasi']!=1){ ?>
                  <input id="confirm<?php echo $i;?>" type="button" class="btn btn-success btn-confirm" value="OK" onclick="confirm('<?php echo $i;?>')" />
                  <input id="reject<?php echo $i;?>" type="button" class="btn btn-danger btn-reject btnReject" value="REJECT" onclick="reject('<?php echo $i;?>')" />
                  <?php }else{ ?>
                    <?php if($getListHD90[$i]['accPATA']==1){ ?>
                      Approved
                    <?php }else{ ?>
                      Rejected
                    <?php } ?>
                  <?php } ?>
                </td>
                <td style="word-wrap: break-word"><?php echo $getListHD90[$i]['issue']?></td>               
                <td><?php echo $getListHD90[$i]['kategori']?></td>
                <td><?php echo str_replace("Diinput Oleh: ","",$getListHD90[$i]['StatusNote']); ?></td>
                <td>
                  <?php if($getListHD90[$i]['Konfirmasi']==1 && $getListHD90[$i]['statusdone']!=1 && $getListHD90[$i]['accPATA']!=2){ ?>
                    <?php if($getListHD90[$i]['statusditangani']==1 && str_replace(" ","",$getListHD90[$i]['Ditangani'])==str_replace(" ","",$_SESSION['siapa'])){ ?>
                      <input id="confirm<?php echo $i;?>" type="button" class="btn btn-success btn-confirm" value="Set Selesai" onclick="setselesai('<?php echo $getListHD90[$i]['No']; ?>')" />  
                    <?php }else{ ?>
                      <?php if($getListHD90[$i]['statusditangani']!=1){ ?>
                      <input id="acceptWork<?php echo $i;?>" type="button" class="btn btn-success" value="Kerjakan" onclick="setkerjakan(<?php echo $i; ?>,'<?php echo $getListHD90[$i]['No']?>')" />
                      <?php }else{ ?>
                        <?php echo 'Ditangani '.$getListHD90[$i]['namaditangani']; ?>
                      <?php } ?>
                    <?php } ?>                                  
                  <?php }else{ ?>
                    done - approved
                  <?php } ?>
                </td>
              </tr>
            <?php
              }
            ?>
        </tbody>
          </table>
<script type="text/javascript">
  $('#datatable').dataTable({
                "bDestroy": true,
                'order': [[ 1, 'asc' ]],
                "stateSave": true,
              });
</script>