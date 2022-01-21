<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Kategoriler
        </div>
        <ul class="list-group">
            @foreach($categories as $category)
                <li class="list-group-item">
                    <a href="#">{{$category->name}}</a>
                    <span class="badge list-group-item-primary float-right">14</span>
                </li>
            @endforeach
        </ul>
    </div>

</div>
