<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn text-white', 'style' => 'background-color:#d8ae7e; border:none;']) }}>
    {{ $slot }}
</button>
