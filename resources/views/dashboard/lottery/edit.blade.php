<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Редактировать Лотерею') }}
        </h2>
    </x-slot>
    <script src="{{ asset('/js/ckeditor/ckeditor.js') }}" type="text/javascript" charset="utf-8" ></script>
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
                <form class="row" action="{{ route('lottery.update', ['lottery' => $lottery->id]) }}" method="POST" enctype="multipart/form-data">
                    <div class="col-9">
                        @csrf
                        @method('PATCH')
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control fg-input" value="{{ old('title') ? old('title') : $lottery->title }}" placeholder="Введите Title">
                        </div>
                        <div class="form-group @error('description') has-error @enderror">
                            <label for="description">Описание (description)</label>
                            <textarea name="description" id="description" class="form-control fg-input" rows="3" placeholder="Введите Description">{{ old('description') ? old('description') : $lottery->description }}</textarea>
                        </div>
                        <div class="form-group @error('heading') has-error @enderror">
                            <label for="heading">Заголовок (H1)</label>
                            <input type="text" name="heading" id="heading" class="form-control fg-input" value="{{ old('heading') ? old('heading') : $lottery->heading }}" placeholder="Введите заголовок">
                        </div>
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">Название лотереи</label>
                            <input type="text" name="name" id="name" class="form-control fg-input" value="{{ old('name') ? old('name') : $lottery->name }}" placeholder="Введите название лотереи">
                        </div>
                        <div class="form-group @error('slug') has-error @enderror">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control fg-input" value="{{ old('slug') ? old('slug') : $lottery->slug }}" placeholder="Slug">
                        </div>
                        <div class="form-group @error('text') has-error @enderror">
                            <label for="text">Сео текст</label>
                            <textarea name="text" id="text" class="form-control fg-input" rows="3" placeholder="Введите сео текст">{{ old('text') ? old('text') : $lottery->text }}</textarea>
                        </div>
                        <div class="form-group @error('ticket') has-error @enderror">
                            <label for="ticket">Скрипт апи</label>
                            <textarea name="ticket" id="ticket" class="form-control fg-input" rows="3" placeholder="Введите Скрипт апи">{{ old('ticket') ? old('ticket') : $lottery->ticket }}</textarea>
                        </div>
                    </div>
                    <div class="col-3">

                        <div class="form-group">
                            <label for="image">Логотип лотереи <font color="red">*</font></label>
                            <img src="{{ asset($lottery->image) }}" class="img-thumbnail" alt=""><br><br>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
                            @error('image')<div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group @error('country') has-error @enderror">
                            <label for="country">Страна</label>
                            <input type="text" name="country" id="country" class="form-control fg-input" value="{{ old('country') ? old('country') : $lottery->country }}" placeholder="Страна">
                        </div>
                        <div class="form-group @error('rating') has-error @enderror">
                            <label for="rating">Рейтинг</label>
                            <input type="number" min="0" max="10" step="0.1" name="rating" id="rating" class="form-control fg-input" value="{{ old('rating') ? old('rating') : $lottery->rating }}" placeholder="Рейтинг">
                        </div>
                        <div class="form-group @error('currency') has-error @enderror">
                            <label for="currency">Валюта</label>
                            <input type="text" name="currency" id="currency" class="form-control fg-input" value="{{ old('currency') ? old('currency') : $lottery->currency }}" placeholder="Валюта">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="hidden" name="previous" value="{{ $previous }}">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
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
