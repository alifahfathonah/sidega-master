<?php defined('BASEPATH') or exit('No direct script access allowed');

class Perencanaan_desa_model extends CI_Model
{
	protected $table = 'tbl_perencanaan_desa';

	const ENABLE = 1;
	const DISABLE = 0;

	const ORDER_ABLE = [
		1  => 'p.status',
		2  => 'p.tahun',
		3  => 'p.desa',
		4  => 'p.bidang_desa',
		5  => 'p.urutan_prioritas',
		6  => 'p.nama_program_kegiatan',
		7  => 'p.sdgs_ke',
		8  => 'p.lokasi',
		9  => 'p.sumber_dana',
	];

	public function get_data(string $search = '', $tahun = '')
	{
		$builder = $this->db->select([
			'p.*',
			'(CASE WHEN SUM(CAST(d.id_pilihan as UNSIGNED INTEGER)) IS NOT NULL THEN CONCAT(SUM(CAST(d.id_pilihan as UNSIGNED INTEGER))) ELSE CONCAT("belum ada progres") END) AS sum_id_pilihan',
			'(CASE WHEN COUNT(CAST(d.id_pilihan as UNSIGNED INTEGER)) IS NOT NULL THEN CONCAT(COUNT(CAST(d.id_pilihan as UNSIGNED INTEGER))) ELSE CONCAT("belum ada responden") END) AS count_id_pilihan',
		])
			->from("{$this->table} p")
			->join('tbl_perencanaan_desa_polling d', 'd.id_perencanaan_desa = p.id', 'left')
			->group_by('p.id');

		if (empty($search)) {
			$search = $builder;
		} else {
			$search = $builder->group_start()
				->like('p.tahun', $search)
				->or_like('p.desa', $search)
				->or_like('p.bidang_desa', $search)
				->or_like('p.urutan_prioritas', $search)
				->or_like('p.nama_program_kegiatan', $search)
				->or_like('p.sdgs_ke', $search)
				->or_like('p.lokasi', $search)
				->or_like('p.sumber_dana', $search)
				->group_end();
		}

		$condition = $tahun === 'semua'
			? $search
			: $search->where('p.tahun', $tahun);

		return $condition;
	}


	public function get_data_usulan(string $search = '', $tahun = '')
	{
		$builder = $this->db->select([
			'p.*',
			'(CASE WHEN SUM(CAST(d.id_pilihan as UNSIGNED INTEGER)) IS NOT NULL THEN CONCAT(SUM(CAST(d.id_pilihan as UNSIGNED INTEGER))) ELSE CONCAT("belum ada progres") END) AS sum_id_pilihan',
			'(CASE WHEN COUNT(CAST(d.id_pilihan as UNSIGNED INTEGER)) IS NOT NULL THEN CONCAT(COUNT(CAST(d.id_pilihan as UNSIGNED INTEGER))) ELSE CONCAT("belum ada responden") END) AS count_id_pilihan',
		])
			->from("{$this->table} p")
			->where('p.status_usulan = 1')
			->join('tbl_perencanaan_desa_polling d', 'd.id_perencanaan_desa = p.id', 'left')
			->group_by('p.id');

		if (empty($search)) {
			$search = $builder;
		} else {
			$search = $builder->group_start()
				->like('p.tahun', $search)
				->or_like('p.desa', $search)
				->or_like('p.bidang_desa', $search)
				->or_like('p.urutan_prioritas', $search)
				->or_like('p.nama_program_kegiatan', $search)
				->or_like('p.sdgs_ke', $search)
				->or_like('p.lokasi', $search)
				->or_like('p.sumber_dana', $search)
				->group_end();
		}

		$condition = $tahun === 'semua'
			? $search
			: $search->where('p.tahun', $tahun);

		return $condition;
	}

	public function get_data_daftar_polling(string $search = '', $tahun = '')
	{
		$builder = $this->db->select([
			'p.*',
			'(CASE WHEN SUM(CAST(d.id_pilihan as UNSIGNED INTEGER)) IS NOT NULL THEN CONCAT(SUM(CAST(d.id_pilihan as UNSIGNED INTEGER))) ELSE CONCAT("belum ada progres") END) AS sum_id_pilihan',
			'(CASE WHEN 
				COUNT(CAST(d.id_pilihan as UNSIGNED INTEGER)) IS NOT NULL 
				THEN CONCAT(COUNT(CAST(d.id_pilihan as UNSIGNED INTEGER))) 
				ELSE CONCAT("belum ada responden") END) AS count_id_pilihan',
		])
			->from("{$this->table} p")
			->where('p.status_usulan = 1 and p.status_vote = 1')
			->join('tbl_perencanaan_desa_polling d', 'd.id_perencanaan_desa = p.id', 'left')
			->group_by('p.id');

