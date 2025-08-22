@props([
    'question' => '',        // Question text
    'type' => 'single',     // single, multiple, text, true-false
    'options' => [],        // Array of answer options
    'correct' => null,      // Correct answer(s)
    'explanation' => '',    // Explanation for the answer
    'points' => 1,         // Points for correct answer
    'hint' => null,        // Optional hint
    'image' => null,       // Optional question image
    'code' => null,        // Optional code snippet
    'time_limit' => null,  // Time limit in seconds
    'required' => true,    // Whether question is required
    'feedback' => null,    // Instant feedback messages
    'shuffle' => false,    // Whether to shuffle options
    'review_mode' => false // Whether in review mode showing correct answers
])

@php
    $questionId = 'question_' . Str::random(8);

    if ($shuffle && $type !== 'text') {
        $options = collect($options)->shuffle()->all();
    }

    $hasTimeLimit = $time_limit !== null;
    $timeExpired = false;

    $getOptionClass = function($option) use ($correct, $review_mode) {
        if (!$review_mode) return '';

        if (is_array($correct)) {
            return in_array($option, $correct) ? 'is-correct' : 'is-incorrect';
        }

        return $option === $correct ? 'is-correct' : 'is-incorrect';
    };
@endphp

<div class="quiz-question card mb-4" id="{{ $questionId }}">
    <div class="card-body">
        <!-- Question Header -->
        <div class="question-header d-flex justify-content-between align-items-start mb-3">
            <div class="question-text flex-grow-1">
                @if($required)
                    <span class="text-danger">*</span>
                @endif
                <h5 class="mb-0">{{ $question }}</h5>
                @if($points > 1)
                    <small class="text-muted">({{ $points }} points)</small>
                @endif
            </div>

            @if($hasTimeLimit)
                <div class="question-timer ms-3" data-time-limit="{{ $time_limit }}">
                    <div class="timer-display badge bg-primary">
                        <i class="fas fa-clock me-1"></i>
                        <span class="time-remaining">{{ $time_limit }}s</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Question Media -->
        @if($image)
            <div class="question-image mb-3">
                <img src="{{ asset($image) }}"
                     class="img-fluid rounded"
                     alt="Question image">
            </div>
        @endif

        @if($code)
            <div class="question-code mb-3">
                <pre class="language-{{ $code['language'] ?? 'plaintext' }}"><code>{{ $code['content'] }}</code></pre>
            </div>
        @endif

        <!-- Question Options -->
        <div class="question-options mb-3">
            @switch($type)
                @case('single')
                    <div class="list-group">
                        @foreach($options as $option)
                            <label class="list-group-item d-flex align-items-center {{ $getOptionClass($option) }}">
                                <input type="radio"
                                       name="{{ $questionId }}"
                                       value="{{ $option }}"
                                       class="form-check-input me-2"
                                       {{ $review_mode ? 'disabled' : '' }}>
                                {{ $option }}
                                @if($review_mode)
                                    @if($option === $correct)
                                        <i class="fas fa-check text-success ms-auto"></i>
                                    @endif
                                @endif
                            </label>
                        @endforeach
                    </div>
                    @break

                @case('multiple')
                    <div class="list-group">
                        @foreach($options as $option)
                            <label class="list-group-item d-flex align-items-center {{ $getOptionClass($option) }}">
                                <input type="checkbox"
                                       name="{{ $questionId }}[]"
                                       value="{{ $option }}"
                                       class="form-check-input me-2"
                                       {{ $review_mode ? 'disabled' : '' }}>
                                {{ $option }}
                                @if($review_mode && in_array($option, $correct))
                                    <i class="fas fa-check text-success ms-auto"></i>
                                @endif
                            </label>
                        @endforeach
                    </div>
                    @break

                @case('text')
                    <div class="form-group">
                        <textarea class="form-control"
                                  rows="3"
                                  name="{{ $questionId }}"
                                  placeholder="Type your answer here..."
                                  {{ $review_mode ? 'disabled' : '' }}></textarea>
                    </div>
                    @if($review_mode && $correct)
                        <div class="mt-2">
                            <strong>Correct Answer:</strong>
                            <p class="mb-0">{{ $correct }}</p>
                        </div>
                    @endif
                    @break

                @case('true-false')
                    <div class="list-group">
                        @foreach(['True', 'False'] as $option)
                            <label class="list-group-item d-flex align-items-center {{ $getOptionClass($option) }}">
                                <input type="radio"
                                       name="{{ $questionId }}"
                                       value="{{ $option }}"
                                       class="form-check-input me-2"
                                       {{ $review_mode ? 'disabled' : '' }}>
                                {{ $option }}
                                @if($review_mode && $option === $correct)
                                    <i class="fas fa-check text-success ms-auto"></i>
                                @endif
                            </label>
                        @endforeach
                    </div>
                    @break
            @endswitch
        </div>

        <!-- Question Footer -->
        <div class="question-footer">
            @if($hint)
                <div class="question-hint mb-2">
                    <button class="btn btn-link btn-sm text-muted p-0"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#hint-{{ $questionId }}">
                        <i class="fas fa-lightbulb me-1"></i> Show Hint
                    </button>
                    <div class="collapse" id="hint-{{ $questionId }}">
                        <div class="card card-body bg-light mt-2">
                            {{ $hint }}
                        </div>
                    </div>
                </div>
            @endif

            @if($review_mode && $explanation)
                <div class="question-explanation mt-3">
                    <h6 class="mb-2">Explanation:</h6>
                    <div class="card card-body bg-light">
                        {{ $explanation }}
                    </div>
                </div>
            @endif

            @if($feedback)
                <div class="question-feedback mt-3" style="display: none;">
                    <div class="alert alert-success feedback-correct" role="alert" style="display: none;">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ $feedback['correct'] ?? 'Correct!' }}
                    </div>
                    <div class="alert alert-danger feedback-incorrect" role="alert" style="display: none;">
                        <i class="fas fa-times-circle me-2"></i>
                        {{ $feedback['incorrect'] ?? 'Incorrect. Try again!' }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .quiz-question {
        transition: all 0.3s ease;
    }

    .quiz-question .list-group-item {
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .quiz-question .list-group-item:hover {
        background-color: var(--bs-light);
    }

    .quiz-question .list-group-item.is-correct {
        background-color: rgba(var(--bs-success-rgb), 0.1);
        border-color: var(--bs-success);
    }

    .quiz-question .list-group-item.is-incorrect {
        background-color: rgba(var(--bs-danger-rgb), 0.1);
        border-color: var(--bs-danger);
    }

    .quiz-question .question-timer {
        min-width: 80px;
        text-align: center;
    }

    .quiz-question .timer-display.time-warning {
        background-color: var(--bs-warning) !important;
    }

    .quiz-question .timer-display.time-danger {
        background-color: var(--bs-danger) !important;
    }

    .quiz-question .question-image img {
        max-height: 400px;
        object-fit: contain;
    }

    .quiz-question pre {
        background-color: var(--bs-light);
        padding: 1rem;
        border-radius: 0.375rem;
        margin-bottom: 0;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Timer functionality
        document.querySelectorAll('.question-timer').forEach(timer => {
            const timeLimit = parseInt(timer.dataset.timeLimit);
            const display = timer.querySelector('.time-remaining');
            let timeLeft = timeLimit;

            const countdown = setInterval(() => {
                timeLeft--;
                display.textContent = timeLeft + 's';

                // Update timer appearance
                const timerBadge = timer.querySelector('.timer-display');
                if (timeLeft <= 10) {
                    timerBadge.classList.add('time-danger');
                } else if (timeLeft <= 30) {
                    timerBadge.classList.add('time-warning');
                }

                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    const questionEl = timer.closest('.quiz-question');
                    questionEl.classList.add('time-expired');

                    // Disable inputs
                    questionEl.querySelectorAll('input, textarea').forEach(input => {
                        input.disabled = true;
                    });
                }
            }, 1000);
        });

        // Instant feedback functionality
        document.querySelectorAll('.quiz-question input').forEach(input => {
            input.addEventListener('change', function() {
                const question = this.closest('.quiz-question');
                const feedback = question.querySelector('.question-feedback');
                if (!feedback) return;

                const correctFeedback = feedback.querySelector('.feedback-correct');
                const incorrectFeedback = feedback.querySelector('.feedback-incorrect');

                // Show appropriate feedback
                feedback.style.display = 'block';
                if (this.value === question.dataset.correct) {
                    correctFeedback.style.display = 'block';
                    incorrectFeedback.style.display = 'none';
                } else {
                    correctFeedback.style.display = 'none';
                    incorrectFeedback.style.display = 'block';
                }
            });
        });
    });
