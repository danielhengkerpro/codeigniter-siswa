<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    // Menghubungkan Model ke tabel 'siswa'
    protected $table = 'siswa';

    // Menentukan primary key
    protected $primaryKey = 'id';

    // Kolom yang diizinkan untuk dikelola
    protected $allowedFields = ['nis', 'nama', 'kelas'];

    // Method untuk mengambil data siswa dengan filter cari, kelas, urutan + pagination
    public function getSiswa($sort = 'nis_asc', $perPage = 5, $cari = null, $filterKelas = null)
    {
        $builder = $this;

        // Filter Pencarian (Nama atau NIS)
        if (!empty($cari)) {
            $builder = $builder->groupStart()
                               ->like('nama', $cari)
                               ->orLike('nis', $cari)
                               ->groupEnd();
        }

        // Filter Kelas
        if (!empty($filterKelas)) {
            $builder = $builder->where('kelas', $filterKelas);
        }

        // Pengurutan (Sorting)
        switch ($sort) {
            case 'nama_asc':
                $builder = $builder->orderBy('nama', 'ASC');
                break;
            case 'nama_desc':
                $builder = $builder->orderBy('nama', 'DESC');
                break;
            case 'nis_desc':
                $builder = $builder->orderBy('nis', 'DESC');
                break;
            case 'kelas_asc':
                $builder = $builder->orderBy('kelas', 'ASC');
                break;
            case 'nis_asc':
            default:
                $builder = $builder->orderBy('nis', 'ASC');
                break;
        }

        return $builder->paginate($perPage, 'siswa');
    }

    // Mengambil daftar nama kelas unik untuk dropdown filter
    public function getKelasList()
    {
        return $this->select('kelas')
                    ->distinct()
                    ->orderBy('kelas', 'ASC')
                    ->findAll();
    }
}