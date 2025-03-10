<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Dashboard | Past Paper Finder</title>
  <link rel="stylesheet" href="analyticspageforteacher.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Added Chart.js CDN -->
</head>
<body>
  <div class="teacher-dashboard">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Past Paper Finder</h2>
      <nav>
        <a href="teacherDashboard.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
        <a href="uploadsteacher.php"><i class="fa fa-upload"></i> Upload Past Papers</a>
        <a href="managepastpaperteacher.php"><i class="fa fa-folder"></i> Manage Papers</a>
        <a href="analyticspageteacher.php"class="active"><i class="fa fa-chart-line"></i> Analytics</a>
        <!-- <a href="communicate.php"><i class="fa fa-comments"></i> Communicate</a> -->
        <a href="StudentRequest.php"><i class="fa fa-comments"></i> Student Requests</a>
        <a href="teacherlogout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main>
    <section>
      <canvas class="chart-container" id="bar_chart"></canvas>
      <canvas class="chart-container" id="pie_chart"></canvas>
      <canvas class="chart-container" id="line_chart"></canvas>
      <canvas class="chart-container" id="area_chart"></canvas>
     
    </section>
  </main>

  </div>

  <script>
    // Bar Chart (3D effect simulation using chart.js)
    new Chart(document.getElementById("bar_chart"), {
        type: 'bar',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                label: '3D Bar Chart Example',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            // Simulate 3D effect
            rotation: {
                x: 15,
                y: 15
            }
        }
    });

    // Pie Chart (No 3D effect)
    new Chart(document.getElementById("pie_chart"), {
        type: 'pie',
        data: {
            labels: ['Red', 'Blue', 'Yellow'],
            datasets: [{
                label: 'Pie Chart Example',
                data: [300, 50, 100],
                backgroundColor: ['red', 'blue', 'yellow']
            }]
        },
        options: {
            responsive: true
        }
    });

    // Line Chart (No 3D effect)
    new Chart(document.getElementById("line_chart"), {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Line Chart Example',
                data: [65, 59, 80, 81, 56, 55],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true
        }
    });

    // Area Chart (No 3D effect)
    new Chart(document.getElementById("area_chart"), {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Area Chart Example',
                data: [65, 59, 80, 81, 56, 55],
                fill: true,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true
        }
    });

    // Scatter Chart (Simulating 3D effect using rotation)
    new Chart(document.getElementById("scatter_chart"), {
        type: 'scatter',
        data: {
            datasets: [{
                label: '3D Scatter Chart Example',
                data: [{
                    x: 10,
                    y: 20
                }, {
                    x: 15,
                    y: 35
                }, {
                    x: 25,
                    y: 45
                }, {
                    x: 40,
                    y: 60
                }],
                backgroundColor: 'rgb(75, 192, 192)',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            // 3D-like rotation effect
            rotation: {
                x: 45,
                y: 45
            }
        }
    });
  </script>
</body>
</html>
