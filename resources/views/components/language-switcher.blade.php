<div class="relative w-li6">
    <select onchange="window.location.href = this.value" class="block w-full p-ma3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
        <option value="{{ route('language.switch', 'lv') }}" {{ app()->getLocale() == 'lv' ? 'selected' : '' }}>
            🇱🇻 Latviešu
        </option>
        <option value="{{ route('language.switch', 'en') }}" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>
            🇬🇧 English
        </option>
    </select>
</div>
