@extends('layouts.app')
@section('title', 'Team Ranking')

@section('style')
    <style>
        body {
            background-color: #f4f4f4;
            /* Warna latar belakang yang lembut */
        }

        .card {
            border: 1px solid #4d4dff;
            /* Warna border yang sesuai dengan logo */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #1f1f7a;
            /* Warna header yang sesuai dengan logo */
            color: white;
        }

        .card-body {
            background-color: #ffffff;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table thead th {
            background-color: #1f1f7a;
            /* Warna header tabel */
            color: white;
        }

        .table-bordered {
            border-color: #4d4dff;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #4d4dff;
        }

        .text-center {
            text-align: center;
        }

        .ranking-title {
            color: #4d4dff;
        }

        .empty-row {
            color: #a1a1a1;
        }

        .top-rank {
            background-color: #e0f7fa;
            /* Warna latar belakang untuk peringkat 1-5 */
        }

        .timer {
            font-size: 4rem;
            /* Memperbesar ukuran font timer */
            margin-bottom: 1rem;
        }

        .btn-custom {
            background-color: #4d4dff;
            border-color: #4d4dff;
            color: white;
        }
    </style>
@endsection

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4 class="ranking-title text-white">Team Rank</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div id="timer" class="timer">30:00:000</div>
                            <button id="start-timer" class="btn btn-custom">Start</button>
                            <button id="stop-timer" class="btn btn-warning">Stop</button>
                            <button id="reset-timer" class="btn btn-secondary">Reset</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Kavling</th>
                                        <th>Bu Dwina</th>
                                        <th>Pak Gandung</th>
                                        <th>Pak Saiful</th>
                                        <th>Pak Fajar</th>
                                        <th>Bu Farah</th>
                                        <th>Panitia</th>
                                        <th>Hasil Nilai</th>
                                    </tr>
                                </thead>
                                <tbody id="ranking-table">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let timer;
        const timerDisplay = document.getElementById('timer');
        const startButton = document.getElementById('start-timer');
        const stopButton = document.getElementById('stop-timer');
        const resetButton = document.getElementById('reset-timer');
        const initialTime = 30 * 60 * 1000; // 30 minutes in milliseconds
        let timeLeft = initialTime;

        function updateTimerDisplay() {
            const minutes = Math.floor(timeLeft / 60000);
            const seconds = Math.floor((timeLeft % 60000) / 1000);
            const milliseconds = timeLeft % 1000;
            timerDisplay.textContent =
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}:${milliseconds.toString().padStart(3, '0')}`;
        }

        function startTimer() {
            if (timer) return;

            const startTime = Date.now();
            timer = setInterval(() => {
                const elapsedTime = Date.now() - startTime;
                timeLeft = initialTime - elapsedTime;

                if (timeLeft > 0) {
                    updateTimerDisplay();
                } else {
                    clearInterval(timer);
                    timer = null;
                    timeLeft = 0;
                    updateTimerDisplay();
                }
            }, 10);
        }

        function stopTimer() {
            clearInterval(timer);
            timer = null;
        }

        function resetTimer() {
            clearInterval(timer);
            timer = null;
            timeLeft = initialTime;
            updateTimerDisplay();
        }

        startButton.addEventListener('click', startTimer);
        stopButton.addEventListener('click', stopTimer);
        resetButton.addEventListener('click', resetTimer);
        });
    </script>
@endsection
