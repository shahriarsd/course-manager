<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Course</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1e293b;
            color: white;
            padding: 2rem;
        }

        .form-control,
        .form-select {
            background-color: #334155;
            color: white;
            border: 1px solid #475569;
        }

        .form-control::placeholder {
            color: #cbd5e1;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }

        .module-block,
        .content-block {
            background-color: #1e293b;
            border: 1px solid #475569;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            position: relative;
        }

        .remove-btn {
            position: absolute;
            top: 0.25rem;
            right: 0.5rem;
            color: #f87171;
            font-size: 1.25rem;
            border: none;
            background: transparent;
        }
    </style>
</head>

<body>
    <div class="container">

        <h1 class="mb-4">Create a Course</h1>

        <a href="{{ route('courses.index') }}" class="text-info text-decoration-none mb-3 d-block">&lt; Back to Course Page</a>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form id="courseForm" action="{{ route('courses.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="title" class="form-label">Course Title *</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter course title" required>
                </div>
                <div class="col-md-6">
                    <label for="feature_video" class="form-label">Feature Video URL</label>
                    <input type="url" class="form-control" name="feature_video" id="feature_video" placeholder="Enter feature video URL">
                </div>
            </div>

             <div class="row mb-3">
                <div class="col-md-6">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="Enter description">
                </div>
                <div class="col-md-6">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" name="category" id="category" placeholder="Enter category">
                </div>
            </div>

            <button type="button" class="btn btn-primary mb-3" onclick="addModule()">Add Module +</button>

            <div id="modules-container"></div>

            <!-- <button type="button" class="btn btn-primary mb-3" onclick="addModule()">Add Module +</button> -->

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>

    <script>
        let moduleIndex = 0;

        function addModule() {
            const moduleHTML = `
            <div class="module-block" id="module-${moduleIndex}">
                <button type="button" class="remove-btn" onclick="document.getElementById('module-${moduleIndex}').remove()">&times;</button>
                <h5 class="mb-3">Module ${moduleIndex + 1}</h5>

                 <button type="button" class="btn btn-sm btn-secondary mb-2" onclick="addContent(${moduleIndex})">Add Content +</button>

                <div class="mb-3">
                 <label>Module Title *</label>
                    <input type="text" name="modules[${moduleIndex}][title]" class="form-control" required>
                </div>

                <div id="module-${moduleIndex}-contents"></div>

            </div>
        `;

            $('#modules-container').append(moduleHTML);
            moduleIndex++;
        }

        function addContent(moduleIdx) {
            const contentCount = $(`#module-${moduleIdx}-contents .content-block`).length;
            const contentHTML = `
            <div class="content-block">
                <button type="button" class="remove-btn" onclick="this.closest('.content-block').remove()">&times;</button>
                <div class="mb-2">
                <label>Content Title *</label>
                    <input type="text" name="modules[${moduleIdx}][contents][${contentCount}][title]" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Video Source Type *</label>
                    <select name="modules[${moduleIdx}][contents][${contentCount}][source_type]" class="form-select" required>
                        <option value="">Choose...</option>
                        <option value="youtube">YouTube</option>
                        <option value="drive"> Drive</option>
                        <option value="upload">Upload</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label>Video URL</label>
                    <input type="url" name="modules[${moduleIdx}][contents][${contentCount}][video_url]" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Video Length (HH:MM:SS)</label>
                    <input type="text" name="modules[${moduleIdx}][contents][${contentCount}][video_length]" class="form-control">
                </div>
            </div>
        `;
            $(`#module-${moduleIdx}-contents`).append(contentHTML);
        }

        $(document).ready(function() {
            $('#courseForm').validate({
                errorClass: 'text-danger',
                rules: {
                    title: 'required'
                },
                messages: {
                    title: 'Course title is required.'
                }
            });
        });
    </script>
</body>

</html>