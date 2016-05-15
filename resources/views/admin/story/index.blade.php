@extends('admin.layouts.master')

@section('title', 'Story')

@section('content')
    <a href="{{ route('admin_story_setup', ['stype' => 'storybasic']) }}" class="button">Create News Story</a>
    <a href="{{ route('admin_story_setup', ['stype' => 'story']) }}" class="button">Create Promoted Story</a>
    <a href="{{ route('admin_story_setup', ['stype' => 'storyexternal']) }}" class="button">Create External Story</a>

    <table class="hover">
        <thead>
            <tr>
                <th>id</th>
                <th>Type</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Author</th>
                <th>Published</th>
                <th>Featured</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($storys as $story)
                <tr class="{{ $story->published_highlight }}">
                    <td>{{ $story->id }}</td>
                    <td>{{ $story->story_type }}</td>
                    <td>
                        <a href="{{ route('admin.story.show', $story->id) }}">{{ $story->title }}</a>
                    </td>
                    <td>{{ $story->slug }}</td>
                    <td>{{ $story->author->name }}</td>
                    <td>{{ $story->published_date }}</td>
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
