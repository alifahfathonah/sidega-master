<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
    async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxsKE9ArOZcaNtsfXIMFqr4N-UCsmp-Ng&callback=initMap"
    defer
></script>
<script>
  $(document).ready(function()
  {
    $('#simpan_wilayah').click(function()
    {
      var path = $('#path').val();
      $.ajax(
      {
        type: "POST",
        url: "<?=$form_action?>",
        dataType: 'json',
        data: {path},
      })
        .always(function (e) {
          alert('Perubahan yang dilakukan telah berhasil disimpan! Klik Kembali untuk pindah ke halaman sebelumnya!')
        });
    });
  });

  var batasWilayah
  var map
  var gmaps

  var daerah_desa = <?=$wil_ini['path'] ?: 'null' ?>

  daerah_desa && daerah_desa[0].map((arr, i) => {
    daerah_desa[i] = { lat: arr[0], lng: arr[1] }
  })

  function initMap() {
    gmaps = google.maps

    <?php if (!empty($desa['lat']) && !empty($desa['lng'])): ?>
        var center = {
            lat: <?=$desa['lat']?>,
            lng: <?=$desa['lng']?>
        }
    <?php else: ?>
        var center = {
            lat: <?=$wil_atas['lat']?>,
            lng: <?=$wil_atas['lat']?>
        }
    <?php endif; ?>
	
    
    var zoom = 13;
    map = new gmaps.Map($('#map')[0], {
      center,
      zoom,
      streetViewControl: true,
      mapTypeId:google.maps.MapTypeId.HYBRID,
    })
    
    <?php if (!empty($wil_ini['path'])): ?>
      //Style polygon
      batasWilayah = new gmaps.Polygon({
        paths: daerah_desa,
        strokeColor: '#555555',
        strokeOpacity: 0.5,
        strokeWeight: 3,
        fillColor: '#0028ea',
        fillOpacity: 0.15,
        editable: true,
        draggable: false
      });

      batasWilayah.setMap(map)
      batasWilayah.addListener('mouseup', editPath)
      batasWilayah.addListener('dragend', editPath)
    <?php endif; ?>
  }

  function editPath() {
    const PATHS = this.getPath()
    const NEWPATH = []
    
    for (var i = 0; i < PATHS.getLength(); i++) {
      const { lat, lng } = PATHS.getAt(i)
      NEWPATH.push([lat(), lng()])
    }

    $('#path').val(JSON.stringify([NEWPATH]))
  }

  function polygonDelete() {
    batasWilayah.setMap(null)
    batasWilayah = null
    $('#path').val(null);
  }

  function polygonAdd() {
    const { lat, lng } = map.getCenter()

    // Clear existing polygon
    if (batasWilayah) polygonDelete()

    // Re new polygon in new position
    batasWilayah = new gmaps.Polygon({
      paths: [
        { lat: lat() - 0.001,   lng: lng() - 0.002 }, // Left
        { lat: lat() + 0.001, lng: lng() - 0.002 }, // Right
        { lat: lat() + 0.001, lng: lng() },         // Top
      ],
      strokeColor: '#555555',
      strokeOpacity: 0.5,
      strokeWeight: 3,
      fillColor: '#0028ea',
      fillOpacity: 0.15,
      editable: true,
      draggable: false
    });

    batasWilayah.setMap(map)
    batasWilayah.addListener('mouseup', editPath)
    batasWilayah.addListener('dragend', editPath)
  }

  function polygonReset() {
    // Clear existing polygon
    polygonDelete()

    // Create initial / last saved polygon
    batasWilayah = new gmaps.Polygon({
      paths: daerah_desa,
      strokeColor: '#555555',
      strokeOpacity: 0.5,
      strokeWeight: 3,
      fillColor: '#0028ea',
      fillOpacity: 0.15,
      editable: true,
      draggable: false
    });

    batasWilayah.setMap(map)
    batasWilayah.addListener('mouseup', editPath)
    batasWilayah.addListener('dragend', editPath)
  }
</script>
<style>
  #float-btn
  {
    position: absolute;
    top: 10px;
    right: 15%;
    z-index: 5;
    font-family: 'Roboto','sans-serif';
  }
  #float-btn button
  {
    line-height: 20px;
    margin: 1px 0;
    margin-right: -5px;
    padding: 10px 15px;
    background: #ffffff;
    border: none;
    border-radius: 2px;
    font-size: initial;
    box-shadow: 1px 1px 4px 0px silver;
  }
  #float-btn button:hover { background: #ddd }
  #map
  {
    width: 100%;
    height: 450px;
    border: 1px solid #000;
  }
</style>

<div class="content-wrapper">
  <section class="content-header">
		<h1>Peta <?= $wil_ini['nama']?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<?php foreach ($breadcrumb as $tautan): ?>
				<li><a href="<?= $tautan['link'] ?>"> <?= $tautan['judul'] ?></a></li>
			<?php endforeach; ?>			
            <li class="active">Peta <?= $wilayah ?></li>
		</ol>
	</section>
  <section class="content">


    <div class='modal-body'>
      <div class="row">
        <div class="col-sm-12">
          <div id="float-btn">
            <button type="button" onclick="polygonAdd()">Tambah</button>
            <button type="button" onclick="polygonDelete()">Hapus</button>
            <button type="button" onclick="polygonReset()">Reset</button>
          </div>
          <div id="map"></div>
          <input type="hidden" id="path" name="path" value="<?= $wil_ini['path']?>">
        </div>
      </div>
    </div>
    <div class="modal-footer">
    <?php if ($this->CI->cek_hak_akses('h')): ?>
        <a href="<?= site_url('identitas_desa')?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali"><i class="fa fa-arrow-circle-o-left"></i> Kembali</a>  
        <a href="#" class="btn btn-social btn-box btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" download="SIDeGa.gpx" id="exportGPX"><i class='fa fa-download'></i> Export ke GPX</a>    
        <button type="reset" class="btn btn-social btn-box btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
        <button type="submit" class="btn btn-social btn-box btn-info btn-sm" data-dismiss="modal" id="simpan_wilayah"><i class='fa fa-check'></i> Simpan</button>
    <?php endif; ?>
    </div>
	</section>
</div>