@extends('backend.layout.master')

@push('meta-title')
    Riho - Category Section
@endpush

@push('add-css')

@endpush


@section('body-content')

{{-- Breadcrumb section --}}
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
            <h4>Category Tables</h4>
            </div>
            
            <div class="col-6"> 
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">                                       
                            <svg style="color: #FFF;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1); "><path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"></path></svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Category</li>
                </ol>
            </div>
        </div>
    </div>

</div>

@endsection


@push('add-js')
    
@endpush