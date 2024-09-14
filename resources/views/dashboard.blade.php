<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .dashboard-header {
        text-align: center;
        margin-bottom: 30px;
        }
        .info-card {
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .info-card h4, .info-card h6 {
            margin: 0;
        }
        .alignement {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }
        .chart-container {
            width: 40%;
            margin: 3% 0% 5% 3%;
        }
        .co {
            background-color: rgb(137, 210, 255);
        }
        .table td, .table th {
            vertical-align: middle;
            border-left: 1px solid black;
            border-right: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-header">
            <h2>Dashboard</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="info-card bg-light">
                    <h4>Number of users : <span class="text-primary">{{ $nb_users }}</span></h4>
                    <h6>Number of admins : <span class="text-success">{{ $nb_admin }}</span></h6>
                    <h6>Number of simple users : <span class="text-warning">{{ $nb_user }}</span></h6>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-card bg-light">
                    <h5>Number of technologies : <span class="text-danger"> {{ $nb_tech }} </span></h5>
                    <h5>Number of projects : <span class="text-success"> {{ $nb_project }} </span></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="alignement">
        <div class="chart-container">
            <canvas id="notesChart"></canvas>
        </div>
        <div class="chart-container" style="margin-right: 6%;">
            <canvas id="techsChart"></canvas>
        </div>
    </div>

    <div class="chart-container" style="width: 60%; margin: 3% auto 10%;">
        <canvas id="projectsChart"></canvas>
    </div>

    <table class="table" style="width: 75%; margin: 3% auto 10%;">
        <thead class="thead-dark">
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">User Name</th>
                <th class="text-center" scope="col">Total Notes</th>
                <th class="text-center" scope="col">Notes</th>
                <th class="text-center" scope="col">Best Note</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($userNotes as $name => $user)
                <tr class="{{ $user['total_notes'] == 0 ? 'table-danger' : 'table-success' }}">
                    <th class="text-center" scope="row">{{ $i }}</th>
                    <td class="text-center">{{ $name }}</td>
                    <td class="text-center">{{ $user['total_notes'] }}</td>
                    <td class="text-center">
                        @if ($user['total_notes'] == 0)
                            Unavailable
                        @else
                            @foreach ($user['notes'] as $note)
                                {{ $note['note'] }}/5 en {{ $note['tech_name'] }}<br>
                            @endforeach
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($user['total_notes'] == 0)
                            Unavailable
                        @else
                            {{ $user['max_note'] }}/5 en {{ $user['max_note_name'] }}
                        @endif
                    </td>
                </tr>
                @php $i++; @endphp
            @endforeach
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            var ctxNotes = document.getElementById('notesChart').getContext('2d');
            var notesChart = new Chart(ctxNotes, {
                type: 'bar',
                data: {
                    labels: ['1/5', '2/5', '3/5', '4/5', '5/5'],
                    datasets: [{
                        label: 'Nombre de notes',
                        data: [
                            {{ $notesCount[1] ?? 0 }},
                            {{ $notesCount[2] ?? 0 }},
                            {{ $notesCount[3] ?? 0 }},
                            {{ $notesCount[4] ?? 0 }},
                            {{ $notesCount[5] ?? 0 }}
                        ],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Notes Distribution',
                            font: {
                                size: 18
                            },
                            padding: {
                                top: 10,
                                bottom: 15
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            var ctxTechs = document.getElementById('techsChart').getContext('2d');
            var notesData = {!! json_encode($techCount) !!};
            var labels = Object.keys(notesData);
            var data = Object.values(notesData);

            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            var backgroundColors = labels.map(() => getRandomColor());
            var borderColors = backgroundColors.map(color => color.replace(/0.2\)$/, '1)'));

            var techsChart = new Chart(ctxTechs, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of notes',
                        data: data,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Distribution of Notes by Technology',
                            font: {
                                size: 18
                            },
                            padding: {
                                top: 10,
                                bottom: 15
                            }
                        }
                    }
                }
            });

            var ctxProjects = document.getElementById('projectsChart').getContext('2d');
            var projectDurations = {!! json_encode($projectDurations) !!};
            var projectLabels = projectDurations.map(project => project.name);
            var projectData = projectDurations.map(project => project.total_duration);

            var projectsChart = new Chart(ctxProjects, {
                type: 'bar',
                data: {
                    labels: projectLabels,
                    datasets: [{
                        label: 'Total Duration',
                        data: projectData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Total Duration by Project',
                            font: {
                                size: 18
                            },
                            padding: {
                                top: 10,
                                bottom: 15
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value.toFixed(2);
                                },
                                stepSize: 0.25
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
