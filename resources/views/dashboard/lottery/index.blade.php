<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Лотереи') }}
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
                    <div class="col-2">
                        <a href="{{ route('lottery.add') }}" class="btn btn-primary">Добавить лотереи</a>
                    </div>
                    @if ($lottery->count() > 0)
                    <div class="col-3">
                        <a href="{{ route('lottery.refresh_all') }}" class="btn btn-primary">Обновить все лотереи</a>
                    </div>
                    @endif 
                </div>
                @if ($lottery->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Логотип</th>
                            <th>Валюта</th>
                            <th>Джекпот</th>
                            <th>Рейтинг</th>
                            <th>Дата розыграша</th>
                            <th style="width: 10%;">Количество результатов</th>
                            <th>Публикация</th>
                            <th style="width: 10%;">Обновить информацию</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($lottery as $loto)
                        <tr>
                            <td>{{ $loto->id }}</td>
                            <td>{{ $loto->name }}</td>
                            <td><img src="{{ asset($loto->image) }}" width="60px" alt=""></td>
                            <td>{{ $loto->currency }}</td>
                            <td>{{ $loto->jackpot }}</td>
                            <td>{{ $loto->rating }}</td>
                            <td>{{ date('d.m.Y', $loto->close_date) }}</td>
                            <td>{{ $loto->results->count() }}</td>
                            <td>
                                <form action="{{ route('lottery.status', ['lottery' => $loto->id]) }}" method="POST">
                                    @csrf
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status-{{ $loto->id }}" name="status" onchange="this.form.submit();" {{ $loto->published ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status-{{ $loto->id }}"></label>
                                    </div>
                                </form>
                            </td>
                            <td><a href="{{ url('dashboard/lottery/'.$loto->id.'/refresh/') }}" class="btn btn-success">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-counterclockwise" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/><path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/></svg>
                            </a></td>
                            <td><a href="{{ route('lottery.edit', ['lottery' => $loto->id]) }}" class="btn btn-warning">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/></svg>
                            </a></td>
                            <td>
                                <form action="{{ route('lottery.destroy', ['lottery' => $loto->id]) }}" method="POST">
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
                {{ $lottery->links() }}
                @else
                <h2>Список лотерей пуст.</h2>   
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
