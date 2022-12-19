<x-app>
  <section class="d-flex flex-wrap justify-content-center">
    @foreach ($books as $book)
    <x-book-card :title="$book->title" :image="$book->image" :desc="$book->description" />
    @endforeach
  </section>
</x-app>
