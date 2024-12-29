    <title>Create Post</title>

    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Include the main layout -->
    @extends('layouts.master')

    @section('content')
    
    <div class="container-fluid px-4">

        <div class="card mt-4">
            <div class="card-header">
                <h4 class="float-start">Add Posts</h4>
              
            </div>
    
            <div class="card-body">
    
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
        
                <!-- Form to create a post -->
                <form method="POST" action="{{ route('admin.add-post') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Post Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="faculty">Category</label>
                        <select id="faculty" name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="form-group">
                        <label for="subcategory">Level</label>
                        <select id="subcategory" name="subcategory" class="form-control">
                        </select>
                    </div>
        
                    

                    <div class="mb-3">
                        <label for="">Slug</label>
                        <input type="text" name="slug" class="form-control">
                    </div>
    
                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea id="mySummernote" name="description" rows="5" class="form-control"></textarea>
                    </div>
    
                    <div class="mb-3">
                        <label for="">Youtube IFrame</label>
                        <input type="text" name="yt_iframe" class="form-control">
                    </div>
    
                    <h4>SEO Tags</h4>
                    <div class="mb-3">
                        <label for="">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control">
                    </div>
    
                    <div class="mb-3">
                        <label for="">Meta Description</label>
                        <textarea name="meta_description" rows="4" class="form-control"></textarea>
                    </div>
    
                    <div class="mb-3">
                        <label for="">Meta Keywords</label>
                        <input type="text" name="meta_keyword" class="form-control">
                    </div>
    
                    <h4>Status</h4>
                    <div class="row">
                        <div class="col-mod-4">
                            <div class="mb-3">
                                <input type="checkbox" name="status">
                                <label for="">Status</label>
                            </div>
                        </div>
                    </div>
        
        
        
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Create Post</button>
                </form>
            </div>

        </div>
    

    <!-- Script to handle dynamic level fetching -->
    <script>

        // Listen for changes in the category dropdown
        document.getElementById('faculty').addEventListener('change', function () {
            var categoryId = this.value;  // Get selected category ID
            // console.log(categoryId);
            var subcategorySelect = document.getElementById('subcategory');

            // Clear previous levels
            subcategorySelect.innerHTML = '<option value="">Select Level</option>';

            // If no category is selected, stop the process
            if (!categoryId) return;

            // Fetch levels for the selected category
            fetch(`/admin/get-levels/${categoryId}`)
        .then(response => response.json())
        .then(data => {
            // Check if the response contains data (levels)
            if (Array.isArray(data) && data.length > 0) {
                // Loop through the levels array and create option elements
                data.forEach(level => {
                    var option = document.createElement('option');
                    option.value = level.id;  // Set the value as level ID
                    option.textContent = level.name;  // Set the display text as level name
                    subcategorySelect.appendChild(option);  // Append to the subcategory select element
                });
            } else {
                // If no levels found, show a message in the dropdown
                subcategorySelect.innerHTML = '<option value="">No levels available</option>';
            }
        })
        .catch(error => {
            // Handle error, show message in case of failure
            console.error('Error fetching levels:', error);
            subcategorySelect.innerHTML = '<option value="">Error fetching levels</option>';
        });
        });
    </script>
    @endsection

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
