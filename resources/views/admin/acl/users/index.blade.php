@extends('admin.layouts.master')
@section('content')
    
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        @can('username-search')
                        <form class="s7__nav-search-form" action="{{route('username.search')}}" method="GET">
                            <input type="text" name="name" placeholder="Search By Name..." autocomplete="off">
                            <button type="submit"><i data-feather="search"></i></button>
                        </form>
                        @endcan
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-wrap justify-content-end align-items-center">
                        @can('email-search')
                        <form class="s7__nav-search-form" action="{{route('email.search')}}" method="GET">
                            <input type="text" name="email" placeholder="Search By Email..." autocomplete="off">
                            <button type="submit"><i data-feather="search"></i></button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <!-- Adiciona CSS para forçar rolagem horizontal -->
            <style>
                .scrollable-table {
                    display: block;
                    width: 100%;
                    overflow-x: auto;
                    white-space: nowrap;
                }
                .scrollable-table th, .scrollable-table td {
                    min-width: 150px; /* Ajuste conforme necessário */
                }
            </style>
            <div class="scrollable-table">
                <table class="table s7__table">
                    <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Email')}}</th>
                        <th>{{__('Mobile')}}</th>
                        <th>{{__('Balance')}}</th>
                        <th>{{__('Pix Key')}}</th> <!-- Nova coluna para a chave PIX -->
                        <th>{{__('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $key => $data)
                        <tr>
                            <td>{{ $users->firstItem() + $key }}</td>
                            <td>{{ $data->name }}</td>
                            <td><b>{{ $data->email }}</b></td>
                            <td>{{ $data->mobile }}</td>
                            <td>{{ number_format($data->balance, 2) }}</td>
                            <td>{{ $data->chave_pix ?? 'N/A' }}</td> <!-- Exibe a chave PIX ou 'N/A' se estiver vazia -->
                            <td>
                                @can('user-view')
                                <a href="{{ route('user.view', $data->id) }}" class="btn s7__btn-primary btn-sm" title="View"><i class="las la-desktop"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="7">{{__('No Data Found!')}}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="py-4 justify-content-center pagination flex-wrap pagination-rounded-flat pagination-success">
                {{ $users->links() }} 
            </div>
        </div>
    </div>

@endsection
