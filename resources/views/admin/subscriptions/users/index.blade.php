@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card card-rounded">
                <div class="card-body">

                    <h4 class="card-title card-title-dash">Status Langganan</h4>

                    <form class="row g-2 mb-3 mt-2">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Cari user..."
                                value="{{ request('search') }}">
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Berakhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
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
                                        <td colspan="5" class="text-center text-muted">
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
                                    {{-- Previous --}}
                                    <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $users->previousPageUrl() }}">&laquo;</a>
                                    </li>

                                    {{-- Pages --}}
                                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">
                                                {{ $page }}
                                            </a>
                                        </li>
                                    @endforeach

                                    {{-- Next --}}
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

    {{-- CUSTOM CSS (INLINE, DI HALAMAN YANG SAMA) --}}
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
            opacity: 0.5;
        }
    </style>
@endsection
