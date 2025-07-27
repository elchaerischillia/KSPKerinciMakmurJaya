@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-4">FAQ</h2>

        <div class="faq-list mx-auto" style="max-width: 800px;">
            @forelse ($faqs as $faq)
                <div class="faq-item mb-3">
                    <div 
                        class="faq-question fw-bold" 
                        style="cursor: pointer; font-size: 16px; padding: 10px; background-color: #f5f5f5; border-radius: 5px;"
                        onclick="toggleAnswer({{ $loop->index }})"
                    >
                        {{ $faq->pertanyaan }}
                    </div>
                    <div 
                        id="answer-{{ $loop->index }}" 
                        class="faq-answer mt-2" 
                        style="display: none; font-size: 14px; padding: 10px 15px; background-color: #fafafa; border-left: 3px solid #007bff; border-radius: 0 5px 5px 0;"
                    >
                        {{-- Format prosedur pakai list atau <div> --}}
                        {!! nl2br(e($faq->jawaban)) !!}
                    </div>
                </div>
            @empty
                <p class="text-center">Belum ada pertanyaan tersedia.</p>
            @endforelse
        </div>
    </div>

    <script>
        function toggleAnswer(index) {
            const answer = document.getElementById('answer-' + index);
            if (answer.style.display === 'none') {
                answer.style.display = 'block';
            } else {
                answer.style.display = 'none';
            }
        }
    </script>
@endsection
