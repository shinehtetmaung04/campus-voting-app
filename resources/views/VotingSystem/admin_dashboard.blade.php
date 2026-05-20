<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="main">
    <div class="header"><img src="Images/logo.png" alt="Logo" width="70px">University of Computer Studies(Thaton)</div>

    <div class="dashboard">
        <!-- King Voting -->
        <div class="card">
            <h3>King Voting Result</h3>
            <canvas id="kingChart"></canvas>
        </div>

        <!-- Queen Voting -->
        <div class="card">
            <h3>Queen Voting Result</h3>
            <canvas id="queenChart"></canvas>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Pass the PHP data to JavaScript
    const kingVotes = @json($kingVotes);
    const kingLabels = @json($kingLabels);
    const queenVotes = @json($queenVotes);
    const queenLabels = @json($queenLabels);

    // Get canvas elements
    const kingCanvas = document.getElementById('kingChart');
    const queenCanvas = document.getElementById('queenChart');

    let kingChart, queenChart;

    // Function to generate gradient colors
    function generateColors(baseColor, count) {
        const colors = [];
        for (let i = 0; i < count; i++) {
            const opacity = 0.6 + (i / (count * 2));
            colors.push(baseColor.replace('OPACITY', opacity));
        }
        return colors;
    }

    // Function to shuffle the array and its corresponding votes
    function shuffleData(labels, votes) {
        const shuffledLabels = [...labels];
        const shuffledVotes = [...votes];

        for (let i = shuffledLabels.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [shuffledLabels[i], shuffledLabels[j]] = [shuffledLabels[j], shuffledLabels[i]];
            [shuffledVotes[i], shuffledVotes[j]] = [shuffledVotes[j], shuffledVotes[i]];
        }

        return { shuffledLabels, shuffledVotes };
    }

    // Function to update King chart
    // Function to update King chart
function updateKingChart(kingVotes) {
    // Destroy the previous chart and redraw it with the new data
    if (kingChart) {
        kingChart.destroy();
    }

    kingChart = new Chart(kingCanvas, {
        type: 'bar',
        data: {
            labels: Array(kingVotes.length).fill(''),  // Empty labels to hide names
            datasets: [{
                label: 'Numbers of Vote',
                data: kingVotes,  // Use the shuffled kingVotes
                backgroundColor: generateColors('rgba(59, 130, 246, OPACITY)', kingVotes.length)
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            scales: {
                y: { ticks: { display: true } },
                x: {
                    beginAtZero: true,
                    title: { display: true, text: 'Numbers of Vote' }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        // Show only the vote count (no name)
                        label: function(tooltipItem) {
                            return `Votes: ${tooltipItem.raw}`;  // Display only the vote count
                        }
                    }
                }
            }
        }
    });
}

// Function to update Queen chart
function updateQueenChart(queenVotes) {
    // Destroy the previous chart and redraw it with the new data
    if (queenChart) {
        queenChart.destroy();
    }

    queenChart = new Chart(queenCanvas, {
        type: 'bar',
        data: {
            labels: Array(queenVotes.length).fill(''),  // Empty labels to hide names
            datasets: [{
                label: 'Numbers of Vote',
                data: queenVotes,  // Use the shuffled queenVotes
                backgroundColor: generateColors('rgba(236, 72, 153, OPACITY)', queenVotes.length)
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            scales: {
                y: { ticks: { display: true } },
                x: {
                    beginAtZero: true,
                    title: { display: true, text: 'Numbers of Vote' }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        // Show only the vote count (no name)
                        label: function(tooltipItem) {
                            return `Votes: ${tooltipItem.raw}`;  // Display only the vote count
                        }
                    }
                }
            }
        }
    });
}


    // Initial chart render
    updateKingChart(kingVotes, kingLabels);
    updateQueenChart(queenVotes, queenLabels);

    // Shuffle data and update charts every 10 seconds
    setInterval(() => {
        // Shuffle the data for King and Queen charts
        const { shuffledLabels: shuffledKingLabels, shuffledVotes: shuffledKingVotes } = shuffleData(kingLabels, kingVotes);
        const { shuffledLabels: shuffledQueenLabels, shuffledVotes: shuffledQueenVotes } = shuffleData(queenLabels, queenVotes);

        // Update the charts with shuffled data
        updateKingChart(shuffledKingVotes, shuffledKingLabels);
        updateQueenChart(shuffledQueenVotes, shuffledQueenLabels);
    }, 10000); // Shuffle every 10 seconds
});
</script>

</body>
</html>
