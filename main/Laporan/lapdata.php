<?php
	@include('../../action/GetData.php');
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 id="title">Laporan Semua Helpdesk</h2>
        <div class="clearfix"></div>
      </div>
      	<div class="x_content">
      		<div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Helpdesk Tahun&nbsp;</h2> <h2 style="color:green;display:inline;"><?php echo $currentYear;?></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                	<div class="col-md-12 hidden-small">
                  <h2 class="line_30">Total Helpdesk : <?php echo $getTotalHelpdeskcurrentYear[0]['jumlah'];?></h2>

                  <table class="countries_list">
                    <tbody>
                      <tr>
                        <td>Ditolak</td>
                        <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskDitolakcurrentYear[0]['jumlah'];?></td>
                      </tr>
                      <tr>
                        <td>Belum Dikerjakan</td>
                        <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskBelumDitanganicurrentYear[0]['jumlah'];?></td>
                      </tr>
                      <tr>
                        <td>Sedang Dikerjakan</td>
                        <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskSedangDitanganicurrentYear[0]['jumlah'];?></td>
                      </tr>
                      <tr>
                        <td>Selesai</td>
                        <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskSelesaicurrentYear[0]['jumlah'];?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-12 hidden-small" style="border-top:1px solid black;">
                  <b><h2 class="line_30">Berdasarkan Program</h2></b>

                  <table class="countries_list">
                    <tbody>
                      <?php
                        for($i=0;$i<count($getDataHelpdeskByAplikasicurrentYear);$i++){
                      ?>
                           <tr <?php if($i % 2== 0){echo 'style="background-color:#d9f9d4;"';}?> >
                              <td><?php echo $getDataHelpdeskByAplikasicurrentYear[$i]['NamaAplikasi'];?></td>
                              <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskByAplikasicurrentYear[$i]['jumlah'];?></td>
                            </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-12 hidden-small" style="border-top:1px solid black;">
                  <h2 class="line_30">Berdasarkan Jenis Laporan</h2>
                  <table class="countries_list">
                    <tbody>
                      <?php
                        for($i=0;$i<count($getDataHelpdeskByJenisLaporancurrentYear);$i++){
                      ?>
                           <tr <?php if($i % 2== 0){echo 'style="background-color:#d9f9d4;"';}?> >
                              <td><?php echo $getDataHelpdeskByJenisLaporancurrentYear[$i]['NamaLaporan'];?></td>
                              <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskByJenisLaporancurrentYear[$i]['jumlah'];?></td>
                            </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- --------------------------- -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Helpdesk Tahun&nbsp;</h2> <h2 style="color:green;display:inline;"><?php echo $currentYear-1;?></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="col-md-12 hidden-small">
                  <h2 class="line_30">Total Helpdesk : <?php echo $getTotalHelpdesklastYear[0]['jumlah'];?></h2>

                  <table class="countries_list">
                    <tbody>
                      <tr>
                        <td>Ditolak</td>
                        <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskDitolaklastYear[0]['jumlah'];?></td>
                      </tr>
                      <tr>
                        <td>Belum Dikerjakan</td>
                        <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskBelumDitanganilastYear[0]['jumlah'];?></td>
                      </tr>
                      <tr>
                        <td>Sedang Dikerjakan</td>
                        <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskSedangDitanganilastYear[0]['jumlah'];?></td>
                      </tr>
                      <tr>
                        <td>Selesai</td>
                        <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskSelesailastYear[0]['jumlah'];?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-12 hidden-small" style="border-top:1px solid black;">
                  <b><h2 class="line_30">Berdasarkan Program</h2></b>

                  <table class="countries_list">
                    <tbody>
                      <?php
                        for($i=0;$i<count($getDataHelpdeskByAplikasilastYear);$i++){
                      ?>
                           <tr <?php if($i % 2== 0){echo 'style="background-color:#d9f9d4;"';}?> >
                              <td><?php echo $getDataHelpdeskByAplikasilastYear[$i]['NamaAplikasi'];?></td>
                              <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskByAplikasilastYear[$i]['jumlah'];?></td>
                            </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-12 hidden-small" style="border-top:1px solid black;">
                  <h2 class="line_30">Berdasarkan Jenis Laporan</h2>
                  <table class="countries_list">
                    <tbody>
                      <?php
                        for($i=0;$i<count($getDataHelpdeskByJenisLaporanlastYear);$i++){
                      ?>
                           <tr <?php if($i % 2== 0){echo 'style="background-color:#d9f9d4;"';}?> >
                              <td><?php echo $getDataHelpdeskByJenisLaporanlastYear[$i]['NamaLaporan'];?></td>
                              <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskByJenisLaporanlastYear[$i]['jumlah'];?></td>
                            </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- --------------------------- -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Helpdesk Tahun&nbsp;</h2> <h2 style="color:green;display:inline;"><?php echo $currentYear-2;?></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="col-md-12 hidden-small">
                  <h2 class="line_30">Total Helpdesk : <?php echo $getTotalHelpdesklasttwoYear[0]['jumlah'];?></h2>

                  <table class="countries_list">
                    <tbody>
                      <tr>
                        <td>Ditolak</td>
                        <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskDitolaklasttwoYear[0]['jumlah'];?></td>
                      </tr>
                      <tr>
                        <td>Belum Dikerjakan</td>
                        <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskBelumDitanganilasttwoYear[0]['jumlah'];?></td>
                      </tr>
                      <tr>
                        <td>Sedang Dikerjakan</td>
                        <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskSedangDitanganilasttwoYear[0]['jumlah'];?></td>
                      </tr>
                      <tr>
                        <td>Selesai</td>
                        <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskSelesailasttwoYear[0]['jumlah'];?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-12 hidden-small" style="border-top:1px solid black;">
                  <b><h2 class="line_30">Berdasarkan Program</h2></b>

                  <table class="countries_list">
                    <tbody>
                      <?php
                        for($i=0;$i<count($getDataHelpdeskByAplikasilasttwoYear);$i++){
                      ?>
                           <tr <?php if($i % 2== 0){echo 'style="background-color:#d9f9d4;"';}?> >
                              <td><?php echo $getDataHelpdeskByAplikasilasttwoYear[$i]['NamaAplikasi'];?></td>
                              <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskByAplikasilasttwoYear[$i]['jumlah'];?></td>
                            </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-12 hidden-small" style="border-top:1px solid black;">
                  <h2 class="line_30">Berdasarkan Jenis Laporan</h2>
                  <table class="countries_list">
                    <tbody>
                      <?php
                        for($i=0;$i<count($getDataHelpdeskByJenisLaporanlasttwoYear);$i++){
                      ?>
                           <tr <?php if($i % 2== 0){echo 'style="background-color:#d9f9d4;"';}?> >
                              <td><?php echo $getDataHelpdeskByJenisLaporanlasttwoYear[$i]['NamaLaporan'];?></td>
                              <td class="fs15 fw700 text-right"><?php echo $getDataHelpdeskByJenisLaporanlasttwoYear[$i]['jumlah'];?></td>
                            </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
            <?php if($_SESSION['jabatan']==3){?>
  	      	    <div class="col-md-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Input knob</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                          </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="col-md-2">
                        <p>Display value</p>
                        <input class="knob" data-width="100" data-height="120" data-min="-100" data-max="1000" data-displayPrevious=true data-fgColor="#26B99A" value="44">
                      </div>
                      <div class="col-md-2">
                        <p>&#215; 'cursor' mode</p>
                        <input class="knob" data-width="100" data-height="120" data-cursor=true data-fgColor="#34495E" value="29">
                      </div>
                      <div class="col-md-2">
                        <p>Step 0.1</p>
                        <input class="knob" data-width="100" data-height="120" data-min="-10000" data-displayPrevious=true data-fgColor="#26B99A" data-max="10000" data-step=".1" value="0">
                      </div>
                      <div class="col-md-2">
                        <p>Angle arc</p>
                        <input class="knob" data-width="100" data-height="120" data-angleOffset=-125 data-angleArc=250 data-fgColor="#34495E" data-rotation="anticlockwise" value="35">
                      </div>
                      <div class="col-md-2">
                        <p>Alternate design</p>
                        <input class="knob" data-width="110" data-height="120" data-displayPrevious=true data-fgColor="#26B99A" data-skin="tron" data-thickness=".2" value="75">
                      </div>
                      <div class="col-md-2">
                        <p>Angle offset</p>
                        <input class="knob" data-width="100" data-height="120" data-angleOffset=90 data-linecap=round data-fgColor="#26B99A" value="35">
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
     	</div>
    </div>
  </div>
</div>