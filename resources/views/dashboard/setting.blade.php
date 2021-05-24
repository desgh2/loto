<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Настройки сайта') }}
        </h2>
    </x-slot>
    <script src="{{ asset('/js/ckeditor/ckeditor.js') }}" type="text/javascript" charset="utf-8" ></script>
    <div class="container">
        <div class="row">
            <div class="bg-white mt-5 p-3 col-12">
                @if(session('notification'))
                <div class="alert alert-{{ session('notification.class') }}" role="alert">
                    {{ session('notification.message') }}.
                </div>
                @endif
                @if ($setting)
                {{-- Обновление настроек --}}
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('setting.update', ['setting' => $setting->id]) }}" method="POST" class="row">
                    @csrf
                    <div class="col-8">
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control fg-input" value="{{ old('title') ? old('title') : $setting->title }}" placeholder="Title">
                        </div>
                        <div class="form-group @error('description') has-error @enderror">
                            <label for="description">Описание (description)</label>
                            <textarea name="description" id="description" class="form-control fg-input" rows="3" placeholder="Введите Description">{{ old('desription') ? old('desription') : $setting->description }}</textarea>
                        </div>
                        <div class="form-group @error('heading') has-error @enderror">
                            <label for="heading">Заголовок (H1)</label>
                            <input type="text" name="heading" id="heading" class="form-control fg-input" value="{{ old('heading') ? old('heading') : $setting->heading }}" placeholder="Заголовок (H1)">
                        </div>
                        <div class="form-group @error('text') has-error @enderror">
                            <label for="text">Сео текст</label>
                            <textarea name="text" id="text" class="form-control fg-input" rows="3" placeholder="Введите сео текст">{{ old('text') ? old('text') : $setting->text }}</textarea>
                        </div>
                        <div class="form-group @error('lottery_count') has-error @enderror">
                            <label for="lottery_count">Количество записей для лотерей</label>
                            <input type="number" min="1" step="1" name="lottery_count" id="lottery_count" class="form-control fg-input" value="{{ old('lottery_count') ? old('lottery_count') : $setting->lottery_count }}" placeholder="Количество записей для лотерей">
                        </div>
                        <div class="form-group @error('result_count') has-error @enderror">
                            <label for="result_count">Количество записей для результатов</label>
                            <input type="number" min="1" step="1" name="result_count" id="result_count" class="form-control fg-input" value="{{ old('result_count') ? old('result_count') : $setting->result_count }}" placeholder="Количество записей для результатов">
                        </div>
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                    <div class="col-4">
                        <p style="font-size: 20px;font-weight: 700;margin-bottom: 20px;">Контакты</p>
                        <div class="form-group @error('address') has-error @enderror">
                            <label for="address">Адрес</label>
                            <input type="text" name="address" id="address" class="form-control fg-input" value="{{ old('address') ? old('address') : $setting->address }}" placeholder="Адрес">
                        </div>
                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">E-mail</label>
                            <input type="text" name="email" id="email" class="form-control fg-input" value="{{ old('email') ? old('email') : $setting->email }}" placeholder="E-mail">
                        </div>
                        <div class="form-group @error('phone') has-error @enderror">
                            <label for="phone">Телефон</label>
                            <input type="text" name="phone" id="phone" class="form-control fg-input" value="{{ old('phone') ? old('phone') : $setting->phone }}" placeholder="Телефон">
                        </div>
                        <p style="font-size: 20px;font-weight: 700;margin-bottom: 20px;">Рекомендуемые лотереи</p>
                        <div class="widgets-recommend" style="overflow-y: scroll; height: 500px;">
                            <ul>
                            @foreach (App\Models\Lottery::all() as $loto)
                            @php
                                $widget = json_decode($setting->recommend);
                            @endphp
                                <li>
                                    @if (in_array($loto->id, $widget))
                                    <input type="checkbox" id="lt-{{ $loto->id }}" name="recommend[]" value="{{ $loto->id }}" checked>
                                    @else
                                    <input type="checkbox" id="lt-{{ $loto->id }}" name="recommend[]" value="{{ $loto->id }}">
                                    @endif
                                    <label for="lt-{{ $loto->id }}">
                                        <img width="60px" style="display: inline-block; margin: 0 10px;" src="{{ $loto->image }}" alt="">
                                        <span>{{ $loto->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </form>
                @else
                {{-- Добавление настроек --}}
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('setting.store') }}" method="POST" class="row">
                    @csrf
                    <div class="col-8">
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control fg-input" value="{{ old('title') }}" placeholder="Title">
                        </div>
                        <div class="form-group @error('description') has-error @enderror">
                            <label for="description">Описание (description)</label>
                            <textarea name="description" id="description" class="form-control fg-input" rows="3" placeholder="Введите Description">{{ old('desription') }}</textarea>
                        </div>
                        <div class="form-group @error('heading') has-error @enderror">
                            <label for="heading">Заголовок (H1)</label>
                            <input type="text" name="heading" id="heading" class="form-control fg-input" value="{{ old('heading') }}" placeholder="Заголовок (H1)">
                        </div>
                        <div class="form-group @error('text') has-error @enderror">
                            <label for="text">Сео текст</label>
                            <textarea name="text" id="text" class="form-control fg-input" rows="3" placeholder="Введите сео текст">{{ old('text') }}</textarea>
                        </div>
                        <div class="form-group @error('lottery_count') has-error @enderror">
                            <label for="lottery_count">Количество записей для лотерей</label>
                            <input type="number" min="1" step="1" name="lottery_count" id="lottery_count" class="form-control fg-input" value="{{ old('lottery_count') }}" placeholder="Количество записей для лотерей">
                        </div>
                        <div class="form-group @error('result_count') has-error @enderror">
                            <label for="result_count">Количество записей для результатов</label>
                            <input type="number" min="1" step="1" name="result_count" id="result_count" class="form-control fg-input" value="{{ old('result_count') }}" placeholder="Количество записей для результатов">
                        </div>
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                    <div class="col-4">
                        <p style="font-size: 20px;font-weight: 700;margin-bottom: 20px;">Контакты</p>
                        <div class="form-group @error('address') has-error @enderror">
                            <label for="address">Адрес</label>
                            <input type="text" name="address" id="address" class="form-control fg-input" value="{{ old('address') }}" placeholder="Адрес">
                        </div>
                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">E-mail</label>
                            <input type="text" name="email" id="email" class="form-control fg-input" value="{{ old('email') }}" placeholder="E-mail">
                        </div>
                        <div class="form-group @error('phone') has-error @enderror">
                            <label for="phone">Телефон</label>
                            <input type="text" name="phone" id="phone" class="form-control fg-input" value="{{ old('phone') }}" placeholder="Телефон">
                        </div>
                        <p style="font-size: 20px;font-weight: 700;margin-bottom: 20px;">Рекомендуемые лотереи</p>
                        <div class="widgets-recommend" style="overflow-y: scroll; height: 500px;">
                            <ul>
                            @foreach (App\Models\Lottery::all() as $loto)
                                <li>
                                    <input type="checkbox" id="lt-{{ $loto->id }}" name="recommend[]" value="{{ $loto->id }}">
                                    <label for="lt-{{ $loto->id }}">
                                        <img width="60px" style="display: inline-block; margin: 0 10px;" src="{{ $loto->image }}" alt="">
                                        <span>{{ $loto->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
    <script>
        var content_config  = {
            filebrowserUploadUrl: "/dashboard/upload",
            filebrowserUploadMethod: 'form',
            font_defaultLabel: 'Open Sans',
        }
        var text = CKEDITOR.replace( 'text', content_config );
    </script>
</x-app-layout>
