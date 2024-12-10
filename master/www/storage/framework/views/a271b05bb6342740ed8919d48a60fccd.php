<a href="<?php echo e(route('category', $category->id)); ?>"
   style="<?php echo e($category->img ? "background-image: url('$category->img')" : "background: var(--accent-hover-color)"); ?>"
   class="home-grid__item">
    <div class="home-grid__item-label"><?php echo e($category->name); ?></div>
</a><?php /**PATH /var/www/app/resources/views/components/category-card.blade.php ENDPATH**/ ?>