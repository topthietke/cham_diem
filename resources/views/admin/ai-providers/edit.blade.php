@extends('layouts.admin')

@section('title', 'Sửa AI')

@section('content')
<h1 class="h4 fw-bold mb-4">Sửa {{ $aiProvider->name }}</h1>
<div class="card-soft p-4 p-md-5" style="max-width: 560px">
    <form method="POST" action="{{ route('admin.ai-providers.update', $aiProvider) }}">
        @method('PUT')
        @include('admin.ai-providers._form')
    </form>
</div>
@endsection
