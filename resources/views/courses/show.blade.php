<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} - Course Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --info-color: #0dcaf0;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --light-bg: #f8f9fa;
            --dark-text: #212529;
            --muted-text: #6c757d;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), #0a58ca);
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .course-info-card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        
        .module-card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
            overflow: hidden;
        }
        
        .module-header {
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
            border-bottom: 2px solid var(--primary-color);
        }
        
        .content-list {
            background: white;
        }
        
        .content-item {
            padding: 12px 20px;
            border-bottom: 1px solid #e9ecef;
            transition: background-color 0.2s ease;
        }
        
        .content-item:hover {
            background-color: #f8f9fa;
        }
        
        .content-item:last-child {
            border-bottom: none;
        }
        
        .content-type-badge {
            font-size: 0.75rem;
            padding: 4px 8px;
            border-radius: 12px;
        }
        
        .badge-video { background-color: #dc3545; }
        .badge-document { background-color: #0dcaf0; }
        .badge-quiz { background-color: #198754; }
        .badge-link { background-color: #ffc107; color: #000; }
        
        .video-url-section {
            background: linear-gradient(45deg, #fff3cd, #ffeaa7);
            border-left: 4px solid var(--warning-color);
        }
        
        .action-buttons {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .btn-custom {
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .btn-custom:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .stats-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <!-- Page Header -->
        <div class="page-header p-4 mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-2">{{ $course->title }}</h1>
                    <p class="mb-0 opacity-90">
                        <i class="bi bi-book me-2"></i>Course Details & Content Overview
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('courses.index') }}" class="btn btn-light btn-custom">
                        <i class="bi bi-arrow-left me-2"></i>Back to Courses
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Featured Video URL Section -->
                @if($course->feature_video)
                <div class="card course-info-card mb-4">
                    <div class="card-header video-url-section">
                        <h5 class="mb-0">
                            <i class="bi bi-camera-video-fill text-warning me-2"></i>
                            Featured Video
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-1 text-muted">Video URL:</p>
                                <a href="{{ $course->feature_video }}" target="_blank" class="text-decoration-none">
                                    <i class="bi bi-link-45deg me-1"></i>
                                    {{ $course->feature_video }}
                                </a>
                            </div>
                            <a href="{{ $course->feature_video }}" target="_blank" class="btn btn-outline-primary btn-sm btn-custom">
                                <i class="bi bi-play-circle me-1"></i>
                                Watch Video
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Course Modules -->
                <div class="card course-info-card">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="bi bi-collection-fill text-primary me-2"></i>
                                Course Modules
                            </h5>
                            <span class="badge bg-primary rounded-pill">
                                {{ count($course->modules) }} {{ count($course->modules) == 1 ? 'Module' : 'Modules' }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @forelse($course->modules as $index => $module)
                        <div class="module-card">
                            <div class="module-header p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-primary rounded-circle me-3" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                            {{ $index + 1 }}
                                        </span>
                                        <h6 class="mb-0 fw-bold">{{ $module->title }}</h6>
                                    </div>
                                    <span class="badge bg-secondary rounded-pill">
                                        {{ count($module->contents) }} {{ count($module->contents) == 1 ? 'Item' : 'Items' }}
                                    </span>
                                </div>
                            </div>
                            <div class="content-list">
                                @forelse($module->contents as $content)
                                <div class="content-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="bi 
                                                @if($content->source_type === 'video') bi-play-circle-fill text-danger
                                                @elseif($content->source_type === 'document') bi-file-earmark-text-fill text-info
                                                @elseif($content->source_type === 'quiz') bi-patch-question-fill text-success
                                                @else bi-link-45deg text-warning @endif
                                                me-3"></i>
                                            <div>
                                                <h6 class="mb-0">{{ $content->title }}</h6>
                                                <small class="text-muted">{{ ucfirst($content->source_type) }} Content</small>
                                            </div>
                                        </div>
                                        <span class="badge content-type-badge
                                            @if($content->source_type === 'video') badge-video
                                            @elseif($content->source_type === 'document') badge-document
                                            @elseif($content->source_type === 'quiz') badge-quiz
                                            @else badge-link @endif">
                                            {{ ucfirst($content->source_type) }}
                                        </span>
                                    </div>
                                </div>
                                @empty
                                <div class="content-item text-center text-muted">
                                    <i class="bi bi-inbox display-6"></i>
                                    <p class="mb-0 mt-2">No content available in this module</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-collection display-4"></i>
                            <p class="mt-3 mb-0">No modules found for this course</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Course Statistics -->
                <div class="stats-card p-4 mb-4">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-graph-up text-primary me-2"></i>
                        Course Statistics
                    </h6>
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h4 class="text-primary mb-0">{{ count($course->modules) }}</h4>
                                <small class="text-muted">Modules</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success mb-0">
                                {{ $course->modules->sum(function($module) { return count($module->contents); }) }}
                            </h4>
                            <small class="text-muted">Content Items</small>
                        </div>
                    </div>
                </div>

                <!-- Content Types Breakdown -->
                <div class="stats-card p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-pie-chart text-info me-2"></i>
                        Content Types
                    </h6>
                    @php
                        $contentTypes = [];
                        foreach($course->modules as $module) {
                            foreach($module->contents as $content) {
                                $type = $content->source_type;
                                $contentTypes[$type] = ($contentTypes[$type] ?? 0) + 1;
                            }
                        }
                    @endphp
                    
                    @forelse($contentTypes as $type => $count)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <i class="bi 
                                @if($type === 'video') bi-play-circle-fill text-danger
                                @elseif($type === 'document') bi-file-earmark-text-fill text-info
                                @elseif($type === 'quiz') bi-patch-question-fill text-success
                                @else bi-link-45deg text-warning @endif
                                me-2"></i>
                            <span class="text-capitalize">{{ $type }}s</span>
                        </div>
                        <span class="badge bg-light text-dark">{{ $count }}</span>
                    </div>
                    @empty
                    <p class="text-muted mb-0">No content available</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <!-- <div class="action-buttons p-4 mt-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary btn-custom">
                        <i class="bi bi-arrow-left me-2"></i>Back to Course List
                    </a>
                </div>
                <div class="col-md-6 text-md-end">
                    <button class="btn btn-warning btn-custom me-2">
                        <i class="bi bi-pencil-square me-2"></i>Edit Course
                    </button>
                    <button class="btn btn-success btn-custom">
                        <i class="bi bi-people-fill me-2"></i>Manage Students
                    </button>
                </div>
            </div>
        </div> -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>