<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
	#map
	{
		width:100%;
		height:62vh
	}
	.icon {
		max-width: 70%;
		max-height: 70%;
		margin: 4px;
	}
	.leaflet-control-layers {
		display: block;
		position: relative;
	}
	.leaflet-control-locate a {
	font-size: 2em;
	}
	.grid-print-container {
	  grid-template: auto 1fr auto / 1fr;
	  background-color: white;
	}
	.grid-map-print {
	  grid-row: 2;
	}

	.grid-print-container > .title,
	.grid-print-container > .sub-content {
	  color: black;
	}
	.title {
	  grid-row: 1;
	  justify-self: center;
	  text-align: center;
	  color: grey;
	  box-sizing: border-box;
	  margin-top: 0;
	}
	.sub-content {
	  grid-row: 5;
	  padding-left: 10px;
	  text-align: center;
	  color: grey;
	  box-sizing: border-box;
	}
	[leaflet-browser-print-pages] {
	  display: none;
	}
	.pages-print-container [leaflet-browser-print-pages] {
	  display: block;
	}
</style>
<!-- Menampilkan OpenStreetMap -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>Peta Wilayah <?= $nama_wilayah ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<?php foreach ($breadcrumb as $tautan): ?>
				<li><a href="<?= $tautan['link'] ?>"> <?= $tautan['judul'] ?></a></li>
			<?php endforeach; ?>
			<li class="active">Peta Wilayah <?= $wilayah ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<form action="<?= $form_action?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
						<div class="box-body">
							<div class="row">
								<div class="col-sm-12">
									<div id="map">
										<input type="hidden" id="path" name="path" value="<?= $wil_ini['path']?>">
										<input type="hidden" name="id" id="id"  value="<?= $wil_ini['id']?>"/>
										<input type="hidden" name="zoom" id="zoom"  value="<?= $wil_ini['zoom']?>"/>
										<table class="title" leaflet-browser-print-content width="100%" style="border: solid 1px grey; text-align: center;">
											<tr>
												<td align="center"></td>
											</tr>
											<tr>
												<?php if ($wilayah == $nama_wilayah): ?>
													<td align="center"><img src="<?= gambar_desa($wil_atas['logo']);?>" alt="logo"  class="logo_mandiri"></td>
												<?php else: ?>
													<td align="center"><img src="<?= gambar_desa($logo['logo']);?>" alt="logo"  class="logo_mandiri"></td>
												<?php endif; ?>
											</tr>
											<tr>
												<td>
													<?php if ($wilayah == $nama_wilayah): ?>
														<h5 class="title text-center">PEMERINTAH <?= strtoupper($this->setting->sebutan_kabupaten)?></h5>
														<h5 class="title text-center"><?= strtoupper($wil_atas['nama_kabupaten'])?></h5>
														<h5 class="title text-center"><?= strtoupper($this->setting->sebutan_kecamatan)?></h5>
														<h5 class="title text-center"><?= strtoupper($wil_atas['nama_kecamatan'])?></h5>
														<h5 class="title text-center"><?= strtoupper($this->setting->sebutan_desa)?></h5>
														<h5 class="title text-center"><?= strtoupper($wil_atas['nama_desa'])?></h5>
													<?php else: ?>
														<h5 class="title text-center">PEMERINTAH <?= strtoupper($this->setting->sebutan_kabupaten)?></h5>
														<h5 class="title text-center"><?= strtoupper($desa['nama_kabupaten'])?></h5>
														<h5 class="title text-center"><?= strtoupper($this->setting->sebutan_kecamatan)?></h5>
														<h5 class="title text-center"><?= strtoupper($desa['nama_kecamatan'])?></h5>
														<h5 class="title text-center"><?= strtoupper($this->setting->sebutan_desa)?></h5>
														<h5 class="title text-center"><?= strtoupper($desa['nama_desa'])?></h5>
													<?php endif; ?>
												</td>
											</tr>
											<tr>
												<td align="center"></td>
											</tr>
											<tr>
												<td>
													<?php if ($wilayah == $nama_wilayah): ?>
														<h3 class="title text-center">PETA WILAYAH</h3>
														<h3 class="title text-center"><?= strtoupper($this->setting->sebutan_desa)?></h3>
														<h3 class="title text-center"><?= strtoupper($wil_atas['nama_desa'])?></h3>
													<?php elseif ($wilayah == ucwords($this->setting->sebutan_dusun)): ?>
														<h3 class="title text-center">PETA WILAYAH</h3>
														<h3 class="title text-center"><?= strtoupper($this->setting->sebutan_dusun)?></h3>
														<h3 class="title text-center"><?= strtoupper($wil_ini['dusun'])?></h3>
													<?php elseif ($wilayah == "RW"): ?>
														<h3 class="title text-center">PETA WILAYAH</h3>
														<h3 class="title text-center">RW <?= $wil_ini['rw']?></h3>
														<h3 class="title text-center"><?= strtoupper($this->setting->sebutan_dusun)?> <?= strtoupper($wil_ini['dusun'])?></h3>
													<?php else: ?>
														<h3 class="title text-center">PETA WILAYAH</h3>
														<h3 class="title text-center">RT <?= $wil_ini['rt']?> RW <?= $wil_ini['rw']?> </h3>
														<h3 class="title text-center"><?= strtoupper($this->setting->sebutan_dusun)?> <?= strtoupper($wil_ini['dusun'])?></h3>
													<?php endif; ?>
												</td>
											</tr>
											<tr>
												<td align="center"></td>
											</tr>
											<tr>
												<td align="center"><img src="<?= base_url()?>assets/images/kompas.png" alt="SIDeGa"></td>
											</tr>
										</table>
								</div>
							</div>
						</div>
						<div class='box-footer'>
							<div class='col-xs-12'>
                                <label class="control-label col-sm-1">Warna</label>
								<div class="col-sm-2">
									<div class="input-group my-colorpicker2">
										<input type="text" id="warna" name="warna" class="form-control input-sm required" placeholder="#FFFFFF" value="<?= $wil_ini['warna']?>">
										<div class="input-group-addon input-sm">
											<i></i>
										</div>
									</div>
								</div>

								<a href="<?= $tautan['link'] ?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali"><i class="fa fa-arrow-circle-o-left"></i> Kembali</a>
								<a href="#" class="btn btn-social btn-box btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" download="SIDeGa.gpx" id="exportGPX"><i class='fa fa-download'></i> Export ke GPX</a>
								<button type='reset' class='btn btn-social btn-box btn-danger btn-sm' id="resetme"><i class='fa fa-times'></i> Reset</button>
								<button type='submit' class='btn btn-social btn-box btn-info btn-sm pull-right'><i class='fa fa-check'></i> Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
	var infoWindow;
	window.onload = function()
	{
		//Jika posisi kantor dusun belum ada, maka posisi peta akan menampilkan peta desa
		<?php if (!empty($wil_ini['lat']) && !empty($wil_ini['lng'])): ?>
			var posisi = [<?=$wil_ini['lat'].",".$wil_ini['lng']?>];
			var zoom = <?=$wil_ini['zoom']?>;
		<?php else: ?>
			var posisi = [<?=$wil_atas['lat'].",".$wil_atas['lng']?>];
			var zoom = <?=$wil_atas['zoom']?>;
		<?php endif; ?>

		//Inisialisasi tampilan peta
		var peta_wilayah = L.map('map').setView(posisi, zoom);

		//1. Menampilkan overlayLayers Peta Semua Wilayah
		var marker_desa = [];
		var marker_dusun = [];
		var marker_rw = [];
		var marker_rt = [];

		//OVERLAY WILAYAH DESA
		<?php if (!empty($desa['path'])): ?>
			set_marker_desa(marker_desa, <?=json_encode($desa)?>, "<?=ucwords($this->setting->sebutan_desa).' '.$desa['nama_desa']?>", "<?= favico_desa()?>");
		<?php endif; ?>

		//OVERLAY WILAYAH DUSUN
		<?php if (!empty($dusun_gis)): ?>
			set_marker(marker_dusun, '<?=addslashes(json_encode($dusun_gis))?>', '#FFFF00', '<?=ucwords($this->setting->sebutan_dusun)?>', 'dusun');
		<?php endif; ?>

		//OVERLAY WILAYAH RW
		<?php if (!empty($rw_gis)): ?>
			set_marker(marker_rw, '<?=addslashes(json_encode($rw_gis))?>', '#8888dd', 'RW', 'rw');
		<?php endif; ?>

		//OVERLAY WILAYAH RT
		<?php if (!empty($rt_gis)): ?>
			set_marker(marker_rt, '<?=addslashes(json_encode($rt_gis))?>', '#008000', 'RT', 'rt');
		<?php endif; ?>

		//Menampilkan overlayLayers Peta Semua Wilayah
		<?php if (!empty($wil_atas['path'])): ?>
	    var overlayLayers = overlayWil(marker_desa, marker_dusun, marker_rw, marker_rt, "<?=ucwords($this->setting->sebutan_desa)?>", "<?=ucwords($this->setting->sebutan_dusun)?>");
		<?php else: ?>
			var overlayLayers = {};
		<?php endif; ?>

		//Menampilkan BaseLayers Peta
		var baseLayers = getBaseLayers(peta_wilayah, '<?=$this->setting->google_key?>');

		//Menampilkan Peta wilayah yg sudah ada
		<?php if (!empty($wil_ini['path'])): ?>
			var wilayah = <?=$wil_ini['path']?>;
			showCurrentPolygon(wilayah, peta_wilayah);
		<?php endif; ?>

		//Menambahkan zoom scale ke peta
		L.control.scale().addTo(peta_wilayah);

		//Menambahkan toolbar ke peta
		peta_wilayah.pm.addControls(editToolbarPoly());

		//Menambahkan Peta wilayah
		addPetaPoly(peta_wilayah);

		// update value zoom ketika ganti zoom
		updateZoom(peta_wilayah);

		//Export/Import Peta dari file GPX
		L.Control.FileLayerLoad.LABEL = '<img class="icon" src="<?= base_url()?>assets/images/gpx.png" alt="file icon"/>';
		L.Control.FileLayerLoad.TITLE = 'Impor GPX/KML';
		control = eximGpxPoly(peta_wilayah);

		//Import Peta dari file SHP
		eximShp(peta_wilayah);

		//Geolocation IP Route/GPS
		geoLocation(peta_wilayah);

		//Menghapus Peta wilayah
		hapusPeta(peta_wilayah);

		//Menampilkan baseLayers dan overlayLayers
		L.control.layers(baseLayers, overlayLayers, {position: 'topleft', collapsed: true}).addTo(peta_wilayah);

		//Menambahkan tombol cetak peta ke PNG
    L.control.browserPrint({
      documentTitle: "Peta_Wilayah",
      printModes: [
        L.control.browserPrint.mode.auto("Auto"),
				L.control.browserPrint.mode.landscape("Landscape"),
				L.control.browserPrint.mode.portrait("Portrait")
      ],
    }).addTo(peta_wilayah);

    L.Control.BrowserPrint.Utils.registerLayer(L.MarkerClusterGroup, 'L.MarkerClusterGroup', function (layer, utils) {
			return layer;
		});

		L.Control.BrowserPrint.Utils.registerLayer(L.MapboxGL, 'L.MapboxGL', function(layer, utils) {
				return L.mapboxGL(layer.options);
			}
		);

		peta_wilayah.on("browser-print-start", function(e){
        L.control.scale({
            position: 'bottomleft',
        }).addTo(e.printMap);
    });

    window.print = function () {
			return domtoimage
					.toPng(document.querySelector(".grid-print-container"))
					.then(function (dataUrl) {
						var link = document.createElement('a');
						link.download = peta_wilayah.printControl.options.documentTitle || "exportedMap" + '.png';
						link.href = dataUrl;
						link.click();
					});
		};
		//EOF Menambahkan tombol cetak peta ke PNG

	}; //EOF window.onload
</script>
<script src="<?= base_url()?>assets/js/leaflet.filelayer.js"></script>
<script src="<?= base_url()?>assets/js/togeojson.js"></script>