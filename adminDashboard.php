<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard | Past Paper Finder</title>
    <link rel="stylesheet" href="adminDashboard.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
  </head>
  <body>
    <div class="admin-dashboard">
      <!-- Sidebar -->
      <aside class="sidebar">
        <h2>Past Paper Finder</h2>
        <nav>
          <a href="#" class="active"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
          <a href="#users"><i class="fa fa-users"></i> Manage Users</a>
          <a href="#analytics"><i class="fa fa-chart-line"></i> Analytics</a>
          <a href="#moderate"><i class="fa fa-check-circle"></i> Moderate Content</a>
          <a href="#reports"><i class="fa fa-file-alt"></i> Reports</a>
          <a href="#settings"><i class="fa fa-cogs"></i> Settings</a>
          <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </nav>
      </aside>

      <!-- Main Content -->
      <main>
        <!-- Welcome Section -->
        <section class="welcome">
          <h1>Welcome, Admin</h1>
          <p>
            Manage the system, analyze data, and moderate content efficiently.
          </p>
        </section>

        <!-- Analytics Section -->
        <section id="analytics" class="analytics">
          <h2>System Analytics</h2>
          <div class="stats">
            <div class="stat-card">
              <h3>Total Papers</h3>
              <p>1,234</p>
            </div>
            <div class="stat-card">
              <h3>Total Downloads</h3>
              <p>10,456</p>
            </div>
            <div class="stat-card">
              <h3>Active Users</h3>
              <p>543</p>
            </div>
          </div>
        </section>

        <!-- User Management Section -->
        <section id="users" class="users">
          <h2>Manage Users</h2>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Dynamically populated via PHP -->
            </tbody>
          </table>
        </section>

        <!-- Moderate Content Section -->
        <section id="moderate" class="moderate">
          <h2>Moderate Content</h2>
          <div class="moderation">
            <p>Approve or reject uploaded papers from teachers.</p>
            <button class="btn">Approve</button>
            <button class="btn">Reject</button>
          </div>
        </section>

        <!-- Reports Section -->
        <section id="reports" class="reports">
          <h2>Reports</h2>
          <form method="GET" action="generate_report.php">
            <label for="timeframe">Select Timeframe:</label>
            <select name="timeframe" id="timeframe">
              <option value="weekly">Weekly</option>
              <option value="monthly">Monthly</option>
              <option value="yearly">Yearly</option>
            </select>
            <button type="submit">Generate Report</button>
          </form>
        </section>
      </main>
    </div>

    <script src="script-admin.js"></script>
  </body>
</html>
