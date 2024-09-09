<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Project Dashboard</h1>

    <!-- Login Form -->
    <div id="login-section" class="mt-4">
        <h3>Login</h3>
        <form id="login-form">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <div id="login-error" class="text-danger mt-2" style="display: none;"></div>
    </div>

    <!-- Projects Section -->
    <div id="projects-section" class="mt-4" style="display: none;">
        <h3>Your Projects</h3>
        <button class="btn btn-success mb-3" id="create-project-btn">Create New Project</button>
        <ul id="projects-list" class="list-group mb-4">
            <!-- Projects will be listed here -->
        </ul>
    </div>

    <!-- Project Details Section -->
    <div id="project-details-section" class="mt-4" style="display: none;">
        <h3>Project Tasks</h3>
        <button class="btn btn-secondary mb-3" id="back-to-projects-btn">Back to Projects</button>
        <h4>Tasks for Project: <span id="project-name"></span></h4>
        <button class="btn btn-success mb-3" id="create-task-btn">Add New Task</button>
        <ul id="tasks-list" class="list-group">
            <!-- Tasks will be listed here -->
        </ul>
    </div>
</div>

<!-- Modal for Update -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="mb-3">
                        <label for="update-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="update-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="update-description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="update-description" required>
                    </div>
                    <input type="hidden" id="update-id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update-confirm-btn">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Delete Confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="delete-confirm-btn">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS + Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<!-- Axios for API requests -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    let token = null; // Variable to store the token
    let currentProjectId = null; // Variable to store the current project ID
    let deleteId = null; // Variable to store the ID of the item to delete
    let updateId = null; // Variable to store the ID of the item to update

    document.getElementById('login-form').addEventListener('submit', function (event) {
        event.preventDefault();
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        axios.post('/api/login', {
            email: email,
            password: password
        })
            .then(function (response) {
                token = response.data.token; // Store the token

                // Hide login form and show the projects section
                document.getElementById('login-section').style.display = 'none';
                document.getElementById('projects-section').style.display = 'block';

                fetchProjects(); // Fetch all projects
            })
            .catch(function (error) {
                document.getElementById('login-error').textContent = 'Login failed! Please check your credentials.';
                document.getElementById('login-error').style.display = 'block';
            });
    });

    // Function to fetch all projects
    function fetchProjects() {
        axios.get('/api/projects', {
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function (response) {
                const projectsList = document.getElementById('projects-list');
                projectsList.innerHTML = ''; // Clear existing projects
                response.data.forEach(function (project) {
                    const li = document.createElement('li');
                    li.classList.add('list-group-item');
                    li.innerHTML = `
                    <span>${project.name}</span>
                    <button class="btn btn-warning btn-sm float-end" onclick="openUpdateModal(${project.id}, '${project.name}', '${project.description}')">Update</button>
                    <button class="btn btn-danger btn-sm float-end me-2" onclick="openDeleteModal(${project.id}, 'project')">Delete</button>
                    <button class="btn btn-info btn-sm float-end me-2" onclick="viewProjectDetails(${project.id}, '${project.name}')">View</button>
                `;
                    projectsList.appendChild(li);
                });
            })
            .catch(function (error) {
                console.error('Failed to fetch projects:', error);
            });
    }

    // Function to open the update modal with existing project data
    function openUpdateModal(id, name, description) {
        document.getElementById('update-name').value = name;
        document.getElementById('update-description').value = description;
        updateId = id; // Store the project ID to update
        const updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
        updateModal.show();
    }

    // Update project on confirmation
    document.getElementById('update-confirm-btn').addEventListener('click', function() {
        const updatedName = document.getElementById('update-name').value;
        const updatedDescription = document.getElementById('update-description').value;

        axios.put(`/api/projects/${updateId}`, {
            name: updatedName,
            description: updatedDescription
        }, {
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function(response) {
                alert('Project updated successfully!');
                const updateModal = bootstrap.Modal.getInstance(document.getElementById('updateModal'));
                updateModal.hide();
                fetchProjects();
            })
            .catch(function(error) {
                console.error('Failed to update project:', error);
            });
    });

    // Open delete confirmation modal
    function openDeleteModal(id, type) {
        deleteId = id; // Store the project or task ID to delete
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    // Confirm and perform deletion of a project or task
    document.getElementById('delete-confirm-btn').addEventListener('click', function() {
        axios.delete(`/api/projects/${deleteId}`, {
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function(response) {
                alert('Deleted successfully!');
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                deleteModal.hide();
                fetchProjects();
            })
            .catch(function(error) {
                console.error('Failed to delete:', error);
            });
    });

    // Function to view project details and list tasks
    function viewProjectDetails(projectId, projectName) {
        currentProjectId = projectId; // Store current project ID
        document.getElementById('projects-section').style.display = 'none';
        document.getElementById('project-details-section').style.display = 'block';
        document.getElementById('project-name').textContent = projectName;

        fetchTasks(); // Fetch tasks for the selected project
    }

    // Function to fetch tasks for the current project
    function fetchTasks() {
        axios.get(`/api/tasks?project_id=${currentProjectId}`, {
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function (response) {
                const tasksList = document.getElementById('tasks-list');
                tasksList.innerHTML = ''; // Clear existing tasks
                response.data.forEach(function (task) {
                    const li = document.createElement('li');
                    li.classList.add('list-group-item');
                    li.innerHTML = `
                <span>${task.name} - ${task.status}</span>
                <button class="btn btn-warning btn-sm float-end" onclick="openUpdateTaskModal(${task.id}, '${task.name}', '${task.description}', '${task.status}')">Update</button>
                <button class="btn btn-danger btn-sm float-end me-2" onclick="openDeleteModal(${task.id}, 'task')">Delete</button>
            `;
                    tasksList.appendChild(li);
                });
            })
            .catch(function (error) {
                console.error('Failed to fetch tasks:', error);
            });
    }


    // Open modal to update a task
    function openUpdateTaskModal(id, name, description, status) {
        document.getElementById('update-name').value = name;
        document.getElementById('update-description').value = description;
        document.getElementById('update-status').value = status;
        updateId = id; // Store the task ID
        const updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
        updateModal.show();
    }


    // Back to project list
    document.getElementById('back-to-projects-btn').addEventListener('click', function() {
        document.getElementById('project-details-section').style.display = 'none';
        document.getElementById('projects-section').style.display = 'block';
    });

    // Create a new project
    document.getElementById('create-project-btn').addEventListener('click', function() {
        const projectName = prompt('Enter project name:');
        if (projectName) {
            axios.post('/api/projects', {
                name: projectName,
                description: 'New project description'
            }, {
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            })
                .then(function(response) {
                    alert('Project created successfully!');
                    fetchProjects();
                })
                .catch(function(error) {
                    console.error('Failed to create project:', error);
                });
        }
    });

    // Create a new task
    document.getElementById('create-task-btn').addEventListener('click', function() {
        const taskName = prompt('Enter task name:');
        const taskDescription = prompt('Enter task description:');
        const taskStatus = prompt('Enter task status (todo, in-progress, done):');
        if (taskName && taskDescription && taskStatus) {
            axios.post('/api/tasks', {
                project_id: currentProjectId,
                name: taskName,
                description: taskDescription,
                status: taskStatus
            }, {
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            })
                .then(function(response) {
                    alert('Task created successfully!');
                    fetchTasks();
                })
                .catch(function(error) {
                    console.error('Failed to create task:', error);
                });
        }
    });

    // Update a task on confirmation
    document.getElementById('update-confirm-btn').addEventListener('click', function() {
        const updatedName = document.getElementById('update-name').value;
        const updatedDescription = document.getElementById('update-description').value;
        const updatedStatus = prompt('Enter task status (todo, in-progress, done):');

        axios.put(`/api/tasks/${updateId}`, {
            name: updatedName,
            description: updatedDescription,
            status: updatedStatus
        }, {
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function(response) {
                alert('Task updated successfully!');
                const updateModal = bootstrap.Modal.getInstance(document.getElementById('updateModal'));
                updateModal.hide();
                fetchTasks(); // Refresh tasks after update
            })
            .catch(function(error) {
                console.error('Failed to update task:', error);
            });
    });

</script>

</body>
</html>
