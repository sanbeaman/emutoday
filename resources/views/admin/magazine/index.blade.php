@extends('admin.layouts.master')

@section('title', 'View Magazines')

@section('content')
    <a href="{{ route('admin.magazine.create') }}" class="button">Create New Magazine</a>

    <table class="hover">
        <thead>
            <tr>
                <th>id</th>
                <th>year</th>
                <th>season</th>
                <th>title</th>
                <th>start date</th>
                <th>updated at</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($magazines as $magazine)
                <tr>
                    <td><a href="{{ route('admin.magazine.show', $magazine->id) }}">{{ $magazine->id }}</a></td>
                    <td>{{ $magazine->year }}</td>
                    <td>{{ $magazine->season }}</td>
                    <td>{{ $magazine->title }}</td>
                    <td>{{ $magazine->start_date }}</td>
                    <td>{{ $magazine->updated_at}}</td>
                    <td>
                        <a href="{{ route('admin.magazine.edit', $magazine->id) }}">
                            <i class="fi-pencil"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.magazine.confirm', $magazine->id) }}">
                            <i class="fi-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
