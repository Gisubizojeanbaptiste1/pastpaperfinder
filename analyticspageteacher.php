<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Dashboard | Past Paper Finder</title>
  <link rel="stylesheet" href="analyticspageforteacher.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
  <div class="teacher-dashboard">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Past Paper Finder</h2>
      <nav>
        <a href="teacherDashboard.php" class="active"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
        <a href="uploadsteacher.php"><i class="fa fa-upload"></i> Upload Past Papers</a>
        <a href="managepastpaperteacher.php"><i class="fa fa-folder"></i> Manage Papers</a>
        <a href="analyticspageteacher.php"><i class="fa fa-chart-line"></i> Analytics</a>
        <a href="communicate.php"><i class="fa fa-comments"></i> Communicate</a>
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main>
    <section>
      <div class="chart-container" id="bar_chart"></div>
      <div class="chart-container" id="pie_chart"></div>
      <div class="chart-container" id="line_chart"></div>
      <div class="chart-container" id="area_chart"></div>
      <div class="chart-container" id="scatter_chart"></div>
    </section>
  </main>

  </div>

  <script>
    // Function to show the input for 'Other' class
    function checkClassSelection() {
        var classSelection = document.getElementById("classselection").value;
        var classOtherInput = document.getElementById("classOtherInput");

        if (classSelection === "other") {
            classOtherInput.style.display = "block";
        } else {
            classOtherInput.style.display = "none";
        }
    }

    // Function to show the input for 'Other' category
    function checkCategory() {
        var categorySelection = document.getElementById("category").value;
        var categoryOtherInput = document.getElementById("categoryOtherInput");

        if (categorySelection === "other") {
            categoryOtherInput.style.display = "block";
        } else {
            categoryOtherInput.style.display = "none"; 
        }
    }
</script>
<script type="text/javascript">
    // Load the Google Charts library
    google.charts.load('current', {
      packages: ['corechart', 'bar', 'pie', 'line', 'area', 'scatter']
    });

    google.charts.setOnLoadCallback(drawCharts);

    // Function to draw the charts
    function drawCharts() {
      // Bar Chart
      var barData = google.visualization.arrayToDataTable([
        ['Category', 'Quantity'],
        ['Drugs', 200],
        ['Books', 150],
        ['Supplies', 100],
        ['Equipments', 50]
      ]);
      var barOptions = {
        title: 'Category Quantities',
        chartArea: { width: '50%' },
        hAxis: { title: 'Quantity', minValue: 0 },
        vAxis: { title: 'Category' }
      };
      var barChart = new google.visualization.BarChart(document.getElementById('bar_chart'));
      barChart.draw(barData, barOptions);

      // Pie Chart
      var pieData = google.visualization.arrayToDataTable([
        ['Category', 'Percentage'],
        ['Electronics', 45],
        ['Clothing', 30],
        ['Home Appliances', 15],
        ['Books', 10]
      ]);
      var pieOptions = {
        title: 'Product Categories Distribution',
        is3D: true
      };
      var pieChart = new google.visualization.PieChart(document.getElementById('pie_chart'));
      pieChart.draw(pieData, pieOptions);

      // Line Chart
      var lineData = new google.visualization.DataTable();
      lineData.addColumn('number', 'Month');
      lineData.addColumn('number', 'Sales');
      lineData.addRows([
        [1, 100],
        [2, 120],
        [3, 140],
        [4, 160],
        [5, 180],
        [6, 200]
      ]);
      var lineOptions = {
        title: 'Sales Trends',
        curveType: 'function',
        legend: { position: 'bottom' }
      };
      var lineChart = new google.visualization.LineChart(document.getElementById('line_chart'));
      lineChart.draw(lineData, lineOptions);

      // Area Chart
      var areaData = google.visualization.arrayToDataTable([
        ['Month', 'Product A', 'Product B'],
        ['January', 30, 40],
        ['February', 40, 50],
        ['March', 50, 60],
        ['April', 60, 70],
        ['May', 70, 80]
      ]);
      var areaOptions = {
        title: 'Product Sales Comparison',
        isStacked: true
      };
      var areaChart = new google.visualization.AreaChart(document.getElementById('area_chart'));
      areaChart.draw(areaData, areaOptions);

      // Scatter Chart
      var scatterData = new google.visualization.DataTable();
      scatterData.addColumn('number', 'X');
      scatterData.addColumn('number', 'Y');
      scatterData.addRows([
        [1, 2],
        [2, 4],
        [3, 6],
        [4, 8],
        [5, 10]
      ]);
      var scatterOptions = {
        title: 'Data Correlation',
        hAxis: { title: 'X Value' },
        vAxis: { title: 'Y Value' },
        legend: 'none'
      };
      var scatterChart = new google.visualization.ScatterChart(document.getElementById('scatter_chart'));
      scatterChart.draw(scatterData, scatterOptions);
    }
  </script>
</body>
</html>
