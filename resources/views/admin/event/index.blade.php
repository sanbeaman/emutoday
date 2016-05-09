@extends('admin.layouts.master')

@section('title', 'Event')

@section('content')
  <a href="{{ route('admin.event.create') }}" class="button">Create New Event</a>
  <table class="hover">
        <thead>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr class="">
                    <td>{{ $event->id }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->start_date}}</td>
                    <td>{{ $event->end_date }}</td>
                    <td>
                        <a href="{{ route('admin.event.edit', $event->id) }}">
                            <i class="fi-pencil"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.event.confirm', $event->id) }}">
                            <i class="fi-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $events->render() !!}
@endsection
