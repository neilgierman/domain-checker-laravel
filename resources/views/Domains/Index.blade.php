@extends('Layouts.App')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Example </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="/domains/create" title="Create a domain"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Domain Name</th>
            <th>Delivered Count</th>
            <th>Bounced Count</th>
            <th>Date Created</th>
            <th>Date Updated</th>
            <th>Actions</th>
        </tr>
        @foreach ($domains as $domain)
            <tr>
                <td>{{ $domain->id }}</td>
                <td>{{ $domain->domainName }}</td>
                <td>{{ $domain->deliveredCount }}</td>
                <td>{{ $domain->bouncedCount }}</td>
                <td>{{ $domain->created_at }}</td>
                <td>{{ $domain->updated_at }}</td>
                <td>
                    <form action="/domains/{{ $domain->id }}" method="POST">

                        <a href="/domains/{{ $domain->id }}" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="/domains/{{ $domain->id}}/edit">
                            <i class="fas fa-edit  fa-lg"></i>
                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $domains->links() !!}

@endsection
