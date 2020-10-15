@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @include('message')


                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModalCenter">
                        Добавить
                    </button>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Тип</th>
                            <th scope="col">Бренд</th>
                            <th scope="col">Название</th>
                            <th scope="col">Серийный номер</th>
                            <th scope="col">Характеристика</th>
                            <th scope="col">Пользователь</th>
                            <th scope="col">QRCODE</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($details->count() > 0)
                            @foreach($details as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index +1 }}</th>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->brand }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->serial_number }}</td>
                                    <td>{{ $item->character }}</td>
                                    <td>{{ $item->user_name }}</td>
                                    <td>
                                        {!! QrCode::generate($item->hash); !!}
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Добавить</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('store') }}" method="post">
                <div class="modal-body">

                        @csrf
                        <div class="form-group">
                            <label for="type">Тип</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="Например планшет">
                        </div>

                        <div class="form-group">
                            <label for="type1">Бренд</label>
                            <input type="text" class="form-control" id="type1" name="brand" placeholder="Samsung">
                        </div>

                        <div class="form-group">
                            <label for="type2">Название</label>
                            <input type="text" class="form-control" id="type2" name="name" placeholder="Samsung ST 321">
                        </div>

                        <div class="form-group">
                            <label for="type3">Серийный номер</label>
                            <input type="text" class="form-control" id="type2"  name="serial_number"  placeholder="123bgb">
                        </div>

                        <div class="form-group">
                            <label for="type4">Характеристика</label>
                            <textarea type="text" class="form-control" id="type4" name="character"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="type3">Пользователь</label>
                            <input type="text" class="form-control" id="type2" name="user_name" placeholder="Иван Иванов">
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <input type="submit" class="btn btn-primary">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush

