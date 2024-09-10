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

        <!-- Explanation for Project Search -->
        <p>Use the search box below to quickly find a project by typing its name:</p>

        <input type="text" class="form-control mb-3" id="search-projects" placeholder="Search Projects...">
        <button class="btn btn-success mb-3" id="create-project-btn">Create New Project</button>
        <button class="btn btn-danger mb-3 float-end" id="logout-btn">Logout</button> <!-- Logout Button -->
        <ul id="projects-list" class="list-group mb-4">
            <!-- Projects will be listed here -->
        </ul>
    </div>


    <!-- Project Details Section -->
    <div id="project-details-section" class="mt-4" style="display: none;">
        <h3>Project Tasks</h3>
        <button class="btn btn-secondary mb-3" id="back-to-projects-btn">Back to Projects</button>
        <h4>Tasks for Project: <span id="project-name"></span></h4>

        <!-- Explanation for Task Search and Status Filter -->
        <p>Search for a task by name or filter tasks based on their current status:</p>

        <!-- Task Search and Filter -->
        <input type="text" class="form-control mb-3" id="search-tasks" placeholder="Search Tasks...">
        <select class="form-select mb-3" id="task-status-filter">
            <option value="all">All</option>
            <option value="todo">Todo</option>
            <option value="in-progress">In Progress</option>
            <option value="done">Done</option>
        </select>

        <button class="btn btn-success mb-3" id="create-task-btn">Add New Task</button>
        <ul id="tasks-list" class="list-group">
            <!-- Tasks will be listed here -->
        </ul>
    </div>

</div>

<!-- Modal for Updating Project -->
<div class="modal fade" id="updateProjectModal" tabindex="-1" aria-labelledby="updateProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProjectModalLabel">Update Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update-project-form">
                    <div class="mb-3">
                        <label for="update-project-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="update-project-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="update-project-description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="update-project-description" required>
                    </div>
                    <input type="hidden" id="update-project-id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update-project-confirm-btn">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Updating Task -->
<div class="modal fade" id="updateTaskModal" tabindex="-1" aria-labelledby="updateTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateTaskModalLabel">Update Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update-task-form">
                    <div class="mb-3">
                        <label for="update-task-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="update-task-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="update-task-description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="update-task-description" required>
                    </div>
                    <div class="mb-3">
                        <label for="update-task-status" class="form-label">Status</label>
                        <select class="form-control" id="update-task-status" required>
                            <option value="todo">Todo</option>
                            <option value="in-progress">In Progress</option>
                            <option value="done">Done</option>
                        </select>
                    </div>
                    <input type="hidden" id="update-task-id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update-task-confirm-btn">Update</button>
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

<!-- Modal for Creating New Project -->
<div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProjectModalLabel">Create New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-project-form">
                    <div class="mb-3">
                        <label for="project-name-for-modal" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="project-name-for-modal" required>
                    </div>
                    <div class="mb-3">
                        <label for="project-description" class="form-label">Project Description</label>
                        <input type="text" class="form-control" id="project-description" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save-project-btn">Save Project</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Creating New Task -->