		if (empty($search)) {
			$search = $builder;
		} else {
			$search = $builder->group_start()
				->like('p.tahun', $search)
				->or_like('p.desa', $search)
				->or_like('p.bidang_desa', $search)
				->or_like('p.urutan_prioritas', $search)
				->or_like('p.nama_program_kegiatan', $search)
				->or_like('p.sdgs_ke', $search)
				->or_like('p.lokasi', $search)
				->or_like('p.sumber_dana', $search)
				->group_end();
		}

		$condition = $tahun === 'semua'
			? $search
			: $search->where('p.tahun', $tahun);

		return $condition;
	}

	public function get_data_hasil_polling(string $search = '', $tahun = '')
	{
		$builder = $this->db->select([
			'p.*',
			'(CASE WHEN SUM(CAST(d.id_pilihan as UNSIGNED INTEGER)) IS NOT NULL THEN CONCAT(SUM(CAST(d.id_pilihan as UNSIGNED INTEGER))) ELSE CONCAT("belum ada progres") END) AS sum_id_pilihan',
			'(CASE WHEN 
				COUNT(CAST(d.id_pilihan as UNSIGNED INTEGER)) IS NOT NULL 
				THEN CONCAT(COUNT(CAST(d.id_pilihan as UNSIGNED INTEGER))) 
				ELSE CONCAT("belum ada responden") END) AS count_id_pilihan',
			'(CASE WHEN MIN(CAST(d.updated_at as DATETIME)) THEN CONCAT(MIN(CAST(d.updated_at as DATETIME))) ELSE CONCAT("belum ada progres") END) AS min_updated',
			'(CASE WHEN MAX(CAST(d.updated_at as DATETIME)) THEN CONCAT(MAX(CAST(d.updated_at as DATETIME))) ELSE CONCAT("belum ada progres") END) AS max_updated',
			'SUM(IF(d.id_pilihan=1,1,0)) AS sum_ts',
			'SUM(IF(d.id_pilihan=2,1,0)) AS sum_s',
			'SUM(IF(d.id_pilihan=3,1,0)) AS sum_ss',
		])
			->from("{$this->table} p")
			->where('p.status_usulan = 1 and p.status_vote = 1')
			->join('tbl_perencanaan_desa_polling d', 'd.id_perencanaan_desa = p.id', 'left')
			->group_by('p.id');

		if (empty($search)) {
			$search = $builder;
		} else {
			$search = $builder->group_start()
				->like('p.tahun', $search)
				->or_like('p.desa', $search)
				->or_like('p.bidang_desa', $search)
				->or_like('p.urutan_prioritas', $search)
				->or_like('p.nama_program_kegiatan', $search)
				->group_end();
		}

		$condition = $tahun === 'semua'
			? $search
			: $search->where('p.tahun', $tahun);

		return $condition;
	}

	public function list_lokasi_program()
	{
		$data = $this->db->select([
			'p.*',
			"(CASE WHEN p.id_lokasi IS NOT NULL THEN CONCAT(
				(CASE WHEN w.rt != '0' THEN CONCAT('RT ', w.rt, ' / ') ELSE '' END),
				(CASE WHEN w.rw != '0' THEN CONCAT('RW ', w.rw, ' - ') ELSE '' END),
				w.dusun
			) ELSE p.lokasi END) AS alamat",
		])
			->from('tbl_perencanaan_desa p')
			->where('p.status = 1')
			->join('tweb_wil_clusterdesa w', 'p.id_lokasi = w.id', 'left')
			->get()
			->result();

		return $data;
	}

	public function insert()
	{
		$post = $this->input->post();

		$data['tahun']       					= $post['tahun'];
		$data['dusun']              				= $post['dusun'];
		$data['bidang_desa']             		= $post['bidang_desa'];
		$data['urutan_prioritas']     			= $post['urutan_prioritas'];
		$data['nama_program_kegiatan'] 			= $post['nama_program_kegiatan'];
		$data['sdgs_ke']          				= $post['sdgs_ke'];
		$data['data_eksisting']             	= $post['data_eksisting'];
		$data['volume']             			= $post['volume'];
		$data['laki']             				= $post['laki'];
		$data['perempuan']             			= $post['perempuan'];
		$data['rtm']             				= $post['rtm'];
		$data['sumber_dana']             		= $post['sumber_dana'];
		$data['keterangan']             		= $post['keterangan'];
		$data['lokasi']             			= $post['lokasi'];
		$data['lat']             				= $post['lat'];
		$data['lng']             				= $post['lng'];
		$data['pelaksana_kegiatan']             = $post['pelaksana_kegiatan'];
		$data['status']             			= $post['status'] ?: null;
		$data['foto'] 						  	= $this->upload_gambar_pembangunan('foto');
		$data['anggaran']     					= $post['anggaran'];


		$data['created_at']         = date('Y-m-d H:i:s');
		$data['updated_at']         = date('Y-m-d H:i:s');

		if (empty($data['foto'])) unset($data['foto']);

		unset($data['file_foto']);
		unset($data['old_foto']);

		$outp = $this->db->insert('tbl_perencanaan_desa', $data);

		if ($outp) $_SESSION['success'] = 1;
		else $_SESSION['success'] = -1;
	}

	public function update($id = 0)
	{
		$post = $this->input->post();

		$data['tahun']       					= $post['tahun'];
		$data['dusun']              				= $post['dusun'];
		$data['bidang_desa']             		= $post['bidang_desa'];
		$data['urutan_prioritas']     			= $post['urutan_prioritas'];
		$data['nama_program_kegiatan'] 			= $post['nama_program_kegiatan'];
		$data['sdgs_ke']          				= $post['sdgs_ke'];
		$data['data_eksisting']             	= $post['data_eksisting'];
		$data['volume']             			= $post['volume'];
		$data['laki']             				= $post['laki'];
		$data['perempuan']             			= $post['perempuan'];
		$data['rtm']             				= $post['rtm'];
		$data['sumber_dana']             		= $post['sumber_dana'];
		$data['keterangan']             		= $post['keterangan'];
		$data['lokasi']             			= $post['lokasi'];
		$data['lat']             				= $post['lat'];
		$data['lng']             				= $post['lng'];
		$data['pelaksana_kegiatan']             = $post['pelaksana_kegiatan'];
		$data['status']             			= $post['status'] ?: null;
		$data['status_vote']             			= $post['status_vote'];
		$data['status_usulan']             			= $post['status_usulan'];
		$data['status_usulan_musrenbang_kecamatan']             			= $post['status_usulan_musrenbang_kecamatan'];
		$data['foto'] 						  	= $this->upload_gambar_pembangunan('foto');
		$data['anggaran']     					= $post['anggaran'];

		$data['id_lokasi']         				= $post['id_lokasi'];
		$data['created_at']        				= date('Y-m-d H:i:s');
		$data['updated_at']         			= date('Y-m-d H:i:s');

		if (empty($data['foto'])) unset($data['foto']);

		unset($data['file_foto']);
		unset($data['old_foto']);

		$this->db->where('id', $id);
		$outp = $this->db->update('tbl_perencanaan_desa', $data);

		if ($outp) $_SESSION['success'] = 1;
		else $_SESSION['success'] = -1;
	}

	public function update_draf_musrenbang($id = 0)
	{
		$post = $this->input->post();

		$data['skpd_penanggungjawab']       				= $post['skpd_penanggungjawab'];
		$data['prioritas_daerah']       					= $post['prioritas_daerah'];
		$data['sasaran_daerah']       						= $post['sasaran_daerah'];
		$data['sasaran_kegiatan']       					= $post['sasaran_kegiatan'];
		$data['program']       								= $post['program'];
		$data['created_at']        							= date('Y-m-d H:i:s');
		$data['updated_at']         						= date('Y-m-d H:i:s');

		$this->db->where('id', $id);
		$outp = $this->db->update('tbl_perencanaan_desa', $data);

		if ($outp) $_SESSION['success'] = 1;
		else $_SESSION['success'] = -1;
	}

	private function upload_gambar_pembangunan($jenis)
	{
		$this->load->library('upload');
		$this->uploadConfig = array(
			'upload_path' => LOKASI_GALERI,
			'allowed_types' => 'gif|jpg|jpeg|png|pdf',
			'max_size' => max_upload() * 1024,
		);
		// Adakah berkas yang disertakan?
		$adaBerkas = !empty($_FILES[$jenis]['name']);
		if ($adaBerkas !== TRUE) {
			return NULL;
		}
		// Tes tidak berisi script PHP
		if (isPHP($_FILES['logo']['tmp_name'], $_FILES[$jenis]['name'])) {
			$_SESSION['error_msg'] .= " -> Jenis file ini tidak diperbolehkan ";
			$_SESSION['success'] = -1;
			redirect('identitas_instansi');
		}

		$uploadData = NULL;
		// Inisialisasi library 'upload'
		$this->upload->initialize($this->uploadConfig);
		// Upload sukses
		if ($this->upload->do_upload($jenis)) {
			$uploadData = $this->upload->data();
			// Buat nama file unik agar url file susah ditebak dari browser
			$namaFileUnik = tambahSuffixUniqueKeNamaFile($uploadData['file_name']);
			// Ganti nama file asli dengan nama unik untuk mencegah akses langsung dari browser
			$fileRenamed = rename(
				$this->uploadConfig['upload_path'] . $uploadData['file_name'],
				$this->uploadConfig['upload_path'] . $namaFileUnik
			);
			// Ganti nama di array upload jika file berhasil di-rename --
			// jika rename gagal, fallback ke nama asli
			$uploadData['file_name'] = $fileRenamed ? $namaFileUnik : $uploadData['file_name'];
		}
		// Upload gagal
		else {
			$_SESSION['success'] = -1;
			$_SESSION['error_msg'] = $this->upload->display_errors(NULL, NULL);
		}
		return (!empty($uploadData)) ? $uploadData['file_name'] : NULL;
	}

	public function update_lokasi_maps($id, array $request)
	{
		return $this->db->where('id', $id)->update($this->table, [
			'lat'        => $request['lat'],
			'lng'        => $request['lng'],
			'updated_at' => date('Y-m-d H:i:s'),
		]);
	}

	public function delete($id)
	{
		return $this->db->where('id', $id)->delete($this->table);
	}

	public function find($id)
	{
		return $this->db->select([
			'*'
		])
			->from('tbl_perencanaan_desa')
			->where('id', $id)
			->get()
			->row();
	}
	
	public function find_rkpdes($id)
	{
		$data = $this->db->select([
			'*'
		])
			->from('tbl_perencanaan_desa')
			->where('status_rkpdes = 1')
			->get()
			->row();

		return $data;
			
	}
	
	public function find_durkpdes($id)
	{
		$data = $this->db->select([
			'*'
		])
			->from('tbl_perencanaan_desa')
			->where('status_rkpdes = 0')
			->get()
			->row();

		return $data;
			
	}
	
	public function list_filter_tahun()
	{
		return $this->db->select('tahun')
			->distinct()
			->order_by('tahun', 'desc')
			->get($this->table)
			->result();
	}


	//---- Status Aktiv Usulan ----//
	public function unlock($id)
	{
		return $this->db->set('status', static::ENABLE)
			->where('id', $id)
			->update($this->table);
	}

	public function lock($id)
	{
		return $this->db->set('status', static::DISABLE)
			->where('id', $id)
			->update($this->table);
	}

	//---- Status Vote ----//
	public function vote($id)
	{
		return $this->db->set('status_vote', static::ENABLE)
			->where('id', $id)
			->update($this->table);
	}

	public function unvote($id)
	{
		return $this->db->set('status_vote', static::DISABLE)
			->where('id', $id)
			->update($this->table);
	}

	//---- Status Usulan Desa ----//
	public function ajukan($id)
	{
		return $this->db->set('status_usulan', static::ENABLE)
			->where('id', $id)
			->update($this->table);
	}

	public function batalkan($id)
	{
		return $this->db->set('status_usulan', static::DISABLE)
			->where('id', $id)
			->update($this->table);
	}
	//---- Status Status Penetapan APBDes ----//
	public function apbdes_aktiv($id)
	{
		return $this->db->set('status_rkpdes', static::ENABLE)
			->where('id', $id)
			->update($this->table);
	}
	public function durkp_aktiv($id)
	{
		return $this->db->set('status_rkpdes', static::DISABLE)
			->where('id', $id)
			->update($this->table);
	}


	//status usulan musrenbang kecamatan
	public function usulan_kecamatan_aktiv($id)
	{
		return $this->db->set('status_usulan_musrenbang_kecamatan', static::ENABLE)
			->where('id', $id)
			->update($this->table);
	}

	public function usulan_kecamatan_non_aktiv($id)
	{
		return $this->db->set('status_usulan_musrenbang_kecamatan', static::DISABLE)
			->where('id', $id)
			->update($this->table);
	}


	public function get_data_rkpdes(string $search = '', $tahun = '')
	{
		$builder = $this->db->select([
			'p.*',
			'(CASE WHEN SUM(CAST(d.id_pilihan as UNSIGNED INTEGER)) IS NOT NULL THEN CONCAT(SUM(CAST(d.id_pilihan as UNSIGNED INTEGER))) ELSE CONCAT("belum ada progres") END) AS sum_id_pilihan',
			'(CASE WHEN 
				COUNT(CAST(d.id_pilihan as UNSIGNED INTEGER)) IS NOT NULL 
				THEN CONCAT(COUNT(CAST(d.id_pilihan as UNSIGNED INTEGER))) 
				ELSE CONCAT("belum ada responden") END) AS count_id_pilihan',
			'(CASE WHEN MIN(CAST(d.updated_at as DATETIME)) THEN CONCAT(MIN(CAST(d.updated_at as DATETIME))) ELSE CONCAT("belum ada progres") END) AS min_updated',
			'(CASE WHEN MAX(CAST(d.updated_at as DATETIME)) THEN CONCAT(MAX(CAST(d.updated_at as DATETIME))) ELSE CONCAT("belum ada progres") END) AS max_updated',
			'SUM(IF(d.id_pilihan=1,1,0)) AS sum_ts',
			'SUM(IF(d.id_pilihan=2,1,0)) AS sum_s',
			'SUM(IF(d.id_pilihan=3,1,0)) AS sum_ss',
		])
			->from("{$this->table} p")
			->where('p.status_usulan = 1 and p.status_vote = 1')
			->join('tbl_perencanaan_desa_polling d', 'd.id_perencanaan_desa = p.id', 'left')
			->group_by('p.id');

		if (empty($search)) {
			$search = $builder;
		} else {
			$search = $builder->group_start()
				->like('p.tahun', $search)
				->or_like('p.desa', $search)
				->or_like('p.bidang_desa', $search)
				->or_like('p.urutan_prioritas', $search)
				->or_like('p.nama_program_kegiatan', $search)
				->group_end();
		}

		$condition = $tahun === 'semua'
			? $search
			: $search->where('p.tahun', $tahun);

		return $condition;
	}

	public function get_data_apdes(string $search = '', $tahun = '')
	{
		$builder = $this->db->select([
			'p.*',
			'(CASE WHEN SUM(CAST(d.id_pilihan as UNSIGNED INTEGER)) IS NOT NULL THEN CONCAT(SUM(CAST(d.id_pilihan as UNSIGNED INTEGER))) ELSE CONCAT("belum ada progres") END) AS sum_id_pilihan',
			'(CASE WHEN 
				COUNT(CAST(d.id_pilihan as UNSIGNED INTEGER)) IS NOT NULL 
				THEN CONCAT(COUNT(CAST(d.id_pilihan as UNSIGNED INTEGER))) 
				ELSE CONCAT("belum ada responden") END) AS count_id_pilihan',
			'(CASE WHEN MIN(CAST(d.updated_at as DATETIME)) THEN CONCAT(MIN(CAST(d.updated_at as DATETIME))) ELSE CONCAT("belum ada progres") END) AS min_updated',
			'(CASE WHEN MAX(CAST(d.updated_at as DATETIME)) THEN CONCAT(MAX(CAST(d.updated_at as DATETIME))) ELSE CONCAT("belum ada progres") END) AS max_updated',
			'SUM(IF(d.id_pilihan=1,1,0)) AS sum_ts',
			'SUM(IF(d.id_pilihan=2,1,0)) AS sum_s',
			'SUM(IF(d.id_pilihan=3,1,0)) AS sum_ss',
		])
			->from("{$this->table} p")
			->where('p.status_rkpdes = 1 and p.status_vote = 1')
			->join('tbl_perencanaan_desa_polling d', 'd.id_perencanaan_desa = p.id', 'left')
			->group_by('p.id');

		if (empty($search)) {
			$search = $builder;
		} else {
			$search = $builder->group_start()
				->like('p.tahun', $search)
				->or_like('p.desa', $search)
				->or_like('p.bidang_desa', $search)
				->or_like('p.urutan_prioritas', $search)
				->or_like('p.nama_program_kegiatan', $search)
				->group_end();
		}

		$condition = $tahun === 'semua'
			? $search
			: $search->where('p.tahun', $tahun);

		return $condition;
	}
	
	public function get_data_durkp(string $search = '', $tahun = '')
	{
		$builder = $this->db->select([
			'p.*',
		])
			->from("{$this->table} p")
			->where('p.status_rkpdes = 0 and p.status_vote = 1')
			->join('tbl_perencanaan_desa_polling d', 'd.id_perencanaan_desa = p.id', 'left')
			->group_by('p.id');

		if (empty($search)) {
			$search = $builder;
		} else {
			$search = $builder->group_start()
				->like('p.tahun', $search)
				->or_like('p.desa', $search)
				->or_like('p.bidang_desa', $search)
				->or_like('p.urutan_prioritas', $search)
				->or_like('p.nama_program_kegiatan', $search)
				->group_end();
		}

		$condition = $tahun === 'semua'
			? $search
			: $search->where('p.tahun', $tahun);

		return $condition;
	}
	
}
