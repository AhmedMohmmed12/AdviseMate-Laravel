@extends('layouts.HeadStudent')
@section('name')
    <div class="container">
        <x-sidebar>
            
        </x-sidebar>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
    </div>
</body>
</html>
@endsection