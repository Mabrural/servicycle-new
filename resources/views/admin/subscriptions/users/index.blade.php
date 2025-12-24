@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card card-rounded">
                <div class="card-body">

                    <h4 class="card-title card-title-dash">User Subscription</h4>

                    <form class="row g-2 mb-3">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Cari user..."
                                value="{{ request('search') }}">
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover">
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
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $users->links() }}

                </div>
            </div>
        </div>
    </div>
@endsection
