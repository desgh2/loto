<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Баннеры') }}
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
                        <a href="{{ route('banner.create') }}" class="btn btn-primary">Добавить баннер</a>
                    </div>
                </div>
                @if ($banner->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Название лотереи</th>
                            <th>Название баннера</th>
                            <th>Размер</th>
                            <th>Тип</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($banner as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->lottery->name }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->size }}</td>
                            <td>{{ $row->type() }}</td>
                            <td><a href="{{ route('banner.edit', ['banner' => $row->id]) }}" class="btn btn-warning">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/></svg>
                            </a></td>
                            <td>
                                <form action="{{ route('banner.destroy', ['banner' => $row->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить баннер?');">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <h2>Список баннеров пуст.</h2>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
