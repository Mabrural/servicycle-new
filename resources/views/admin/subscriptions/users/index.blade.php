@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card card-rounded">
                <div class="card-body">

                    <h4 class="card-title card-title-dash">Status Langganan</h4>

                    {{-- FILTER --}}
                    <form class="row g-2 mb-3 mt-2" method="GET">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Cari user..."
                                value="{{ request('search') }}">
                        </div>

                        <div class="col-md-2">
                            <select name="per_page" class="form-select">
                                @foreach ([10, 15, 20, 50, 100] as $size)
                                    <option value="{{ $size }}"
                                        {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                        {{ $size }} / halaman
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 d-flex gap-2">
                            <button class="btn btn-primary">Cari</button>
                            <a href="{{ route('admin.subscriptions.users.index') }}" class="btn btn-secondary ">
                                Reset
                            </a>
                        </div>
                    </form>

                    {{-- TABLE --}}
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th width="60">No</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Harga</th>
                                    <th>Diskon</th>
                                    <th>Berakhir</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $index => $user)
                                    <tr>
                                        {{-- NOMOR DINAMIS --}}
                                        <td>
                                            {{ $users->firstItem() + $index }}
                                        </td>

                                        <td>{{ $user->name }}</td>

                                        <td>
                                            <span class="badge bg-primary">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>

                                        <td>
                                            @if ($user->subscription && $user->subscription->isActive())
                                                <span class="badge bg-success">PRO</span>
                                            @else
                                                <span class="badge bg-secondary">FREE</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->subscription && $user->subscription->price)
                                                Rp {{ number_format($user->subscription->price, 0, ',', '.') }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            @if ($user->subscription && $user->subscription->discount)
                                                {{ $user->subscription->discount }}%
                                            @else
                                                -
                                            @endif
                                        </td>


                                        <td>
                                            {{ $user->subscription?->end_at?->format('d M Y') ?? '-' }}
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.subscriptions.users.edit', $user) }}"
                                                class="btn btn-warning btn-sm">
                                                Kelola
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">
                                            Tidak ada data
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINATION --}}
                    @if ($users->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            <nav>
                                <ul class="pagination custom-pagination">
                                    {{-- PREV --}}
                                    <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $users->previousPageUrl() }}">&laquo;</a>
                                    </li>

                                    {{-- PAGES --}}
                                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    {{-- NEXT --}}
                                    <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $users->nextPageUrl() }}">&raquo;</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- CUSTOM PAGINATION STYLE --}}
    <style>
        .custom-pagination .page-link {
            border-radius: 8px;
            margin: 0 4px;
            color: #6c757d;
            border: 1px solid #dee2e6;
        }

        .custom-pagination .page-item.active .page-link {
            background-color: #4B49AC;
            border-color: #4B49AC;
            color: #fff;
        }

        .custom-pagination .page-link:hover {
            background-color: #e9ecef;
        }

        .custom-pagination .page-item.disabled .page-link {
            opacity: .5;
        }
    </style>
@endsection
