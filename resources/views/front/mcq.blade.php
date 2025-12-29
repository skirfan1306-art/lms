@extends('front.layout.app')

@section('title')
Home
@endsection

@section('main') 

 

    <style>
      

        .exam-card {
            border-radius: 16px;
            border: none;
        }

        .question-box {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        }

        .option-label {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 18px;
            border-radius: 10px;
            border: 2px solid #e9ecef;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 12px;
        }

        .option-label:hover {
            background: #f4f7ff;
            border-color: #0d6efd;
        }

        input[type="radio"] {
            display: none;
        }

        input[type="radio"]:checked + .option-label {
            background: #e8f0ff;
            border-color: #0d6efd;
        }

        .option-badge {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #0d6efd;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            flex-shrink: 0;
        }

        .question-title {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .submit-btn {
            padding: 12px 40px;
            font-size: 18px;
            border-radius: 30px;
        }

        .progress {
            height: 8px;
            border-radius: 10px;
        }
    </style>
 

<div class="container my-5">
    <div class="card exam-card shadow">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h4 class="mb-1">Online MCQ Test</h4>
            <small>Answer all 10 questions</small>
        </div>

        <div class="card-body">
 
            <form>

                <!-- Question 1 -->
                <div class="question-box">
                    <div class="question-title">
                        1. What does HTML stand for?
                    </div>
                    <div class="row">
                        <div class="col-6">
                    <input type="radio" name="q1" id="q1a">
                    <label class="option-label" for="q1a">
                        <div class="option-badge">A</div>
                        Hyper Text Markup Language
                    </label>
                    </div>

                    <div class="col-6">
                    <input type="radio" name="q1" id="q1b">
                    <label class="option-label" for="q1b">
                        <div class="option-badge">B</div>
                        High Text Machine Language
                    </label>
                    </div>
                        
                    <div class="col-6">
                    <input type="radio" name="q1" id="q1c">
                    <label class="option-label" for="q1c">
                        <div class="option-badge">C</div>
                        Hyperlinks Text Mark Language
                    </label>
                    </div>
                        
                    <div class="col-6">
                    <input type="radio" name="q1" id="q1d">
                    <label class="option-label" for="q1d">
                        <div class="option-badge">D</div>
                        None of the above
                    </label>
                    </div>
                    
                </div>
                </div>

                <!-- Question 2 -->
                <div class="question-box">
                    <div class="question-title">
                        2. Which language is used for styling web pages?
                    </div>

                    <input type="radio" name="q2" id="q2a">
                    <label class="option-label" for="q2a">
                        <div class="option-badge">A</div>
                        HTML
                    </label>

                    <input type="radio" name="q2" id="q2b">
                    <label class="option-label" for="q2b">
                        <div class="option-badge">B</div>
                        CSS
                    </label>

                    <input type="radio" name="q2" id="q2c">
                    <label class="option-label" for="q2c">
                        <div class="option-badge">C</div>
                        PHP
                    </label>

                    <input type="radio" name="q2" id="q2d">
                    <label class="option-label" for="q2d">
                        <div class="option-badge">D</div>
                        Python
                    </label>
                </div>

                <!-- Submit -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success submit-btn">
                        Submit Exam
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
 
    </main>
 
@endsection