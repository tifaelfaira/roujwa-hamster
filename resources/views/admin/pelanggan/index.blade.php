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
                <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Data Pelanggan</h1>
                <p class="mb-0">List data seluruh pelanggan</p>
            </div>
            <div>
                <a href="{{ route('pelanggan.create') }}" class="btn btn-success text-white">
                    <i class="fas fa-plus me-1"></i>
                    Tambah Pelanggan
                </a>
            </div>
        </div>
    </div>

    <div class="row">
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

        <div class="col-12 mb-4">
            <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    {{-- FORM FILTER DAN SEARCH --}}
                    <form method="GET" action="{{ route('pelanggan.index') }}" class="mb-4">
                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <label for="gender" class="form-label">Filter Gender</label>
                                <select name="gender" class="form-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ request('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="search" class="form-label">Search</label>
                                <div class="input-group">
                                    <input type="text" 
                                           name="search" 
                                           class="form-control" 
                                           value="{{ request('search') }}" 
                                           placeholder="Search nama atau email..." 
                                           aria-label="Search">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    @if(request('search'))
                                        <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary ms-2">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-filter me-1"></i> Terapkan
                                </button>
                                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-refresh me-1"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table id="table-pelanggan" class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0">No</th>
                                    <th class="border-0">Nama Lengkap</th>
                                    <th class="border-0">Email</th>
                                    <th class="border-0">Telepon</th>
                                    <th class="border-0">Gender</th>
                                    <th class="border-0">Tanggal Lahir</th>
                                    <th class="border-0 rounded-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($dataPelanggan->count() > 0)
                                    @foreach ($dataPelanggan as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + ($dataPelanggan->currentPage() - 1) * $dataPelanggan->perPage() }}</td>
                                            <td>
                                                <strong>{{ $item->first_name }} {{ $item->last_name }}</strong>
                                            </td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                <span class="badge bg-{{ $item->gender == 'Male' ? 'primary' : ($item->gender == 'Female' ? 'success' : 'warning') }}">
                                                    {{ $item->gender }}
                                                </span>
                                            </td>
                                            <td>{{ $item->birthday ? \Carbon\Carbon::parse($item->birthday)->format('d/m/Y') : '-' }}</td>
                                            <td>
                                                <div class="action-buttons-horizontal">
                                                    <a href="{{ route('pelanggan.show', $item->pelanggan_id) }}" 
                                                       class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye me-1"></i> Detail
                                                    </a>
                                                    <a href="{{ route('pelanggan.edit', $item->pelanggan_id) }}" 
                                                       class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit me-1"></i> Edit
                                                    </a>
                                                    <form action="{{ route('pelanggan.destroy', $item->pelanggan_id) }}" 
                                                          method="POST" 
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                                            <i class="fas fa-trash me-1"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            @if(request()->has('search') || request()->has('gender'))
                                                Tidak ada data yang sesuai dengan pencarian Anda.
                                            @else
                                                Belum ada data pelanggan.
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- PAGINATION --}}
                    <div class="mt-3">
                        {{ $dataPelanggan->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END MAIN CONTENT --}}

    <style>
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
            background-color: #f8f9fa;
        }
    </style>
@endsection