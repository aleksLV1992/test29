@extends('layouts.app')

@section('title', 'Добавить автомобиль')

@section('content')
    <div class="container">
        <h2>Добавить автомобиль</h2>
        <a href="{{ route('cars.index') }}" class="btn btn-secondary mb-3">Назад</a>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cars.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Марка</label>
                <select name="brand_id" class="form-control" required onchange="filterModels()">
                    <option value="">Выберите марку</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand['id'] }}">{{ $brand['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Модель</label>
                <select name="car_model_id" id="modelSelect" class="form-control" required>
                    <option value="">Сначала выберите марку</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Год выпуска</label>
                <input type="number" name="year" class="form-control" min="1900" max="2025" value="{{ old('year') }}">
            </div>

            <div class="mb-3">
                <label>Пробег (км)</label>
                <input type="number" name="mileage" class="form-control" min="0" value="{{ old('mileage') }}">
            </div>

            <div class="mb-3">
                <label>Цвет</label>
                <input type="text" name="color" class="form-control" value="{{ old('color') }}">
            </div>

            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>

    <script>
        const modelsData = @json($models);

        function filterModels() {
            const brandId = document.querySelector('select[name="brand_id"]').value;
            const modelSelect = document.getElementById('modelSelect');
            modelSelect.innerHTML = '<option value="">Загрузка моделей...</option>';

            if (!brandId) return;

            const filtered = modelsData.filter(m => m.brand.id == brandId);
            modelSelect.innerHTML = '<option value="">Выберите модель</option>';
            filtered.forEach(m => {
                const option = document.createElement('option');
                option.value = m.id;
                option.textContent = m.name;
                modelSelect.appendChild(option);
            });
        }
    </script>
@endsection
