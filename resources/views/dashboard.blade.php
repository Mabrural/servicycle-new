@extends('layouts.main')

@section('container')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-tab">
                        @if ($showAlert)
                            <div class="col-lg-12 mt-2">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Perhatian!</strong> Bengkel Anda sedang dalam proses peninjauan
                                    (maks. 1×24 jam). Untuk mempercepat verifikasi, lengkapi profil bengkel Anda
                                    <a href="{{ route('profile.mitra') }}">di sini</a>.
                                </div>
                            </div>
                        @endif

                        {{-- Tampilan berdasarkan role --}}
                        @auth
                            @if (auth()->user()->role == 'admin')
                                @include('dashboard.admin')
                            @elseif(auth()->user()->role == 'mitra')
                                @include('dashboard.mitra')
                            @elseif(auth()->user()->role == 'customer')
                                @include('dashboard.customer')
                            @endif
                        @endauth

                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('layouts.footer')
        <!-- partial -->
    </div>
@endsection
