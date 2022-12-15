@props([
'title' => 'Card title',
'desc' => 'Card description'
])

<div class="card m-3" style="width: 18rem;">
	<img src="https://api.lorem.space/image/book?w=150" class="card-img-top" alt="...">
	<div class="card-body">
		<h5 class="card-title">{{$title}}</h5>
		<p class="card-text">{{$desc}}</p>
		<a href="#" class="btn btn-primary">Prestar</a>
	</div>
</div>
