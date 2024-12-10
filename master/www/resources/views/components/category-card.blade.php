<a href="{{ route('category', $category->id) }}"
   style="{{ $category->img ? "background-image: url('$category->img')" : "background: var(--accent-hover-color)" }}"
   class="home-grid__item">
    <div class="home-grid__item-label">{{ $category->name }}</div>
</a>