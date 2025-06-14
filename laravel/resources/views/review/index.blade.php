<x-app-layout>
    @foreach($reviews as $review)
        <p>
            {{ $review }}
        </p>
    @endforeach
</x-app-layout>