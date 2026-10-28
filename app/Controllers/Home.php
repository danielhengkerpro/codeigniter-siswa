<?php

namespace App\Controllers;

use App\Models\SiswaModel;

class Home extends BaseController
{
    public function index(): string
    {
        $siswaModel = new SiswaModel();

        // Ambil query parameter
        $sort   = $this->request->getGet('sort') ?? 'nis_asc';
        $cari   = trim($this->request->getGet('cari') ?? '');
        $kelas  = trim($this->request->getGet('kelas') ?? '');
        $perPage = 5; // 5 siswa per halaman

        $currentPage = $this->request->getGet('page_siswa') ? (int) $this->request->getGet('page_siswa') : 1;

        $data['siswa']          = $siswaModel->getSiswa($sort, $perPage, $cari, $kelas);
        $data['pager']          = $siswaModel->pager->only(['sort', 'cari', 'kelas']);
        $data['sort']           = $sort;
        $data['cari']           = $cari;
        $data['kelas_terpilih'] = $kelas;
        $data['nomor_awal']     = 1 + ($perPage * ($currentPage - 1));
        $data['daftar_kelas']   = $siswaModel->getKelasList();
        $data['total_siswa']    = $siswaModel->countAll();
        $data['total_kelas']    = count($data['daftar_kelas']);

        return view('siswa_view', $data);
    }

    // Method untuk menyimpan data siswa baru (dengan validasi)
    public function tambah()
    {
        $siswaModel = new SiswaModel();

        $rules = [
            'nis'   => 'required|numeric|is_unique[siswa.nis]',
            'nama'  => 'required|min_length[3]|max_length[100]',
            'kelas' => 'required',
        ];

        $messages = [
            'nis' => [
                'required'  => 'NIS wajib diisi!',
                'numeric'   => 'NIS harus berupa angka!',
                'is_unique' => 'NIS sudah terdaftar, silakan gunakan NIS lain!'
            ],
            'nama' => [
                'required'   => 'Nama lengkap wajib diisi!',
                'min_length' => 'Nama lengkap minimal 3 karakter!'
            ],
            'kelas' => [
                'required'   => 'Kelas wajib dipilih atau diisi!'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            $errors = implode('<br>', $this->validator->getErrors());
            return redirect()->back()->withInput()->with('error', $errors);
        }

        $siswaModel->save([
            'nis'   => trim($this->request->getPost('nis')),
            'nama'  => trim($this->request->getPost('nama')),
            'kelas' => trim($this->request->getPost('kelas')),
        ]);

        return redirect()->to(base_url())->with('success', 'Data siswa berhasil ditambahkan!');
    }

    // Method untuk menghapus data siswa
    public function hapus($id)
    {
        $siswaModel = new SiswaModel();
        $siswa = $siswaModel->find($id);

        if ($siswa) {
            $siswaModel->delete($id);
            return redirect()->to(base_url())->with('success', 'Data siswa berhasil dihapus!');
        }

        return redirect()->to(base_url())->with('error', 'Data siswa tidak ditemukan!');
    }

    // Method untuk memperbarui data siswa via Modal (dengan validasi NIS unik kecuali milik sendiri)
    public function edit($id)
    {
        $siswaModel = new SiswaModel();

        $rules = [
            'nis'   => "required|numeric|is_unique[siswa.nis,id,{$id}]",
            'nama'  => 'required|min_length[3]|max_length[100]',
            'kelas' => 'required',
        ];

        $messages = [
            'nis' => [
                'required'  => 'NIS wajib diisi!',
                'numeric'   => 'NIS harus berupa angka!',
                'is_unique' => 'NIS tersebut sudah digunakan oleh siswa lain!'
            ],
            'nama' => [
                'required'   => 'Nama lengkap wajib diisi!',
                'min_length' => 'Nama lengkap minimal 3 karakter!'
            ],
            'kelas' => [
                'required'   => 'Kelas wajib dipilih atau diisi!'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            $errors = implode('<br>', $this->validator->getErrors());
            return redirect()->back()->withInput()->with('error', $errors);
        }

        $siswaModel->update($id, [
            'nis'   => trim($this->request->getPost('nis')),
            'nama'  => trim($this->request->getPost('nama')),
            'kelas' => trim($this->request->getPost('kelas')),
        ]);

        return redirect()->to(base_url())->with('success', 'Data siswa berhasil diperbarui!');
    }

    // Method untuk update langsung saat tabel diklik & diketik (Inline Edit)
    // Disertai validasi NIS unik agar tidak duplikat dengan siswa lain
    public function updateInline()
    {
        $siswaModel = new SiswaModel();

        $id    = $this->request->getPost('id');
        $field = $this->request->getPost('field');
        $value = trim($this->request->getPost('value') ?? '');

        // 1. Pastikan kolom yang diubah valid
        if (!in_array($field, ['nis', 'nama', 'kelas'])) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Kolom yang diedit tidak valid!'
            ], 400);
        }

        // 2. Pastikan nilai tidak kosong
        if ($value === '') {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => strtoupper($field) . ' tidak boleh kosong!'
            ], 422);
        }

        // 3. Validasi khusus NIS agar tidak double / duplikat dengan siswa lain
        if ($field === 'nis') {
            if (!is_numeric($value)) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'NIS harus berupa angka!'
                ], 422);
            }

            // Cek apakah NIS sudah dipakai oleh siswa LAIN (id != $id)
            $existing = $siswaModel->where('nis', $value)
                                   ->where('id !=', $id)
                                   ->first();

            if ($existing) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => "NIS '{$value}' sudah digunakan oleh siswa '{$existing['nama']}'!"
                ], 422);
            }
        }

        // 4. Validasi khusus Nama
        if ($field === 'nama' && mb_strlen($value) < 3) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Nama lengkap minimal 3 karakter!'
            ], 422);
        }

        // Simpan perubahan ke database
        $siswaModel->update($id, [
            $field => $value
        ]);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => ucfirst($field) . ' berhasil diperbarui!'
        ]);
    }

    // Method untuk ekspor daftar siswa ke file CSV (bisa langsung dibuka di Microsoft Excel)
    public function export()
    {
        $siswaModel = new SiswaModel();
        $siswa = $siswaModel->orderBy('nis', 'ASC')->findAll();

        $filename = 'data_siswa_' . date('Ymd_His') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        // UTF-8 BOM untuk kompatibilitas Excel bahasa Indonesia
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        fputcsv($output, ['No', 'NIS', 'Nama Lengkap', 'Kelas']);

        $no = 1;
        foreach ($siswa as $row) {
            fputcsv($output, [
                $no++,
                "'" . $row['nis'], // Tanda kutip agar NIS 0 awal tidak terpotong di Excel
                $row['nama'],
                $row['kelas']
            ]);
        }

        fclose($output);
        exit;
    }
}