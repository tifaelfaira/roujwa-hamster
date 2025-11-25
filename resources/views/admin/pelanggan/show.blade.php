@extends('layouts.admin.app')

@section('content')
    {{-- START MAIN CONTENT --}}
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Pelanggan</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Detail Pelanggan</h1>
                <p class="mb-0">Informasi lengkap data pelanggan</p>
            </div>
            <div>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!! session('success') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {!! session('error') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-user me-2"></i>Informasi Pelanggan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="35%">Nama Lengkap</th>
                                    <td>{{ $pelanggan->first_name }} {{ $pelanggan->last_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $pelanggan->email }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td>{{ $pelanggan->phone ?: '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="35%">Tanggal Lahir</th>
                                    <td>{{ $pelanggan->birthday ? \Carbon\Carbon::parse($pelanggan->birthday)->format('d/m/Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>
                                        <span class="badge bg-{{ $pelanggan->gender == 'Male' ? 'primary' : ($pelanggan->gender == 'Female' ? 'success' : 'warning') }} fs-6">
                                            {{ $pelanggan->gender }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="mt-4 action-buttons-horizontal">
                        <a href="{{ route('pelanggan.edit', $pelanggan->pelanggan_id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i> Edit Data Pelanggan
                        </a>
                        <form action="{{ route('pelanggan.destroy', $pelanggan->pelanggan_id) }}" 
                              method="POST" 
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                <i class="fas fa-trash me-1"></i> Hapus Pelanggan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MULTIPLE FILE UPLOAD SECTION --}}
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-file-upload me-2"></i>File Pendukung
                    </h5>
                </div>
                <div class="card-body">
                    {{-- FORM UPLOAD --}}
                    <div class="mb-4">
                        <h6 class="mb-3">
                            <i class="fas fa-cloud-upload-alt me-1"></i>Upload File Pendukung
                        </h6>
                        <form method="POST" action="{{ route('pelanggan.upload') }}" enctype="multipart/form-data" class="mb-4">
                            @csrf
                            <input type="hidden" name="ref_table" value="pelanggan">
                            <input type="hidden" name="ref_id" value="{{ $pelanggan->pelanggan_id }}">
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="filename" class="form-label">Pilih File (Multiple)</label>
                                        <input type="file" class="form-control" name="filename[]" multiple required 
                                               accept=".doc,.docx,.pdf,.jpg,.jpeg,.png">
                                        <div class="form-text">
                                            Format file: doc, docx, pdf, jpg, jpeg, png. Maksimal 2MB per file.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-upload me-1"></i> Upload File
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- DAFTAR FILE --}}
                    <h6 class="mb-3">
                        <i class="fas fa-files me-1"></i>File yang sudah diupload
                    </h6>
                    @if($files->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="40%">Nama File</th>
                                        <th width="20%">Tipe File</th>
                                        <th width="20%">Tanggal Upload</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($files as $index => $file)
                                        @php
                                            $fileExtension = strtolower(pathinfo($file->filename, PATHINFO_EXTENSION));
                                            $filePath = 'multiple_uploads/' . $file->filename;
                                            $fileExists = Storage::disk('public')->exists($filePath);
                                            $fileUrl = $fileExists ? Storage::url($filePath) : null;
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']) && $fileExists)
                                                        <img src="{{ $fileUrl }}" 
                                                             alt="{{ $file->filename }}" 
                                                             width="40" 
                                                             height="40" 
                                                             class="rounded me-2 object-fit-cover"
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                        <div class="file-icon me-2" style="display: none;">
                                                            <i class="fas fa-file-image text-primary fa-2x"></i>
                                                        </div>
                                                    @else
                                                        <div class="file-icon me-2">
                                                            <i class="fas fa-file-{{ $fileExtension == 'pdf' ? 'pdf' : ($fileExtension == 'doc' || $fileExtension == 'docx' ? 'word' : 'alt') }} text-primary fa-2x"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="fw-bold">{{ $file->filename }}</div>
                                                        <small class="text-muted">
                                                            @if($fileExists)
                                                                {{ round(Storage::disk('public')->size($filePath) / 1024, 2) }} KB
                                                            @else
                                                                File tidak ditemukan
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary text-uppercase">{{ $fileExtension }}</span>
                                            </td>
                                            <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <div class="action-buttons-horizontal">
                                                    @if($fileExists)
                                                        <a href="{{ $fileUrl }}" 
                                                           target="_blank" 
                                                           class="btn btn-info btn-sm"
                                                           download>
                                                            <i class="fas fa-download me-1"></i> Download
                                                        </a>
                                                        <a href="{{ $fileUrl }}" 
                                                           target="_blank" 
                                                           class="btn btn-primary btn-sm">
                                                            <i class="fas fa-eye me-1"></i> Lihat
                                                        </a>
                                                    @endif
                                                    <form action="{{ route('pelanggan.deleteFile', $file->id) }}" 
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Hapus file {{ $file->filename }}?')">
                                                            <i class="fas fa-trash me-1"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada file yang diupload.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- END MAIN CONTENT --}}

    <style>
        .object-fit-cover {
            object-fit: cover;
        }
        .file-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .action-buttons-horizontal {
            display: flex;
            gap: 5px;
            justify-content: center;
        }
        .action-buttons-horizontal .btn {
            white-space: nowrap;
            padding: 6px 8px;
            font-size: 0.75rem;
        }
        .table th {
            font-weight: 600;
        }
        .card-header {
            border-bottom: none;
        }
    </style>
@endsection