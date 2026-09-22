@props([
    'label',
    'name',
    'type' => 'text',
    'placeholder' => '',
    'autocomplete' => null,
    'wrapperClass' => '',
])

<label class="grid gap-2 text-sm font-semibold text-white {{ $wrapperClass }}">
    <span>{{ $label }}</span>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        @if ($type !== 'password') value="{{ old($name) }}" @endif
        @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
        required
        {{ $attributes->merge(['class' => 'w-full rounded-xl border border-white/20 bg-white px-4 py-3.5 font-normal text-ink-900 outline-none transition placeholder:text-stone-400 focus:ring-4 focus:ring-white/20']) }}
    >
    @error($name)
        <span class="text-xs font-medium text-[#ffe1e7]">{{ $message }}</span>
    @enderror
</label>
