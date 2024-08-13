<div class="flex items-center">
    @for($i = 1; $i <= 5; $i++)
        <input
            type="radio"
            id="star{{ $i }}"
            name="rating"
            value="{{ $i }}"
            class="hidden"
            @if($i == old('rating', $rating)) checked @endif
            aria-label="Rate {{ $i }} stars"
        />
        <label for="star{{ $i }}" class="cursor-pointer">
            <svg
                class="w-14 h-14 {{ $i <= old('rating', $rating) ? 'text-yellow-400' : 'text-gray-300' }}"
                fill="currentColor"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
                role="img"
                aria-hidden="true"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5l1.9 3.9 4.3.6-3.1 3 0.7 4.3-3.8-2-3.8 2 0.7-4.3-3.1-3 4.3-0.6L12 4.5z"></path>
            </svg>
        </label>
    @endfor
</div>

@push('scripts')
    <script>
        const ratingInputs = document.querySelectorAll('input[name="rating"]');
        const ratingLabels = document.querySelectorAll('label[for^="star"]');

        ratingInputs.forEach((input) => {
            input.addEventListener('change', (event) => {
                const value = event.target.value;
                ratingLabels.forEach((label, index) => {
                    if (index < value) {
                        label.querySelector('svg').classList.add('text-yellow-400');
                        label.querySelector('svg').classList.remove('text-gray-300');
                    } else {
                        label.querySelector('svg').classList.remove('text-yellow-400');
                        label.querySelector('svg').classList.add('text-gray-300');
                    }
                });
            });
        });
    </script>
@endpush