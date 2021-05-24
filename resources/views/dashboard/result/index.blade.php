<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Результаты лотерей') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="bg-white mt-5 p-3 col-12">
                @if(session('notification'))
                <div class="alert alert-{{ session('notification.class') }}" role="alert">
                    {{ session('notification.message') }}.
                </div>    
                @endif
                <div class="row mb-3">
                    <div class="col-3">
                        <a href="{{ route('result.add') }}" class="btn btn-primary">Получить результаты</a>
                    </div>
                </div>
                @if ($results->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Название лотереи</th>
                            <th>Валюта</th>
                            <th>Джекпот</th>
                            <th>Дата розыграша</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <td>{{ $result->id }}</td>
                            <td>{{ $result->name }}</td>
                            <td>{{ $result->currency }}</td>
                            <td>{{ $result->jackpot }}</td>
                            <td>{{ date('d.m.Y', $result->close_date) }}</td>
                            <td>
                                <form action="{{ route('result.destroy', ['result' => $result->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить лотерею?');">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach    
                    </tbody>
                </table>   
                {{ $results->links() }}
                @else
                <h2>Список результатов розыгрышей пуст.</h2> 
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
