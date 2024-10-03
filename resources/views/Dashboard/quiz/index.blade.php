<x-dashboard>
    @section('page_title', 'Manage Quizzes')

    <div class="container mt-5">

        <div class="d-flex justify-content-between">
            <h2>Quizzes List</h2>
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        Filter By Topic
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link  href="{{ route('quiz.index') }}">
                            All
                    </x-dropdown-link>
                    @foreach($topics as $topic)
                            <x-dropdown-link  href="{{ route('quizzes.by_topic.admin', $topic->id) }}">
                                {{ $topic->name }}
                            </x-dropdown-link>
                    @endforeach
                </x-slot>
            </x-dropdown>

        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Time Limit</th>
                    <th>Topic</th>
                    <th>Created By</th>
                    <th>Quiz Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quizzes as $quiz)
                <tr>
                    <td>{{ $quiz->title }}</td>
                    <td>{{ $quiz->description }}</td>
                    <td>{{ $quiz->time_limit }} minutes</td>
                    <td>{{ $quiz->topic->name }}</td>
                    <td>{{ $quiz->creator["name"] }}</td>
                    <td>{{ ucwords(str_replace("_"," ",$quiz->quiz_type)) }}</td>
                    <td class="d-flex justify-content-evenly">
                      @if(auth()->check() && auth()->user()->role=="super_admin"||auth()->user()->id==$quiz->created_by)
                            <a href="{{ route('questions.index', $quiz->id) }}"><i class="fa-regular fa-eye"></i></a>
                            <form action="{{ route('quiz.delete', $quiz->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"><i class=" fa-regular fa-trash-can  text-danger "></i></button>
                            </form>
                        @else
                          <p class="text-secondary">No Action Can Be Took</p>
                      @endif
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-dashboard>