<div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaskModalLabel">Create New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-task-form">
                    <div class="mb-3">
                        <label for="task-name" class="form-label">Task Name</label>
                        <input type="text" class="form-control" id="task-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="task-description" class="form-label">Task Description</label>
                        <input type="text" class="form-control" id="task-description" required>
                    </div>
                    <div class="mb-3">
                        <label for="task-status" class="form-label">Task Status</label>
                        <select class="form-control" id="task-status" required>
                            <option value="todo">Todo</option>
                            <option value="in-progress">In Progress</option>
                            <option value="done">Done</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save-task-btn">Save Task</button>
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
    let updateId = null; // Variable to store the ID of the item to update
    let updateType = null; // Variable to store whether it's a project or task
    let deleteId = null; // Variable to store the ID of the item to delete
    let deleteType = null; // Variable to store whether it's a project or task

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

    // Function to fetch all projects and filter by search term
    function fetchProjects() {
        axios.get('/api/projects', {
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function (response) {
                const projectsList = document.getElementById('projects-list');
                const searchValue = document.getElementById('search-projects').value.toLowerCase();
                projectsList.innerHTML = ''; // Clear existing projects

                response.data
                    .filter(project => project.name.toLowerCase().includes(searchValue)) // Filter by search term
                    .forEach(function (project) {
                        const li = document.createElement('li');
                        li.classList.add('list-group-item');
                        li.innerHTML = `
                <span><strong>${project.name}</strong> <small>${project.description}</small></span>
                <div class="float-end">
                    <button class="btn btn-info btn-sm me-2" onclick="viewProjectDetails(${project.id}, '${project.name}')">View</button>
                    <button class="btn btn-warning btn-sm me-2" onclick="openUpdateProjectModal(${project.id}, '${project.name}', '${project.description}')">Update</button>
                    <button class="btn btn-danger btn-sm" onclick="openDeleteModal(${project.id}, 'project')">Delete</button>
                </div>
                `;
                        projectsList.appendChild(li);
                    });
            })
            .catch(function (error) {
                console.error('Failed to fetch projects:', error);
            });
    }

    // Open the update modal for a project
    function openUpdateProjectModal(id, name, description) {
        document.getElementById('update-project-name').value = name;
        document.getElementById('update-project-description').value = description;
        updateId = id; // Store the project ID to update

        // Show the project update modal
        const updateProjectModal = new bootstrap.Modal(document.getElementById('updateProjectModal'));
        updateProjectModal.show();
    }

    // Open the update modal for a task
    function openUpdateTaskModal(id, name, description, status) {
        document.getElementById('update-task-name').value = name;
        document.getElementById('update-task-description').value = description;
        document.getElementById('update-task-status').value = status;
        updateId = id; // Store the task ID to update

        // Show the task update modal
        const updateTaskModal = new bootstrap.Modal(document.getElementById('updateTaskModal'));
        updateTaskModal.show();
    }

    // Update project on confirmation
    document.getElementById('update-project-confirm-btn').addEventListener('click', function() {
        const updatedName = document.getElementById('update-project-name').value;
        const updatedDescription = document.getElementById('update-project-description').value;

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
                const updateProjectModal = bootstrap.Modal.getInstance(document.getElementById('updateProjectModal'));
                updateProjectModal.hide();
                fetchProjects(); // Refresh projects after update
            })
            .catch(function(error) {
                console.error('Failed to update project:', error);
            });
    });

    // Update task on confirmation
    document.getElementById('update-task-confirm-btn').addEventListener('click', function() {
        const updatedName = document.getElementById('update-task-name').value;
        const updatedDescription = document.getElementById('update-task-description').value;
        const updatedStatus = document.getElementById('update-task-status').value;

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
                const updateTaskModal = bootstrap.Modal.getInstance(document.getElementById('updateTaskModal'));
                updateTaskModal.hide();
                fetchTasks(); // Refresh tasks after update
            })
            .catch(function(error) {
                console.error('Failed to update task:', error);
            });
    });

    // Open delete confirmation modal
    function openDeleteModal(id, type) {
        deleteId = id; // Store the ID to delete
        deleteType = type; // Store the type of the item (either 'project' or 'task')
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    // Confirm and perform deletion of a project or task
    document.getElementById('delete-confirm-btn').addEventListener('click', function() {
        let deleteUrl = '';

        if (deleteType === 'project') {
            deleteUrl = `/api/projects/${deleteId}`; // Delete project endpoint
        } else if (deleteType === 'task') {
            deleteUrl = `/api/tasks/${deleteId}`; // Delete task endpoint
        }

        axios.delete(deleteUrl, {
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function(response) {
                alert('Deleted successfully!');
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                deleteModal.hide();

                // Refresh projects or tasks based on the deleteType
                if (deleteType === 'project') {
                    fetchProjects();
                } else if (deleteType === 'task') {
                    fetchTasks();
                }
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

    // Function to fetch tasks for the current project and filter by search term and status
    function fetchTasks() {
        axios.get(`/api/tasks?project_id=${currentProjectId}`, {
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function (response) {
                const tasksList = document.getElementById('tasks-list');
                const searchValue = document.getElementById('search-tasks').value.toLowerCase();
                const statusFilter = document.getElementById('task-status-filter').value;

                tasksList.innerHTML = ''; // Clear existing tasks

                response.data
                    .filter(task => task.name.toLowerCase().includes(searchValue)) // Filter by search term
                    .filter(task => statusFilter === 'all' || task.status === statusFilter) // Filter by status
                    .forEach(function (task) {
                        // Determine the badge class based on the task status
                        let badgeClass = '';

                        if (task.status === 'todo') {
                            badgeClass = 'badge bg-warning'; // For 'todo' status
                        } else if (task.status === 'in-progress') {
                            badgeClass = 'badge bg-danger'; // For 'in-progress' status
                        } else if (task.status === 'done') {
                            badgeClass = 'badge bg-success'; // For 'done' status
                        }

                        const li = document.createElement('li');
                        li.classList.add('list-group-item');
                        li.innerHTML = `
                <span><strong>${task.name}</strong> <small>${task.description}</small> - <span class="${badgeClass}">${task.status}</span></span>
                <div class="float-end">
                    <button class="btn btn-warning btn-sm me-2" onclick="openUpdateTaskModal(${task.id}, '${task.name}', '${task.description}', '${task.status}')">Update</button>
                    <button class="btn btn-danger btn-sm" onclick="openDeleteModal(${task.id}, 'task')">Delete</button>
                </div>
                `;
                        tasksList.appendChild(li);
                    });
            })
            .catch(function (error) {
                console.error('Failed to fetch tasks:', error);
            });
    }


    document.getElementById('create-task-btn').addEventListener('click', function() {
        const createTaskModal = new bootstrap.Modal(document.getElementById('createTaskModal'));
        createTaskModal.show();
    });

    document.getElementById('back-to-projects-btn').addEventListener('click', function() {
        document.getElementById('project-details-section').style.display = 'none';
        document.getElementById('projects-section').style.display = 'block';
    });

    document.getElementById('save-task-btn').addEventListener('click', function() {
        const taskName = document.getElementById('task-name').value;
        const taskDescription = document.getElementById('task-description').value;
        const taskStatus = document.getElementById('task-status').value;

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
                    const createTaskModal = bootstrap.Modal.getInstance(document.getElementById('createTaskModal'));
                    createTaskModal.hide();
                    fetchTasks(); // Refresh task list after creation
                })
                .catch(function(error) {
                    console.error('Failed to create task:', error);
                });
        } else {
            alert('Please fill in all fields.');
        }
    });

    document.getElementById('create-project-btn').addEventListener('click', function() {
        const createProjectModal = new bootstrap.Modal(document.getElementById('createProjectModal'));
        createProjectModal.show();
    });

    document.getElementById('save-project-btn').addEventListener('click', function() {
        const projectName = document.getElementById('project-name-for-modal').value;
        const projectDescription = document.getElementById('project-description').value;

        if (projectName && projectDescription) {
            axios.post('/api/projects', {
                name: projectName,
                description: projectDescription
            }, {
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            })
                .then(function(response) {
                    alert('Project created successfully!');
                    const createProjectModal = bootstrap.Modal.getInstance(document.getElementById('createProjectModal'));
                    createProjectModal.hide();
                    fetchProjects(); // Refresh project list after creation
                })
                .catch(function(error) {
                    console.error('Failed to create project:', error);
                });
        } else {
            alert('Please fill in both the project name and description.');
        }
    });

    // Logout event listener
    document.getElementById('logout-btn').addEventListener('click', function() {
        axios.post('/api/logout', {}, {
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function(response) {
                alert('You have been logged out successfully!');
                token = null; // Clear the token

                // Hide the projects section and show the login form
                document.getElementById('projects-section').style.display = 'none';
                document.getElementById('login-section').style.display = 'block';
            })
            .catch(function(error) {
                console.error('Failed to logout:', error);
            });
    });

    document.getElementById('search-projects').addEventListener('input', fetchProjects);
    document.getElementById('search-tasks').addEventListener('input', fetchTasks);
    document.getElementById('task-status-filter').addEventListener('change', fetchTasks);

</script>

</body>
</html>
