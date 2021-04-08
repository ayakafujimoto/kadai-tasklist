@extends('layouts.app')

@section('content')

    <h1>メッセージ一覧</h1>

    @if (count($task) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>メッセージ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($task as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    @foreach ($task as $task)
    <tr>
        {{-- メッセージ詳細ページへのリンク --}}
        <td>{!! link_to_route('tasks.show', $task->id, ['task' => $task->id]) !!}</td>
        <td>{{ $message->content }}</td>
    </tr>
    @endforeach
@endsection