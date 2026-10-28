<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa XI RPL</title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- CDN CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        :root {
            --font-sans: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            --bg-canvas: #f8fafc;
            --border-soft: #e2e8f0;
            --border-input: #cbd5e1;
            --text-heading: #0f172a;
            --text-body: #334155;
            --text-muted: #64748b;
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--bg-canvas);
            color: var(--text-body);
            -webkit-font-smoothing: antialiased;
        }

        /* Modern Card Container */
        .card-custom {
            background-color: #ffffff;
            border: 1px solid var(--border-soft);
            border-radius: 0.625rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.05);
        }

        .card-header-custom {
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-soft);
            padding: 1rem 1.25rem;
        }

        /* Toolbar Controls */
        .toolbar-btn {
            height: 36px;
            font-size: 0.84rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border-radius: 0.375rem;
            padding: 0 0.85rem;
        }

        .filter-input {
            height: 36px;
            font-size: 0.84rem;
            border-color: var(--border-input);
            border-radius: 0.375rem;
        }
        .filter-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
        }

        /* Custom Dropdown Styling */
        .custom-select-btn {
            height: 36px;
            background-color: #ffffff;
            border: 1px solid var(--border-input);
            color: var(--text-body);
            font-size: 0.84rem;
            font-weight: 500;
            border-radius: 0.375rem;
            padding: 0 0.85rem;
            transition: all 0.15s ease;
        }
        .custom-select-btn:hover,
        .custom-select-btn:focus,
        .custom-select-btn[aria-expanded="true"] {
            border-color: #94a3b8;
            background-color: #f8fafc;
            color: var(--text-heading);
        }

        .custom-dropdown-menu {
            border-radius: 0.5rem;
            padding: 0.35rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--border-soft) !important;
            min-width: 165px;
        }
        .custom-dropdown-menu .dropdown-item {
            border-radius: 0.35rem;
            padding: 0.4rem 0.75rem;
            font-size: 0.8125rem;
            color: var(--text-body);
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .custom-dropdown-menu .dropdown-item:hover {
            background-color: #f1f5f9;
            color: var(--text-heading);
        }
        .custom-dropdown-menu .dropdown-item.active {
            background-color: #eff6ff;
            color: #2563eb;
            font-weight: 600;
        }

        /* Table Design */
        .table-custom {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        .table-custom thead th {
            background-color: #f8fafc;
            color: #475569;
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-top: none;
            border-bottom: 1px solid var(--border-soft);
            padding: 0.65rem 0.85rem;
            white-space: nowrap;
        }

        .table-custom tbody td {
            padding: 0.7rem 0.85rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            font-size: 0.875rem;
            color: var(--text-body);
        }

        .table-custom tbody tr:hover td {
            background-color: #fbfcfe;
        }

        /* Numbers Tabular */
        .tabular-nums {
            font-variant-numeric: tabular-nums;
            font-feature-settings: "tnum";
        }

        /* Class Badge */
        .badge-kelas {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            font-size: 0.78rem;
            font-weight: 500;
            border-radius: 9999px;
            background-color: #f1f5f9;
            color: #334155;
            border: 1px solid var(--border-soft);
        }

        /* Action Buttons (Edit & Hapus) - Sleek & Cohesive */
        .btn-edit-action {
            color: #2563eb;
            background-color: #ffffff;
            border: 1px solid var(--border-input);
            font-weight: 500;
            font-size: 0.78rem;
            padding: 0.25rem 0.6rem;
            border-radius: 0.35rem;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.12s ease;
        }
        .btn-edit-action:hover {
            color: #1d4ed8;
            background-color: #eff6ff;
            border-color: #bfdbfe;
        }

        .btn-delete-action {
            color: #dc2626;
            background-color: #ffffff;
            border: 1px solid var(--border-input);
            font-weight: 500;
            font-size: 0.78rem;
            padding: 0.25rem 0.6rem;
            border-radius: 0.35rem;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.12s ease;
        }
        .btn-delete-action:hover {
            color: #b91c1c;
            background-color: #fef2f2;
            border-color: #fecaca;
        }

        /* Inline Editable Cell */
        .editable-cell {
            cursor: pointer;
            border-radius: 0.25rem;
            padding: 0.2rem 0.35rem;
            margin: -0.2rem -0.35rem;
            transition: all 0.12s ease;
            border: 1px dashed transparent;
        }
        .editable-cell:hover {
            background-color: #eff6ff !important;
            border-color: #93c5fd;
        }
        .editable-cell:focus {
            background-color: #ffffff !important;
            outline: none;
            border: 1px solid #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        /* Pagination Styling */
        .pagination {
            margin-bottom: 0;
            gap: 4px;
        }
        .pagination li a,
        .pagination li span {
            display: block;
            padding: 0.3rem 0.65rem;
            color: #0284c7;
            text-decoration: none;
            background-color: #ffffff;
            border: 1px solid var(--border-soft);
            border-radius: 0.35rem;
            font-size: 0.8125rem;
            font-weight: 500;
            transition: all 0.12s ease;
        }
        .pagination li a:hover {
            background-color: #f1f5f9;
            border-color: #cbd5e1;
            color: #0369a1;
        }
        .pagination li.active a,
        .pagination li.active span {
            z-index: 3;
            color: #ffffff;
            background-color: #0284c7;
            border-color: #0284c7;
        }
    </style>
</head>
<body>
    <?php
    $sort_label_map = [
        'nis_asc'   => 'NIS (Terkecil)',
        'nis_desc'  => 'NIS (Terbesar)',
        'nama_asc'  => 'Nama (A - Z)',
        'nama_desc' => 'Nama (Z - A)',
        'kelas_asc' => 'Kelas (A - Z)',
    ];
    ?>

    <!-- 1. Header & Navigasi -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm py-2" aria-label="Navigasi Utama">
            <div class="container">
                <a class="navbar-brand fw-bold d-flex align-items-center gap-2 m-0 fs-6" href="<?= base_url(); ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
                    <span>Data Siswa XI RPL</span>
                </a>
            </div>
        </nav>
    </header>

    <!-- 2. Konten Utama (Landmark <main>) -->
    <main class="container my-4 my-md-5">
        <div class="card card-custom">
            <!-- Card Header -->
            <div class="card-header-custom d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
                <div>
                    <h1 class="h6 fw-bold m-0 text-dark">Daftar Siswa Terdaftar</h1>
                    <p class="text-muted small m-0 mt-0.5">Klik langsung pada sel NIS, Nama, atau Kelas untuk edit instan di tabel</p>
                </div>
                <span class="badge bg-light text-secondary border tabular-nums px-2.5 py-1.5 fw-medium align-self-start align-self-sm-auto">
                    Total: <?= count($siswa); ?> data
                </span>
            </div>

            <div class="card-body p-3 p-md-4">
                <!-- Baris Toolbar: Kiri (Aksi) & Kanan (Pencarian & Filter) -->
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                    <!-- Kiri: Tombol Aksi Tambah & Ekspor (Side-by-side sejajar) -->
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-primary toolbar-btn shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
                            <span>Tambah Siswa</span>
                        </button>
                        <a href="<?= base_url('home/export'); ?>" class="btn btn-outline-secondary toolbar-btn bg-white shadow-sm" title="Unduh data format CSV">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-success"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                            <span>Ekspor CSV</span>
                        </a>
                    </div>

                    <!-- Kanan: Form Pencarian & Custom Dropdowns (Satu Baris Sejajar) -->
                    <form id="filterForm" action="<?= base_url(); ?>" method="GET" class="d-flex align-items-center gap-2 flex-wrap">
                        <!-- Input Pencarian -->
                        <div class="input-group" style="width: 190px;">
                            <span class="input-group-text bg-white border-end-0 text-muted filter-input py-0 pe-1" style="height: 36px;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            </span>
                            <input type="text" name="cari" class="form-control filter-input border-start-0 ps-1" 
                                   placeholder="Cari NIS / Nama..." value="<?= esc($cari); ?>"
                                   aria-label="Cari siswa berdasarkan NIS atau Nama">
                        </div>

                        <!-- Hidden Inputs untuk nilai filter dropdown -->
                        <input type="hidden" name="kelas" id="inputFilterKelas" value="<?= esc($kelas_terpilih); ?>">
                        <input type="hidden" name="sort" id="inputFilterSort" value="<?= esc($sort); ?>">

                        <!-- Dropdown Kelas (Custom CSS) -->
                        <div class="dropdown">
                            <button class="btn custom-select-btn dropdown-toggle d-flex align-items-center justify-content-between gap-2 shadow-sm" 
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false" style="min-width: 130px;">
                                <span><?= !empty($kelas_terpilih) ? esc($kelas_terpilih) : 'Semua Kelas'; ?></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end custom-dropdown-menu">
                                <li>
                                    <button type="button" class="dropdown-item <?= empty($kelas_terpilih) ? 'active' : ''; ?>" onclick="setFilter('kelas', '')">
                                        <span>Semua Kelas</span>
                                        <?php if (empty($kelas_terpilih)) : ?>
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                        <?php endif; ?>
                                    </button>
                                </li>
                                <?php if (!empty($daftar_kelas)) : ?>
                                    <?php foreach ($daftar_kelas as $k) : ?>
                                        <li>
                                            <button type="button" class="dropdown-item <?= ($kelas_terpilih == $k['kelas']) ? 'active' : ''; ?>" onclick="setFilter('kelas', '<?= esc($k['kelas']); ?>')">
                                                <span><?= esc($k['kelas']); ?></span>
                                                <?php if ($kelas_terpilih == $k['kelas']) : ?>
                                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                                <?php endif; ?>
                                            </button>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <!-- Dropdown Sort (Custom CSS) -->
                        <div class="dropdown">
                            <button class="btn custom-select-btn dropdown-toggle d-flex align-items-center justify-content-between gap-2 shadow-sm" 
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false" style="min-width: 145px;">
                                <span><?= $sort_label_map[$sort] ?? 'NIS (Terkecil)'; ?></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end custom-dropdown-menu">
                                <?php foreach ($sort_label_map as $val => $lbl) : ?>
                                    <li>
                                        <button type="button" class="dropdown-item <?= ($sort == $val) ? 'active' : ''; ?>" onclick="setFilter('sort', '<?= $val; ?>')">
                                            <span><?= $lbl; ?></span>
                                            <?php if ($sort == $val) : ?>
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                            <?php endif; ?>
                                        </button>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Tombol Reset -->
                        <?php if (!empty($cari) || !empty($kelas_terpilih) || $sort !== 'nis_asc') : ?>
                            <a href="<?= base_url(); ?>" class="btn btn-outline-secondary d-flex align-items-center justify-content-center bg-white shadow-sm" 
                               title="Reset filter" aria-label="Reset filter pencarian" style="height: 36px; width: 36px; padding: 0;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                            </a>
                        <?php endif; ?>
                    </form>
                </div>

                <!-- Tabel Data Siswa (Tersusun Seimbang dengan Lebar Kolom Tepat) -->
                <div class="table-responsive">
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="text-center">No</th>
                                <th style="width: 120px;">NIS</th>
                                <th>Nama Siswa</th>
                                <th style="width: 140px;">Kelas</th>
                                <th style="width: 160px;" class="text-end pe-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($siswa)) : ?>
                                <?php $no = $nomor_awal; ?>
                                <?php foreach ($siswa as $row) : ?>
                                    <tr>
                                        <td class="text-center text-muted tabular-nums"><?= $no++; ?></td>
                                        <!-- Kolom NIS, Nama, dan Kelas bisa langsung diklik & diedit -->
                                        <td>
                                            <span contenteditable="true" class="editable-cell tabular-nums text-secondary fw-medium d-inline-block" 
                                                  data-id="<?= $row['id']; ?>" data-field="nis"
                                                  title="Klik untuk mengedit NIS" role="textbox" aria-label="NIS siswa, klik untuk mengedit"><?= esc($row['nis']); ?></span>
                                        </td>
                                        <td>
                                            <span contenteditable="true" class="editable-cell text-dark fw-medium d-inline-block" 
                                                  data-id="<?= $row['id']; ?>" data-field="nama"
                                                  title="Klik untuk mengedit Nama" role="textbox" aria-label="Nama siswa, klik untuk mengedit"><?= esc($row['nama']); ?></span>
                                        </td>
                                        <td>
                                            <span contenteditable="true" class="editable-cell badge-kelas" 
                                                  data-id="<?= $row['id']; ?>" data-field="kelas"
                                                  title="Klik untuk mengedit Kelas" role="textbox" aria-label="Kelas siswa, klik untuk mengedit"><?= esc($row['kelas']); ?></span>
                                        </td>
                                        <td class="text-end pe-2">
                                            <!-- Tombol Edit & Hapus Serasi & Rapi -->
                                            <div class="d-inline-flex gap-1.5 justify-content-end">
                                                <button type="button" class="btn btn-edit-action btn-edit"
                                                    data-bs-toggle="modal" data-bs-target="#modalEdit"
                                                    data-id="<?= $row['id']; ?>"
                                                    data-nis="<?= esc($row['nis']); ?>"
                                                    data-nama="<?= esc($row['nama']); ?>"
                                                    data-kelas="<?= esc($row['kelas']); ?>"
                                                    aria-label="Edit data <?= esc($row['nama']); ?>"
                                                    title="Edit data siswa">
                                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                                    Edit
                                                </button>

                                                <button type="button" class="btn btn-delete-action btn-hapus"
                                                    data-id="<?= $row['id']; ?>"
                                                    data-nama="<?= esc($row['nama']); ?>"
                                                    aria-label="Hapus data <?= esc($row['nama']); ?>"
                                                    title="Hapus data siswa">
                                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <p class="text-muted mb-2">
                                            <?= !empty($cari) ? "Tidak ditemukan data siswa dengan kata kunci \"<strong>" . esc($cari) . "</strong>\"." : "Belum ada data siswa terdaftar."; ?>
                                        </p>
                                        <?php if (!empty($cari) || !empty($kelas_terpilih)) : ?>
                                            <a href="<?= base_url(); ?>" class="btn btn-sm btn-outline-primary">Kembali ke Semua Data</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Navigasi Pagination -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3 pt-3 border-top gap-2">
                    <small class="text-muted tabular-nums">Menampilkan maksimal 5 siswa per halaman</small>
                    <div>
                        <?= $pager->links('siswa', 'default_full'); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Tambah Data Siswa -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-bottom bg-light">
                    <h2 class="modal-title h6 fw-bold text-dark mb-0" id="modalTambahLabel">Tambah Data Siswa</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="<?= base_url('home/tambah'); ?>" method="POST">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="nis" class="form-label small fw-medium">NIS</label>
                            <input type="number" name="nis" id="nis" class="form-control" placeholder="Contoh: 1024101" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label small fw-medium">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Contoh: Ahmad Fauzi" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label small fw-medium">Kelas</label>
                            <input type="text" name="kelas" id="kelas" class="form-control" placeholder="Contoh: XI RPL 1" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-top">
                        <button type="button" class="btn btn-outline-secondary btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm px-3">Simpan Siswa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Data Siswa -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-bottom bg-light">
                    <h2 class="modal-title h6 fw-bold text-dark mb-0" id="modalEditLabel">Edit Data Siswa</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form id="formEditSiswa" action="" method="POST">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="edit_nis" class="form-label small fw-medium">NIS</label>
                            <input type="number" name="nis" id="edit_nis" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama" class="form-label small fw-medium">Nama Lengkap</label>
                            <input type="text" name="nama" id="edit_nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_kelas" class="form-label small fw-medium">Kelas</label>
                            <input type="text" name="kelas" id="edit_kelas" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-top">
                        <button type="button" class="btn btn-outline-secondary btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm px-3">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CDN JS Bootstrap 5 & SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert2 Toast
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        // Flash message handling
        <?php if (session()->getFlashdata('success')) : ?>
            Toast.fire({
                icon: 'success',
                title: '<?= session()->getFlashdata('success'); ?>'
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                html: '<?= session()->getFlashdata('error'); ?>'
            });
        <?php endif; ?>

        // Fungsi filter untuk custom styled dropdowns
        function setFilter(field, value) {
            if (field === 'kelas') {
                document.getElementById('inputFilterKelas').value = value;
            } else if (field === 'sort') {
                document.getElementById('inputFilterSort').value = value;
            }
            document.getElementById('filterForm').submit();
        }

        // Reusable Modal Edit Setup
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const id    = this.getAttribute('data-id');
                const nis   = this.getAttribute('data-nis');
                const nama  = this.getAttribute('data-nama');
                const kelas = this.getAttribute('data-kelas');

                document.getElementById('edit_nis').value   = nis;
                document.getElementById('edit_nama').value  = nama;
                document.getElementById('edit_kelas').value = kelas;
                document.getElementById('formEditSiswa').action = '<?= base_url('home/edit/'); ?>' + id;
            });
        });

        // Konfirmasi Hapus Data
        document.querySelectorAll('.btn-hapus').forEach(btn => {
            btn.addEventListener('click', function() {
                const id   = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');

                Swal.fire({
                    title: 'Hapus data siswa?',
                    text: `Apakah kamu yakin ingin menghapus data "${nama}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '<?= base_url('home/hapus/'); ?>' + id;
                    }
                });
            });
        });

        // Script untuk Inline Editing (dengan Validasi NIS Unik)
        document.querySelectorAll('.editable-cell').forEach(cell => {
            let originalValue = '';

            // Simpan nilai awal saat sel diklik/difokuskan
            cell.addEventListener('focus', function() {
                originalValue = this.innerText.trim();
            });

            // Jika tekan tombol Enter, simpan perubahan
            cell.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.blur();
                }
            });

            // Saat kursor keluar dari sel (blur), kirim data baru ke server
            cell.addEventListener('blur', function() {
                const newValue = this.innerText.trim();
                const id    = this.getAttribute('data-id');
                const field = this.getAttribute('data-field');

                if (newValue !== originalValue && newValue !== '') {
                    const formData = new FormData();
                    formData.append('id', id);
                    formData.append('field', field);
                    formData.append('value', newValue);

                    fetch('<?= base_url('home/updateInline'); ?>', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json().then(data => ({ ok: response.ok, data })))
                    .then(res => {
                        if (res.ok && res.data.status === 'success') {
                            this.style.backgroundColor = '#d1e7dd';
                            setTimeout(() => {
                                this.style.backgroundColor = '';
                            }, 800);
                            originalValue = newValue;

                            // Update data atribut tombol edit jika ada
                            const editBtn = document.querySelector(`.btn-edit[data-id="${id}"]`);
                            if (editBtn) {
                                editBtn.setAttribute(`data-${field}`, newValue);
                            }

                            Toast.fire({
                                icon: 'success',
                                title: res.data.message || 'Perubahan disimpan'
                            });
                        } else {
                            // GAGAL (Contoh: NIS double / error server):
                            this.style.backgroundColor = '#f8d7da';
                            setTimeout(() => {
                                this.style.backgroundColor = '';
                            }, 800);
                            this.innerText = originalValue;

                            Toast.fire({
                                icon: 'error',
                                title: res.data.message || 'Gagal menyimpan perubahan!'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        this.innerText = originalValue;
                    });
                } else if (newValue === '') {
                    this.innerText = originalValue;
                }
            });
        });
    </script>
</body>
</html>