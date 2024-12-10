<?php

namespace App\Http\Controllers;

use App\Models\MasterClass;
use App\Models\Category;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterClassController extends Controller
{
    /**
     * Отображение формы создания мастер-класса.
     *
     */
    public function create()
    {
        return $this->form(new MasterClass());
    }

    /**
     * Сохранение нового мастер-класса.
     *
     */
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        // Проверка на занятость слота
        $slotTaken = MasterClass::where('date', $data['date'])
            ->where('time', $data['time'])
            ->exists();

        if ($slotTaken) {
            return redirect()->back()->withErrors(['time' => 'Выбранная дата и время уже заняты.']);
        }

        $data['user_id'] = Auth::id();
        MasterClass::create($data);

        return redirect()->route('cabinet')->with('success', 'Мастер-класс успешно создан!');
    }

    /**
     * Отображение формы редактирования мастер-класса.
     *
     */
    public function edit($id)
    {
        $masterClass = $this->findOwnedMasterClass($id);
        return $this->form($masterClass);
    }

    /**
     * Отмена записи.
     *
     */
    public function cancelRegister($id)
    {
        // Найти регистрацию
        $registration = Auth::user()->registrations()->findOrFail($id);

        // Удалить запись
        $registration->delete();

        return redirect()->route('cabinet')->with('success', 'Вы успешно отменили запись на мастер-класс.');
    }

    /**
     * Получение занятых временных слотов на указанную дату.
     *
     */
    public function getUnavailableSlots(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
        ]);

        // Получаем все занятые временные слоты для указанной даты
        $unavailableSlots = MasterClass::where('date', $request->input('date'))
            ->pluck('time');

        return response()->json($unavailableSlots);
    }

    /**
     * Обновление мастер-класса.
     *
     */
    public function update(Request $request, $id)
    {
        $masterClass = $this->findOwnedMasterClass($id);

        $data = $request->validate([
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $masterClass->update($data);

        return redirect()->route('cabinet')->with('success', 'Описание и стоимость мастер-класса успешно обновлены!');
    }

    /**
     * Удаление мастер-класса.
     *
     */
    public function destroy($id)
    {
        $masterClass = $this->findOwnedMasterClass($id);
        $masterClass->delete();

        return redirect()->route('cabinet')->with('success', 'Мастер-класс успешно удалён!');
    }

    /**
     * Запись на мастер-класс.
     *
     */
    public function register($id)
    {
        // Найти мастер-класс
        $masterClass = MasterClass::with('registrations')->findOrFail($id);

        // Проверить, доступен ли мастер-класс
        if (!$masterClass->isAvailable()) {
            return redirect()->back()->withErrors(['error' => 'Мастер-класс недоступен для записи.']);
        }

        // Проверить, не записан ли пользователь ранее
        $alreadyRegistered = $masterClass->registrations()
            ->where('user_id', Auth::id())
            ->exists();

        if ($alreadyRegistered) {
            return redirect()->back()->withErrors(['error' => 'Вы уже записаны на этот мастер-класс.']);
        }

        // Записать пользователя
        Registration::create([
            'master_class_id' => $masterClass->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('category', ['id' => $masterClass->category_id])
            ->with('success', 'Вы успешно записались на мастер-класс.');
    }

    /**
     * Отображение формы создания/редактирования мастер-класса.
     *
     */
    protected function form(MasterClass $masterClass)
    {
        $categories = Category::all();

        $unavailableSlots = MasterClass::where('date', $masterClass->date)
            ->where('id', '!=', $masterClass->id) // Исключаем текущий мастер-класс при редактировании
            ->pluck('time');

        return view('forms.master-class', compact('masterClass', 'categories', 'unavailableSlots'));
    }

    /**
     * Поиск мастер-класса, принадлежащего текущему пользователю.
     *
     */
    protected function findOwnedMasterClass($id)
    {
        $masterClass = MasterClass::findOrFail($id);

        if ($masterClass->user_id !== Auth::id()) {
            abort(403, 'У вас нет прав на выполнение этого действия.');
        }

        return $masterClass;
    }

    /**
     * Валидация запроса.
     *
     */
    protected function validateRequest(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after_or_equal:today',
            'time' => [
                'required',
                'in:9-11,11-13,13-15,15-17', // Допустимые значения
            ],
            'group_size' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('masterclass_images', 'public');
        }

        return $validated;
    }
}
