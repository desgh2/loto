<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Добавить запись') }}
        </h2>
    </x-slot>
    <script src="{{ asset('/js/ckeditor/ckeditor.js') }}" type="text/javascript" charset="utf-8" ></script>
    <div class="container">
        <div class="row">
            <div class="bg-white mt-5 mb-3 p-3 col-12">
                <a href="{{ url()->previous() }}" class="btn btn-primary mb-3">Назад</a>
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <form class="row" action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="col-9">
                        @csrf
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">Название</label>
                            <input type="text" name="name" id="name" class="form-control fg-input" value="{{ old('name') }}" placeholder="Введите название">
                        </div>
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="title">Заголовок (title)</label>
                            <input type="text" name="title" id="title" class="form-control fg-input" value="{{ old('title') }}" placeholder="Заголовок (title)">
                        </div>
                        <div class="form-group @error('description') has-error @enderror">
                            <label for="description">Описание (description)</label>
                            <textarea name="description" id="description" class="form-control fg-input" rows="3" placeholder="Описание (description)">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group @error('heading') has-error @enderror">
                            <label for="heading">Заголовок (H1)</label>
                            <input type="text" name="heading" id="heading" class="form-control fg-input" value="{{ old('heading') }}" placeholder="Заголовок (H1)">
                        </div>
                        <div class="form-group @error('text') has-error @enderror">
                            <label for="text">Контент</label>
                            <textarea name="text" id="text" class="form-control fg-input" rows="3" placeholder="Описание (Контент)">{{ old('text') }}</textarea>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="image">Изображение постера <font color="red">*</font></label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
                            @error('image')<div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Добавить</button>
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
