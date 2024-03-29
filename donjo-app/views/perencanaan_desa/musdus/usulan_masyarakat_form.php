<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script>
  function ubah_dusun(dusun) {
    $('#isi_rt').hide();
    var rw = $('#rw');
    select_options(rw, urlencode(dusun));
  }

  function ubah_rw(dusun, rw) {
    $('#isi_rt').show();
    var rt = $('#id_cluster');
    var params = urlencode(dusun) + '/' + urlencode(rw);
    select_options(rt, params);
  }
</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>Form Usulan Masyarakat</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
      <li class="breadcrumb-item"><a href="<?= site_url('desa_musdus') ?>">Perencanaan Desa</a></li>
      <li class="breadcrumb-item"><a href="<?= site_url('desa_musdus/usulan_masyarakat') ?>">Usulan Masyarakat</a></li>
      <li class="breadcrumb-item"><a href="#!">Form</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" id="maincontent">
    <div class="row">
      <div class="col-md-3">
        <?php $this->load->view('perencanaan_desa/menu'); ?>
      </div>
      <div class="col-md-9">
        <div class="box">
          <form id="validasi" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <div class="row">
              <div class="col-md-12">
                <div class="box-header">
                  <a href="<?= site_url('perencanaan_desa') ?>" class="btn btn-sm btn-info"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;" for="tahun">Tahun Anggaran</label>
                        <div class="col-sm-3">
                          <select class="form-control select2" id="tahun" name="tahun" style="width:100%;">
                            <option value="">Pilih Tahun</option>
                            <?php for ($i = date('Y') + 5; $i >= date('Y') - 2; $i--) : ?>
                              <option value="<?= $i ?>">
                                <?= $i ?>
                              </option>
                            <?php endfor; ?>
                          </select>
                          <script>
                            $('#tahun').val("<?= $main->tahun ?>");
                          </script>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;" for="bidang_desa">Pilih Dusun</label>
                        <div class="col-sm-6">
                          <select name="dusun" class="form-control select2 input-sm required" onchange="ubah_dusun($(this).val())">
                            <option value="">Pilih <?= ucwords($this->setting->sebutan_dusun) ?></option>
                            <?php foreach ($dusun as $data) : ?>
                              <option value="<?= $data['dusun'] ?>" <?php selected($data['dusun'], $data['dusun']) ?>><?= $data['dusun'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;" for="bidang_desa">Bidang/Sub Bidang</label>
                        <div class="col-sm-6">
                          <select class="form-control select2 input-sm required" name="bidang_desa">
                            <option value="">- Pilih Sub Bidang Desa -</option>
                            <?php foreach ($bidang_desa as $data) : ?>
                              <option value="<?= $data['nama'] ?>" <?php selected($data['nama'], $data['nama']); ?>><?= $data['nama'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;" for="urutan_prioritas">Urutan Prioritas</label>
                        <div class="col-sm-2">
                          <input maxlength="50" class="form-control input-sm required col-md-1" name="urutan_prioritas" id="urutan_prioritas" value="<?= $main->urutan_prioritas ?>" type="text" placeholder="diisi angka" />
                          <code>isi dengan angka</code>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Nama Program/Kegiatan</label>
                        <div class="col-sm-9">
                          <input maxlength="50" class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;" for="sdgs_ke">Mendukung SDGS Desa Ke-</label>
                        <div class="col-sm-2">
                          <input maxlength="50" class="form-control input-sm" name="sdgs_ke" id="sdgs_ke" value="<?= $main->sdgs_ke ?>" type="text" placeholder="contoh: 1, 2, 3" />
                          <code>isi dengan angka</code>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;" for="data_eksisting">Data Eksisting Tahun Berjalan</label>
                        <div class="col-sm-9">
                          <textarea rows="5" class="form-control input-sm required" name="data_eksisting" id="data_eksisting"><?= $main->data_eksisting ?>
                      </textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="lokasi" class="col-sm-3 control-label">Lokasi</label>
                        <div class="col-sm-9">
                          <input maxlength="100" class="form-control input-sm required" name="lokasi" id="lokasi" value="<?= $main->lokasi ?>" type="text" placeholder="Lokasi" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Prakiraan Volume & Satuan</label>
                        <div class="col-sm-4">
                          <input maxlength="50" class="form-control input-sm required" name="volume" id="volume" value="<?= $main->volume ?>" type="text" placeholder="Volume" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;"><strong>Penerima Manfaat</strong></label>
                        <div class="col-sm-9">
                          <div class="form-group row">
                            <div class="col-md-4 mb-4">
                              <label class="col-sm-6 control-label">laki</label>
                              <div class="col-sm-6">
                                <input maxlength="50" class="form-control input-sm required" name="laki" id="laki" value="<?= $main->laki ?>" type="text" placeholder="" />
                              </div>
                            </div>
                            <div class="col-md-4 mb-4">
                              <label class="col-sm-6 control-label">Perempuan</label>
                              <div class="col-sm-6">
                                <input maxlength="50" class="form-control input-sm required" name="perempuan" id="perempuan" value="<?= $main->perempuan ?>" type="text" placeholder="" />
                              </div>
                            </div>
                            <div class="col-md-4 mb-4">
                              <label class="col-sm-6 control-label">RTM</label>
                              <div class="col-sm-6">
                                <input maxlength="50" class="form-control input-sm required" name="rtm" id="rtm" value="<?= $main->rtm ?>" type="text" placeholder="" />
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;"><strong>Perkiraan Biaya dan Sumber Pembiayaan</strong></label>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Jumlah (Rp)</label>
                        <div class="col-sm-9">
                          <input class="form-control input-sm required" name="anggaran" id="anggaran" value="<?= $main->anggaran ?>" type="text" placeholder="Anggaran" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;" for="sumber_dana">Sumber Dana</label>
                        <div class="col-sm-9">
                          <select class="form-control select2" id="sumber_dana" name="sumber_dana" style="width:100%;">
                            <?php foreach ($sumber_dana as $value) : ?>
                              <option <?= $value === $main->sumber_dana ? 'selected' : '' ?> value="<?= $value ?>">
                                <?= $value ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <?php if ($main->foto) : ?>
                        <div class="form-group row">
                          <label class="control-label col-sm-4" for="nama"></label>
                          <div class="col-sm-6">
                            <input type="hidden" name="old_foto" value="<?= $main->foto ?>">
                            <img class="attachment-img img-responsive img-circle" src="<?= base_url() . LOKASI_GALERI . $main->foto ?>" alt="Gambar Dokumentasi" width="200" height="200">
                          </div>
                        </div>
                      <?php endif; ?>
                      <div class="form-group row">
                        <label class="control-label col-sm-3" for="upload">Unggah Gambar Utama</label>
                        <div class="col-sm-9">
                          <div class="input-group input-group-sm">
                            <input type="text" class="form-control " id="file_path" name="foto">
                            <input id="file" type="file" class="hidden" name="foto">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-info btn-flat" id="file_browser"><i class="fa fa-search"></i> Browse</button>
                            </span>
                          </div>
                          <span class="help-block"><code>(Kosongkan jika tidak ingin mengubah gambar)</code></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-footer">
                    <div class="col-xs-12"> <a href="<?= site_url('perencanaan_desa') ?>" class="btn btn-danger"><i class="fa fa-times"></i> Batal</a>
                      <button type="submit" class="btn btn-info pull-right"><i class="fa fa-check"></i> Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
  function pilih_lokasi(pilih) {
    if (pilih == 1) {
      $('#lokasi').val(null);
      $('#lokasi').removeClass('required');
      $("#manual").hide();
      $("#pilih").show();
      $('#id_lokasi').addClass('required');
    } else {
      $('#id_lokasi').val(null);
      $('#id_lokasi').trigger('change', true);
      $('#id_lokasi').removeClass('required');
      $("#manual").show();
      $('#lokasi').addClass('required');
      $("#pilih").hide();
    }
  }

  $(document).ready(function() {
    pilih_lokasi(<?= is_null($main->lokasi) ? 1 : 2 ?>);
  });
</script>