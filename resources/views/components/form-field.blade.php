@props([
    'label',
    'name',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
])

<label class="grid gap-2 text-sm font-semibold text-ink-700">
    <span>{{ $label }} @if ($required)<span class="text-prevanta-600">*</span>@endif</span>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        @if ($type !== 'password') value="{{ old($name) }}" @endif
        @if ($required) required @endif
        {{ $attributes->merge(['class' => 'w-full rounded-xl border border-prevanta-100 bg-[#fcfafb] px-4 py-3 text-sm font-normal text-ink-900 outline-none transition placeholder:text-stone-400 focus:border-prevanta-400 focus:ring-4 focus:ring-prevanta-100/70']) }}
    >
    @error($name)
        <span class="text-xs font-medium text-red-600">{{ $message }}</span>
    @enderror
</label>
