@if($errors->any())
    <div class="Huialert Huialert-error"><i class="Hui-iconfont">&#xe6a6;</i>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

@if(session()->has('error'))
    <div class="Huialert Huialert-danger">
        <i class="Hui-iconfont">&#xe6a6;</i>
        {{ session('error') }}
    </div>
@endif

@if(session()->has('msg'))
    <div class="Huialert Huialert-success">
        <i class="Hui-iconfont">&#xe6a6;</i>
        {{ session('msg') }}
    </div>
@endif