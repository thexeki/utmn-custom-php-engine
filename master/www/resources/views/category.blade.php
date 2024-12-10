@extends("layouts.main")

@section('header', $category->name)

@section('main')
    <div class="category">
        <h1 class="category__title">{{ $category->name }}</h1>
        <div class="row--small grid between">
            <div class="category__content">
                <img src="{{ $category->img ? asset('storage/' . $category->img) : '/logo.svg' }}"
                     alt="Иллюстрация {{ $category->name }}">
                <p>{{ $category->description }}</p>
            </div>
            <h3 class="category__more">Другие категории:</h3>
            <div class="category__grid">
                @foreach($otherCategories as $cat)
                    <x-category-card :category="$cat"></x-category-card>
                @endforeach
            </div>
        </div>

        <div class="row shedule">
            <div class="row--small">
                <h2>Расписание</h2>
                @error('error')
                <div class="error-message">{{ $message }}</div>
                @enderror
                @if (session('success'))
                    <div class="complete-message">{{ session('success') }}</div>
                @endif
                <div class="drivers">
                    @forelse($masterClasses as $masterClass)
                        <x-driver-card :masterClass="$masterClass"></x-driver-card>
                    @empty
                        <p>В этой категории пока нет мастер-классов.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div id="registerModal" class="modal hidden">
        <div class="modal-content">
            <button class="modal-close" id="modalClose">×</button>
            <h2>Подтверждение записи</h2>
            <p><strong>ФИО пользователя:</strong> <span id="userName">{{ Auth::user()->name }}</span></p>
            <p><strong>Вид творчества:</strong> <span id="categoryName"></span></p>
            <p><strong>ФИО мастера:</strong> <span id="teacherName"></span></p>
            <p><strong>Дата:</strong> <span id="masterClassDate"></span></p>
            <p><strong>Время:</strong> <span id="masterClassTime"></span></p>
            <form method="POST" id="registerForm">
                @csrf
                <button type="submit" class="btn confirm-btn">Подтвердить</button>
                <button type="button" class="btn cancel-btn" id="cancelBtn">Отменить</button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const registerButtons = document.querySelectorAll('.driver-btn');
            const modal = document.getElementById('registerModal');
            const modalClose = document.getElementById('modalClose');
            const cancelBtn = document.getElementById('cancelBtn');
            const categoryName = document.getElementById('categoryName');
            const teacherName = document.getElementById('teacherName');
            const masterClassDate = document.getElementById('masterClassDate');
            const masterClassTime = document.getElementById('masterClassTime');
            const registerForm = document.getElementById('registerForm');

            registerButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();

                    const masterClassData = JSON.parse(button.dataset.masterClass);
                    categoryName.textContent = masterClassData.category_name;
                    teacherName.textContent = masterClassData.teacher_name;
                    masterClassDate.textContent = masterClassData.date;
                    masterClassTime.textContent = masterClassData.time;

                    registerForm.action = `/register/${masterClassData.id}`;
                    modal.classList.remove('hidden');
                });
            });

            modalClose.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            cancelBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
        });
    </script>
@endsection

