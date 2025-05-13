<?php
require_once "../../Controllers/host_listingscontroller.php";
require_once "../../vendor/functions.php";
$host_listing=new host_listingscontroller;
session_start();
$name=$_SESSION['admin']['name'];
if(isset($_GET["logout"])){
session_unset();
session_destroy();
header("Location:./admin_login.php");
}
$pending=$host_listing->get_pending_list();
if(isset($_GET['approved'])){
  $id=$_GET['approved'];

$host_listing->update_statues($id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - WanderNest</title>
    <!-- Bootstrap CSS -->
    <link href="../../vendor/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../vendor/css/font-awesome.min.css">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background-color: #f8f9fa;
            width: 250px;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
            transition: 0.3s;
            position: relative;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background-color: #e9ecef;
            color: #0d6efd;
        }
        .sidebar-link i {
            width: 24px;
            margin-right: 10px;
        }
        .stat-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }

        /* Enhanced Notification Badge Styles */
        .notification-badge {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .notification-badge.urgent {
            background: linear-gradient(45deg, #ff6b6b, #ff4757);
            color: white;
            animation: pulse-danger 2s infinite;
        }

        .notification-badge.warning {
            background: linear-gradient(45deg, #ffa502, #ff7f50);
            color: white;
            animation: pulse-warning 2s infinite;
        }

        .sidebar-link:hover .notification-badge {
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        @keyframes pulse-danger {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 82, 82, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(255, 82, 82, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 82, 82, 0);
            }
        }

        @keyframes pulse-warning {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 165, 2, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(255, 165, 2, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 165, 2, 0);
            }
        }

        .notification-counter {
            position: relative;
            display: inline-flex;
            align-items: center;
            margin-left: auto;
        }

        .notification-ripple {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            animation: ripple 1s linear infinite;
            background: inherit;
        }

        @keyframes ripple {
            0% {
                transform: scale(1);
                opacity: 0.4;
            }
            100% {
                transform: scale(2.5);
                opacity: 0;
            }
        }

        .table-responsive {
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .status-badge {
            width: 80px;
            text-align: center;
        }
        .action-buttons .btn {
            padding: 2px 8px;
            font-size: 0.8rem;
        }

        .quick-actions {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }

        .quick-action-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #0d6efd;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .quick-action-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }

        .top-bar {
            background: white;
            padding: 1rem;
            margin-bottom: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .notification-dropdown {
            max-height: 400px;
            overflow-y: auto;
            min-width: 300px;
        }

        .notification-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
            transition: background-color 0.3s;
        }

        .notification-item:hover {
            background-color: #f8f9fa;
        }

        .notification-item.unread {
            background-color: #e7f1ff;
        }

        .activity-timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -22px;
            top: 0;
            height: 100%;
            width: 2px;
            background-color: #dee2e6;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            left: -27px;
            top: 0;
            height: 12px;
            width: 12px;
            border-radius: 50%;
            background-color: #0d6efd;
            border: 2px solid white;
        }

        .timeline-item.success::after {
            background-color: #198754;
        }

        .timeline-item.warning::after {
            background-color: #ffc107;
        }

        .timeline-item.danger::after {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="text-center mb-4">
            <h4>WanderNest</h4>
            <small class="text-muted">Admin Panel</small>
        </div>
        <div class="nav flex-column">
            <a href="#dashboard" class="sidebar-link active" data-bs-toggle="tab">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="#complaints" class="sidebar-link" data-bs-toggle="tab">
                <i class="fas fa-flag"></i> Complaints
                <div class="notification-counter">
                    <!-- <span class="notification-badge urgent">
                        5
                        <span class="notification-ripple"></span>
                    </span> -->
                </div>
            </a>
            <a href="#hosts" class="sidebar-link" data-bs-toggle="tab">
                <i class="fas fa-users"></i> Host Approvals
                <div class="notification-counter">
                    <!-- <span class="notification-badge warning">
                        3
                        <span class="notification-ripple"></span>
                    </span> -->
                </div>
            </a>
            <a href="#users" class="sidebar-link" data-bs-toggle="tab">
                <i class="fas fa-user"></i> Users
            </a>
            <a href="#reports" class="sidebar-link" data-bs-toggle="tab">
                <i class="fas fa-chart-bar"></i> Reports
            </a>
            <a href="#settings" class="sidebar-link" data-bs-toggle="tab">
                <i class="fas fa-cog"></i> Settings
            </a>
<a href="?logout=true" class="sidebar-link text-danger">
    <i class="fas fa-sign-out-alt"></i> Logout
</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="top-bar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="btn btn-light me-2" id="toggleSidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <h4 class="mb-0">Welcome, <?=$name?></h4>
            </div>
            <div class="d-flex align-items-center">
                <div class="dropdown me-3">
                    <button class="btn btn-light position-relative" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                            <span class="visually-hidden">unread notifications</span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end notification-dropdown">
                        <h6 class="dropdown-header">Notifications</h6>
                        <div class="notification-item unread">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-plus text-primary me-2"></i>
                                <div>
                                    <p class="mb-0">New host registration</p>
                                    <small class="text-muted">2 minutes ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="notification-item unread">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-flag text-danger me-2"></i>
                                <div>
                                    <p class="mb-0">New complaint received</p>
                                    <small class="text-muted">10 minutes ago</small>
                                </div>
                            </div>
                        </div>
                        <div class="notification-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <div>
                                    <p class="mb-0">Host approved successfully</p>
                                    <small class="text-muted">1 hour ago</small>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="dropdown-item text-center text-primary">View all notifications</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-light d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                        <!-- <img src="https://randomuser.me/api/portraits/men/1.jpg" class="rounded-circle" width="32" height="32"> -->
                        <span>Admin User</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="./admin_dashboard.php?logout=true"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <!-- Dashboard Tab -->
            <div class="tab-pane fade show active" id="dashboard">
                <h2 class="mb-4">Dashboard Overview</h2>
                
                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card stat-card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Pending Complaints</h5>
                                <h2 class="mb-0">5</h2>
                                <small>Requires attention</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card bg-warning text-dark">
                            <div class="card-body">
                                <h5 class="card-title text-white">Host Approvals</h5>
                                <h2 class="mb-0 text-white">3</h2>
                                <small class="text-white">Waiting for review</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">Active Users</h5>
                                <h2 class="mb-0">1,234</h2>
                                <small>Last 24 hours</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card bg-info text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Hosts</h5>
                                <h2 class="mb-0">456</h2>
                                <small>Verified hosts</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Recent Activity</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Activity</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2 mins ago</td>
                                        <td>New complaint received from John Doe</td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>15 mins ago</td>
                                        <td>Host application submitted by Maria Garcia</td>
                                        <td><span class="badge bg-info">Under Review</span></td>
                                    </tr>
                                    <tr>
                                        <td>1 hour ago</td>
                                        <td>Complaint resolved: ID #1234</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Add before closing main tag -->
                <div class="quick-actions">
                    <button class="quick-action-btn" title="Add New Host" data-bs-toggle="tooltip">
                        <i class="fas fa-user-plus"></i>
                    </button>
                    <button class="quick-action-btn" style="background: #dc3545;" title="Urgent Complaints" data-bs-toggle="tooltip">
                        <i class="fas fa-flag"></i>
                    </button>
                    <button class="quick-action-btn" style="background: #198754;" title="Help" data-bs-toggle="tooltip">
                        <i class="fas fa-question"></i>
                    </button>
                </div>

                <!-- Add to the dashboard tab, after the statistics cards -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Recent Activity Timeline</h5>
                            </div>
                            <div class="card-body">
                                <div class="activity-timeline">
                                    <div class="timeline-item success">
                                        <h6 class="mb-1">Host Application Approved</h6>
                                        <p class="mb-0">Maria Garcia's application was approved</p>
                                        <small class="text-muted">5 minutes ago</small>
                                    </div>
                                    <div class="timeline-item warning">
                                        <h6 class="mb-1">New Host Application</h6>
                                        <p class="mb-0">John Smith submitted a host application</p>
                                        <small class="text-muted">30 minutes ago</small>
                                    </div>
                                    <div class="timeline-item danger">
                                        <h6 class="mb-1">Complaint Received</h6>
                                        <p class="mb-0">New complaint about unresponsive host</p>
                                        <small class="text-muted">1 hour ago</small>
                                    </div>
                                    <div class="timeline-item">
                                        <h6 class="mb-1">System Update</h6>
                                        <p class="mb-0">System maintenance completed</p>
                                        <small class="text-muted">2 hours ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Quick Stats</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Host Approval Rate</span>
                                    <div class="progress" style="width: 60%; height: 6px;">
                                        <div class="progress-bar bg-success" style="width: 85%"></div>
                                    </div>
                                    <span class="ms-2">85%</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Complaint Resolution</span>
                                    <div class="progress" style="width: 60%; height: 6px;">
                                        <div class="progress-bar bg-warning" style="width: 65%"></div>
                                    </div>
                                    <span class="ms-2">65%</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>User Satisfaction</span>
                                    <div class="progress" style="width: 60%; height: 6px;">
                                        <div class="progress-bar bg-info" style="width: 92%"></div>
                                    </div>
                                    <span class="ms-2">92%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Complaints Tab -->
            <div class="tab-pane fade" id="complaints">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Manage Complaints</h2>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-download me-1"></i>Export
                        </button>
                        <button class="btn btn-outline-secondary">
                            <i class="fas fa-print me-1"></i>Print
                        </button>
                    </div>
                </div>

                <!-- Filters -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <select class="form-select">
                            <option value="">All Statuses</option>
                            <option value="new">New</option>
                            <option value="in-review">In Review</option>
                            <option value="resolved">Resolved</option>
                            <option value="invalid">Invalid</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option value="">All Types</option>
                            <option value="host">Host Complaints</option>
                            <option value="listing">Listing Complaints</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search complaints...">
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Complaints Table -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>User</th>
                                <th>Type</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#1234</td>
                                <td>2024-03-15</td>
                                <td>John Doe</td>
                                <td>Host</td>
                                <td>Unresponsive Host</td>
                                <td><span class="badge bg-danger status-badge">New</span></td>
                                <td class="action-buttons">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#complaintModal">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- More complaint rows... -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Host Approvals Tab -->
            <div class="tab-pane fade" id="hosts">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Host Approvals</h2>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-download me-1"></i>Export
                        </button>
                    </div>
                </div>

                <!-- Filters -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <select class="form-select">
                            <option value="">All Statues</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search hosts...">
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Host Applications Table -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Host Name</th>
                                <th>Location</th>
                                <th>Title</th>
                                <th>start_date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <?php foreach($pending as $list):?>
                                <td><?=$list['listing_id']?></td>
                                <td><?=$list['name']?></td>
                                <td><?=$list['country'].$list['city']?></td>
                                <td><?=$list['title']?></td>
                                <td><?=$list['start_date']?></td>
                                <td><span class="badge bg-warning status-badge">Pending</span></td>
                                <td class="action-buttons">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#hostModal">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="../admin/admin_dashboard.php?approved=<?=$list['listing_id']?>"  class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                                <?php endforeach;?>
                            </tr>
                            <!-- More host rows... -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Users Tab -->
            <div class="tab-pane fade" id="users">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>User Management</h2>
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary">
                            <i class="fas fa-user-plus me-1"></i>Add New User
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-download me-1"></i>Export
                        </button>
                    </div>
                </div>

                <!-- Filters -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <select class="form-select">
                            <option value="">All Roles</option>
                            <option value="admin">Admin</option>
                            <option value="host">Host</option>
                            <option value="traveler">Traveler</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search users...">
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Joined Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#1001</td>
                                <td>
                                    <!-- <img src="https://randomuser.me/api/portraits/men/1.jpg" class="rounded-circle me-2" width="30"> -->
                                    John Smith
                                </td>
                                <td>john@example.com</td>
                                <td>Traveler</td>
                                <td>2024-01-15</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td class="action-buttons">
                                    <button class="btn btn-primary btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm" title="Suspend">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>#1002</td>
                                <td>
                                    <!-- <img src="https://randomuser.me/api/portraits/women/1.jpg" class="rounded-circle me-2" width="30"> -->
                                    Sarah Johnson
                                </td>
                                <td>sarah@example.com</td>
                                <td>Host</td>
                                <td>2024-02-20</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td class="action-buttons">
                                    <button class="btn btn-primary btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm" title="Suspend">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Reports Tab -->
            <div class="tab-pane fade" id="reports">
                <h2 class="mb-4">Analytics & Reports</h2>

                <!-- Summary Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h6 class="card-title text-muted">Total Revenue</h6>
                                <h3 class="mb-2">$12,450</h3>
                                <p class="mb-0 text-success">
                                    <i class="fas fa-arrow-up me-1"></i>
                                    <span>18.2%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h6 class="card-title text-muted">New Users</h6>
                                <h3 class="mb-2">245</h3>
                                <p class="mb-0 text-success">
                                    <i class="fas fa-arrow-up me-1"></i>
                                    <span>12.5%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h6 class="card-title text-muted">Active Listings</h6>
                                <h3 class="mb-2">682</h3>
                                <p class="mb-0 text-danger">
                                    <i class="fas fa-arrow-down me-1"></i>
                                    <span>2.4%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h6 class="card-title text-muted">Success Rate</h6>
                                <h3 class="mb-2">94.2%</h3>
                                <p class="mb-0 text-success">
                                    <i class="fas fa-arrow-up me-1"></i>
                                    <span>5.1%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">User Growth</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-placeholder" style="height: 300px; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                                    <p class="text-muted">User Growth Chart</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">User Distribution</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-placeholder" style="height: 300px; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                                    <p class="text-muted">Distribution Pie Chart</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Report Generation -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Generate Reports</h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Report Type</label>
                                <select class="form-select">
                                    <option>User Activity</option>
                                    <option>Financial Summary</option>
                                    <option>Host Performance</option>
                                    <option>Complaint Analysis</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Date Range</label>
                                <select class="form-select">
                                    <option>Last 7 Days</option>
                                    <option>Last 30 Days</option>
                                    <option>Last 3 Months</option>
                                    <option>Custom Range</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Format</label>
                                <select class="form-select">
                                    <option>PDF</option>
                                    <option>Excel</option>
                                    <option>CSV</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-file-export me-1"></i>Generate Report
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Settings Tab -->
            <div class="tab-pane fade" id="settings">
                <h2 class="mb-4">System Settings</h2>

                <!-- General Settings -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">General Settings</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Site Name</label>
                                <input type="text" class="form-control" value="TravelExchange">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Admin Email</label>
                                <input type="email" class="form-control" value="admin@WanderNest.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Time Zone</label>
                                <select class="form-select">
                                    <option>UTC</option>
                                    <option>GMT</option>
                                    <option>EST</option>
                                    <option>PST</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Maintenance Mode</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="maintenanceMode">
                                    <label class="form-check-label" for="maintenanceMode">Enable Maintenance Mode</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Email Settings -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Email Settings</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">SMTP Host</label>
                                <input type="text" class="form-control" value="smtp.example.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">SMTP Port</label>
                                <input type="number" class="form-control" value="587">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">SMTP Username</label>
                                <input type="text" class="form-control" value="smtp_user">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">SMTP Password</label>
                                <input type="password" class="form-control" value="********">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Encryption</label>
                                <select class="form-select">
                                    <option>TLS</option>
                                    <option>SSL</option>
                                    <option>None</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Security Settings</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Password Policy</label>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Require uppercase letters</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Require numbers</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Require special characters</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Minimum Password Length</label>
                                <input type="number" class="form-control" value="8">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Two-Factor Authentication</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="twoFactorAuth">
                                    <label class="form-check-label" for="twoFactorAuth">Require 2FA for admin accounts</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Complaint Detail Modal -->
    <div class="modal fade" id="complaintModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Complaint Details #1234</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Complainant Information</h6>
                            <p><strong>Name:</strong> John Doe</p>
                            <p><strong>Email:</strong> john@example.com</p>
                            <p><strong>Date Submitted:</strong> 2024-03-15</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Complaint Status</h6>
                            <p><strong>Current Status:</strong> <span class="badge bg-danger">New</span></p>
                            <p><strong>Type:</strong> Host Complaint</p>
                            <p><strong>Priority:</strong> High</p>
                        </div>
                    </div>
                    <hr>
                    <h6>Complaint Description</h6>
                    <p>Detailed description of the complaint goes here...</p>
                    <h6>Attached Evidence</h6>
                    <div class="d-flex gap-2">
                        <!-- <img src="https://via.placeholder.com/100" alt="Evidence 1" class="img-thumbnail">
                        <img src="https://via.placeholder.com/100" alt="Evidence 2" class="img-thumbnail"> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Mark as Invalid</button>
                    <button type="button" class="btn btn-success">Resolve Complaint</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Host Detail Modal -->
    <div class="modal fade" id="hostModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Host Application Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Host Information</h6>
                            <p><strong>Name:</strong> Maria Garcia</p>
                            <p><strong>Location:</strong> Barcelona, Spain</p>
                            <p><strong>Type:</strong> Language School</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Application Status</h6>
                            <p><strong>Date Applied:</strong> 2024-03-14</p>
                            <p><strong>Status:</strong> <span class="badge bg-warning">Pending</span></p>
                        </div>
                    </div>
                    <hr>
                    <h6>Description</h6>
                    <p>Detailed description of the host and their offering...</p>
                    <h6>Photos</h6>
                    <div class="d-flex gap-2">
                        <!-- <img src="https://via.placeholder.com/100" alt="Location 1" class="img-thumbnail">
                        <img src="https://via.placeholder.com/100" alt="Location 2" class="img-thumbnail">
                        <img src="https://via.placeholder.com/100" alt="Location 3" class="img-thumbnail"> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Reject</button>
                    <button type="button" class="btn btn-success">Approve</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="../../vendor/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle sidebar navigation
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Handle complaint status changes
        function updateComplaintStatus(complaintId, status) {
            // Implementation for updating complaint status
            console.log(`Updating complaint ${complaintId} to ${status}`);
        }

        // Handle host approval/rejection
        function updateHostStatus(hostId, status) {
            // Implementation for updating host status
            console.log(`Updating host ${hostId} to ${status}`);
        }

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Toggle sidebar
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('expanded');
        });

        // Handle notification clicks
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function() {
                this.classList.remove('unread');
            });
        });
    </script>
</body>
</html> 