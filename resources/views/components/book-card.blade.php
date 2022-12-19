@props([
'title' => 'Card title',
'desc' => 'Card description',
'image' => null
])

<div class="card m-3" style="width: 18rem;">
  @if($image)
  <img src="/storage/images/{{$image}}" class="card-img-top" alt="...">
  @else
  <img src="https://api.lorem.space/image/book?w=150" class="card-img-top" alt="...">
  @endif
  <div class="card-body">
    <h5 class="card-title">{{$title}}</h5>
    <p class="card-text">{{$desc}}</p>
    <a href="#" class="btn btn-primary">Prestar</a>
  </div>
</div>
