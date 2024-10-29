<h1>Your Pending Tasks</h1>
<ul>
    @foreach($tasks as $task)
        <li>{{ $task['title'] }} - Due: {{ $task['due_date'] }}</li>
    @endforeach
</ul>
