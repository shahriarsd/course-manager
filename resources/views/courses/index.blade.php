<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">Course List</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>SL</th>
                <th>Course Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Modules</th>
                <th>Contents</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($courses as $index => $course)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $course->title }}</td>
                <td>{{ $course->description ?? '' }}</td>
                <td>{{ $course->category ?? '' }}</td>
                <td>
                    @foreach($course->modules as $module)
                        <span class="badge bg-primary">{{ $module->title }}</span>
                    @endforeach
                </td>
                <td>
                    @foreach($course->modules as $module)
                        @foreach($module->contents as $content)
                            <span class="badge bg-secondary">{{ $content->title }}</span>
                        @endforeach
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('courses.show', $course->id) }}" class="btn btn-sm btn-info">View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html> -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Course List</h3>
        <a href="{{ route('courses.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add Course
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>SL</th>
                <th>Course Title</th>
                <th>Modules</th>
                <th>Contents</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse($courses as $index => $course)
            <tr>
                <td>{{ ($courses->currentPage() - 1) * $courses->perPage() + $index + 1 }}</td>
                <td>{{ $course->title }}</td>
                <td>
                    @foreach($course->modules as $module)
                        <span class="badge bg-primary mb-1">{{ $module->title }}</span>
                    @endforeach
                </td>
                <td>
                    @foreach($course->modules as $module)
                        @foreach($module->contents as $content)
                            <span class="badge bg-secondary mb-1">{{ $content->title }}</span>
                        @endforeach
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('courses.show', $course->id) }}" class="btn btn-sm btn-outline-info" title="View Course">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No courses found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $courses->links('pagination::bootstrap-5') }}
    </div>
</div>
</body>
</html>
