<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Добавить баннер') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="bg-white mt-5 mb-3 p-3 col-12">
                <a href="{{ $previous }}" class="btn btn-primary mb-3">Назад</a>
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <form class="row" action="{{ route('banner.update', ['banner' => $banner->id]) }}" method="POST">
                    <div class="col-9">
                        @csrf
                        @method('PATCH')
                        <div class="form-group @error('loto_id') has-error @enderror">
                            <label for="loto_id">Выберите лотерею</label>
                            <select name="loto_id" id="loto_id" class="form-control">
                                <option value="" disabled selected>Выберите лотерею</option>
                                @foreach ($lottery as $loto)
                                @if ($loto->id == $banner->loto_id)
                                <option value="{{ $loto->id }}" selected>{{ $loto->name }}</option>
                                @else
                                <option value="{{ $loto->id }}">{{ $loto->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">Название баннера</label>
                            <input type="text" name="name" id="name" class="form-control fg-input" value="{{ $banner->name }}" placeholder="Введите название баннера">
                        </div>
                        <div class="form-group @error('size') has-error @enderror">
                            <label for="size">Размер баннера</label>
                            <input type="text" name="size" id="size" class="form-control fg-input" value="{{ $banner->size }}" placeholder="Введите размер баннера">
                        </div>
                        <div class="form-group @error('script') has-error @enderror">
                            <label for="script">Код скрипта</label>
                            <textarea name="script" id="script" class="form-control fg-input" rows="3" placeholder="Введите код скрипта">{{ $banner->script }}</textarea>
                        </div>
                        <div class="form-group @error('type') has-error @enderror">
                            <label for="type">Выберите тип баннера</label>
                            <select name="type" id="type" class="form-control">
                            @foreach ($banner::$types as $key => $value)
                                @if ($key == $banner->type)
                                <option value="{{ $key }}" selected>{{ $value }}</option>
                                @else
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">

                    </div>
                    <div class="col-12">
                        <input type="hidden" name="previous" value="{{ $previous }}">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