</script>
@endpush

{{-- Usage Examples:
<!-- Single Choice Question -->
<x-ui.quiz-question
    question="What is Laravel's template engine called?"
    type="single"
    :options="['Blade', 'Twig', 'Smarty', 'Mustache']"
    correct="Blade"
    :points="2"
    hint="It's named after a type of weapon"
    explanation="Blade is Laravel's powerful templating engine that provides convenient shortcuts for common PHP control structures."
/>

<!-- Multiple Choice Question with Image -->
<x-ui.quiz-question
    question="Which of these are valid HTTP methods?"
    type="multiple"
    :options="['GET', 'POST', 'PUT', 'DELETE', 'FETCH']"
    :correct="['GET', 'POST', 'PUT', 'DELETE']"
    image="images/quiz/http-methods.png"
    :feedback="[
        'correct' => 'Great job! You know your HTTP methods.',
        'incorrect' => 'Some of these are not valid HTTP methods.'
    ]"
/>

<!-- Text Answer Question with Code -->
<x-ui.quiz-question
    question="What will be the output of this code?"
    type="text"
    :code="[
        'language' => 'php',
        'content' => 'echo array_sum([1, 2, 3, 4, 5]);'
    ]"
    correct="15"
    :time_limit="60"
/>

<!-- True/False Question in Review Mode -->
<x-ui.quiz-question
    question="Laravel Eloquent models must extend the Model class."
    type="true-false"
    correct="True"
    explanation="All Eloquent models must extend the Illuminate\Database\Eloquent\Model class."
    :review_mode="true"
/>
--}}
