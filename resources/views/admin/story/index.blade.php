@extends('admin.layouts.master')

@section('title', 'Story')

@section('content')
    <a href="{{ route('admin_story_setup', ['stype' => 'storybasic']) }}" class="button">Create News Story</a>
    <a href="{{ route('admin_story_setup', ['stype' => 'story']) }}" class="button">Create Promoted Story</a>
    <a href="{{ route('admin_story_setup', ['stype' => 'storyexternal']) }}" class="button">Create External Story</a>

    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Type</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Author</th>
                <th>Start Date</th>
                <th>Featured</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($storys as $story)
                <tr class="{{ $story->present()->publishedHighlight }}">
                    <td>{{ $story->id }}</td>
                    <td>{{ $story->story_folder }}</td>
                    <td>
                        <a href="{{ route('admin.story.show', $story->id) }}">{{ $story->title }}</a>
                    </td>
                    <td>{{ $story->slug }}</td>
                    <td>{{ $story->author->name }}</td>
                    <td>{{ $story->start_date }}</td>
                    <td>{{ $story->is_featured }}</td>
                    <td>
                        <a href="{{ route('admin.story.edit', $story->id) }}">
                            <i class="fi-pencil"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.story.confirm', $story->id) }}">
                            <i class="fi-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $storys->render() !!}
@endsection
