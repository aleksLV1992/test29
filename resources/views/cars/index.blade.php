@extends('layouts.app')

@section('title', 'Список автомобилей')

@section('content')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="container">
        <h2>Автомобили</h2>
        <a href="{{ route('cars.create') }}" class="btn btn-primary mb-3">Добавить автомобиль</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Марка</th>
                <th>Модель</th>
                <th>Год</th>
                <th>Пробег</th>
                <th>Цвет</th>
                <th>Владелец</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car['brand']['name'] }}</td>
                    <td>{{ $car['carModel']['name'] }}</td>
                    <td>{{ $car['year'] ?? '—' }}</td>
                    <td>{{ number_format($car['mileage'] ?? 0, 0, '', ' ') }} км</td>
                    <td>{{ $car['color'] ?? '—' }}</td>
                    <td>
                        @if($car['user'])
                            <strong>{{ $car['user']['name'] }}</strong><br>
                            <small>{{ $car['user']['email'] }}</small>
                        @else
                            <em>Нет владельца</em>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('cars.edit', $car['id']) }}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{ route('cars.destroy', $car['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить автомобиль?')">
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
