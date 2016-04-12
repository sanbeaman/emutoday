@extends('admin.layouts.master')

@section('title', 'View Pages')

@section('content')
    <a href="{{ route('admin.pages.create') }}" class="button">Create New Page</a>

    <table class="hover">
        <thead>
            <tr>
                <th>id</th>
                <th>template</th>
                <th>uri</th>
                <th>start date</th>
                <th>end date</th>
                <th>is active</th>
                <th>updated at</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
                <tr>
                    <td><a href="{{ route('admin.page.show', $page->id) }}">{{ $page->id }}</a></td>
                    <td>{{ $page->template }}</td>
                    <td>{{ $page->uri }}</td>
                    <td>{{ $page->start_date }}</td>
                    <td>{{ $page->end_date }}</td>
                    <td>{{ $page->updated_at}}</td>
                    <td>
                        <a href="{{ route('admin.page.edit', $story->id) }}">
                            <i class="fi-pencil"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.page.confirm', $story->id) }}">
                            <i class="fi-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
